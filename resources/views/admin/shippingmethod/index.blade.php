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
            Métodos de envío
        </li>
        <li>
            <a href="{{ route('admins.shippingmethod.index') }}">Métodos de envío</a>
        </li>
        <li class="active">Listado</li>
    </ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row new">
            <div class="col-md-12">
                <a href="{{route('admins.shippingmethod.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nuevo método de envío</a>
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
                        @if(count($shippingmethods) == 0)
                            <tr>
                                <td colspan="7" class="no-data">No existen datos</td>
                            </tr>
                        @else
                            @foreach($shippingmethods as $key=>$shippingmethod)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $shippingmethod->name }}</td>
                                    <td>{{ $shippingmethod->code }}</td>
                                    <td>
                                        @if($shippingmethod->image)
                                            <div class="image-container">
                                                <img src="{{ asset('/admin/assets/images/shippingmethod/'.$shippingmethod->image) }}" alt="{{ $shippingmethod->name }}">
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $shippingmethod->position }}</td>
                                    <td>{{ $shippingmethod->status === 'enabled' ? 'Habilitado' : 'Deshabilitado' }}</td>
                                    <td>
                                        <a href="{{ route('admins.shippingmethod.edit', $shippingmethod->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a>

                                        <button
                                            class="btn btn-danger button-modal-delete" 
                                            data-modal-configure-title="Eliminar Método de envío"
                                            data-modal-configure-name="{{ $shippingmethod->name }}"
                                            data-modal-configure-id="{{ $shippingmethod->id }}"
                                            data-modal-configure-url="{{ route('admins.shippingmethod.delete') }}"
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