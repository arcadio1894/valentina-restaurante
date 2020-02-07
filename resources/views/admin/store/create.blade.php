@extends('layouts.appAdmin')

@section('styles')
	<style>
		#map{
			width: 100%;
			height: 500px;
		}
	</style>
    <link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Inicio</a>
		</li>

		<li>
			<a href="#">Tiendas</a>
		</li>
		<li class="active">Listado</li>
	</ul><!-- /.breadcrumb -->
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">CREAR TIENDA</div>

				<div class="panel-body" id="body">
					<form id="formRegistrar" data-url="{{ route('admins.store.store') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="name"> Nombre: </label>

							<div class="col-sm-9">
								<input type="text" id="name" placeholder="Nombre" name="name" class="col-xs-10 col-sm-5" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="code"> Código: </label>

							<div class="col-sm-9">
								<input type="text" id="code" placeholder="Código" name="code" class="col-xs-10 col-sm-5" />
							</div>
						</div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="service"> Servicios: </label>

                            <div class="col-sm-9">
                                <select id="service" name="service" class="col-xs-10 col-sm-5" data-placeholder="Seleccione el servicio...">
                                    <option value="delivery">Delivery</option>
                                    <option value="pickup">Pickup</option>
                                    <option value="full">Full</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="image"> Imagen: </label>

                            <div class="col-sm-9">
                                <input type="file" id="image" name="image" />
                            </div>
                        </div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="address"> Dirección: </label>

							<div class="col-sm-9">
								<textarea class=" col-xs-10 col-sm-5" id="address" name="address" placeholder="Dirección"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="phone"> Teléfono: </label>

							<div class="col-sm-9">
								<input type="text" id="phone" placeholder="Teléfono" name="phone" class="col-xs-10 col-sm-5" />
							</div>
						</div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="attention_schedule"> Horario de atención: </label>

                            <div class="col-sm-9">
                                <textarea class=" col-xs-10 col-sm-5" id="attention_schedule" name="attention_schedule" placeholder="Horario de atención"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="longitude"> Longitud: </label>

                            <div class="col-sm-9">
                                <input type="text" id="longitude" placeholder="Longitud" name="longitude" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="latitude"> Latitud: </label>

                            <div class="col-sm-9">
                                <input type="text" id="latitude" placeholder="Latitud" name="latitude" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="longitude"> Orden: </label>

                            <div class="col-sm-9">
                                <input type="text" id="order" placeholder="Orden" name="order" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="status"> Estado: </label>

                            <div class="col-sm-9">
                                <select id="status" name="status" class="col-xs-10 col-sm-5" data-placeholder="Seleccione el estado...">
                                    <option value="enabled">Habilitado</option>
                                    <option value="disabled">Deshabilitado</option>
                                </select>

                            </div>
                        </div>

						<div class="form-actions center">
                            <a href="{{route('admins.store.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Volver</a>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/jquery.toast.js') }}"></script>
	<script src="{{asset('js/admin/store/create.js')}}"></script>
@endsection