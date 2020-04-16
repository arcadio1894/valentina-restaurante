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
                @foreach( $locations as $location )
                    <div class="card">
                        <div class="card-header">
                            @switch($location->type_place)
                                @case('condominium')
                                <span>CONDOMINIO </span>
                                @break

                                @case('business')
                                <span>NEGOCIO</span>
                                @break

                                @case('hotel')
                                <span>HOTEL</span>
                                @break

                                @case('department')
                                <span>DEPARTAMENTO</span>
                                @break

                                @default
                                <span>CASA</span>
                            @endswitch

                            <a href="{{ route('web.account.location.delete') }}" class="genric-btn small-button primary-border btn-sm pull-right"
                               onclick="event.preventDefault();
                               document.getElementById('delete-form').submit();"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Eliminar
                            </a>

                            <form id="delete-form" action="{{ route('web.account.location.delete') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="location_id" value="{{ $location->id }}">
                            </form>
                            <a href="{{ route('web.account.location.edit', $location->id) }}" class="genric-btn small-button primary-border btn-sm pull-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Editar</a>
                        </div>
                        <div class="card-body">
                            <h5 style="display:inline" class="card-title">Direccion: </h5>
                            <p style="display:inline" class="card-text">{{ $location->address }}</p>
                            <hr>
                            <h5 style="display:inline" class="card-title">Documento: </h5>
                            <p style="display:inline" class="card-text">{{ $location->document }}</p>
                        </div>
                    </div>
                    <br>
                @endforeach
                <a href="#" class="genric-btn small-button primary-border btn-sm pull-right">
                    <i class="fa fa-map-marker fa-lg"></i>&nbsp;
                    Agregar dirección
                </a>

            </div>
        </div>
    </div>
</div>

@endsection