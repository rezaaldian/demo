<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SsoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These     
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/login2',[LoginController::class,'index']);
Route::post('/login2',[LoginController::class,'authenticate']);

Route::get('/server',[SsoController::class,'konek']);
Route::get('/portal',[SsoController::class,'authsso']);
Route::get('/keluar',[SsoController::class,'keluar']);

