@extends('layouts.appAdmin')

@section('styles')
<style>
	.mt-4{
		margin-top: 4px;
	}

	.mt-20{
		margin-top: 20px;
	}

	.mb-4{
		margin-bottom: 4px;
	}

	.mb-10{
		margin-bottom: 4px;
	}
	
	.mr-0{
		margin-right: 0px;
	}

	.mr-4{
		margin-right: 4px;
	}

	.mt-27{
		margin-top: 26px;
	}

	.tree-branch-product{
        margin: 4px !important;
    }

	.selectable-category{
		margin-left: 9px;
		margin-right: 4px;
	    color: #F9E8CE;
	    width: 13px;
	    height: 13px;
	    line-height: 13px;
	    font-size: 11px;
	    text-align: center;
	    border-radius: 3px;
	    -webkit-box-sizing: content-box;
	    -moz-box-sizing: content-box;
	    box-sizing: content-box;
	    border: 1px solid #ff9800c2;
	    box-shadow: 0 1px 2px rgba(0,0,0,.05);
	}

	.selected-category{
		background-color: #ff9800c2;
	}

	.selected-category-label{
		font-weight: bold;
		color: #2E8965 !important;
	}

	.btn-items{
		margin: 4px;
		font-weight: bold;
	}

	.btn-label{
		height: 26px;
	}
	
	.items{
		margin: 0 !important;
	}

	.selection-item{
		margin: 15px 0 10px 0;
	    padding: 10px 0 10px 0;
		border: 1px solid #2E8965;
		border-radius: 5px;
	}

	.table-products{
		color: white !important;
    	background-color: #337ab7 !important;
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
            <a href="{{ route('admins.product.index') }}">Productos</a>
        </li>
        <li class="active">Nuevo</li>
    </ul>
@endsection

@section('content')

<div class="col-md-10 col-md-offset-1">
	<div class="page-header">
	    <h1 class="page-title text-primary-d2">
	        Producto
	         <small class="page-info text-secondary-d2">
	            <i class="fa fa-angle-double-right text-80"></i>
	            nuevo
	        </small>
	    </h1>
	</div>
	
	<div class="widget-box">
		<div class="widget-header widget-header-blue widget-header-flat">
			<h4 class="widget-title lighter">Flujo de creación de producto</h4>
		</div>

		<div class="widget-body">
			<div class="widget-main">
				<div id="fuelux-wizard-container" class="no-steps-container">
					<div>
						<ul class="steps" style="margin-left: 0">
							<li data-step="1" class="active">
								<span class="step">1</span>
								<span class="title">Tipo de producto</span>
							</li>
							<li data-step="2" class="">
								<span class="step">2</span>
								<span class="title">Información de producto</span>
							</li>
						</ul>
					</div>

					<hr>

					<div class="step-content pos-rel">
						<div class="step-pane active" data-step="1">
							<h3 class="lighter block green">Tipo de producto</h3>
							
							<div class="form-group">
								<select name="product_type" id="product_type" class="form-control">
									<option value="">--Seleccionar--</option>
									<option value="simple">Simple</option>
									<option value="bundle">Paquete</option>
								</select>
								<p class="type-product-error red hide">* Seleccione el tipo de producto</p>
							</div>
						</div>

						<div class="step-pane" data-step="2">
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

												<li class="hide">
													<a data-toggle="tab" href="#options">Artículos del paquete</a>
												</li>
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
																	<input type="text" class="form-control" name="code">
																</div>	
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="name">Nombre: <span class="required">*</span></label>
																	<input type="text" class="form-control" name="name">
																</div>	
															</div>
														</div>
														<div class="form-group">
															<label for="description">Descripción: <span class="required">*</span></label>
															<textarea name="description" rows="4" class="form-control"></textarea>
														</div>
														<div class="row">
															<div class="col-md-6">
																<label for="price">Precio: <span class="required">*</span></label>
																<input type="number" min="0" step="0.00" class="form-control" name="price">
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="initial_stock">Stock: <span class="required">*</span></label>
																	<input type="number" min="0" step="1" pattern="\d+" class="form-control" name="initial_stock">
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="position">Position: </label>
																	<input type="text" class="form-control" name="position">
																</div>		
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="status">Estado: <span class="required">*</span></label>
																	<select name="status" class="form-control">
																		<option value="">--Seleccionar--</option>
																		<option value="enabled">Habilitado</option>
																		<option value="disabled">Desabilitado</option>
																	</select>
																</div>	
															</div>
														</div>
													</div>
													
													<div id="gallery" class="tab-pane">
														<div class="form-group">
															<label for="small_image">Imagen pequeña: </label>
															<input type="file" name="small_image" class="form-control">
														</div>
														<div class="form-group">
															<label for="image">Imagen: </label>
															<input type="file" name="image" class="form-control">
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
														<div class="items row">
															
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

				<hr>
				<div class="wizard-actions">
					<button class="btn btn-prev" disabled="disabled">
						<i class="ace-icon fa fa-arrow-left"></i>
						<span>Anterior</span>
					</button>
					<button class="btn btn-success btn-next save-form" data-last="Finish">
						<span>Siguiente</span>
						<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
					</button>
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
				<button class="btn btn-success pull-right mb-4" id="modal-filterable-products"
				data-modal-filterable-products-url="{{ route('admins.product.filterable') }}"><i class="fa fa-search"></i>&nbsp;Buscar</button>
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
							<th><input type="text" class="col-md-12"></th>
							<th><input type="text"></th>
							<th><input type="text"></th>
							<th class="col-md-12">
								<span class="col-md-3 mt-4">Desde:&nbsp;</span>
								<input type="text" class="col-md-3">
								<span class="col-md-3 mt-4">Hasta:&nbsp;</span>
								<input type="text" class="col-md-3">
							</th>
						</tr>
					</thead>
					<tbody id="modal-table-products"></tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="modal-products-option-items-add">Guardar</button>
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