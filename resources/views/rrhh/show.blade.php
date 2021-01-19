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
					<li class="breadcrumb-item"><a href="{{ url('/rrhhs') }}">RRHH</a></li>
					<li class="breadcrumb-item active">Ver RRHH</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3><b>{{ $rrhh->title }}</b></h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $rrhh->details }}</p>
                        
                        @if ( $rrhh->sucursals )
                            @foreach ( $rrhh->sucursals as $sucursal ) 
                                <span class="badge badge-success">
                                    {{ $sucursal->name }} 
                                </span>
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