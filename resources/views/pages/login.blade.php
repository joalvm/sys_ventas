@extends('templates.basic')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-3"></div>
        <form action="{{ url('login') }}" method="POST" class="col-lg-4 col-md-6">
            <div class="card card-login shadow-sm">
                <div class="card-header">
                    <h3 class="h3 mt-3">Iniciar Sesión</h3>
                    <p class="text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Ha ocurrido un error!</strong>
                            @foreach($errors->all() as $error)
                                <div>- {{ $error }}</div>
                            @endforeach
                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                                >
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="form-floating mb-3">
                        <input type="text" id="txtusername" name="username" class="form-control" placeholder="Nombre de Usuario" required autofocus>
                        <label for="txtusername" class="sr-only">Usuario</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" id="txtpassword" name="password" class="form-control" placeholder="Contraseña" required>
                        <label for="txtpassword" class="sr-only">contraseña</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input form-check-input-lg" id="chk_rememberme">
                        <label class="form-check-label" for="chk_rememberme">Mantener sesión activa.</label>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-block" type="submit">ACCEDER</button>
                        <p class="text-center mb-0 mt-0">ó</p>
                        <a href="{{ url('register') }}" class="btn btn-outline-primary btn-block" type="submit">REGISTRARME</a>
                    </div>
                </div>
            </div>
            @csrf()
            <br>
            <p class="mt-2 text-muted text-center">&copy; {{ date('Y') }}</p>
        </form>
    </div>

@endsection

@push('post_html')
<link rel="stylesheet" href="{{ url('static/css/login.css') }}">
@endpush
