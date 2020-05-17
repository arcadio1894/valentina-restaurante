@extends('layouts.appAdmin')

@section('styles')
    <style>
        .no-data{
            text-align: center;
        }
        .new{
            margin-bottom: 15px;
        }
    </style>
    <link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
@endsection

@section('breadcrumb')
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            Catálogo
        </li>
        <li>
            <a href="{{ route('admins.product.index') }}">Productos</a>
        </li>
        <li class="active">Listado</li>
    </ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row new">
            <div class="col-md-12">
                <a href="{{route('admins.product.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nueva producto</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Posicion</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($products) == 0)
                            <tr>
                                <td colspan="4" class="no-data">No existen datos</td>
                            </tr>
                        @else
                            @foreach($products as $key=>$product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if($product->small_image)
                                            <img src="{{ asset('/admin/assets/images/product/'.$product->small_image) }}" alt="{{ $product->name }}" height="100">
                                        @endif
                                    </td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->type === 'simple' ? 'Simple' : 'Paquete' }}</td>
                                    <td>S/ {{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->status === 'enabled' ? 'Habilitado' : 'Deshabilitado' }}</td>
                                    <td>{{ $product->position }}</td>
                                    <td>
                                        <a href="{{ route('admins.product.edit', $product->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a>

                                        <button
                                            class="btn btn-danger button-modal-delete" 
                                            data-modal-configure-title="Eliminar producto"
                                            data-modal-configure-name="{{ $product->name }}"
                                            data-modal-configure-id="{{ $product->id }}"
                                            data-modal-configure-url="{{ route('admins.product.delete') }}"
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