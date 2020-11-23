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
					<li class="breadcrumb-item"><a href="{{ url('/todos') }}">Listas de tareas</a></li>
					<li class="breadcrumb-item active">Ver Lista de tarea</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3><b>{{ $todo->name }}</b></h3>
						<h4><b>Dias:</b> {{ $todo->days }}</h4>
					</div>
					<div class="card-body">
						@if ( $todo->tasks->isNotEmpty() )
							@foreach ( $todo->tasks as $task ) 
								<h5><i class="fas fa-check mr-2"></i>{{ $task->title }} </h5>
							@endforeach
						@endif
					</div>
					<div class="card-footer">
						<a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
					</div>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
</section>

@endsection