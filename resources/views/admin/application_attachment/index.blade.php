@extends('layouts.adminlte.default.layout')

@section('header')
<section class="content-header">
    <h1 class="hidden-sm hidden-xs">
        Manage Attachments
        {{-- <small>Optional description</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i> System</a></li>
        <li class="active"><i class="fa fa-book"></i> Manage Attachments</li>
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

<div class="modal fade" id="add-attachment">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('attachmenttypes.add') }}" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-add"></i> Add Attachment Type</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="type">Application Type</label>
                            <select name="type" id="type">
                                <option value="" selected disabled>Please select an application type</option>
                                @foreach ($app_types as $key => $apptype)
                                    <option value="{{ $key }}">{{ $apptype['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Attachment Name</label>
                            <textarea class="form-control" name="name" id="name" placeholder="Attachment Name"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="required">Required?</label>
                            <select name="required" id="required">
                                <option value="" selected disabled>Please select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="active">Active?</label>
                            <select name="active" id="active">
                                <option value="" selected disabled>Please select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
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

<div class="modal fade" id="edit-attachment">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('attachmenttypes.update') }}" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Attachment Type</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Attachment Name</label>
                            <textarea class="form-control" name="name" id="name" placeholder="Attachment Name"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="required">Required?</label>
                            <select name="required" id="required">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="active">Active?</label>
                            <select name="active" id="active">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
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
                <h5 class="box-title">Attachment Types</h5>
                <a id="add_btn" class="btn btn-sm btn-primary pull-right">Add</a>
            </div>
            <div class="box-body">
                <table id="attachment-types" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <th class="text-center" style="width: 10%;">Application Type</th>
                        <th class="text-center" style="width: 40%;">Attachment Name</th>
                        <th class="text-center" style="width: 15%;">Date Added</th>
                        <th class="text-center" style="width: 15%;">Added By</th>
                        <th class="text-center">Required</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 10%;">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($attachments as $attachment)
                            <tr class="text-center">
                                <td>{{ $app_types[$attachment->application_type]['name'] }}</td>
                                <td>{{ $attachment->name }}</td>
                                <td>{{ $attachment->created_at->format('F d, Y - h:i A') }}</td>
                                <td>{{ $attachment->AddedBy->FullName() }}</td>
                                <td>{{ ($attachment->required) ? "Yes" : "No" }}</td>
                                <td>{{ ($attachment->active) ? "Active" : "Inactive" }}</td>
                                <td><a id="btn_edit" data-id="{{ $attachment->id }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a></td>
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
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $("#attachment-types").DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'scrollX'     : true,
            'columnDefs': [
                {"targets": [6], "orderable": false}
            ]
        });
    });

    $("#add_btn").click(function(){
        $("#add-attachment #type").select2();
        $("#add-attachment #required").select2();
        $("#add-attachment #active").select2();
        $("#add-attachment").modal('show');
    });

    $("#attachment-types").on('click', '#btn_edit', function(){
        if ($(this).data('id') !== undefined){
            $.ajax({
                url: "{{ route('attachmenttypes.api') }}",
                method: 'POST',
                data: {
                    'id': $(this).data('id')
                },
                beforeSend: function(){
                    $(this).addClass('disabled').attr('disabled', true);

                },
                success: function(data){
                    $("#edit-attachment #name").val(data['name']);
                    $("#edit-attachment #id").val(data['id']);
                    $("#edit-attachment #active").val(data['active']).select2();
                    $("#edit-attachment #required").val(data['required']).select2();
                    $("#edit-attachment").modal('show');
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
