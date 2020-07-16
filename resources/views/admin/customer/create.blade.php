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
			<a href="{{ route('admins.customer.index') }}">Clientes</a>
		</li>
		<li class="active">Crear</li>
	</ul><!-- /.breadcrumb -->
@endsection

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">CREAR CLIENTE</div>

				<div class="panel-body" id="body">
					<form id="formRegistrar" data-url="{{ route('admins.customer.store') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
						{{ csrf_field() }}
                        <input type="hidden" name="polygons" id="polygons" value="{{ ($polygons) }}">
                        <input type="hidden" name="role_id" value="2">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="control-label col-sm-4" for="name">Nombre (*)</label>
                                <div class="col-sm-8">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('type_doc') ? ' has-error' : '' }}">
                                <label for="type_doc" class="control-label col-sm-4">Tipo de Documento (*)</label>
                                <div class="form-select col-sm-8" id="default-select">
                                    <select name="type_doc" id="type_doc" class="form-control">
                                        <option value="dni">DNI</option>
                                        <option value="passport">Pasaporte</option>
                                    </select>
                                    @if ($errors->has('type_doc'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type_doc') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <label for="birthday" class="control-label col-sm-4">Cumpleaños (*)</label>
                                <div class="col-sm-8">
                                    <input id="birthday" type="date" class="form-control" name="birthday" required>
                                    @if ($errors->has('birthday'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="control-label col-sm-4">Teléfono (*)</label>
                                <div class="col-sm-8">
                                    <input id="phone" type="text" class="form-control" name="phone" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label col-sm-4">Password (*)</label>
                                <div class="col-sm-8">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <small id="passwordHelpInline" class="">
                                        La contraseña debe tener mínimo seis caracteres, al menos tener una letra en mayúscula, una letra minúscula y un caracter(#?!_@$%^&*-) y un número.</small>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label for="lastname" class="control-label col-sm-4">Apellidos (*)</label>
                                <div class="col-sm-8">
                                    <input id="lastname" type="text" class="form-control" name="lastname" required autofocus>
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="document" class="control-label col-sm-4">Número de documento (*)</label>
                                <div class="col-sm-8">
                                    <input id="document" type="text" class="form-control" name="document" required autofocus>
                                    @if ($errors->has('document'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group {{ $errors->has('genre') ? ' has-error' : '' }}">
                                <label for="genre" class="control-label col-sm-4">Género (*)</label>
                                <div class="form-select col-sm-8" id="default-select">
                                    <select name="genre" id="genre" class="form-control">
                                        <option value="male">Masculino</option>
                                        <option value="female">Femenino</option>
                                    </select>
                                    @if ($errors->has('genre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('genre') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label col-sm-4">Correo electrónico (*)</label>
                                <div class="col-sm-8">
                                    <input id="email" type="email" class="form-control" name="email" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="control-label col-sm-4">Confirmar contraseña (*)</label>
                                <div class="col-sm-8">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="control-label col-sm-2">Dirección (*)</label>
                                <div class="col-sm-10">
                                    <input id="address" type="text" class="form-control" name="address" required autofocus>
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div style="width: 100%;height: 400px" id="map"></div>
                            <br>
                            <input type="hidden" id="loc_lat" name="latitude" />
                            <input type="hidden" id="loc_long" name="longitude" />
                        </div>

                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('type_place') ? ' has-error' : '' }}">
                                <label for="type_place" class="control-label col-sm-2">Tipo de lugar (*)</label>
                                <div class="form-select col-sm-10" id="default-select">
                                    <select class="col-md-4" name="type_place" id="type_place">
                                        <option value="home">Casa</option>
                                        <option value="business">Empresa</option>
                                        <option value="department">Departamento</option>
                                        <option value="hotel">Hotel</option>
                                        <option value="condominium">Condominio</option>
                                    </select>
                                    @if ($errors->has('type_place'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type_place') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
                                <label for="reference" class="control-label col-sm-2">Referencia (opcional)</label>
                                <div class="col-sm-10">
                                    <textarea id="reference" name="reference" class="form-control" onfocus="this.placeholder = ''"
                                              onblur="this.placeholder = 'Referencia'" required></textarea>
                                    @if ($errors->has('reference'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('reference') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                        	<label class="col-sm-offset-2 col-sm-10 no-padding-right">
                        		<span class="required">*</span> campos obligatorios
                        	</label>
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
	<script src="https://maps.googleapis.com/maps/api/js?&libraries=places&key={{ env('G_MAPS_API_KEY') }}"></script>
	<script src="{{asset('js/admin/customer/create.js')}}"></script>
@endsection