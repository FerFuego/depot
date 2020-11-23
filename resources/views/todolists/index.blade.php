@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Tareas Realizadas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tareas Realizadas</li>
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
                    <i class="far fa-plus-square"></i>
                    Tareas Realizadas
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                          <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tabletodos" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Sucursal</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Sucursal</th>
                                    <th>Estado</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($todoLists as $todoList)
                                    <tr>
                                        <td>{{ $todoList->created_at->format('j/m/Y - H:i \h\s') }}</td>
                                        <td>{{ $todoList->name }}</td>
                                        <td></td>
                                        <td>
                                            @if ( $todoList->sucursal->isNotEmpty() )
                                                @foreach ( $todoList->sucursal as $sucursal ) 
                                                    <span class="badge badge-success">{{ $sucursal->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if ($todoList->is_complete)
                                                <span class="badge badge-success">Completada</span>
                                            @else
                                                <span class="badge badge-danger">Sin Realizar</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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