@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Ventas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales') }}">Ventas</a></li>
            <li class="breadcrumb-item active">Nueva Venta</li>
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
            <h3 class="card-title">Crear Venta</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('sales.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="sucursal">Sucursal</label>
                  <select name="sucursal" id="select_sucursal" class="form-control selectpicker" multiple data-live-search="true">
                    <option>Seleccione Sucursal</option>
                    @foreach ( $sucursals as $sucursal )
                      <option value="{{ $sucursal->id }}" @if ($loop->first) selected @endif>{{ $sucursal->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="turn">Turno</label>
                  <select name="turn" class="form-control">
                    <option>Seleccione Turno</option>
                    <option value="13hs">13hs</option>
                    <option value="17hs">17hs</option>
                    <option value="22hs">22hs</option>
                    <option value="23hs">23hs</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="amount">Importe parcial en turno</label>
                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Importe" value="{{ old('amount') }}" required>
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="clients">Clientes de clientes en turno</label>
                    <input type="text" name="clients" id="clients" class="form-control" placeholder="Clientes" value="{{ old('clients') }}" required>
                    @error('clients')
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