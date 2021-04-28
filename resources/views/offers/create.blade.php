@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Banners</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/offers') }}">Banners</a></li>
            <li class="breadcrumb-item active">Nueva Oferta</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Crear Oferta</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="sucursal">Sucursales</label>
                  <select name="sucursal[]" id="select_sucursal" class="form-control selectpicker" multiple data-live-search="true" required>
                    <option>Seleccione Sucursal</option>
                    @foreach ( $sucursals as $sucursal )
                      <option value="{{ $sucursal->id }}" @if ($loop->first) selected @endif>{{ $sucursal->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Titulo" value="{{ old('title') }}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="details">Detalle</label>
                    <textarea name="details" id="" cols="30" rows="5" class="form-control" placeholder="Detalle" value="{{ old('details') }}"></textarea>
                    @error('details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row ml-1">
                  <div class="form-group mr-5">
                    <label for="time_start">Dia Comienzo Oferta</label><br>
                    <input type="date" name="time_start" id="time_start" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="time_end">Dia Finaliza Oferta</label><br>
                    <input type="date" name="time_end" id="time_end"  class="form-control">
                  </div>
                </div>
                <div class="form-group">
                    <label for="file">Imagen</label>
                    <input type="file" name="file" id="file" class="form-control" placeholder="Imagen" value="{{ old('file') }}">
                    @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <input type="submit" value="Guardar Cambios" class="btn btn-success float-right">
            </form> 
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
      </div>
    </div>
  </section>

@endsection