@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Reservas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Reservas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="far fa-calendar-alt"></i>
                    Reservas
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                          <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-5">

                        <a href="{{ route('bookings.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> Nueva Reserva</a>
    
                        <div>
                            <label for="">Estados:</label>
                            <span class="badge badge-success">Completado</span>
                            <span class="badge badge-warning">En Proceso</span>
                            <span class="badge badge-danger">Cancelado</span>
                        </div>
                        
                        {!! Form::open(['url' => 'bookings/filter', 'method' => 'post', 'class' => 'form form-inline']) !!}
                            {!! Form::token() !!}
                            {!! Form::label('month', 'Mes', ['class' => 'mr-2']) !!}
                            {!! Form::number('month', $month,   ['class' => 'form-control mr-2', 'min'=>'1', 'max' => '12']) !!}
                            {!! Form::label('year', 'Año', ['class' => 'mr-2']) !!}
                            {!! Form::number('year', $year,   ['class' => 'form-control mr-2', 'min'=>'2021', 'max' => '2100']) !!}
                            {!! Form::submit('Cargar',  ['class' => 'btn btn-info']) !!}
                        {!! Form::close() !!}
                        
                    </div>

                    <div class="table-responsive">
                        <h2>{{ date('F, Y', $start) }}</h2>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Domingo</th>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miercoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>
                                <th>Sabado</th>
                            </thead>
                            @for( $i=1; $i<=6; $i++ )
                                @php $index++; @endphp
                                <tr>
                                    @for( $j=0; $j<7; $j++ )
                                        <td>
                                            @if( $startpos > 0 && $continue2 < date("t", $start) ) 
                                                @php $continue2++; @endphp
                                                <a href="#" data-toggle="modal" data-target="#openDayModal" data-day="{{ $year .'-'. $month .'-'. (($continue2 < 10)?'0':''). $continue2 }}">
                                                    <h4>{{ $continue2 }}</h4>
                                                </a> 
                                                @foreach($bookings as $booking)
                                                    @if( $booking->day == date('Y-m', $start) .'-'. $continue2 || $booking->day == date('Y-m', $start) .'-0'. $continue2 )
                                                        @if ($booking->supplier)
                                                            <span 
                                                                style="cursor: pointer; position: relative;"
                                                                class="badge 
                                                                {{ (!$booking->state) ? 'badge-info':''}}
                                                                {{ ($booking->state == 'Completado') ? 'badge-success':''}}
                                                                {{ ($booking->state == 'En proceso') ? 'badge-warning':''}}
                                                                {{ ($booking->state == 'Cancelado') ? 'badge-danger':''}}"
                                                                onclick="openPopUp({{$booking->id}})"
                                                                title="{{ $booking->state}}"
                                                                id="{{$booking->id}}">
                                                                <div 
                                                                    class="d-none"
                                                                    id="item_{{$booking->id}}"
                                                                    style="position: absolute; bottom: 18px; left: 0; display: flex;border-radius: 10px; overflow: hidden;">
                                                                    <div onclick="setStateBooking({{$booking->id}}, 'En proceso')" class="bg-warning p-2 proceso">En proceso</div>
                                                                    <div onclick="setStateBooking({{$booking->id}}, 'Cancelado')" class="bg-danger p-2 cancelado">Cancelado</div>
                                                                    <div onclick="setStateBooking({{$booking->id}}, 'Completado')" class="bg-success p-2 completado">Completado</div>
                                                                </div>
                                                                {{ Str::upper($booking->supplier) ." ". \Carbon\Carbon::create($booking->start)->format('H:i') ." a ". \Carbon\Carbon::create($booking->end)->format('H:i') ." - ". $booking->time ."min" }}
                                                            </span><br>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if( $i == 1 && $j == date("w", $start) )
                                                <a href="#" data-toggle="modal" data-target="#openDayModal" data-day="{{$year .'-'. $month .'-01'}}">
                                                    <h4>1</h4>
                                                </a>
                                                @php $startpos = $index; @endphp
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
</section>

@endsection
