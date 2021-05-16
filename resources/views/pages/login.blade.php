@extends('templates.basic')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-3"></div>
        <form action="{{ url('login') }}" method="POST" class="col-lg-4 col-md-6">
            <div class="card card-login shadow-sm">
                <div class="card-header">
                    <h3 class="h3 mt-3">Iniciar Sesión</h3>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Ha ocurrido un error!</strong>
                            @foreach($errors->all() as $error)
                                <div>- {{ $error }}</div>
                            @endforeach
                            <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close"
                                >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="txtusername" class="sr-only">Usuario</label>
                        <input type="text" id="txtusername" name="username" class="form-control form-control-lg" placeholder="Nombre de Usuario" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="txtpassword" class="sr-only">contraseña</label>
                        <input type="password" id="txtpassword" name="password" class="form-control form-control-lg" placeholder="Contraseña" required>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input custom-control-input-lg" id="chk_rememberme">
                        <label class="custom-control-label" for="chk_rememberme">Mantener sesión activa.</label>
                    </div>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary btn-block" type="submit">ACCEDER</button>
                    <p class="text-center mt-2 mb-2">ó</p>
                    <a href="{{url('register')}}" class="btn btn-outline-primary btn-block" type="submit">REGISTRARME</a>
                </div>
            </div>
            @csrf()
            <br>
            <p class="mt-2 text-muted text-center">&copy; {{ date('Y') }}</p>
            <pre>@json(session()->all(), JSON_PRETTY_PRINT)</pre>
            <pre>@json(DB::getQueryLog(), JSON_PRETTY_PRINT)</pre>
        </form>
    </div>

@endsection

@push('post_html')
<link rel="stylesheet" href="static/css/login.css">
@endpush
