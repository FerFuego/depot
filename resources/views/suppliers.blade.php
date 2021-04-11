@extends('layouts.app')

@section('content')

<div class="logo-depot">
    <img src="/img/logo.png" alt="logo">
</div>

<div class="container-fluid login-container">
    <div class="row justify-content-end">
        <div class="col-md-5 login-container__column">
            <h1 class="text-center">Turno para Acceso al Deposito</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('storeBooking') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="supplier">Nombre Proveedor</label>
                            <input type="text" name="supplier" id="supplier" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="day">Seleccione Dia</label>
                            <input type="date" name="day" id="day" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pallets">Cantidad de Palets <sup class="text-info"> ( 1 palet = 15min de descarga)</sup></label>
                            <input type="number" name="pallets" id="pallets" class="form-control" min="1" max="32" value="1" required>
                        </div>
                        <input type="submit" value="Reservar" class="btn btn-success float-right">
                    </form>
                </div>
                @if ($result)
                    <div class="card-footer">
                        <h4 class="text-success">Reservado para el dia: {{  \Carbon\Carbon::parse($result->start)->format('d-m-Y') }} <br> 
                            de {{  \Carbon\Carbon::parse($result->start)->format('H:i') ." a ". \Carbon\Carbon::parse($result->end)->format('H:i') ." - ". $result->time ."min" }}</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
