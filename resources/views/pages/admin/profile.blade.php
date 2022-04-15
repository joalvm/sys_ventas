@extends('templates.admin')

@section('title', 'Perfil')

@section('container-type', 'container')
@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="card card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="text-center">
                                    <img src="https://thumbs.dreamstime.com/z/confident-determined-businesswoman-positive-face-expression-personal-development-motivation-concept-confident-173703186.jpg" class="rounded" style="max-width: 100%" alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-4 text-center">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="bi bi-upload mr-2"></i>
                                    <span>Cambiar Imagen</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8">
                <form class="card card-content">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Información Básica</h5>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" id="txtname" name="name" class="form-control" autofocus required placeholder="Nombres">
                                    <label for="txtname">Nombres</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" id="txtlastname" name="lastname" class="form-control" required placeholder="Apellidos">
                                    <label for="txtlastname">Apellidos</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-floating mb-3 with-reload">
                                    <select id="cbodocument_type" name="tipo_documento" class="form-select">
                                        <option disabled selected>Seleccione... con un texto muy largo para ver a donde llega</option>
                                    </select>
                                    <button type="button" class="btn btn-reload"><i class="bi bi-arrow-repeat"></i></button>
                                    <label for="cbodocument_type">Tipo de Documento</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" id="txtnro_documento" name="num_documento" class="form-control" required placeholder="N° Documento">
                                    <label for="txtnro_documento">N° Documento</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" id="txtemail" name="email" class="form-control" required placeholder="Correo Electrónico">
                                    <label for="txtemail">Correo Electrónico</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" id="txtphone" name="telefono" class="form-control" placeholder="Telefono">
                                    <label for="txtphone">Teléfono</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" id="txt_birthday" name="fecha_nacimiento" class="form-control" placeholder="F. de nacimiento">
                                    <label for="txt_birthday">F. de nacimiento</label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-floating mb-3">
                                    <input type="text" id="txtaddress" name="direccion" class="form-control" placeholder="Dirección">
                                    <label for="txtaddress">Dirección</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-right">
                        <button type="button" class="btn btn-outline-primary">
                            <i class="bi bi-save mr-2"></i>
                            <span>Guardar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('post_html')
    <link rel="stylesheet" href="{{ url('static/css/admin/profile.css') }}">
@endpush
