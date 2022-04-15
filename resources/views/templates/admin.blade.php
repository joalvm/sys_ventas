<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    @stack('head')
</head>

<body>
    <div class="container-fluid no-gutters">
        <div class="row">
            <section role="menu" class="sidebar shadow-sm">
                @include('templates/admin/sidebar')
            </section>
            <main role="main" class="main">
                <header role="heading" class="header shadow-sm">
                    @include('templates/admin/navbar')
                </header>
                <div class="main-container">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
@include('layouts/post_html')
<script src="{{ url('static/js/admin/admin.js') }}"></script>
<link rel="stylesheet" href="{{ url('static/css/admin/admin.css') }}">
@stack('post_html')
