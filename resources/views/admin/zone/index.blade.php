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

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row new">
            <div class="col-md-12">
                <a href="{{route('admins.zone.create')}}" class="btn btn-success">Nueva zona</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Zona</th>
                            <th>Estado</th>
                            <th>Fecha de creación</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($zones) == 0)
                            <tr>
                                <td colspan="4" class="no-data">No existen datos</td>
                            </tr>
                        @else
                            @foreach($zones as $key=>$zone)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $zone->name }}</td>
                                    <td>{{ $zone->status }}</td>
                                    <td>{{ $zone->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admins.zone.update', $zone->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a>

                                        <a href="{{ route('admins.zone.delete', $zone->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
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