@extends('layouts.appAdmin')

@section('styles')
    <style>
        .no-data{
            text-align: center;
        }
        .new{
            margin-bottom: 15px;
        }
        .image-container img{
            height: 100px;
        }
    </style>
    <link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            Métodos de pago
        </li>
        <li>
            <a href="{{ route('admins.paymentmethod.index') }}">Métodos de pago</a>
        </li>
        <li class="active">Listado</li>
    </ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row new">
            <div class="col-md-12">
                <a href="{{route('admins.paymentmethod.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nuevo método de pago</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Método</th>
                            <th>Código</th>
                            <th>Imagen</th>
                            <th>Posicion</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($paymentmethods) == 0)
                            <tr>
                                <td colspan="7" class="no-data">No existen datos</td>
                            </tr>
                        @else
                            @foreach($paymentmethods as $key=>$paymentmethod)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $paymentmethod->name }}</td>
                                    <td>{{ $paymentmethod->code }}</td>
                                    <td>
                                        @if($paymentmethod->image)
                                            <div class="image-container">
                                                <img src="{{ asset('/admin/assets/images/paymentmethod/'.$paymentmethod->image) }}" alt="{{ $paymentmethod->name }}">
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $paymentmethod->position }}</td>
                                    <td>{{ $paymentmethod->status === 'enabled' ? 'Habilitado' : 'Deshabilitado' }}</td>
                                    <td>
                                        <a href="{{ route('admins.paymentmethod.edit', $paymentmethod->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a>

                                        <button
                                            class="btn btn-danger button-modal-delete" 
                                            data-modal-configure-title="Eliminar Método de pago"
                                            data-modal-configure-name="{{ $paymentmethod->name }}"
                                            data-modal-configure-id="{{ $paymentmethod->id }}"
                                            data-modal-configure-url="{{ route('admins.paymentmethod.delete') }}"
                                            >
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.toast.js') }}"></script>
    <script src="{{ asset('js/admin/functions.js') }}"></script>
@endsection