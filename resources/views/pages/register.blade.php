<?php
?>

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
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="txtname">Nombres</label>
                                <input type="text"
                                    id="txtname"
                                    name="name"
                                    value="{{old('name')}}"
                                    class="form-control form-control-lg"
                                    required
                                    max="80"
                                    autofocus
                                    />
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="txtlastname">Apellidos</label>
                                <input type="text"
                                    id="txtlastname"
                                    name="lastname"
                                    value="{{ old('lastname') }}"
                                    class="form-control form-control-lg"
                                    required
                                    max="80"
                                    />
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="txtemail">Email</label>
                                <input type="email"
                                    id="txtemail"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control form-control-lg"
                                    required
                                    />
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="cbogender">Genero</label>
                                <select id="cbogener" name="gender"
                                    class="form-control form-control-lg form-control form-control-lg" required>
                                    <option value="" {{ old('gender') ?? 'selected' }} disabled>Seleccione...</option>
                                    <option value="{{ Persons::GENDER_FEMALE }}" {{ old('gender') === Persons::GENDER_FEMALE ? 'selected' : '' }}>Femenino</option>
                                    <option value="{{ Persons::GENDER_MALE }}" {{ old('gender') === Persons::GENDER_MALE ? 'selected' : '' }}>Masculino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label for="txtusername">Usuario</label>
                                <input type="text"
                                    id="txtusername"
                                    name="username"
                                    value="{{ old('username') }}"
                                    class="form-control form-control-lg"
                                    required
                                    max="15" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="txtpassword">Contraseña</label>
                                <input type="password"
                                    id="txtpassword"
                                    name="password"
                                    value="{{ old('password') }}"
                                    class="form-control form-control-lg"
                                    required />
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="txtretry_password">Confirmar Contraseña</label>
                                <input type="password"
                                    id="txtretry_password"
                                    name="retry_password"
                                    value="{{ old('retry_password') }}"
                                    class="form-control form-control-lg"
                                    required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <button type="submit"
                        id="btn-submit"
                        class="btn btn-lg btn-primary btn-block"
                        >
                        <span>REGISTRARME</span>
                    </button>
                    <p class="text-center mt-2 mb-2">ó</p>
                    <a href="{{ url('login') }}"
                        class="btn btn-lg btn-outline-secondary btn-block"
                        >
                        <span>Iniciar Sesión</span>
                    </a>
                </div>
            </div>
            @csrf()
        </form>
    </div>
@endsection

@push('post_html')
    <link rel="stylesheet" href="static/css/register.css">
    <script src="static/js/register.js"></script>
@endpush
