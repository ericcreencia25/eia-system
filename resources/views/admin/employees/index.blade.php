@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
            Employees
            {{-- <small>Optional description</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i> Users</a></li>
            <li class="active"><i class="fa fa-user"></i> Employees</li>
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
            <h3 class="box-title">Manage Employees</h3>
            @can('create-employee')
                <a href="{{ route('employee.add') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> New User</a>
            @endcan
        </div>
        <div class="box-body">
          <table id="table" class="table table-bordered table-hover" style="width: 100% !important;">
            <thead>
            <tr>
              <th>User ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Region</th>
              <th>Group</th>
              <th>Position</th>
              <th>Date Created</th>
              <th>Last Login Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->user->id }}</td>
                        <td>{{ $employee->user->first_name }}</td>
                        <td>{{ $employee->user->last_name }}</td>
                        <td>{{ $employee->user->email }}</td>
                        <td>{{ $employee->region->slug }}</td>
                        <td>{{ $employee->group->slug }}</td>
                        <td>{{ $employee->position->name }}</td>
                        <td>{{ date("M d, Y", strtotime($employee->user->created_at)) }}</td>
                        <td>{{ $employee->user->last_login ? date("M d, Y h:i A", strtotime($employee->user->last_login)) : null }}</td>
                        <td>{{ ($employee->user->isActive()) ? 'Active' : 'Deactivated' }}</td>
                        <td><a href="{{ route('employee.show', ['id' => $employee->user->id ]) }}" class="btn btn-primary btn-sm">View</a></td>
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
                {"orderable": false, "targets": [8]},
            ],
            "order": [[ 0, "asc" ]],
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            "scrollX"     : true,
            'autowidth'   : true
        });
    </script>
@endsection
