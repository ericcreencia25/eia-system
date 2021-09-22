@extends('layouts.adminlte.default.layout')

@section('header')
<section class="content-header">
    <h1 class="hidden-sm hidden-xs">
        Manage Evaluation Items
        {{-- <small>Optional description</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i> System</a></li>
        <li class="active"><i class="fa fa-book"></i> Manage Evaluation Items</li>
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

<div class="modal fade" id="add-item">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('evaluationitems.add') }}" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-add"></i> Add Evaluation Item</h4>
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
                            <label for="name">Evaluation Item Name</label>
                            <textarea class="form-control" name="name" id="name" placeholder="Evaluation Item Name"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="order">Order #</label>
                            <input type="text" class="form-control" id="order" name="order" required>
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

<div class="modal fade" id="edit-item">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('evaluationitems.update') }}" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Evaluation Item</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Evaluation Item Name</label>
                            <textarea class="form-control" name="name" id="name" placeholder="Evaluation Item Name"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="order">Order #</label>
                            <input type="text" class="form-control" id="order" name="order" required>
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
                <h5 class="box-title">Evaluation Items</h5>
                <a id="add_btn" class="btn btn-sm btn-primary pull-right">Add</a>
            </div>
            <div class="box-body">
                <table id="evaluation-items" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <th class="text-center" style="width: 10%;">Application Type</th>
                        <th class="text-center" style="width: 40%;">Evaluation Item</th>
                        <th class="text-center">Order</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 15%;">Date Added</th>
                        <th class="text-center" style="width: 10%;">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr class="text-center">
                                <td>{{ $app_types[$item->application_type_id]['name'] }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->order }}</td>
                                <td>{{ ($item->is_active) ? 'Active' : 'Inactive' }}</td>
                                <td>{{ $item->created_at->format('F d, Y h:i A') }}</td>
                                <td><a id="btn_edit" data-id="{{ $item->id }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a></td>
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

        $("#evaluation-items").DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'scrollX'     : true,
            'columnDefs': [
                {"targets": [5], "orderable": false}
            ],
            "order" : []
        });
    });

    $("#add_btn").click(function(){
        $("#add-item #type").select2();
        $("#add-item #active").select2();
        $("#add-item").modal('show');
    });

    $("#evaluation-items").on('click', '#btn_edit', function(){
        if ($(this).data('id') !== undefined){
            $.ajax({
                url: "{{ route('evaluationitems.api') }}",
                method: 'POST',
                data: {
                    'id': $(this).data('id')
                },
                beforeSend: function(){
                    $(this).addClass('disabled').attr('disabled', true);

                },
                success: function(data){
                    $("#edit-item #name").val(data['name']);
                    $("#edit-item #id").val(data['id']);
                    $("#edit-item #active").val(data['active']).select2();
                    $("#edit-item #order").val(data['order']);
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
