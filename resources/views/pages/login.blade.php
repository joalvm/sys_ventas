@extends('templates.basic')

@section('title', 'Iniciar Sesión')

@section('content')
    <form action="{{ url('login') }}" method="POST" class="form-signin">
        @csrf()
        <h1 class="h3 mb-3 font-weight-normal text-center mb-2">Iniciar Sesión</h1>
        <div class="form-group">
            <label for="txtemail" class="sr-only">Correo Electrónico</label>
            <input type="email" id="txtemail" name="email" class="form-control" placeholder="Correo Electrónico" required autofocus>
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
            <button class="btn btn-lg btn-primary btn-block" type="submit">ACCEDER</button>
            <a href="{{url('register')}}" class="btn btn-lg btn-outline-secondary btn-block" type="submit">REGISTRARME</a>
        </div>
        <p class="mt-5 mb-3 text-muted text-center">&copy; {{ date('Y') }}</p>
    </form>
    <pre>
        @json(Request::session(), JSON_PRETTY_PRINT)
    </pre>
@endsection

@push('post_html')
<link rel="stylesheet" href="static/css/login.css">
@endpush
