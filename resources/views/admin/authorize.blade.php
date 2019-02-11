<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/icon.png">

    <title>@yield('Title', 'Black Pearl')</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/auth-form.css') }}">
    <!-- Scripts -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body class="">
<div class="container">
    <div class="wrapper fadeInDown">
        <div id="formContent">

            {!! Form::open(['route' => 'authorize']) !!}

            {{ Form::text('mobile_phone', '', ['class' => 'fadeIn second', 'placeholder' => 'login']) }}

            {{ Form::text('password', '', ['class' => 'fadeIn third', 'placeholder' => 'password']) }}

            <hr>
            {{ Form::submit('Log In', ['class' => 'fadeIn fourth']) }}
            {!! Form::close() !!}

        </div>
    </div>
</div>
</body>
</html>



