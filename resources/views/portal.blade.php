{{-- @dd($user) --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        <li>NIP : {{ $user->preferred_username }}</li>
        <li>Nama : {{ $user->name }}</li>
        <li>Email : {{ $user->email }}</li>

    </ul>


<a href="/keluar"> LOGOUT</a>
</body>
</html>