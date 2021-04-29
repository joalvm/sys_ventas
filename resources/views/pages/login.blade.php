@extends('templates.basic')

@section('title', 'Login')

@section('content')
    <form class="form-signin">
        <!--<img class="mb-4" src="" alt="" width="72" height="72">-->
        <br><br>
        <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
        <div class="form-group">
            <label for="txtusername" class="sr-only">Usuario</label>
            <input type="email" id="txtusername" name="username" class="form-control" placeholder="Usuario" required autofocus>
        </div>
        <div class="form-group">
            <label for="txtpassword" class="sr-only">contraseña</label>
            <input type="password" id="txtpassword" name="password" class="form-control" placeholder="Contraseña" required>
        </div>
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Mantener sesión activa.</label>
        </div>
        <br>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
        </div>
        <hr>
        <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-{{ date('Y') }}</p>
    </form>
@endsection

@push('post_html')
<link rel="stylesheet" href="static/css/login.css">
@endpush
