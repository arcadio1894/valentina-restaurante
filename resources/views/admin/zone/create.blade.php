@extends('layouts.appAdmin')

@section('styles')
	<style>
		#map{
			width: 100%;
			height: 500px;
		}
	</style>
@endsection

@section('content')
<div class="col-md-10 col-md-offset-1">
	<form action="{{ route('admins.zone.store') }}" method="post">
		{{ csrf_field() }}
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" name="name" class="form-control">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="code">Código</label>
				<input type="text" name="code" class="form-control">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" class="form-control">
					<option value="">Seleccionar</option>
					<option value="enabled">Habilitado</option>
					<option value="disabled">Inabilitado</option>
				</select>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<div id="map"></div>

		        <input type="hidden" name="center_latitude" id="center_latitude" value="{{env('MAP_LATITUDE_CENTER')}}">
		        <input type="hidden" name="center_longitude" id="center_longitude" value="{{env('MAP_LONGITUDE_CENTER')}}">
		        <input type="hidden" name="polygon" id="polygon">
		        <input type="hidden" name="center" id="center">
			</div>
		</div>
		<div class="col-md-12 text-center">
			<div class="form-group">
				<a href="{{route('admins.zone.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Volver</a>
				<button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
			</div>
		</div>
	</form>
</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('G_MAPS_API_KEY') }}&libraries=drawing"></script>
	<script src="{{asset('js/admin/zone/create.js')}}"></script>
@endsection