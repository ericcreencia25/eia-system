@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
            Sections
            {{-- <small>Optional description</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i> Workflow</a></li>
            <li class="active"><i class="fa fa-book"></i> Sections</li>
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
              <th>ID</th>
              <th>Name</th>
              <th>Slug</th>
              <th>Region</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->slug }}</td>
                        <td>{{ $group->Region->name }}</td>
                        <td><a href="{{ route('section.show', ['id' => $group->id] ) }}" class="btn btn-xs btn-primary">View</a></td>
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
                {"orderable": false, "targets": [4]},
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
