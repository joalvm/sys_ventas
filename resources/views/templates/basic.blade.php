<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
        @stack('head')
    </head>
    <body class="antialiased">
        <main class="container">@yield('content')</main>
    </body>
</html>
@include('layouts/post_html')
@stack('post_html')
