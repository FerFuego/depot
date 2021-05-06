@extends('layouts.app')

@section('content')

<style>
	.card-body {
		background-image: url({{ $offer->file ? "../uploads/".$offer->file : "../img/banner-1.png" }});
		background-size:  100%;
		background-repeat: no-repeat;
		height: 800px;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}
	.card-body h3{
		display: block;
		font-size: 90px;
		text-align: center;
		margin-bottom: 0;
		width: 100%;
	}
	.card-body p {
		display: block;
		font-size: 40px;
		text-align: center;
		width: 100%;
		padding: 0 15%
	}
</style>

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
							<h3><b>{{ $offer->title }}</b></h3>
                            <p>{{ $offer->details }}</p>                            
						</div>
						<div class="card-footer">
							<a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
							<a href="{{ url('offers/print/'. $offer->id) }}" class="btn btn-success btn-print">Imprimir</a>
						</div>
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
</section>

@endsection