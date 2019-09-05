<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Resource Controller: Laravel & Vue.js</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<noscript>
    <strong>We're sorry but the application doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
</noscript>
<div id="app">
    <vue-app></vue-app>
</div>
</body>
</html>
