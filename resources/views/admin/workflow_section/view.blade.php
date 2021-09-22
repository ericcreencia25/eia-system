@extends('layouts.adminlte.default.layout')

@section('header')
<section class="content-header">
    <h1 class="hidden-sm hidden-xs">
        {{ $section->name }} ({{ $section->Region->slug }})
        {{-- <small>Optional description</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i> Workflow</a></li>
        <li><i class="fa fa-book"></i> Sections</li>
        <li class="active"><i class="fa fa-book"></i> {{ $section->name }} ({{ $section->Region->slug }})</li>
    </ol>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/form_extra.css">
<link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/bower_components/admin-lte/plugins/iCheck/square/blue.css">
@stop

@section('content')

<div class="modal fade" id="add-default-receiver">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('section.defaultreceiver.add', ['id' => $section->id]) }}" class="modal-content">
            @csrf
            @method('PATCH')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-add"></i>Add Default Receiver</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="user">Employee</label>
                            <select name="user" id="user">
                                <option value="" selected disabled>Please select an employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->User->id }}">{{ $employee->User->FullName() }}</option>
                                @endforeach
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

<div class="modal fade" id="remove-default-receiver">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('section.defaultreceiver.remove', ['id' => $section->id]) }}" class="modal-content">
            @csrf
            @method('PATCH')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-add"></i>Remove Default Receiver</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Are you sure you want to remove this default receiver?</h5>
                        <input type="hidden" name="id" id="id">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Remove</button>
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


<div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h5 class="box-title">Section Details</h5>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped">
                    <colgroup>
                        <col width="20%">
                        <col width="80%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $section->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $section->slug }}</td>
                        </tr>
                        <tr>
                            <th>Region</th>
                            <td>{{ $section->Region->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-6 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h5 class="box-title">Default Receivers</h5>
                <a id="add" href="#" class="btn btn-sm btn-success pull-right">Add</a>
            </div>
            <div class="box-body">
                <table id="default-receivers" class="table table-bordered table-hover">
                    <thead>
                        <th class="text-center" style="width: 80%;">
                            Employee Name
                        </th>
                        <th class="text-center" style="width: 20%;">Actions</th>
                    </thead>
                    <tbody>
                        @if ($section->DefaultReceivers->count() > 0)
                        @foreach ($section->DefaultReceivers as $default_receiver)
                        <tr class="text-center">
                            <td>{{ $default_receiver->User->FullName() }}</td>
                            <td><a class="btn btn-xs btn-danger" id="remove" data-id="{{ $default_receiver->id }}"><i class="fa fa-close"></i></a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="text-center">
                            <td colspan="2">No default receivers</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h5 class="box-title">Section Restriction</h5>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>{{ $section->slug }}</th>
                        @foreach ($sections as $section)
                        <th class="text-center">Can forward to {{ $section->slug }} ({{ $section->Region->slug }})</th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($dictionary as $value)
                        <tr>
                            <th>{{ $value['type']->name }}</th>
                            @foreach ($value['value'] as $val)
                            @if (!empty($val))
                            <td class="text-center"><input type="checkbox" data-id="{{ $val->id }}" @if ($val->visible)
                                checked @endif></td>
                            @else
                            <td></td>
                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.col -->
</div>
@stop

@section('js')
<script src="/bower_components/select2/dist/js/select2.min.js"></script>
<script src="/bower_components/admin-lte/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        }).on('ifClicked', function(event){
            toggle($(this).data('id'));
        });

        $("#user").select2();
    });

    function toggle(id){
        $.ajax({
            'url': "{{ route('section.toggle', ['id' => $section->id]) }}",
            'type': "POST",
            'data': '&to_group_id=' + id,
            'dataType': 'json',
            beforeSend: function(){

            },
            success: function(data){
                if (data['status']){
                    //alert('Success')
                } else {
                    alert('Failed');
                }
            },
            error: function(){

            },
            complete: function(){

            }
        });
    }

    $("#add").click(function(){
        $("#add-default-receiver").modal('show');
    });

    $("#default-receivers tbody").on('click', '#remove', function(e){
        $("#remove-default-receiver #id").val($(this).data('id'));
        $("#remove-default-receiver").modal('show');
    });

</script>
@endsection
