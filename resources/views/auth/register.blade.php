@extends('layouts.appUser')

@section('bradcam_area')
    <div class="bradcam_area breadcam_bg_2">
        <h3>Regístrate Aquí</h3>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
    <style>
        input, textarea {
            border-style: solid !important;
            border-color: #F0542C !important;
        }
        .form-select .nice-select {
            border-style: solid  !important;
            border-color: #F0542C !important;
            border-width: 1px;
        }
    </style>
@endsection

@section('activeRegister')
    active
@endsection

@section('content')
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <span>Al registrarse autoriza el tratamiento de sus datos personales</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10 offset-1">
                <form method="POST" class="form-horizontal" action="">
                    <input type="hidden" name="polygons" id="polygons" value="{{ $polygons }}">
                    <div class="row">
                        {{ csrf_field() }}
                        <input type="hidden" name="role_id" value="2">
                        <div class="col-md-12">
                            <div class="mt-10 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">Nombre completo (*)</label>
                                <input id="name" type="text" class="col-md-6 single-input-primary" name="name" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-10 form-group {{ $errors->has('type_doc') ? ' has-error' : '' }}">
                                <label for="type_doc" class="control-label">Tipo de Documento (*)</label>
                                <div class="form-select" id="default-select">
                                    <select name="type_doc" id="type_doc" class="">
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
                            <div class="mt-10 form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <label for="birthday" class="control-label">Cumpleaños (*)</label>
                                <input id="birthday" type="date" class="single-input-primary" name="birthday" required>

                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="control-label">Teléfono (*)</label>
                                <input id="phone" type="text" class="single-input-primary" name="phone" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Password (*)</label>
                                <input id="password" type="password" class="single-input-primary" name="password" required>
                                <small id="passwordHelpInline" class="text-muted">
                                    La contraseña debe tener mínimo seis caracteres, al menos tener una letra en mayúscula, una letra minúscula y un caracter(#?!_@$%^&*-) y un número.</small>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-10 form-group">
                                <label for="document" class="control-label">Número de documento (*)</label>
                                <input id="document" type="text" class="single-input-primary" name="document" required autofocus>
                                @if ($errors->has('document'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group {{ $errors->has('genre') ? ' has-error' : '' }}">
                                <label for="genre" class="control-label">Género (*)</label>
                                <div class="form-select" id="default-select">
                                    <select name="genre" id="genre">
                                        <option value="male">Masculino</option>
                                        <option value="female">Femenino</option>
                                    </select>
                                </div>
                                @if ($errors->has('genre'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">Correo electrónico (*)</label>
                                <input id="email" type="email" class="single-input-primary" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="password-confirm" class="control-label">Confirmar contraseña (*)</label>
                                <input id="password-confirm" type="password" class="single-input-primary" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="control-label">Dirección (*)</label>
                                <input id="address" type="text" class=" col-md-12 single-input-primary" name="address" required autofocus>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div style="width: 100%;height: 400px" id="map"></div>
                            <br>
                        </div>

                        <div class="col-md-12">
                            <div class="mt-10 form-group {{ $errors->has('type_place') ? ' has-error' : '' }}">
                                <label for="type_place" class="control-label">Tipo de lugar (*)</label>
                                <div class="form-select" id="default-select">
                                    <select class="col-md-6" name="type_place" id="type_place">
                                        <option value="home">Casa</option>
                                        <option value="business">Empresa</option>
                                        <option value="department">Departamento</option>
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
                            <div class="mt-10 form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
                                <label for="reference" class="control-label">Referencia (opcional)</label>
                                <textarea id="reference" name="reference" class="single-textarea single-input-primary" onfocus="this.placeholder = ''"
                                      onblur="this.placeholder = 'Referencia'" required></textarea>
                                @if ($errors->has('reference'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reference') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4 offset-4">
                            <div class="mx-auto">
                                <button type="submit" class="genric-btn primary-border e-large btn-block">
                                    Registrarme
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?&libraries=places,drawing,geometry&key={{ env('G_MAPS_API_KEY') }}"></script>
    <script src="{{ asset('js/jquery.toast.js') }}"></script>
    <script src="{{asset('js/user/auth/register.js')}}"></script>
@endsection
