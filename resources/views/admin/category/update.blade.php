@extends('layouts.appAdmin')

@section('styles')
<style>
	.img-category{
		width: 100px;
	}
</style>
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
	<form action="{{ route('admins.category.update') }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $category->id }}">
		<div class="col-md-12">
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" name="name" class="form-control" value="{{ $category->name }}">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="description">Descripción</label>
				<textarea rows="4" name="description" class="form-control">{{ $category->description }}</textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="parent_id">Categoría padre</label>
				<select name="parent_id" id="parent_id" class="form-control">
					<option value=""> -- Seleccionar -- </option>
					@foreach($parents as $parent)
						<option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected':'' }}>{{ $parent->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="image">Imagen</label>
				<input type="file" name="image" class="form-control">
				@php
					$url = asset('admin/assets/images/gallery/default.png');

					if($category->img){
						$url = asset('admin/assets/images/category').'/'.$category->image;
					}
				@endphp
				<img src="{{ $url }}" alt="{{ $category->name }}" class="img-category">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="position">Posición</label>
				<input type="text" name="position" class="form-control" value="{{ $category->position }}">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" class="form-control">
					<option value=""> -- Seleccionar -- </option>
					<option value="enabled" {{ $category->status == 'enabled'?'selected':''}}>Habilitado</option>
					<option value="disabled" {{ $category->status == 'disabled'?'selected':''}}>Inabilitado</option>
				</select>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<div class="form-group">
				<a href="{{route('admins.category.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Volver</a>
				<button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
			</div>
		</div>
	</form>
</div>
@endsection