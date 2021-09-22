@extends('layouts.adminlte.default.layout')

@section('header')
<section class="content-header">
    <h1 class="hidden-sm hidden-xs">
        Manage Regions
        {{-- <small>Optional description</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i> System</a></li>
        <li class="active"><i class="fa fa-map"></i> Manage Regions</li>
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

<div class="modal fade" id="edit-region">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('regions.update') }}" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="tel_no">Telephone No.</label>
                            <textarea class="form-control" name="tel_no" id="tel_no" placeholder="Telephone No."></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="website">Website Address</label>
                            <textarea class="form-control" name="website" id="website" placeholder="Website Address"></textarea>
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
                <h5 class="box-title">Regions</h5>
            </div>
            <div class="box-body">
                <table id="regions" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <th class="text-center" style="width: 30%;">Region Name</th>
                        <th class="text-center" style="width: 10%;">Slug</th>
                        <th class="text-center" style="width: 20%;">Address</th>
                        <th class="text-center" style="width: 15%;">Telephone No.</th>
                        <th class="text-center" style="width: 15%;">Website Link</th>
                        <th class="text-center" style="width: 10%;">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($regions as $region)
                            <tr class="text-center">
                                <td>{{ $region->name }}</td>
                                <td>{{ $region->slug }}</td>
                                <td>{{ $region->address }}</td>
                                <td>{{ $region->tel_no }}</td>
                                <td>{{ $region->website }}</td>
                                <td><a id="btn_edit" data-id="{{ $region->id }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a></td>
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

        $("#regions").DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'scrollX'     : true,
            'columnDefs': [
                {"targets": [2], "orderable": false}
            ]
        });
    });

    $("#regions").on('click', '#btn_edit', function(){
        if ($(this).data('id') !== undefined){
            $.ajax({
                url: "{{ route('regions.api') }}",
                method: 'POST',
                data: {
                    'id': $(this).data('id')
                },
                beforeSend: function(){
                    $(this).addClass('disabled').attr('disabled', true);
                },
                success: function(data){
                    $("#edit-region #id").val(data['id']);
                    $("#edit-region .modal-title").text(data['name']);
                    $("#edit-region #address").val(data['address']);
                    $("#edit-region #tel_no").val(data['tel_no']);
                    $("#edit-region #website").val(data['website']);
                    $("#edit-region").modal('show');
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
