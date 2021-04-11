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
            <li class="breadcrumb-item active">Ventas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $salesToday['clients'] }}</h3>
                        <p>Total Clientes - Hoy</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">                        
                        <h3><sup style="font-size: 20px">$</sup>{{ $salesToday['sales'] }}</h3>
                        <p>Total Ventas - Hoy</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-money-check-alt"></i>
                    Ventas
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                          <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('sales.create') }}" class="btn btn-info mb-2"><i class="fas fa-plus"></i> Agregar Nueva Venta</a>
                    <div class="col-6 mt-2 mb-2 pl-0">
                        <form action="{{ url('sales/filter')}}" method="POST" class="d-flex">
                            {{ csrf_field() }}
                            <select name="day" class="form-control">
                                <option value="">Fecha</option>
                                @foreach($days as $day)
                                    <option value="{{ $day->created_at->format('Y/m/j') }}" {{ ( isset($request['day']) && $request['day'] == $day->created_at->format('Y/m/j') ) ? 'selected' : '' }}>{{ $day->created_at->format('j/m/Y') }}</option>
                                @endforeach
                            </select>
                            <select name="sucursal" id="" class="form-control ml-2">
                                <option value="">Sucursal</option>
                                @foreach ($sucursals as $sucursal)
                                    <option value="{{ $sucursal->id }}" {{ ( isset($request['sucursal']) && $request['sucursal'] == $sucursal->id ) ? 'selected' : '' }}>{{ $sucursal->name }}</option>
                                @endforeach
                            </select>
                            <select name="turn" id="" class="form-control ml-2">
                                <option value="">Turno</option>
                                <option value="13hs" {{ ( isset($request['turn']) && $request['turn'] == '13hs' ) ? 'selected' : '' }}>13hs</option>
                                <option value="17hs" {{ ( isset($request['turn']) && $request['turn'] == '17hs' ) ? 'selected' : '' }}>17hs</option>
                                <option value="22hs" {{ ( isset($request['turn']) && $request['turn'] == '22hs' ) ? 'selected' : '' }}>22hs</option>
                                <option value="23hs" {{ ( isset($request['turn']) && $request['turn'] == '23hs' ) ? 'selected' : '' }}>23hs</option>
                            </select>
                            <input type="submit" class="btn btn-info ml-2" value="Filtrar">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableSales" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha / Hora</th>
                                    <th>Turno</th>
                                    <th>Sucursal</th>
                                    <th>Importe</th>
                                    <th>Clientes</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $key => $sale)
                                    <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ $sale->created_at->format('j/m/Y - H:i \h\s') }}</td>
                                        <td>{{ $sale->turn }}</td>
                                        <td>
                                            @if ( $sale->sucursal->isNotEmpty() )
                                                @foreach ( $sale->sucursal as $sucursal ) 
                                                    {{ $sucursal->name }} 
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>${{ number_format($sale->amount, 2,',','.') }}</td>
                                        <td>{{ $sale->clients }}</td>
                                        <td>
                                            {{-- <a class="btn btn-primary btn-sm" href="{{ url('/sales/'. $sale->id ) }}">
                                                <i class="fas fa-folder"></i> Ver
                                            </a> --}}
                                            <a class="btn btn-info btn-sm" href="{{ url('/sales/'. $sale->id .'/edit') }}">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteSaleModal" data-saleid="{{ $sale->id }}">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Totales</th>
                                    <th>${{ number_format($totalSales, 2,',','.') }}</th>
                                    <th>{{ number_format($totalClients, 0,',','.') }}</th>
                                    <th></th>
                                </tr>
                            </tfoot>
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
