@extends('layouts.app')

@section('content')

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Gestion de Sucursales</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/sucursals') }}">Sucursales</a></li>
					<li class="breadcrumb-item active">Ver Sucursal</li>
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
							<h3><b>{{ $sucursal->name }}</b></h3>
							<h4><b>{{ $sucursal->address }}</b></h4>
						</div>
						<div class="card-body">
							<h5><b>Telefono:</b> {{ $sucursal->phone }}</h5>
							<h5><b>Email:</b> {{ $sucursal->email }}</h5>
							<h5><b>Horarios:</b> {{ $sucursal->schedule }}</h5>
							<h5><b>Gerentes:<b>
								@if ( $sucursal->users->isNotEmpty() )
									@foreach ( $sucursal->users as $user ) 
										<span class="badge badge-success">
											{{ $user->name }} 
										</span>
									@endforeach
								@endif
							</h5>
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