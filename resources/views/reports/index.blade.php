<!--
# @Author: Codeals
# @Date:   20-06-2019
# @Email:  ian@codeals.es
# @Last modified by:   alejandro
# @Last modified time: 2020-01-16T16:24:17+01:00
# @Copyright: Codeals
-->

@extends('layouts.app')

@section('css')

<!--begin::Page Vendors Styles(used by this page) -->
<!-- <link href="{{ asset('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> -->
<!--end::Page Vendors Styles -->

<!--begin::Page Custom Styles(used by this page) -->
<!-- <link href="assets/css/demo4/pages/general/file-upload/uppy.bundle.css" rel="stylesheet" type="text/css" /> -->

<style media="screen">
    table.dataTable tbody > tr.selected, table.dataTable tbody > tr > .selected {
        background-color: #1dc9b7;;
    }
    body.modal-open {
        height: 100vh;
        overflow-y: hidden !important;
        position: inherit;
    }
    .kt_table-overflow  {
        overflow: auto;
    }
    .uppy-DashboardItem-progress-left {
        -webkit-transform: none;
        transform: none;
        bottom: -15px;
        right: -15px;
        left: auto;
        width: auto;
        display: block;
        position: absolute;
        -webkit-transform: translate(-50%,-50%);
        transform: translate(-50%,-50%);
        z-index: 1002;
        text-align: center;
        -webkit-transition: all .35 ease;
        transition: all .35 ease;
    }
</style>

@endsection

@section('content')


<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

<!-- NOTIFICACION -->
    @if(Session::has('msg'))
        <div class="alert alert-success fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-report-ok"></i></div>
            <div class="alert-text">{{ Session::get('msg') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
    @endif

    @if(Session::has('err'))
        <div class="alert alert-danger fade show" role="alert">
            <div class="alert-icon"><i class="flaticon2-cross"></i></div>
            <div class="alert-text">{{ Session::get('err') }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
     @endif

    <div class="kt-container kt-grid__item kt-grid__item--fluid mt-5">

        <div class="alert alert-light alert-elevate" role="alert">
            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
            <div class="alert-text">
                    Listado de reportes del sistema. <a class="kt-link kt-font-bold" href="https://codeals.es/" target="_blank">here</a>.
            </div>
        </div>

        <div class="kt-portlet kt-portlet--mobile">

            <div class="kt-portlet kt-portlet--mobile">

                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-primary la la-bell"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Lista de Reportes
                        </h3>
                    </div>
                        
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                &nbsp;
                                <a id="deleteReport" style="color: #fff;" class="btn btn-danger btn-elevate btn-icon-sm">
                                    <i class="la la-trash"></i>
                                    Eliminar Selección
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    
                    <div class="tab-content">
                        <div class="kt-portlet__body">
                            <!--begin: Datatable -->
                            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                                <thead>
                                    <tr>
                                        <th>Record ID</th>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Longitude</th>
                                        <th>latitude</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Description</th>
                                        <th>Creado</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reports as $report)
                                        <tr>
                                            <td>{{$report->found->id}}</td>
                                            <td>{{$report->found->id}}</td>
                                            <td>{{$report->user->email}}</td>
                                            <td>{{$report->found->longitude}}</td>
                                            <td>{{$report->found->latitude}}</td>
                                            <td>{{$report->found->product->product}}</td>
                                            <td>{{$report->found->quantity}}</td>
                                            <td>{{$report->found->description}}</td>
                                            <td>{{$report->created_at}}</td>
                                            <td>
                                                {!! Form::open(['route' => ['admin.reports.destroy', $report->id], 'id' => 'form_report_'.$report->id, 'style' => 'display: inline']) !!}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" form-id="form_report_{{$report->id}}" data-dialog="delete_dialog" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Eliminar">
                                                                <i class="la la-trash"></i>
                                                        </button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end: Datatable -->
                        </div>

                    </div>
                    <!-- <div class="kt-separator kt-separator--dashed"></div> -->

                    <!-- Form report -->
                    <form action="{{ route('admin.reports.multidestroy') }}" method="post" id="form-report" class="form-signin" style="text-align: center;">
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-stick-to-bottom fade" id="delete_dialog" role="dialog" data-backdrop="false" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Atención</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button>
                            </div>
                            <div class="modal-body">
                                    <p>Desea eliminar el reporte</p>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger delete">Aceptar</button>
                            </div>
                    </div>
            </div>
    </div>

    
</div>
    <!-- end:: Content -->

@endsection

@section('js')

<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>


<script type="text/javascript">
    var form_to_submit = '';

    $(document).ready(function() {

        $('[data-dialog]').click(function (e) {
            e.preventDefault();
            form_to_submit = $(this).attr('form-id');
            $('#delete_dialog').modal('show');
        });

        $('.delete').click(function () {
            if(form_to_submit != '') {
                // alert('Eliminar '+form_to_submit);
                $("#"+form_to_submit).submit();
            }
        });
    });

</script>

<script type="text/javascript">
    var tableReport = 0;

    $(document).ready(function() {

        /**
         * Submir recharge
         * @var [type]
         */
        $('#deleteReport').click(function(e) {
            e.preventDefault();
                console.log(tableReport);
                console.log(tableReport.rows({selected:true}));
                var selectedRows = tableReport.rows({selected:!0}).data();

                // alert(selectedRows.length)
                if (selectedRows.length > 0) {
                    for (var i = 0; i < selectedRows.length; i++) {
                        $('#form-report').append('<input type="hidden" name="reports['+i+'][id]" value="'+selectedRows[i][0]+'">');
                    }

                    $('#form-report').submit();
                } else {
                    notify('danger', false, '', '{!! trans('report.controller.empty_reports') !!}', 'la la-warning', true, true, true, false, 10, 2000, 'top', 'center', 30, 30, 1000, 10000, 'flash', 'flash');
                    return false;
                }
        });

    });

    // 
    var KTDatatablesCell = function() {
        var reportTable = function() {
            // begin first table

    		tableReport = $('#kt_table_1').DataTable({
                language: 'es',
                select: {
    				style: 'multi',
    				selector: 'td:first-child .kt-checkable',
    			},
    			headerCallback: function(thead, data, start, end, display) {
    				thead.getElementsByTagName('th')[0].innerHTML = `
                        <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--danger" style="margin: 0;">
                            <input type="checkbox" value="" class="kt-group-checkable">
                            <span></span>
                        </label>`;
                    $('#kt_table_1').parent().addClass('kt_table-overflow');
    			},
    			columnDefs: [
    				{
    					targets: 0,
                        width: '30px',
    					orderable: false,
    					render: function(data, type, full, meta) {
    						return `
                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid kt-checkbox--danger" style="margin: 0;">
                                <input type="checkbox" value="" class="kt-checkable">
                                <span></span>
                            </label>`;
    					},
    				}
    			],
    		});

    		tableReport.on('change', '.kt-group-checkable', function() {
    			var set = $(this).closest('table').find('td:first-child .kt-checkable');
    			var checked = $(this).is(':checked');

    			$(set).each(function() {
    				if (checked) {
    					$(this).prop('checked', true);
    					tableReport.rows($(this).closest('tr')).select();
    				}
    				else {
    					$(this).prop('checked', false);
    					tableReport.rows($(this).closest('tr')).deselect();
    				}
    			});
    		});
        };

        return {
            //main function to initiate the module
            init: function() {
                reportTable();
            },

        };
    }();

    // email

    // Class definition

    jQuery(document).ready(function() {
        // KTDatatablesNauta.init();
        KTDatatablesCell.init();

    });

</script>

@endsection
