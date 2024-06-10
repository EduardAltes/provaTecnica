<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" > --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div style="margin-top: 50px"class="container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="username">Username</label>
                <input class="form-group" id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
            </div>

            <div>
                <label for="password">Password</label>
                <input class="form-group" id="password" type="password" name="password" required autocomplete="current-password">
            </div>
            <div>
                <button class="btn btn-primary" type="submit">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>
