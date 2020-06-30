@extends('layouts.appAdmin')

@section('styles')
	<style>
        .image-container{
			display: block;
			width: 100%
		}

		.image-container img{
			margin-top: 10px;
			padding:  10px;
			background-color: #d4d9dc;
			height: 100px;
		}
	</style>
	<link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            Métodos de pago
        </li>
        <li>
            <a href="{{ route('admins.paymentmethod.index') }}">Métodos de pago</a>
        </li>
        <li class="active">Nuevo</li>
    </ul>
@endsection

@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="page-header">
	    <h1 class="page-title text-primary-d2">
	        Métodos de pago
	         <small class="page-info text-secondary-d2">
	            <i class="fa fa-angle-double-right text-80"></i>
	            nuevo
	        </small>
	    </h1>
	</div>
	<form action="{{ route('admins.paymentmethod.store') }}" method="post" enctype="multipart/form-data" id="form">
		{{ csrf_field() }}
		<input type="hidden" name="paymentmethod_id" value="{{ isset($paymentmethod) ? $paymentmethod->id : '' }}">
		<div class="col-md-12">
			<div class="form-group">
				<label for="name">Nombre: <span class="required">*</span></label>
				<input type="text" name="name" class="form-control" value="{{ isset($paymentmethod) ? $paymentmethod->name : '' }}">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="image">Imagen: </label>
				<input type="file" name="image" class="form-control">
				@if(isset($paymentmethod))
					<div class="image-container">
						<img src="{{ asset('admin/assets/images/paymentmethod/'.$paymentmethod->image) }}" alt="{{ $paymentmethod->name }}">
					</div>
				@endif
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="position">Posición: <span class="required">*</span></label>
				<input type="text" name="position" class="form-control" value="{{ isset($paymentmethod) ? $paymentmethod->position : '' }}">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="status">Estado: <span class="required">*</span></label>
				<select name="status" class="form-control">
					<option value="" class="hide"> -- Seleccionar -- </option>
					<option value="enabled" {{ isset($paymentmethod) && $paymentmethod->status == 'enabled' ? 'selected' : '' }}>Habilitado</option>
					<option value="disabled" {{ isset($paymentmethod) && $paymentmethod->status == 'disabled' ? 'selected' : '' }}>Deshabilitado</option>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<p><span class="required">*</span> campos obligatorios</p>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<div class="form-group">
				<a href="{{route('admins.paymentmethod.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Volver</a>
				<button class="btn btn-primary" id="form-submit"><i class="fa fa-save"></i> Guardar</button>
			</div>
		</div>
	</form>
</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/jquery.toast.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/admin/functions.js') }}"></script>
@endsection