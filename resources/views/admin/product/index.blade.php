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
                            <th>Nombre</th>
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
                                    <td>{{ $product->status }}</td>
                                    <td>{{ $product->position }}</td>
                                    <td>
                                        <a href="{{ route('admins.product.edit', $product->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a>

                                        <a href="{{ route('admins.product.delete', $product->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
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