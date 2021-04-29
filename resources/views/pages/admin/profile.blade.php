@extends('templates.admin')

@section('title', 'Perfil')

@section('container-type', 'container')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="card">
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
                <form class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Información Básica</h5>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="txtname">Nombres</label>
                                    <input type="text" id="txtname" name="nombre" class="form-control" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="txtlastname">Apellidos</label>
                                    <input type="text" id="txtlastname" name="apellidos" class="form-control" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="cbodocument_type">Tipo de Documento</label>
                                    <select id="cbodocument_type" name="tipo_documento" class="form-control">
                                        <option disabled selected>Seleccione...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="txtnro_documento">N° Documento</label>
                                    <input type="text" id="txtnro_documento" name="num_documento" class="form-control"
                                        autofocus>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="txtemail">Correo Electrónico</label>
                                    <input type="text" id="txtemail" name="email" class="form-control" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="txtphone">Teléfono</label>
                                    <input type="text" id="txtphone" name="telefono" class="form-control" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="txt_birthday">F. de nacimiento</label>
                                    <input type="text" id="txt_birthday" name="fecha_nacimiento" class="form-control"
                                        autofocus>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="txtaddress">Dirección</label>
                                    <input type="text" id="txtaddress" name="direccion" class="form-control" autofocus>
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
    <link rel="stylesheet" href="static/css/admin/profile.css">
@endpush
