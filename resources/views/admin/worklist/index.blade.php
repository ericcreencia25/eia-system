@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
            Worklist
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i> System</a></li>
            <li class="active"><i class="fa fa-cog"></i> Manage Worklist</li>
        </ol>
    </section>
@stop

@section('css')
<link rel="stylesheet" href="/css/form_extra.css">
<link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/bower_components/admin-lte/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@stop

@section('content')

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

<div class="modal fade" id="confirmationModal">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('worklist.transfer') }}">
            @csrf
            @method('POST')
            <input type="hidden" id="app_ids" name="app_ids">
            <input type="hidden" id="from" name="from">
            <input type="hidden" id="to" name="to">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-add"></i>Confirmation</h4>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to transfer the selected applications? This action is irreversible.</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" id="transfer" class="btn btn-primary">Yes</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">Manage Worklist</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="#">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="user" class="col-sm-2">Employee</label>
                    <div class="col-sm-7">
                        <select name="user" id="user">
                            <option value="" selected disabled>Please select an employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->User->id }}" @if (($selected_employee) && $selected_employee->id == $employee->User->id) selected @endif>{{ $employee->User->FullName() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-primary btn-sm btn-block">Fetch Worklist</button>
                    </div>
                </div>
            </form>
            <table id="table" class="table table-bordered table-hover" style="width: 100% !important;">
                <thead>
                    <tr>
                        <th></th>
                        <th>Application No.</th>
                        <th>Application Type</th>
                        <th>Applicant Name</th>
                        <th>Company</th>
                    </tr>
                </thead>
                    @foreach ($worklist as $application)
                        <tr>
                            <td><input type="checkbox" data-id="{{ $application->id }}"></td>
                            <td>{{ $application->id }}</td>
                            <td>{{ $app_types[$application->Type->id]['name'] }}</td>
                            <td>{{ $application->Owner->FullName() }}</td>
                            <td>{{ $application->Details->Company->CompanyName() }}</td>
                        </tr>
                    @endforeach
                <tbody>
                </tbody>
            </table>
            <br>
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="usertransfer" class="col-sm-2">Employee</label>
                    <div class="col-sm-7">
                        <select name="usertransfer" id="usertransfer">
                            <option value="" selected disabled>Please select an employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->User->id }}">{{ $employee->User->FullName() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button id="tranfer_btn" class="btn btn-primary btn-sm btn-block">Transfer Worklist</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
@stop

@section('js')
<script src="/bower_components/select2/dist/js/select2.min.js"></script>
<script src="/bower_components/admin-lte/plugins/iCheck/icheck.min.js"></script>
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    var application_ids = [];

    $(function(){
        $("#user").select2();
        $("#usertransfer").select2();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $("input:checkbox").iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        }).on('ifClicked', function(event){
            if (application_ids.includes($(this).data('id'))){
                application_ids.splice(application_ids.indexOf($(this).data('id')), 1);
            } else {
                application_ids.push($(this).data('id'));
            }
        });
    });

    $("#table").DataTable({
        "columnDefs": [
            {"className": "text-center", "targets": "_all"},
            {"orderable": false, "targets": [0]},
        ],
        "order": [[ 1, "asc" ]],
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'scrollX'     : true
    });

    $("#tranfer_btn").click(function(e){
        e.preventDefault();
        $("#confirmationModal #app_ids").val(application_ids.join(","));
        $("#confirmationModal #to").val($("#usertransfer").val());
        $("#confirmationModal #from").val($("#user").val());
        $("#confirmationModal").modal('show');
    });
</script>
@endsection
