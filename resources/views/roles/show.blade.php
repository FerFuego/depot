@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Roles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/roles') }}">Roles</a></li>
            <li class="breadcrumb-item active">Ver Role</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3><b>Nombre:</b> {{ $role->name }}</h3>
                    <h4><b>Slug:</b> {{ $role->slug }}</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Permisos</h5>
                    <p class="card-text">
                        ...
                    </p>
                </div>
                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
</section>

@endsection