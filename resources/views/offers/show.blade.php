@extends('layouts.app')

@section('content')

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Gestion de Banners</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/offers') }}">Banners</a></li>
					<li class="breadcrumb-item active">Ver Oferta</li>
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
							<h3><b>{{ $offer->title }}</b></h3>
						</div>
						<div class="card-body">
                            <p>{{ $offer->details }}</p>

                            <a href="{{ url('/download/' . $offer->file ) }}" class="d-block mb-3" title="Descargar">
                                <img src="{{ url('/uploads/'. $offer->file) }}" class="img-fluid" alt="banner">
                            </a>
							
                            @if ( $offer->sucursals )
                                @foreach ( $offer->sucursals as $sucursal ) 
                                    <span class="badge badge-success">
                                        {{ $sucursal->name }} 
                                    </span>
                                @endforeach
                            @endif
						</div>
						<div class="card-footer">
							<a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
							<a href="#" class="btn btn-success btn-print">Imprimir</a>
						</div>
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
</section>

@endsection