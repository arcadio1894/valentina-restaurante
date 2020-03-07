@extends('layouts.appAdmin')

@section('styles')
    <style>
        .no-data{
            text-align: center;
        }
        .new{
            margin-bottom: 15px;
        }
        .img-category{
            width: 100px;
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
            <a href="{{ route('admins.category.index') }}">Categorías</a>
        </li>
        <li class="active">Listado</li>
    </ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row new">
            <div class="col-md-12">
                <a href="{{route('admins.category.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nueva categoría</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Categoría padre</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th>Posicion</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($categories) == 0)
                            <tr>
                                <td colspan="4" class="no-data">No existen datos</td>
                            </tr>
                        @else
                            @foreach($categories as $key=>$category)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ ($category->parent_category)? $category->parent_category->name:'' }}</td>
                                    <td>
                                        @php
                                            $url = asset('admin/assets/images/gallery/default.png');

                                            if($category->image){
                                                $url = asset('admin/assets/images/category').'/'.$category->image;
                                            }
                                        @endphp

                                        <img src="{{ $url  }}" alt="" class="img-category">
                                    </td>
                                    <td>{{ $category->status }}</td>
                                    <td>{{ $category->position }}</td>
                                    <td>
                                        <a href="{{ route('admins.category.edit', $category->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a>

                                        <a href="{{ route('admins.category.delete', $category->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
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