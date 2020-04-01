@extends('layouts.appAdmin')

@section('styles')
<style>
	.mt-4{
		margin-top: 4px;
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
            <a href="{{ route('admins.category.index') }}">Productos</a>
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
								<select name="type" id="type" class="form-control">
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

												<li>
													<a data-toggle="tab" href="#options" class="options hide">Opciones</a>
												</li>
											</ul>
										</div>
									</div>
									
									<form action="{{ route('admins.product.store') }}" method="post" enctype="multipart/form-data">
										{{ csrf_field() }}
										<div class="widget-body">
											<div class="widget-main padding-6">
												<div class="tab-content">
													<div id="general" class="tab-pane in active">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="code">Código</label>
																	<input type="text" class="form-control" name="code">
																</div>	
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="name">Nombre</label>
																	<input type="text" class="form-control" name="name">
																</div>	
															</div>
														</div>
														<div class="form-group">
															<label for="description">Descripción</label>
															<textarea name="description" rows="4" class="form-control"></textarea>
														</div>
														<div class="form-group">
															<label for="price">Precio</label>
															<input type="text" class="form-control" name="price">
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="initial_stock">Stock inicial</label>
																	<input type="text" class="form-control" name="initial_stock">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="stock">Stock</label>
																	<input type="text" class="form-control" name="stock">
																</div>	
															</div>
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="position">Position</label>
																	<input type="text" class="form-control" name="position">
																</div>		
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="type">Estado</label>
																	<select name="type" class="form-control">
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
															<label for="image">Imagen pequeña</label>
															<input type="file" name="image" class="form-control">
														</div>
														<div class="form-group">
															<label for="small_image">Imagen</label>
															<input type="file" name="small_image" class="form-control">
														</div>
													</div>

													<div id="categories" class="tab-pane">
														<div class="widget-box widget-color-blue2">
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

																		<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
																			<i class="icon-caret ace-icon tree-minus"></i>&nbsp;
																			<div class="tree-branch-header">					<span class="tree-branch-name">						<i class="icon-folder red ace-icon fa fa-folder-open"></i>
																					<span class="tree-label">Pictures</span>
																				</span>
																			</div>
																			<ul class="tree-branch-children" role="group">
																				<li class="tree-branch tree-open tree-selected" role="treeitem" aria-expanded="true">
																					<i class="icon-caret ace-icon tree-minus"></i>&nbsp;
																					<div class="tree-branch-header">
																						<span class="tree-branch-name">
																							<i class="icon-folder pink ace-icon fa fa-folder-open"></i>
																							<span class="tree-label">Wallpapers</span>
																						</span>
																					</div>
																					<ul class="tree-branch-children" role="group">
																						<li class="tree-item" role="treeitem">
																							<span class="tree-item-name">
																								<span class="tree-label">
																									<i class="ace-icon fa fa-picture-o green"></i>wallpaper1.jpg
																								</span>
																							</span>
																						</li>
																					</ul>
																				</li>
																			</ul>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>

													<div id="options" class="tab-pane">
														<p>Options</p>
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
					<button class="btn btn-success btn-next" data-last="Finish">
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
			<button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/admin/product/create.js') }}"></script>
@endsection