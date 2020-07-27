<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config("app.name")}}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
<div id="app">
    <transition name="fade" mode="out-in">
        <router-view></router-view>
    </transition>
</div>
@if(config('app.env') == 'local')
    <script src="{{ mix('js/main.js') }}"></script>
@else
    <script src="{{ asset('js/main.js') }}"></script>
@endif
</body>

</html>
