@extends('layouts.adminlte.default.layout')

@section('header')
<section class="content-header">
    <h1 class="hidden-sm hidden-xs">
        Manage Unit Admin
        {{-- <small>Optional description</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i> Manage Users</a></li>
        <li class="active"><i class="fa fa-book"></i> Manage Unit Admin</li>
    </ol>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/form_extra.css">
<link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/bower_components/admin-lte/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@stop

@section('content')

<div class="modal fade" id="add-unit-admin">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('unitadmin.add') }}" class="modal-content">
            @csrf
            @method('PATCH')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-add"></i>Add Unit Admin</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="type">Application Type</label>
                            <select name="type" id="type">
                                <option value="" selected disabled>Please select an application type</option>
                                @foreach ($apptypes as $apptype)
                                    <option value="{{ $apptype->id }}">{{ $apptype->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="region">Region</label>
                            <select id="region">
                                <option value="" selected disabled>Please select a region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="group">Group</label>
                            <select name="group" id="group">
                                <option value="" selected disabled>Please select a group</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user">Employee</label>
                            <select name="user" id="user">
                                <option value="" selected disabled>Please select an employee</option>
                            </select>
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

<div class="modal fade" id="edit-unit-admin">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('unitadmin.update') }}" class="modal-content">
            @csrf
            @method('PATCH')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-add"></i></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <blockquote>
                            <h5>All For Action from the previous Unit Admin will be transfered to the new Unit Admin</h5>
                        </blockquote>
                    </div>
                    <div class="col-sm-12">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="region">Region</label>
                            <select id="region">
                                <option value="" selected disabled>Please select a region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="group">Group</label>
                            <select name="group" id="group">
                                <option value="" selected disabled>Please select a group</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user">Employee</label>
                            <select name="user" id="user">
                                <option value="" selected disabled>Please select an employee</option>
                            </select>
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
                <h5 class="box-title">Unit Admin List</h5>
                <a id="add_btn" class="btn btn-sm btn-primary pull-right">Add</a>
            </div>
            <div class="box-body">
                <table id="unit-admins" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <th class="text-center" style="width: 20%;">Application Type</th>
                        <th class="text-center" style="width: 15%;">Region</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Group</th>
                        <th class="text-center" style="width: 10%;">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($unitadmins as $unitadmin)
                            <tr class="text-center">
                                <td>{{ $unitadmin->ApplicationType->name }}</td>
                                <td>{{ $unitadmin->Group->Region->name }}</td>
                                <td><a href="{{ route('employee.show', ['id' => $unitadmin->User->id]) }}">{{ $unitadmin->User->FullName() }}</a></td>
                                <td>{{ $unitadmin->User->email }}</td>
                                <td><a href="{{ route('section.show', ['id' => $unitadmin->Group->id]) }}">{{ $unitadmin->Group->name }}</a></td>
                                <td>
                                    <a id="btn_edit" data-id="{{ $unitadmin->id }}" data-region="{{ $unitadmin->Group->Region->id }}" data-type="{{ $unitadmin->ApplicationType->name }}" data-name="{{ $unitadmin->User->FullName() }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                                </td>
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
<script>
    var section_initial = '<option value="" selected disabled>Please select a group</option>';
    var employee_initial = '<option value="" selected disabled>Please select an employee</option>';

    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $("#unit-admins").DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'scrollX'     : true,
            'columnDefs': [
                {"targets": [5], "orderable": false}
            ]
        });
    });

    $("#add_btn").click(function(){
        $("#add-unit-admin #type").select2();
        $("#add-unit-admin #region").select2();
        $("#add-unit-admin #group").select2();
        $("#add-unit-admin #user").select2();
        $("#add-unit-admin").modal('show');
    });

    $("#unit-admins").on('click', '#btn_edit', function(){
        $("#edit-unit-admin #id").val($(this).data('id'));
        $("#edit-unit-admin .modal-title").text(($(this).data('type') + " - " + $(this).data('name')));
        $("#edit-unit-admin #region").val($(this).data('region')).change();
        $("#edit-unit-admin #region").select2();
        $("#edit-unit-admin #group").select2();
        $("#edit-unit-admin #user").select2();
        $("#edit-unit-admin").modal('show');
    });

    $("#add-unit-admin #region").change(function(){
        if ($(this).val() !== undefined){
            $.ajax({
                url: "{{ url('/admin/unitadmin/getgroupbyregion') }}",
                method: 'POST',
                data: {
                    'region_id': $(this).val()
                },
                beforeSend: function(){
                    $(this).attr('disabled', true);
                    $("#add-unit-admin #user").empty().append(employee_initial);
                    $("#add-unit-admin #group").empty().append(section_initial);
                },
                success: function(data){
                    var data = JSON.parse(data);
                    $.each(data, function(index, value){
                        var append = '<option value="'+value['id']+'">'+value['name']+'</option>';
                        $("#add-unit-admin #group").append(append);
                    });
                },
                error: function(){
                    $("#add-unit-admin #group").append(section_initial);
                },
                complete: function(){
                    $(this).removeAttr('disabled');
                },
            });
        }
    });

    $("#add-unit-admin #group").change(function(){
        if ($(this).val() !== undefined){
            $.ajax({
                url: "{{ url('/admin/unitadmin/getemployeesbygroup') }}",
                method: 'POST',
                data: {
                    'group_id': $(this).val()
                },
                beforeSend: function(){
                    $(this).attr('disabled', true);
                    $("#add-unit-admin #user").empty().append(employee_initial);
                },
                success: function(data){
                    var data = JSON.parse(data);
                    $.each(data, function(index, value){
                        var append = '<option value="'+value['user']['id']+'">'+ (value['user']['first_name'] + " " + value['user']['last_name']) +'</option>';
                        $("#add-unit-admin #user").append(append);
                    });
                },
                error: function(){
                    $("#add-unit-admin #user").append(employee_initial);
                },
                complete: function(){
                    $(this).removeAttr('disabled');
                },
            });
        }
    });

    $("#edit-unit-admin #region").change(function(){
        if ($(this).val() !== undefined){
            $.ajax({
                url: "{{ url('/admin/unitadmin/getgroupbyregion') }}",
                method: 'POST',
                data: {
                    'region_id': $(this).val()
                },
                beforeSend: function(){
                    $(this).attr('disabled', true);
                    $("#edit-unit-admin #user").empty().append(employee_initial);
                    $("#edit-unit-admin #group").empty().append(section_initial);
                },
                success: function(data){
                    var data = JSON.parse(data);
                    $.each(data, function(index, value){
                        var append = '<option value="'+value['id']+'">'+value['name']+'</option>';
                        $("#edit-unit-admin #group").append(append);
                    });
                },
                error: function(){
                    $("#edit-unit-admin #group").append(section_initial);
                },
                complete: function(){
                    $(this).removeAttr('disabled');
                },
            });
        }
    });

    $("#edit-unit-admin #group").change(function(){
        if ($(this).val() !== undefined){
            $.ajax({
                url: "{{ url('/admin/unitadmin/getemployeesbygroup') }}",
                method: 'POST',
                data: {
                    'group_id': $(this).val()
                },
                beforeSend: function(){
                    $(this).attr('disabled', true);
                    $("#edit-unit-admin #user").empty().append(employee_initial);
                },
                success: function(data){
                    var data = JSON.parse(data);
                    $.each(data, function(index, value){
                        var append = '<option value="'+value['user']['id']+'">'+ (value['user']['first_name'] + " " + value['user']['last_name']) +'</option>';
                        $("#edit-unit-admin #user").append(append);
                    });
                },
                error: function(){
                    $("#edit-unit-admin #user").append(employee_initial);
                },
                complete: function(){
                    $(this).removeAttr('disabled');
                },
            });
        }
    });

</script>
@endsection
