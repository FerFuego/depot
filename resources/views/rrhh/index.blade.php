@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de RRHH</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">RRHH</li>
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
                    <i class="fas fa-user-plus"></i>
                    RRHH
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                          <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('rrhhs.create') }}" class="btn btn-info mb-2"><i class="fas fa-plus"></i> Agregar Nueva RRHH</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableRrhhs" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Sucursal</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Sucursal</th>
                                    <th>Accion</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($rrhhs as $rrhh)
                                    <tr>
                                        <td>{{ $rrhh->id }}</td>
                                        <td>{{ $rrhh->title }}</td>
                                        <td>
                                            @if ( $rrhh->sucursals )
                                                @foreach ( $rrhh->sucursals as $sucursal ) 
                                                    <span class="badge badge-success">
                                                        {{ $sucursal->name }} 
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ url('/rrhhs/'. $rrhh->id ) }}">
                                                <i class="fas fa-folder"></i> Ver
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{ url('/rrhhs/'. $rrhh->id .'/edit') }}">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteRRhhModal" data-rrhhid="{{ $rrhh->id }}">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
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
