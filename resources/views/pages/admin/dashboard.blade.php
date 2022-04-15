@extends('templates.admin')

@section('title', 'Dashboard')

@section('container-type', 'container-fluid')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-content">
                <div class="card-body">
                    <h5 class="card-title">Title</h5>
                    <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias minima dolorem, suscipit necessitatibus nostrum porro ab similique repudiandae, sequi quae doloribus sint aspernatur numquam odit accusamus? Iusto at eos nesciunt.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('post_html')
<link rel="stylesheet" href="{{ url('static/css/admin/dashboard.css') }}">
@endpush
