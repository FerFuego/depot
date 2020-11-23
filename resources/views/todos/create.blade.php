@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Gestion de Listas de Tareas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/todos') }}">Listas de Tareas</a></li>
            <li class="breadcrumb-item active">Nueva Lista de Tareas</li>
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
            <h3 class="card-title">Crear Lista de Tareas</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('todos.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="sucursal">Sucursal</label>
                  <select name="sucursal" id="select_sucursal" class="form-control selectpicker" data-live-search="true" required>
                    <option>Seleccione Sucursal</option>
                    @foreach ( $sucursals as $sucursal )
                      <option value="{{ $sucursal->id }}">{{ $sucursal->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="days">Repetir Dias</label>
                  <select name="days[]" id="select_days" class="form-control selectpicker" multiple data-live-search="true" required>
                    <option value="Lunes, Martes, Miercoles, Jueves, Viernes, Sabado, Domingo">Todos los dias</option>
                    <option value="Lunes, Martes, Miercoles, Jueves, Viernes">Lunes a Viernes</option>
                    <option value="Sabado, Domingo">Sabados y Domingos</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miercoles">Miercoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sabado">Sabado</option>
                    <option value="Domingo">Domingo</option>
                  </select>
                </div>
                <div class="form-group">
                    <label>Seleccione tareas de la lista</label>
                    <select name="tasks[]" class="duallistbox" multiple="multiple" required>
                        @foreach ( $tasks as $task )
                          <option value="{{ $task->id }}">{{ $task->title }}</option>
                        @endforeach
                    </select>
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