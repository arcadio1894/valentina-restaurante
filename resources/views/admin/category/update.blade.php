@extends('layouts.appAdmin')

@section('styles')
<style>
	.img-category{
		width: 100px;
	}
</style>

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
        <li class="active">Modificar</li>
    </ul>
@endsection

@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="page-header">
	    <h1 class="page-title text-primary-d2">
	        Categorías
	         <small class="page-info text-secondary-d2">
	            <i class="fa fa-angle-double-right text-80"></i>
	            Modificar
	        </small>
	    </h1>
	</div>
	<form action="{{ route('admins.category.update') }}" method="post" enctype="multipart/form-data" id="form">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $category->id }}">
		<div class="col-md-12">
			<div class="form-group">
				<label for="name">Nombre: <span class="required">*</span></label>
				<input type="text" name="name" class="form-control" value="{{ $category->name }}">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="description">Descripción: <span class="required">*</span></label>
				<textarea rows="4" name="description" class="form-control">{{ $category->description }}</textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="image">Imagen: </label>
				<input type="file" name="image" class="form-control">
				@php
					$url = asset('admin/assets/images/gallery/default.png');

					if($category->image){
						$url = asset('admin/assets/images/category').'/'.$category->image;
					}
				@endphp
				<img src="{{ $url }}" alt="{{ $category->name }}" class="img-category">
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="position">Posición: <span class="required">*</span></label>
						<input type="text" name="position" class="form-control" value="{{ $category->position }}">
					</div>	
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="visible_on_web">Visible en web: <span class="required">*</span></label>
						<select name="visible_on_web" class="form-control">
							<option value="" class="hide"> -- Seleccionar -- </option>
							<option value="1" {{ $category->visible_on_web === 1 ? 'selected' : '' }}>Sí</option>
							<option value="0" {{ $category->visible_on_web === 0 ? 'selected' : '' }}>No</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="status">Status: <span class="required">*</span></label>
				<select name="status" class="form-control">
					<option value="" class="hide"> -- Seleccionar -- </option>
					<option value="enabled" {{ $category->status == 'enabled'?'selected':''}}>Habilitado</option>
					<option value="disabled" {{ $category->status == 'disabled'?'selected':''}}>Deshabilitado</option>
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