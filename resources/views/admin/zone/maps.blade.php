@extends('layouts.appAdmin')

@section('styles')
	<style>
		#map{
			width: 100%;
			height: 500px;
		}
	</style>
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
        <li class="active">Mapa general</li>
    </ul>
@endsection

@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="col-md-12">
		<div class="form-group">
			<div id="map"></div>

	        <input type="hidden" name="center_latitude" id="center_latitude" value="{{env('MAP_LATITUDE_CENTER')}}">
		        <input type="hidden" name="center_longitude" id="center_longitude" value="{{env('MAP_LONGITUDE_CENTER')}}">
	        <input type="hidden" name="polygons" id="polygons" value="{{ $polygons }}">
		</div>
	</div>
	<div class="col-md-12 text-center">
		<div class="form-group">
			<a href="{{route('admins.zone.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Volver</a>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('G_MAPS_API_KEY') }}&libraries=drawing"></script>
	<script src="{{asset('js/admin/zone/maps.js')}}"></script>
@endsection