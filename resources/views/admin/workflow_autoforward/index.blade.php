@extends('layouts.adminlte.default.layout')

@section('header')
<section class="content-header">
    <h1 class="hidden-sm hidden-xs">
        Manage Automatic Forward Configuration
        {{-- <small>Optional description</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i> System</a></li>
        <li class="active"><i class="fa fa-cog"></i> Manage Automatic Forward Configuration</li>
    </ol>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/form_extra.css">
<link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/bower_components/admin-lte/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@stop

@section('content')

<div class="modal fade" id="add-item">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('workflow_autoforward.add') }}" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-add"></i> Add Definition</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="app_type">Application Type</label>
                            <select name="app_type" id="app_type" class="form-control">
                                <option value="" disabled selected> - </option>
                                @foreach ($app_types as $key => $app_type)
                                    <option value="{{ $key }}">{{ $app_type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="app_sub_type">Application Sub Type</label>
                            <select name="app_sub_type" id="app_sub_type" class="form-control">
                                <option value="" disabled selected> - </option>
                                @foreach ($sub_types as $key => $sub_type)
                                    <option value="{{ $key }}">{{ $sub_type }}</option>
                                @endforeach
                                <option value="0">Not Applicable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="from_section">From Section</label>
                            <select name="from_section" id="from_section" class="form-control">
                                <option value="" disabled selected> - </option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->Region->name }} - {{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <div class="form-group">
                            <label for="from_position">From Position</label>
                            <select name="from_position" id="from_position" class="form-control">
                                <option value="" disabled selected> - </option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="is_unit_admin">Unit Admin?</label>
                            <select name="is_unit_admin" id="is_unit_admin" class="form-control">
                                <option value="0" selected>No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="to_section">To Section</label>
                            <select name="to_section" id="to_section" class="form-control">
                                <option value=""> - </option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->Region->name }} - {{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="to_position">To Position</label>
                            <select name="to_position" id="to_position" class="form-control">
                                <option value=""> - </option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="action_needed">Action</label>
                            <select name="action_needed" id="action_needed" class="form-control">
                                <option value=""> - </option>
                                @foreach ($actions as $key => $action)
                                    <option value="{{ $key }}">{{ $action['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="time_delay">Time Delay</label>
                            <input type="text" id="time_delay" name="time_delay" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="time_unit">Unit</label>
                            <select name="time_unit" id="time_unit" class="form-control">
                                <option value="" selected disabled> - </option>
                                @foreach ($delay_units as $key => $unit)
                                    <option value="{{ $key }}">{{ $unit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="text" name="order" id="order" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="accept_application" name="accept_application"> Accept Application
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="request_payment" name="request_payment"> Request Payment
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="request_inspection" name="request_inspection"> Request Inspection
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="generate_terms" name="generate_terms"> Generate Terms and Conditions
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit-item">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('workflow_autoforward.update') }}" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Definition</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="app_type">Application Type</label>
                            <select name="app_type" id="app_type" class="form-control">
                                <option value="" disabled selected> - </option>
                                @foreach ($app_types as $key => $app_type)
                                    <option value="{{ $key }}">{{ $app_type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label for="app_sub_type">Application Sub Type</label>
                            <select name="app_sub_type" id="app_sub_type" class="form-control">
                                <option value="" disabled selected> - </option>
                                @foreach ($sub_types as $key => $sub_type)
                                    <option value="{{ $key }}">{{ $sub_type }}</option>
                                @endforeach
                                <option value="0">Not Applicable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="from_section">From Section</label>
                            <select name="from_section" id="from_section" class="form-control">
                                <option value="" disabled selected> - </option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->Region->name }} - {{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <div class="form-group">
                            <label for="from_position">From Position</label>
                            <select name="from_position" id="from_position" class="form-control">
                                <option value="" disabled selected> - </option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="is_unit_admin">Unit Admin?</label>
                            <select name="is_unit_admin" id="is_unit_admin" class="form-control">
                                <option value="0" selected>No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="to_section">To Section</label>
                            <select name="to_section" id="to_section" class="form-control">
                                <option value=""> - </option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->Region->name }} - {{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="to_position">To Position</label>
                            <select name="to_position" id="to_position" class="form-control">
                                <option value=""> - </option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="action_needed">Action</label>
                            <select name="action_needed" id="action_needed" class="form-control">
                                <option value=""> - </option>
                                @foreach ($actions as $key => $action)
                                    <option value="{{ $key }}">{{ $action['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="time_delay">Time Delay</label>
                            <input type="text" id="time_delay" name="time_delay" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="time_unit">Unit</label>
                            <select name="time_unit" id="time_unit" class="form-control">
                                <option value="" selected disabled> - </option>
                                @foreach ($delay_units as $key => $unit)
                                    <option value="{{ $key }}">{{ $unit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="text" name="order" id="order" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="accept_application" name="accept_application"> Accept Application
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="request_payment" name="request_payment"> Request Payment
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="request_inspection" name="request_inspection"> Request Inspection
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" id="generate_terms" name="generate_terms"> Generate Terms and Conditions
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@if (Session::has('message'))

    @if (Session::get('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ Session::get('message') }}
    </div>
    @else
    <div class="alert alert-error alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-close"></i> Error!</h4>
        {{ Session::get('message') }}
    </div>
    @endif

@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-close"></i> Error!</h4>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h5 class="box-title">Automatic Forward Configuration</h5>
                <a id="add_btn" class="btn btn-sm btn-primary pull-right">Add</a>
            </div>
            <div class="box-body">
                <table id="Definition-items" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <th class="text-center" style="width: 10%;">App Type</th>
                        <th class="text-center" style="width: 10%;">App Sub-Type</th>
                        <th class="text-center" style="width: 25%;">From</th>
                        <th class="text-center" style="width: 25%;">To</th>
                        <th class="text-center" style="width: 10%;">Action Needed</th>
                        <th class="text-center" style="width: 5%;">Time Delay</th>
                        <th class="text-center" style="width: 5%;">Tasks</th>
                        <th class="text-center" style="width: 5%;">Order</th>
                        <th class="text-center" style="width: 5%;">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($definitions as $definition)
                            <tr class="text-center">
                                <td>{{ $definition->ApplicationType->short_name }}</td>
                                <td>{{ $definition->ApplicationSubType() }}</td>
                                <td>{{ $definition->From() }}</td>
                                <td>{{ $definition->To() }}</td>
                                <td>{{ $definition->ActionNeeded() }}</td>
                                <td>{{ $definition->Delay() }}</td>
                                <td>{{ $definition->Tasks() }}</td>
                                <td>{{ $definition->order }}</td>
                                <td><a id="btn_edit" data-id="{{ $definition->id }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a id="btn_edit" href="{{ route('workflow_autoforward.delete', ['id' => $definition->id ]) }}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="/bower_components/select2/dist/js/select2.min.js"></script>
<script src="/bower_components/admin-lte/plugins/iCheck/icheck.min.js"></script>
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/bower_components/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/bower_components/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/bower_components/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $(".date input").inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
        $(".date input").datepicker();

        $("#Definition-items").DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'scrollX'     : true,
            'columnDefs': [
                {"targets": [6, 8], "orderable": false}
            ],
            "order" : []
        });
    });

    $("#add_btn").click(function(){
        $("#add-item #app_type").select2();
        $("#add-item #app_sub_type").select2();
        $("#add-item #from_section").select2();
        $("#add-item #from_position").select2();
        $("#add-item #to_section").select2();
        $("#add-item #to_position").select2();
        $("#add-item #action_needed").select2();
        $("#add-item").modal('show');
    });

    $("#Definition-items").on('click', '#btn_edit', function(){
        if ($(this).data('id') !== undefined){
            $.ajax({
                url: "{{ route('workflow_autoforward.api') }}",
                method: 'POST',
                data: {
                    'id': $(this).data('id')
                },
                beforeSend: function(){
                    $(this).addClass('disabled').attr('disabled', true);

                },
                success: function(data){
                    $("#edit-item #id").val(data['id']);
                    $("#edit-item #app_type").val(data['application_type']).select2();
                    $("#edit-item #app_sub_type").val(data['application_subtype']).select2();
                    $("#edit-item #from_section").val(data['from_section']).select2();
                    $("#edit-item #from_position").val(data['from_position']).select2();
                    $("#edit-item #to_section").val(data['to_section']).select2();
                    $("#edit-item #to_position").val(data['to_position']).select2();
                    $("#edit-item #action_needed").val(data['action_needed_id']).select2();
                    $("#edit-item #time_delay").val(data['time_delay']);
                    $("#edit-item #time_unit").val(data['time_delay_unit']).select2();
                    $("#edit-item #is_unit_admin").val(data['is_unit_admin']).select2();
                    $("#edit-item #order").val(data['order']);
                    $("#edit-item #accept_application").prop("checked", data['accept_application']);
                    $("#edit-item #request_payment").prop("checked", data['request_payment']);
                    $("#edit-item #request_inspection").prop("checked", data['request_inspection']);
                    $("#edit-item #generate_terms").prop("checked", data['generate_terms']);
                    $("#edit-item").modal('show');
                },
                error: function(){

                },
                complete: function(){
                    $(this).removeClass('disabled').removeAttr('disabled');
                },
            });
        }
    });

</script>
@endsection
