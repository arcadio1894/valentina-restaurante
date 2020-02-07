@extends('layouts.appAdmin')

@section('styles')
    <link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet">
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
            <a href="#">Inicio</a>
        </li>

        <li>
            <a href="#">Tiendas</a>
        </li>
        <li class="active">Listado</li>
    </ul><!-- /.breadcrumb -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row new">
            <div class="col-md-12">
                <a href="{{route('admins.store.create')}}" class="btn btn-success">Nueva tienda</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-striped" id="dynamic-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tienda</th>
                            <th scope="col">Horario</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de creación</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($stores) == 0)
                            <tr>
                                <td >No existen datos</td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                            </tr>
                        @else
                            @foreach($stores as $key=>$store)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $store->name }}</td>
                                    <td>{{ $store->attention_schedule }}</td>
                                    <td>
                                        {{ $store->status == 'enabled'? 'Habilitada':'Deshabilitada' }}
                                    </td>
                                    <td>{{ $store->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admins.store.edit', $store->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a>

                                        <a data-eliminar data-id="{{ $store->id }}" data-name="{{ $store->name }}" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
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

<div id="modalEliminar" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h5 class="modal-title">Eliminar Tienda</h5>
                </div>
                <div class="col-md-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <form id="formEliminar" data-url="{{ route('admins.store.delete') }}">
                {{ csrf_field() }}
                <input type="hidden" name="store_id" id="id_delete">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nameD">¿Está seguro de eliminar esta tienda?</label>
                        <input type="text" class="form-control" id="nameD" name="nameD" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.toast.js') }}"></script>
    <script src="{{asset('js/admin/store/index.js')}}"></script>
    <script src="{{ asset('admin/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.select.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($) {
            //initiate dataTables plugin
            var myTable =
                    $('#dynamic-table')
                    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                            .DataTable( {
                                bAutoWidth: false,
                                "aoColumns": [
                                    null, null,null, null, null,
                                    { "bSortable": false }
                                ],
                                "aaSorting": [],


                                //"bProcessing": true,
                                //"bServerSide": true,
                                //"sAjaxSource": "http://127.0.0.1/table.php"	,

                                //,
                                //"sScrollY": "200px",
                                //"bPaginate": false,

                                //"sScrollX": "100%",
                                //"sScrollXInner": "120%",
                                //"bScrollCollapse": true,
                                //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                                //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                                //"iDisplayLength": 50


                                select: {
                                    style: 'multi'
                                }
                            } );



            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

            new $.fn.dataTable.Buttons( myTable, {
                buttons: [
                    {
                        "extend": "colvis",
                        "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)'
                    },
                    {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "csv",
                        "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "pdf",
                        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: false,
                        message: 'This print was produced using the Print button for DataTables'
                    }
                ]
            } );
            myTable.buttons().container().appendTo( $('.tableTools-container') );

            //style the message box
            var defaultCopyAction = myTable.button(1).action();
            myTable.button(1).action(function (e, dt, button, config) {
                defaultCopyAction(e, dt, button, config);
                $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
            });


            var defaultColvisAction = myTable.button(0).action();
            myTable.button(0).action(function (e, dt, button, config) {

                defaultColvisAction(e, dt, button, config);


                if($('.dt-button-collection > .dropdown-menu').length == 0) {
                    $('.dt-button-collection')
                            .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                            .find('a').attr('href', '#').wrap("<li />")
                }
                $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
            });

            ////

            setTimeout(function() {
                $($('.tableTools-container')).find('a.dt-button').each(function() {
                    var div = $(this).find(' > div').first();
                    if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                    else $(this).tooltip({container: 'body', title: $(this).text()});
                });
            }, 500);

            myTable.on( 'select', function ( e, dt, type, index ) {
                if ( type === 'row' ) {
                    $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
                }
            } );
            myTable.on( 'deselect', function ( e, dt, type, index ) {
                if ( type === 'row' ) {
                    $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
                }
            } );

            //table checkboxes
            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
            //select/deselect all rows according to table header checkbox
            $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
                var th_checked = this.checked;//checkbox inside "TH" table header

                $('#dynamic-table').find('tbody > tr').each(function(){
                    var row = this;
                    if(th_checked) myTable.row(row).select();
                    else  myTable.row(row).deselect();
                });
            });
            //select/deselect a row when the checkbox is checked/unchecked
            $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
                var row = $(this).closest('tr').get(0);
                if(this.checked) myTable.row(row).deselect();
                else myTable.row(row).select();
            });
            $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });
        })
    </script>
@endsection