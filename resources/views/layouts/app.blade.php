<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/icon.png">

    <title>@yield('Title', 'Сама собі зірка')</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->

</head>
<body class="">
<div id="app">
    <router-view></router-view>
</div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
