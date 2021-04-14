@extends('layouts.app')

@section('content')
 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
			<div class="row">

				<div class="col-lg-3 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							<h3>{{ $salesToday['clients'] }}</h3>
							<p>Total Clientes</p>
						</div>
						<div class="icon">
							<i class="ion ion-ios-people"></i>
						</div>
						<a href="/sales" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				
				<div class="col-lg-3 col-6">
					<div class="small-box bg-success">
						<div class="inner">                        
							<h3><sup style="font-size: 20px">$</sup>{{ $salesToday['sales'] }}</h3>
							<p>Total Ventas</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="/sales" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				
				{{-- <div class="col-lg-3 col-6">
					<div class="small-box bg-warning">
						<div class="inner">
							<h3>44</h3>
							<p>User Registrations</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div> --}}

				{{-- <div class="col-lg-3 col-6">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3>65</h3>
							<p>Unique Visitors</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div> --}}
				
			</div>
		</div>
		
        <div class="row">

            {{-- <section class="col-lg-7 connectedSortable">
				@foreach( $sucursals as $j => $sucursal)

					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Lista de Tareas Diarias</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
								<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button>
							</div>
						</div>
						<div class="card-body">							
							<ul class="todo-list ui-sortable" data-widget="todo-list">
								@foreach( $sucursal->todo_lists as $k => $task )
									@if ( $task->created_at->format('d') == date('d') )
										<li class="{{ $task->is_complete ? 'done' : '' }}">
											<span class="handle">
												<i class="fas fa-ellipsis-v"></i>
												<i class="fas fa-ellipsis-v"></i>
											</span>
											<div  class="icheck-primary d-inline ml-2">
												<input type="checkbox" value="{{ $task->id }}" name="task_id" id="todoCheck{{ $j.$k }}" {{ $task->is_complete ? 'checked' : '' }}>
												<label for="todoCheck{{ $j.$k }}" title="Finalizar Tarea"></label>
											</div>
											<span class="text">{{ $task->name }}</span>
											<small class="badge badge-warning {{ $task->state == 'En Proceso' ? 'inline-block' : 'd-none' }}" id="process{{$j.$k}}"><i class="far fa-clock"></i> En Proceso</small>
											<div class="tools todo-state" data-id="{{ $task->id }}" data-state="{{ $task->state }}" data-process="{{$j.$k}}">
												<i class="fas fa-edit" title="En Proceso"></i>
											</div>
										</li>
									@endif
								@endforeach
							</ul>
						</div>
						<div class="card-footer">
							Sucursal: {{ $sucursal->name }}
						</div>
					</div>

				@endforeach
			</section> --}}

			<section class="col-lg-5 connectedSortable">
				{{-- ABM Sales --}}
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Cargar Ventas</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
							<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button>
						</div>
					</div>
					<div class="card-body">
						<form action="{{ route('sales.store') }}" method="POST">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="sucursal">Sucursal</label>
								<select name="sucursal" id="select_sucursal" class="form-control selectpicker" data-live-search="true">
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
								<input type="text" name="amount" id="amount" class="form-control" placeholder="200000" value="{{ old('amount') }}" required>
								@error('amount')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="clients">Cantidad de clientes en turno</label>
								<input type="text" name="clients" id="clients" class="form-control" placeholder="2000" value="{{ old('clients') }}" required>
								@error('clients')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<input type="submit" value="Guardar" class="btn btn-success float-right">
						</form> 
					</div>
					<!-- /.card-body -->
				</div>
				{{-- /. ABM Sales --}}
			</section>
			
			<section class="col-lg-5 connectedSortable">
				<!-- Calendar -->
                <div class="card bg-gradient-success">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Calendario
                        </h3>
                        <!-- tools card -->
                        <div class="card-tools">
                            <!-- button with a dropdown -->
                            {{-- <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                <i class="fas fa-bars"></i></button>
                                <div class="dropdown-menu" role="menu">
                                    <a href="#" class="dropdown-item">Agregar Evento</a>
                                    <a href="#" class="dropdown-item">Eliminar evento</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">Ver calendario</a>
                                </div>
                            </div> --}}
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
				<!-- /.card -->
			</section>
			
		</div>
		
    </section>

@endsection

