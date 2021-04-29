@extends('templates.admin')

@section('title', 'Dashboard')

@section('container-type', 'container-fluid')
@section('content')
<div class="container">
    <h1 class="display-4 text-center">Hola mundo!</h1>
</div>
@endsection

@push('post_html')
<link rel="stylesheet" href="static/css/admin/dashboard.css">
@endpush
