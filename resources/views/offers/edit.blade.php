@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Ofertas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/offers') }}">Ofertas</a></li>
            <li class="breadcrumb-item active">Editar Oferta</li>
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
            <h3 class="card-title">Editar Oferta</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ url('/offers/'. $offer->id) }}" method="POST" enctype="multipart/form-data">
              @method('PATCH')
              @csrf()
                <div class="form-group">
                  <label for="sucursal">Sucursal</label>
                  <select name="sucursal[]" id="select_sucursal" class="form-control selectpicker" multiple data-live-search="true">
                    <option>Seleccione Sucursal</option>
                    @foreach ( $sucursals as $sucursal )
                      <option value="{{ $sucursal->id }}" {{ in_array( $sucursal->id, $offer->sucursals->pluck('id')->toArray() ) ? 'selected' : '' }}>{{ $sucursal->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Titulo" value="{{ $offer->title }}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="details">Detalle</label>
                    <textarea name="details" id="" cols="30" rows="5" class="form-control" placeholder="Detalle">{{ $offer->details }}</textarea>
                    @error('details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file">Imagen</label>
                    <div class="col-3 mb-3">
                      @if ( $offer->file )
                        <img src="{{ url('/uploads/'. $offer->file) }}" class="img-fluid" alt="banner">
                      @endif
                    </div>
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