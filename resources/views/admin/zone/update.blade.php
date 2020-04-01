@extends('layouts.appAdmin')

@section('styles')
	<style>
		#map{
			width: 100%;
			height: 500px;
		}
	</style>

	<link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            Inicio
        </li>
        <li>
            <a href="{{ route('admins.zone.index') }}">Zonas</a>
        </li>
        <li class="active">Modificar</li>
    </ul>
@endsection

@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="page-header">
	    <h1 class="page-title text-primary-d2">
	        Zonas
	         <small class="page-info text-secondary-d2">
	            <i class="fa fa-angle-double-right text-80"></i>
	            Modificar
	        </small>
	    </h1>
	</div>
	<form action="{{ route('admins.zone.update') }}" method="post" id="form">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $zone->id }}">
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" name="name" class="form-control" value="{{ $zone->name }}">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="code">Código</label>
				<input type="text" name="code" class="form-control" value="{{ $zone->code }}">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" class="form-control">
					<option value="">Seleccionar</option>
					<option value="enabled" {{ $zone->status == 'enabled'? 'selected':'' }}>Habilitado</option>
					<option value="disabled" {{ $zone->status == 'disabled'? 'selected':'' }}>Inabilitado</option>
				</select>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<div id="map"></div>

		        <input type="hidden" name="center_latitude" id="center_latitude" value="{{ json_decode($zone->center)[0] }}">
		        <input type="hidden" name="center_longitude" id="center_longitude" value="{{ json_decode($zone->center)[1] }}">
		        <input type="hidden" name="polygon" id="polygon" value="{{ $zone->polygon }}">
		        <input type="hidden" name="center" id="center" value="{{ $zone->center }}">
			</div>
		</div>
		<div class="col-md-12 text-center">
			<div class="form-group">
				<a href="{{route('admins.zone.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Volver</a>
				<button class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
			</div>
		</div>
	</form>
</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('G_MAPS_API_KEY') }}&libraries=drawing"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.toast.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/admin/functions.js') }}"></script>
	<script src="{{asset('js/admin/zone/update.js')}}"></script>
@endsection