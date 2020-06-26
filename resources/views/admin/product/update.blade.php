@extends('layouts.appAdmin')

@section('styles')
@include('admin.product.styles')
<link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            Catálogo
        </li>
        <li>
            <a href="{{ route('admins.product.index') }}">Productos</a>
        </li>
        <li class="active">Modificar</li>
    </ul>
@endsection

@section('content')

<div class="col-md-10 col-md-offset-1">
	<div class="page-header">
	    <h1 class="page-title text-primary-d2">
	        Producto
	         <small class="page-info text-secondary-d2">
	            <i class="fa fa-angle-double-right text-80"></i>
	            Modificar
	        </small>
	    </h1>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<div id="fuelux-wizard-container" class="no-steps-container">
				<div class="step-content pos-rel">
					<div class="col-sm-12 widget-container-col ui-sortable" id="widget-container-col-12">
						<div class="widget-box ui-sortable-handle" id="widget-box-12">
							<div class="widget-header widget-header-small">
								<h4 class="widget-title smaller green">Información de producto</h4>

								<div class="widget-toolbar no-border">
									<ul class="nav nav-tabs">
										<li class="active">
											<a data-toggle="tab" href="#general">General</a>
										</li>

										<li>
											<a data-toggle="tab" href="#gallery">Galería</a>
										</li>

										<li>
											<a data-toggle="tab" href="#categories">Categorías</a>
										</li>
										
										@if($product->type === 'bundle')
											<li>
												<a data-toggle="tab" href="#options">Artículos del paquete</a>
											</li>
										@endif
									</ul>
								</div>
							</div>
							
							<form action="{{ route('admins.product.store') }}" method="post" enctype="multipart/form-data" id="product-form">
								{{ csrf_field() }}
								<input type="hidden" name="type" id="type">
								<div class="widget-body">
									<div class="widget-main padding-6">
										<div class="tab-content">
											<div id="general" class="tab-pane in active">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="code">Código: <span class="required">*</span></label>
															<input type="text" class="form-control" name="code" value="{{ $product->code }}">
														</div>	
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="name">Nombre: <span class="required">*</span></label>
															<input type="text" class="form-control" name="name" value="{{ $product->name }}">
														</div>	
													</div>
												</div>
												<div class="form-group">
													<label for="description">Descripción: <span class="required">*</span></label>
													<textarea name="description" rows="4" class="form-control">{{ $product->description }}</textarea>
												</div>
												<div class="row">
													<div class="col-md-6">
														<label for="price">Precio: <span class="required">*</span></label>
														<input type="number" min="0" step="0.00" class="form-control" name="price" value="{{ $product->price }}">
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="initial_stock">Stock: <span class="required">*</span></label>
															<input type="number" min="0" step="1" pattern="\d+" class="form-control" name="initial_stock" value="{{ $product->initial_stock }}">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="position">Position: </label>
															<input type="text" class="form-control" name="position" value="{{ $product->position }}">
														</div>		
													</div>

													@if($product->type === 'simple')
														<div class="col-md-6">
															<div class="form-group">
																<label for="visibility">Visibilidad: <span class="required">*</span></label>
																<select name="visibility" class="form-control">
																	<option value="">--Seleccionar--</option>
																	<option value="catalog" {{ $product->visibility === 'catalog' ? 'selected' : '' }}>Catálogo</option>
																	<option value="bundle" {{ $product->visibility === 'bundle' ? 'selected' : '' }}>Parte de un paquete</option>
																</select>
															</div>
														</div>
													@else
														<div class="col-md-6">
															<div class="form-group">
																<label for="status">Estado: <span class="required">*</span></label>
																<select name="status" class="form-control">
																	<option value="">--Seleccionar--</option>
																	<option value="enabled" {{ $product->status === 'enabled' ? 'selected' : '' }}>Habilitado</option>
																	<option value="disabled" {{ $product->status === 'disabled' ? 'selected' : '' }}>Desabilitado</option>
																</select>
															</div>	
														</div>
													@endif
												</div>
												
												@if($product->type === 'simple')
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="status">Estado: <span class="required">*</span></label>
																<select name="status" class="form-control">
																	<option value="">--Seleccionar--</option>
																	<option value="enabled" {{ $product->status === 'enabled' ? 'selected' : '' }}>Habilitado</option>
																	<option value="disabled" {{ $product->status === 'disabled' ? 'selected' : '' }}>Desabilitado</option>
																</select>
															</div>	
														</div>
													</div>
												@endif
											</div>
											
											<div id="gallery" class="tab-pane">
												<div class="form-group">
													<label for="small_image">Imagen pequeña: </label>
													<input type="file" name="small_image" class="form-control">
													@if($product->small_image)
														<div class="image-container">
															<img src="{{ asset('admin/assets/images/product/'.$product->small_image) }}" alt="{{ $product->name }}">
														</div>
													@endif
												</div>
												<div class="form-group">
													<label for="image">Imagen: </label>
													<input type="file" name="image" class="form-control">
													@if($product->image)
														<div class="image-container">
															<img src="{{ asset('admin/assets/images/product/'.$product->image) }}" alt="{{ $product->name }}">
														</div>
													@endif
												</div>
											</div>

											<div id="categories" class="tab-pane">
												<div class="widget-box widget-color-green2">
													<div class="widget-header">
														<h4 class="widget-title lighter smaller">Seleccionar categoría
														</h4>
													</div>
													
													<div class="widget-body">
								                        <div class="widget-main padding-8">
								                            <ul id="tree2" class="tree tree-unselectable tree-folder-select" role="tree">
								                                <li class="tree-branch hide" data-template="treebranch" role="treeitem" aria-expanded="false">
								                                    <i class="icon-caret ace-icon tree-plus"></i>&nbsp;
								                                    <div class="tree-branch-header">
								                                        <span class="tree-branch-name">
								                                            <i class="icon-folder ace-icon fa fa-folder"></i>
								                                            <span class="tree-label"></span>
								                                        </span>
								                                    </div>
								                                    <ul class="tree-branch-children" role="group"></ul>
								                                    <div class="tree-loader hidden" role="alert">
								                                        <div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i>
								                                        </div>
								                                    </div>
								                                </li>
								                                <li class="tree-item hide" data-template="treeitem" role="treeitem">
								                                    <span class="tree-item-name">
								                                        <span class="tree-label"></span>
								                                    </span>
								                                </li>

								                                {!! $htmlCategories !!}
								                            </ul>
								                        </div>
								                    </div>
												</div>
											</div>

											<div id="options" class="tab-pane">
												<div class="widget-box">
													<div class="widget-header">
														<h4 class="widget-title">Artículos del paquete</h4>
														<button type="button" class="btn btn-primary btn-xs pull-right btn-items" id="add_option">Agregar nueva opción</button>
													</div>
												</div>
												<div class="option-items row">
													@foreach($product->options as $option)
														<div class="row option-object option-{{ $option->id }}">
															<div class="col-md-12">
																<div class="col-md-9 mb-10">
																	<label for="title">Título: <span class="required">*</span></label>
																	<input type="text" name="title" class="form-control" value="{{ $option->title }}">
																</div>
																<div class="col-md-3 mt-27 mb-10">
																	<button type="button" class="btn btn-sm btn-danger" data-delete-option="">Eliminar</button>
																</div>
															</div>
															<div class="col-md-12 mt-4">
																<div class="col-md-3">
																	<label for="option_type">Tipo: <span class="required">*</span></label>
																	<select name="option_type" id="option_type" class="form-control">
																		<option value="select" {{ $option->type === 'select' ? 'selected' : '' }}>Select</option>
																		<option value="radio" {{ $option->type === 'radio' ? 'selected' : '' }}>Radio button</option>
																		<option value="checkbox" {{ $option->type === 'checkbox' ? 'selected' : '' }}>Checkbox</option>
																		<option value="multiselect" {{ $option->type === 'multiselect' ? 'selected' : '' }}>Multiselect</option>
																	</select>
																</div>
																<div class="col-md-3">
																	<label for="is_required">Requerido: <span class="required">*</span></label>
																	<select name="is_required" id="is_required" class="form-control">
																		<option value="0" {{ $option->is_required === 0 ? 'selected' : '' }}>No</option>
																		<option value="1" {{ $option->is_required === 1 ? 'selected' : '' }}>Sí</option>
																	</select>
																</div>
																<div class="col-md-3">
																	<label for="position">Posición: <span class="required">*</span></label>
																	<input type="text" name="position" class="form-control" value="{{ $option->position }}">
																</div>
																<div class="col-md-3">
																	<div class="btn-label"></div>
																	<button type="button" class="btn btn-info btn-sm" data-add-item="{{ $option->id }}">Agregar elementos</button>
																</div>
															</div>
															<div class="col-md-12 table-responsive mt-20">
																<table class="table table-striped">
																	<thead>
																		<tr class="table-products">
																			<th>Producto</th>
																			<th>Precio</th>
																			<th>Cantidad</th>
																			<th>Posición</th>
																			<th>Predeterminado</th>
																			<th>Eliminar</th>
																		</tr>
																	</thead>
																	<tbody class="option-table-items">
																		@foreach($option->selections as $selection)
																			<tr data-selection-id="{{ $selection->product_id }}">
																				<td style="vertical-align:middle">{{ $selection->product->name }}</td>
																				<td style="vertical-align:middle">{{ $selection->price }}</td>
																				<td><input type="text" value="{{ $selection->qty }}"></td>
																				<td><input type="text" value="{{ $selection->position }}"></td>
																				<td class="text-center"><input type="radio" {{$selection->is_default ? 'checked':'' }}></td>
																				<td><button class="btn btn-danger btn-xs" data-delete-selection=""><i class="fa fa-trash"></i></button></td>
																			</tr>
																		@endforeach
																	</tbody>
																</table>
															</div>
														</div>
													@endforeach
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

	<div class="col-md-12 text-center mt-4">
		<div class="form-group">
			<a href="{{route('admins.product.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Volver</a>
			<button class="btn btn-primary submit-form hide"><i class="fa fa-save"></i> Guardar</button>
		</div>
	</div>
</div>
@endsection

@section('modals')
<div class="modal" tabindex="-1" role="dialog" id="modal-products">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Seleccionar productos</h4>
			</div>
			<div class="modal-body table-responsive">
				<button class="btn btn-success pull-right mb-4" id="modal-search-products"
				data-modal-search-products-url="{{ route('admins.product.filterable') }}"><i class="fa fa-search"></i>&nbsp;Buscar</button>
				<input type="hidden" id="temporay-option-id" value="">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Seleccionar</th>
							<th class="col-md-2">Id</th>
							<th>Producto</th>
							<th>Código</th>
							<th>Precio</th>
						</tr>
						<tr>
							<th></th>
							<th><input type="text" class="col-md-12" id="modal-search-id"></th>
							<th><input type="text" id="modal-search-name"></th>
							<th><input type="text" id="modal-search-code"></th>
							<th class="col-md-12">
								<span class="col-md-3 mt-4">Desde:&nbsp;</span>
								<input type="text" class="col-md-3" id="modal-search-min-price">
								<span class="col-md-3 mt-4">Hasta:&nbsp;</span>
								<input type="text" class="col-md-3" id="modal-search-max-price">
							</th>
						</tr>
					</thead>
					<tbody id="modal-table-products"></tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="modal-products-option-items-add">Agregar</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/jquery.toast.js') }}"></script>
	<script src="{{ asset('js/admin/functions.js') }}"></script>
	<script src="{{ asset('js/admin/product/create.js') }}"></script>
@endsection