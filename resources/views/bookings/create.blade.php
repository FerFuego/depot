@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Turnos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/offers') }}">Reservas</a></li>
            <li class="breadcrumb-item active">Nueva Reserva</li>
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
            <h3 class="card-title">Crear Turno para Acceso a Deposito</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('storeBooking') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="supplier">Nombre Proveedor</label>
                    <input type="text" name="supplier" id="supplier" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="pallets">Cantidad de Palets <sup class="text-info"> ( 1 palet = 15min de descarga)</sup></label>
                  <input type="number" name="pallets" id="pallets" class="form-control" min="1" max="32" value="1" required>
                </div>
                <div class="form-group">
                    <label for="day">Seleccione Dia</label>
                    <input type="date" name="day" id="day" class="form-control" onchange="getBookingDay(this.value)" required>
                </div>
                <div id="js-calendar"></div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <input type="submit" value="Reservar" class="btn btn-success float-right">
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-6">
        @if (isset($result))
            <div class="card-footer">
                <h4 class="text-success">Reservado para el dia: {{  \Carbon\Carbon::parse($result->start)->format('d-m-Y') }} <br> 
                    A las {{  \Carbon\Carbon::parse($result->start)->format('H:i') }}</h4>
            </div>
        @endif
    </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
      </div>
    </div>
  </section>

@endsection