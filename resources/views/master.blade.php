<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @if (\Route::currentRouteName()=="pattern.simple")
    <meta http-equiv="refresh" content="300">
    @endif
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css.css') }}" rel="stylesheet">
    <!--<link rel="stylesheet" href="http://codepoints.net/api/font-face/Symbola.css">-->


</head>
<body
@if (Route::currentRouteName()== "pattern.simple")
class= "black"
@endif
>

        @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/js.js') }}"></script>
</body>
</html>
