@extends('layouts.appUser')

@section('styles')
    <style>
        .active{
            background-color: #F2C64D !important;
            font-weight: bold;
        }
        .nice-select:focus {
            background-color: #ff5e13 !important;
        }
        .usuario{
            background: transparent;
            padding: 12px 26px;
            font-size: 18px;
            font-weight: 400;
            border: 1px dashed #F2C64D;
            color: #F2C64D;
            border-radius: 10px;
            font-family: "Paytone One", sans-serif;
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
                <a class="nav-link active" href="{{ route('web.account.user') }}">Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('web.account.location') }}">Direcciones</a>
            </li>
        </ul>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 offset-1">
                <div class=" text-center">
                    <br>
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Éxito!</strong> {{Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="usuario">
                        Usuario: {{ $user->email }}
                    </div>

                </div>
                <form method="POST" class="form-horizontal" action="{{ route('web.customer.update') }}">
                    <div class="row">
                        {{ csrf_field() }}
                        <input type="hidden" name="role_id" value="2">
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="col-md-6">
                            <div class="mt-10 form-group">
                                <label for="name" class="control-label">Nombre (*)</label>
                                <input id="name" type="text" class="single-input-primary" name="name" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="type_doc" class="control-label">Tipo de Documento (*)</label>
                                <div class="form-select" id="default-select">
                                    <select name="type_doc" id="type_doc" class="">
                                        <option value="dni" {{ ( $user->type_doc == 'dni') ? 'selected' : '' }}>DNI</option>
                                        <option value="passport" {{ ( $user->type_doc == 'passport') ? 'selected' : '' }}>Pasaporte</option>
                                    </select>

                                </div>
                                @if ($errors->has('type_doc'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('type_doc') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="birthday" class="control-label">Cumpleaños (*)</label>
                                <input id="birthday" type="date" class="single-input-primary" name="birthday" value="{{ $user->birthday }}" required>
                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="phone" class="control-label">Teléfono (*)</label>
                                <input id="phone" type="text" class="single-input-primary" name="phone" value="{{ $user->phone }}" required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mt-10 form-group">
                                <label for="lastname" class="control-label">Apellidos (*)</label>
                                <input id="lastname" type="text" class="single-input-primary" name="lastname" value="{{ $user->lastname }}" required >
                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="document" class="control-label">Número de documento (*)</label>
                                <input id="document" type="text" class="single-input-primary" name="document" value="{{ $user->document }}" required >
                                @if ($errors->has('document'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-10 form-group">
                                <label for="genre" class="control-label">Género (*)</label>
                                <div class="form-select border" id="default-select" >
                                    <select name="genre" id="genre" >
                                        <option value="male" {{ ( $user->genre == 'male') ? 'selected' : '' }}>Masculino</option>
                                        <option value="female" {{ ( $user->genre == 'female') ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                </div>
                                @if ($errors->has('genre'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                </span>
                                @endif
                            </div>
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