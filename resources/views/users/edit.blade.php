@extends('layouts.app')

@section('content')

<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Gestion de Usuarios</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{ url('/users') }}">Usuarios</a></li>
						<li class="breadcrumb-item active">Editar Usuario</li>
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
					<h3 class="card-title">Editar Usuario</h3>

					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fas fa-minus"></i></button>
					</div>
				</div>
				<div class="card-body">
					<form action="{{ url('/users/'. $user->id) }}" method="POST">
						@method('PATCH')
						@csrf()
						<div class="form-group">
							<label for="name">Nombre Completo</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Nombre Completo" value="{{ $user->name }}" required>
							@error('name')
									<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
									</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ $user->email }}" required>
							@error('email')
									<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
									</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="password">Contraseña</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" minlength="8">
							@error('password')
									<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
									</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="password_confirmation">Confirmar Contraseña</label>
							<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar Contraseña">
						</div>
						<div class="form-group">
							<label for="role">Rol</label>
							<select name="role" id="role" class="form-control">
								@if ( $user->roles->isNotEmpty() )
									@foreach ( $user->roles as $role ) 
										<option value="{{ $role->id }}">{{ $role->name }}</option>
									@endforeach
								@else
									<option>Seleccione Rol</option>
								@endif
								<option disabled>_____________________</option>
								@foreach ( $roles as $role )
									<option data-role-id="{{ $role->id }}" data-role-slug="{{ $role->slug }}" value="{{ $role->id }}">{{ $role->name }}</option>
								@endforeach
							</select>
						</div>
						<div id="permissions_box">
							<label for="roles">Seleccione los Permisos</label>
							<div id="permissions_checkbox_list">
								@foreach ( $allPermissions as $permission ) 
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="permissions[]" class="custom-control-input" id="{{ $permission->slug }}" value="{{ $permission->id }}" {{ in_array( $permission->id, $user->permissions->pluck('id')->toArray() ) ? 'checked=checked' : '' }}>
										<label for="{{ $permission->slug }}" class="custom-control-label">{{ $permission->name }}</label>
									</div>
								@endforeach
							</div>
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