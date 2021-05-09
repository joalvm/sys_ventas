@extends('templates.basic')

@section('title', 'Registro')

@section('content')
<div class="row">
    <div class="col-3"></div>
    <form action="{{ url('login') }}" method="POST" class="col-6">
        @csrf()
        <div class="card">
            <div class="card-header">
                <h5 class="display-4">Registrarme</h5>
                <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtname">Nombres</label>
                            <input type="text" id="txtname" name="name" class="form-control" placeholder="Nombres" autofocus>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label for="txtlastname">Apellidos</label>
                            <input type="text" id="txtlastname" name="lastname" class="form-control" placeholder="Apellidos" autofocus>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('post_html')
<link rel="stylesheet" href="static/css/register.css">
<link rel="stylesheet" href="static/css/register.js">
@endpush
