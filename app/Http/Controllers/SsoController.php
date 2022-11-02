<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;

class SsoController extends Controller
{

    protected $server = 'https://ssodev.jabarprov.go.id:8443/auth/',
              $clientId= 'devs',
              $redirect = 'http://portal.test/portal';
				
        
    public function konek(){
        $url = 'https://ssodev.jabarprov.go.id:8443/auth/realms/ssojabar/protocol/openid-connect/auth?response_type=code&client_id=devs&redirect_uri=http://portal.test/portal';
        return redirect($url);
        
    }

    
    public function authsso (){
		$code =  $_GET['code'];
		$curl = curl_init();
 curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://ssodev.jabarprov.go.id:8443/auth/realms/ssojabar/protocol/openid-connect/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=authorization_code&client_id=devs&client_secret=b8ff6695-08b9-4ca0-976f-fd7a64451a22&code='.$code.'&redirect_uri=http://portal.test/portal',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$data= json_decode($response);
$access_token= $data->access_token;

$ch = curl_init('https://ssodev.jabarprov.go.id:8443/auth/realms/ssojabar/protocol/openid-connect/userinfo');
        
    $headers = array(
      'Content-Type: application/x-www-form-urlencoded',
      'Authorization: Bearer '.$access_token
  );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
    /* set return type json */
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
    /* execute request */
    $result = curl_exec($ch);
         
    /* close cURL resource */
    curl_close($ch);
    $profil = json_decode($result);
    Session::put('nama', $profil->name);
    Session::put('username', $profil->preferred_username);
        return view('portal',[
			'user' => $profil,
      'at' => $data
				]);
    }

	public function keluar(){
		Session::flush();
    return redirect('https://ssodev.jabarprov.go.id:8443/auth/realms/ssojabar/protocol/openid-connect/logout?redirect_uri=http://portal.test');
	}


}
