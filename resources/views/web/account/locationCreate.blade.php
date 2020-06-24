@extends('layouts.appUser')

@section('styles')
    <style>
        .active{
            background-color: #F2C64D !important;
            font-weight: bold;
        }
        .small-button{
            line-height: 30px !important;
            margin-right: 1em;
        }
        .nice-select:focus {
            background-color: #ff5e13 !important;
        }
        .required{
            color: red;
            font-size: 18px;
        }
    </style>
@endsection

@section('content')
<div class="best_burgers_area">

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('web.account.orders') }}">Mis Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('web.account.user') }}">Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('web.account.location') }}">Direcciones</a>
            </li>
        </ul>
        <br>
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Éxito!</strong> {{Session::get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <input type="hidden" name="polygons" id="polygons" value="{{ json_encode($polygons,TRUE) }}">
                <form method="POST" class="form-horizontal" action="{{ route('web.account.location.store') }}">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="mt-10 form-group">
                                <label for="name" class="control-label">Nombre <span class="required">(*)</span></label>
                                <input id="name" type="text" class="single-input-primary" name="name" value="{{ $customer->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="type_doc" class="control-label">Tipo de Documento <span class="required">(*)</span></label>
                                <div class="form-select" id="default-select">
                                    <select name="type_doc" id="type_doc" class="">
                                        <option value="dni" >DNI</option>
                                        <option value="passport" >Pasaporte</option>
                                    </select>

                                </div>
                                @if ($errors->has('type_doc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_doc') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="phone" class="control-label">Teléfono <span class="required">(*)</span></label>
                                <input id="phone" type="text" class="single-input-primary" name="phone" value="" required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mt-10 form-group">
                                <label for="lastname" class="control-label">Apellidos <span class="required">(*)</span></label>
                                <input id="lastname" type="text" class="single-input-primary" name="lastname" value="{{ $customer->lastname }}" required >
                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="document" class="control-label">Número de documento <span class="required">(*)</span></label>
                                <input id="document" type="text" class="single-input-primary" name="document" value="" required >
                                @if ($errors->has('document'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('document') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="email" class="control-label">Email <span class="required">(*)</span></label>
                                <input id="email" type="text" class="single-input-primary" name="email" value="{{ $customer->email }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address" class="control-label">Dirección <span class="required">(*)</span></label>
                                <input id="address" type="text" class=" col-md-12 single-input-primary" name="address" value="" required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                            <span id="divmap"></span>
                            <div style="width: 100%;height: 400px" id="map"></div>
                            <input type="hidden" id="loc_lat" value="" name="latitude" />
                            <input type="hidden" id="loc_long" value="" name="longitude" />
                        </div>

                        <div class="col-md-12">
                            <div class="mt-10 form-group">
                                <label for="type_place" class="control-label">Tipo de lugar <span class="required">(*)</span></label>
                                <div class="form-select" id="default-select">
                                    <select class="col-md-6" name="type_place" id="type_place">
                                        <option value="home" >Casa</option>
                                        <option value="business" >Empresa</option>
                                        <option value="department" >Departamento</option>
                                        <option value="hotel">Hotel</option>
                                        <option value="condominium">Condominio</option>
                                    </select>
                                </div>
                                @if ($errors->has('type_place'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('type_place') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mt-10 form-group">
                                <label for="reference" class="control-label">Referencia (opcional)</label>
                                <textarea id="reference" name="reference" class="single-textarea single-input-primary" onfocus="this.placeholder = ''"
                                          onblur="this.placeholder = 'Referencia'" required>  </textarea>
                                @if ($errors->has('reference'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reference') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="col-sm-offset-3 col-sm-9 no-padding-right">
                                <span class="required">(*)</span> campos obligatorios
                            </label>
                        </div>

                        <div class="col-md-4 offset-4">
                            <div class="mx-auto">
                                <button type="submit" class="genric-btn primary-border e-large btn-block">
                                    Guardar cambios
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="//maps.googleapis.com/maps/api/js?&libraries=places,drawing,geometry&key={{ env('G_MAPS_API_KEY') }}"></script>
    <script src="{{ asset('js/jquery.toast.js') }}"></script>
    <script src="{{asset('js/user/account/locationCreate.js')}}"></script>
@endsection