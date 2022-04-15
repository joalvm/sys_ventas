@extends('templates.basic')

@section('title', 'Registro')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <form action="{{ url('register') }}" id="frm-register" method="POST" class="col-lg-6 col-md-8">
            <div class="card card-register shadow-sm">
                <div class="card-header">
                    <h3 class="h3 mt-3">Registrarme</h3>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Ha ocurrido un error!</strong>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="txtname" name="name" value="{{ old('name') }}" class="form-control" required max="80" placeholder="Nombres" autofocus />
                                <label for="txtname">Nombres</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="txtlastname" name="lastname" value="{{ old('lastname') }}" class="form-control" required max="80" placeholder="Apellidos" />
                                <label for="txtlastname">Apellidos</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="email" id="txtemail" name="email" value="{{ old('email') }}" class="form-control" required placeholder="Correo Electrónico" />
                                <label for="txtemail">Correo Electrónico</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-floating mb-3">
                                <select id="cbogener" name="gender" class="form-select" required placeholder="Genero">
                                    <option {{ old('gender') ?? 'selected' }} disabled>Seleccione...</option>
                                    <option
                                        value="{{ \App\Models\Persons::GENDER_FEMALE }}"
                                        {{ old('gender') === \App\Models\Persons::GENDER_FEMALE ? 'selected' : '' }}
                                        >Femenino</option>
                                    <option
                                        value="{{ \App\Models\Persons::GENDER_MALE }}"
                                        {{ old('gender') === \App\Models\Persons::GENDER_MALE ? 'selected' : '' }}
                                        >Masculino</option>
                                </select>
                                <label for="cbogender">Genero</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div class="form-floating mb-3">
                                <input type="text" id="txtusername" name="username" value="{{ old('username') }}" class="form-control" required max="15" placeholder="Usuario" />
                                <label for="txtusername">Usuario</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" id="txtpassword" name="password" value="{{ old('password') }}" class="form-control" required placeholder="Contraseña" />
                                <label for="txtpassword">Contraseña</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" id="txtretry_password" name="retry_password" value="{{ old('retry_password') }}" class="form-control" required placeholder="Confirmar Contraseña" />
                                <label for="txtretry_password">Confirmar Contraseña</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="submit" id="btn-submit" class="btn btn-primary">
                            <span>REGISTRARME</span>
                        </button>
                        <p class="text-center mb-0">ó</p>
                        <a href="{{ url('login') }}" class="btn btn-outline-primary">
                            <span>Iniciar Sesión</span>
                        </a>
                    </div>
                </div>
            </div>
            @csrf()
        </form>
    </div>
@endsection

@push('post_html')
    <link rel="stylesheet" href="{{ url('static/css/register.css') }}">
    <script src="{{ url('static/js/register.js') }}"></script>
@endpush
