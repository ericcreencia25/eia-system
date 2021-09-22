@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
            Applicants
            {{-- <small>Optional description</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i> Users</a></li>
            <li class="active"><i class="fa fa-user"></i> Applicants</li>
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
        <!-- /.box-header -->
        <div class="box-body">
          <table id="table" class="table table-bordered table-hover" style="width: 100% !important;">
            <thead>
            <tr>
              <th>User ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Company Name</th>
              <th>Email</th>
              <th>Date Created</th>
              <th>Last Login Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($applicants as $chunk)
                    @foreach ($chunk as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ ($user->Company) ? $user->Company->CompanyName() . " (" . $user->Company->reference_code . ")" : ' - ' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ date("M d, Y", strtotime($user->created_at)) }}</td>
                            <td>{{ $user->last_login ? date("M d, Y h:i A", strtotime($user->last_login)) : null }}</td>
                            <td>{{ ($user->isActive()) ? 'Active' : 'Deactivated' }}</td>
                            <td><a href="{{ route('applicant.show', ['id' => $user->id ]) }}" class="btn btn-primary btn-sm">View</a></td>
                        </tr>
                    @endforeach
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
            'autoWidth'   : true,
            'scrollX'     : true
        });
    </script>
@endsection
