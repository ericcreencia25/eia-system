@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
            Logs
            {{-- <small>Optional description</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i> System</a></li>
            <li class="active"><i class="fa fa-book"></i> Logs</li>
        </ol>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
            <h3 class="box-title">Manage Logs</h3>
        </div>
        <div class="box-body">
          <table id="table" class="table table-bordered table-hover" style="width: 100% !important;">
            <thead>
            <tr>
              <th>ID</th>
              <th>Action</th>
              <th>User Name</th>
              <th>User Type</th>
              <th>IP</th>
              <th>Timestamp</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ ($log->causer) ? $log->causer->first_name . " " . $log->causer->last_name : null }}</td>
                        <td>{{ ($log->causer) ? ($log->causer->type == 1) ? 'Applicant' : 'Employee' : null }}</td>
                        <td>{{ $log->getExtraProperty('ip') }}</td>
                        <td>{{ date("F d, Y h:i:s A", strtotime($log->created_at)) }}</td>
                        <td><a href="{{ route('log.view', ['id' => $log->id ]) }}" class="btn btn-primary btn-sm">View</a></td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
@stop

@section('js')
    <script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script>
        $("#table").DataTable({
            "columnDefs": [
                {"className": "text-center", "targets": "_all"},
                {"orderable": false, "targets": [6]},
            ],
            "order": [[ 0, "desc" ]],
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'scrollX'     : true
        });
    </script>
@endsection
