<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    <link rel="stylesheet" href="static/css/admin.css">
    @stack('head')
</head>

<body>
    <div class="container-fluid no-gutters">
        <div class="row">
            <header role="heading" class="header bg-light shadow-sm">
                @include('templates/admin/navbar')
            </header>
            <section role="menu" class="sidebar bg-light shadow-sm">
                @include('templates/admin/sidebar')
            </section>
            <main role="main" class="main p-0">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
@include('layouts/post_html')
@stack('post_html')
