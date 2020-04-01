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
        .ml-5{
            margin-left: 5px;
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
                <a href="{{route('admins.category.create','')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nueva categoría raíz</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-box widget-color-blue2">
                    <div class="widget-header">
                        <h4 class="widget-title lighter smaller">Lista de categorías</h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-8">
                            <ul id="tree2" class="tree tree-unselectable tree-folder-select" role="tree">
                                <li class="tree-branch hide" data-template="treebranch" role="treeitem" aria-expanded="false">
                                    <i class="icon-caret ace-icon tree-plus"></i>&nbsp;
                                    <div class="tree-branch-header">
                                        <span class="tree-branch-name">
                                            <i class="icon-folder ace-icon fa fa-folder"></i>
                                            <span class="tree-label"></span>
                                        </span>
                                    </div>
                                    <ul class="tree-branch-children" role="group"></ul>
                                    <div class="tree-loader hidden" role="alert">
                                        <div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i>
                                        </div>
                                    </div>
                                </li>
                                <li class="tree-item hide" data-template="treeitem" role="treeitem">
                                    <span class="tree-item-name">
                                        <span class="tree-label"></span>
                                    </span>
                                </li>

                                {!! $htmlCategories !!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="url_category_update" value="{{ route('admins.category.edit','') }}">
    <input type="hidden" id="url_category_delete" value="{{ route('admins.category.delete','') }}">
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/category/index.js') }}"></script>
@endsection