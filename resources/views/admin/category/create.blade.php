@extends('layouts.appAdmin')

@section('styles')
	<link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            Catálogo
        </li>
        <li>
            <a href="{{ route('admins.category.index') }}">Categorías</a>
        </li>
        <li class="active">Nueva</li>
    </ul>
@endsection

@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="page-header">
	    <h1 class="page-title text-primary-d2">
	        Categorías
	         <small class="page-info text-secondary-d2">
	            <i class="fa fa-angle-double-right text-80"></i>
	            nueva
	        </small>
	    </h1>
	</div>
	<form action="{{ route('admins.category.store') }}" method="post" enctype="multipart/form-data" id="form">
		{{ csrf_field() }}
		<input type="hidden" name="level" value="{{ $level }}">
		<input type="hidden" name="parent_id" value="{{ $parent_id }}">
		<div class="col-md-12">
			<div class="form-group">
				<label for="name">Nombre: <span class="required">*</span></label>
				<input type="text" name="name" class="form-control">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="description">Descripción: <span class="required">*</span></label>
				<textarea rows="4" name="description" class="form-control"></textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="image">Imagen: </label>
				<input type="file" name="image" class="form-control">
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="position">Posición: <span class="required">*</span></label>
						<input type="text" name="position" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="visible_on_web">Visible en web: <span class="required">*</span></label>
						<select name="visible_on_web" class="form-control">
							<option value="" class="hide"> -- Seleccionar -- </option>
							<option value="1">Sí</option>
							<option value="0">No</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="status">Estado: <span class="required">*</span></label>
				<select name="status" class="form-control">
					<option value="" class="hide"> -- Seleccionar -- </option>
					<option value="enabled">Habilitado</option>
					<option value="disabled">Deshabilitado</option>
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
				<a href="{{route('admins.category.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Volver</a>
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