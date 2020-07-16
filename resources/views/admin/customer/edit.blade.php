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
				<div class="panel-heading">EDITAR CLIENTE</div>

				<div class="panel-body" id="body">
                    <div class="col-sm-12">
                        {{-- FORMULARIO DE EDITAR --}}
                        <form id="formEdit" data-url="{{ route('admins.customer.update') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="role_id" value="2">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-4" for="name">Nombre (*)</label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $customer->name }}" required autofocus>
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

                            </div>

                            <div class="form-group">
                                <label class="col-sm-offset-2 col-sm-10 no-padding-right">
                                    <span class="required">*</span> campos obligatorios
                                </label>
                            </div>

                            <div class="form-actions center">
                                <a href="{{route('admins.customer.index')}}" class="btn btn-danger"><i class="fa fa-backward"></i> Volver</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                            </div>
                        </form>

                    </div>
                    <div class="col-sm-6">
                        {{-- GRILLA DE DIRECCIONES --}}
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($locations) == 0)
                                        <tr>
                                            <td >No existen datos</td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                        </tr>
                                    @else
                                        @foreach($locations as $key=>$location)
                                            <tr>
                                                <td>{{ $location->name }} {{ $customer->lastname }}</td>
                                                <td>{{ $location->address }}</td>
                                                <td>{{ $location->type }}</td>
                                                <td>
                                                    <a data-editar class="btn btn-danger"><i class="fa fa-pencil-square"></i> </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        {{-- EDITOR DE DIRECCIONES --}}
                        <form id="formEditLocation" data-url="{{--{{ route('admins.customer.location.edit') }}--}}" class="form-horizontal" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="polygons" id="polygons" value="{{ ($polygons) }}">
                            <input type="hidden" name="role_id" value="2">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-12 align-left" for="name">Nombre (*)</label>
                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('type_doc') ? ' has-error' : '' }}">
                                    <label for="type_doc" class="control-label col-md-12 align-left">Tipo de Documento (*)</label>
                                    <div class="form-select col-md-12" id="default-select">
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
                                    <label for="birthday" class="control-label col-md-12 align-left">Cumpleaños (*)</label>
                                    <div class="col-md-12">
                                        <input id="birthday" type="date" class="form-control" name="birthday" required>
                                        @if ($errors->has('birthday'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone" class="control-label col-md-12 align-left">Teléfono (*)</label>
                                    <div class="col-md-8">
                                        <input id="phone" type="text" class="form-control" name="phone" required>

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                    <label for="lastname" class="control-label col-md-12 align-left">Apellidos (*)</label>
                                    <div class="col-md-8">
                                        <input id="lastname" type="text" class="form-control" name="lastname" required autofocus>
                                        @if ($errors->has('lastname'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="document" class="control-label col-md-12 align-left">Número de documento (*)</label>
                                    <div class="col-sm-12">
                                        <input id="document" type="text" class="form-control" name="document" required autofocus>
                                        @if ($errors->has('document'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-group {{ $errors->has('genre') ? ' has-error' : '' }}">
                                    <label for="genre" class="control-label col-md-12 align-left">Género (*)</label>
                                    <div class="form-select col-md-12" id="default-select">
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
                                    <label for="email" class="control-label col-md-12 align-left">Correo electrónico (*)</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="control-label col-md-12 align-left">Dirección (*)</label>
                                    <div class="col-sm-12">
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
                                    <label for="type_place" class="control-label col-md-12 align-left">Tipo de lugar (*)</label>
                                    <div class="form-select col-sm-10" id="default-select">
                                        <select class="col-md-12" name="type_place" id="type_place">
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
                                    <label for="reference" class="control-label col-md-12 align-left">Referencia (opcional)</label>
                                    <div class="col-sm-12">
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
                                <label class="col-md-12 no-padding-right">
                                    <span class="required">*</span> campos obligatorios
                                </label>
                            </div>

                            <div class="form-actions center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/jquery.toast.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?&libraries=places&key={{ env('G_MAPS_API_KEY') }}"></script>
	<script src="{{asset('js/admin/customer/edit.js')}}"></script>
@endsection