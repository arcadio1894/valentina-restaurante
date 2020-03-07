@extends('layouts.appAdmin')

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
	<form action="{{ route('admins.category.store') }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="col-md-12">
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" name="name" class="form-control">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="description">Descripción</label>
				<textarea rows="4" name="description" class="form-control"></textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="parent_id">Categoría padre</label>
				<select name="parent_id" id="parent_id" class="form-control">
					<option value=""> -- Seleccionar -- </option>
					@foreach($parents as $parent)
						<option value="{{ $parent->id }}">{{ $parent->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="image">Imagen</label>
				<input type="file" name="image" class="form-control">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="position">Posición</label>
				<input type="text" name="position" class="form-control">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" class="form-control">
					<option value=""> -- Seleccionar -- </option>
					<option value="enabled">Habilitado</option>
					<option value="disabled">Inabilitado</option>
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