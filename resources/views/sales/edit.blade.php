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
            <li class="breadcrumb-item active">Editar Venta</li>
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
            <h3 class="card-title">Editar Venta</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ url('/sales/'. $sale->id) }}" method="POST">
              @method('PATCH')
              @csrf()
                <div class="form-group">
                  <label for="sucursal">Sucursal</label>
                  <select name="sucursal" id="select_sucursal" class="form-control selectpicker" multiple data-live-search="true">
                    <option>Seleccione Sucursal</option>
                    @foreach ( $sucursals as $sucursal )
                      <option value="{{ $sucursal->id }}" {{ in_array( $sucursal->id, $sale->sucursal->pluck('id')->toArray() ) ? 'selected' : '' }}>{{ $sucursal->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="amount">Importe parcial en turno</label>
                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Importe" value="{{ $sale->amount }}" required>
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="clients">Cantidad de clientes en turno</label>
                    <input type="text" name="clients" id="clients" class="form-control" placeholder="Clientes" value="{{ $sale->clients }}" required>
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