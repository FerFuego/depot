@extends('layouts.app')

@section('content')

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Lista de Tareas</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
					<li class="breadcrumb-item active">Ver Lista de tarea</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 connectedSortable">
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
			</div>

		</div>
		<!-- /.row -->
	</div>
</section>

@endsection