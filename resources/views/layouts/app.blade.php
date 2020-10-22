<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config("app.name")}}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"/>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?version=2.0">
</head>

<body>
<div id="app">
    <transition name="flip" mode="in-out">
        <router-view></router-view>
    </transition>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7R6gDLqkVN6FvMZW89hqFlfLq7u9cHfI&libraries=places"></script>
@if(config('app.env') == 'local')
    <script src="{{ mix('js/app.js') }}"></script>
@else
    <script src="{{ asset('js/app.js') }}?version=2.0"></script>
@endif
</body>

</html>
