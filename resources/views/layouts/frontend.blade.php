<!DOCTYPE html>
<html dir="{{ Locales::getDir() }}" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="PUSHER_APP_KEY" content="{{ config('broadcasting.connections.pusher.key') }}">
        <meta name="PUSHER_APP_CLUSTER" content="{{ config('broadcasting.connections.pusher.options.cluster') }}">
        <meta name="PUSHER_APP_HOST" content="{{ config('broadcasting.connections.pusher.options.host') }}">
        <meta name="PUSHER_APP_PORT" content="{{ config('broadcasting.connections.pusher.options.port') }}">

        <title>{{ isset($title) ? $title .' | '. Settings::get('title', config('app.name')) : Settings::get('title', config('app.name')) }}</title>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/app.css')) }}">
        @stack('styles')
    </head>
    <body class="{{ $class ?? '' }}">
        <div id="app">
            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset(mix('js/app.js')) }}" type="text/javascript"></script>
        @stack('scripts')
    </body>
</html>
