@extends('layouts.adminlte.default.layout')

@section('header')
<section class="content-header">
    <h1 class="hidden-sm hidden-xs">
        Manage Holidays
        {{-- <small>Optional description</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i> System</a></li>
        <li class="active"><i class="fa fa-calendar-minus-o"></i> Manage Holidays</li>
    </ol>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/form_extra.css">
<link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/bower_components/admin-lte/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@stop

@section('content')

<div class="modal fade" id="add-item">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('holidays.add') }}" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-add"></i> Add Holiday</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="date" class="control-label">Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="date"
                                    name="date" placeholder="Date">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Coverage (Regions)</label>
                            <select name="coverage[]" id="coverage" class="form-control" multiple>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" class="form-control" placeholder="Notes"></textarea>
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
        <form method="POST" action="{{ route('holidays.update') }}" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Holiday</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="date" class="control-label">Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="date"
                                    name="date" placeholder="Date">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Coverage (Regions)</label>
                            <select name="coverage[]" id="coverage" class="form-control" multiple>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" class="form-control" placeholder="Notes"></textarea>
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
                <h5 class="box-title">Holidays</h5>
                <a id="add_btn" class="btn btn-sm btn-primary pull-right">Add</a>
            </div>
            <div class="box-body">
                <table id="holiday-items" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                        <th class="text-center" style="width: 10%;">Date</th>
                        <th class="text-center" style="width: 20%;">Description</th>
                        <th class="text-center" style="width: 20%;">Regions</th>
                        <th class="text-center">Notes</th>
                        <th class="text-center" style="width: 10%;">Added By</th>
                        <th class="text-center" style="width: 10%;">Updated By</th>
                        <th class="text-center" style="width: 5%;">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($holidays as $holiday)
                            <tr class="text-center">
                                <td>{{ $holiday->date->format('F d, Y') }}</td>
                                <td>{{ $holiday->description }}</td>
                                <td>{{ implode(", ", $holiday->RegionSummary()) }}</td>
                                <td>{{ $holiday->notes }}</td>
                                <td>{{ $holiday->CreatedBy->FullName() }}</td>
                                <td>{{ $holiday->UpdatedBy->FullName() }}</td>
                                <td><a id="btn_edit" data-id="{{ $holiday->id }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a></td>
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
<script src="/bower_components/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/bower_components/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/bower_components/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $(".date input").inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
        $(".date input").datepicker();

        $("#holiday-items").DataTable({
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
        $("#add-item #coverage").select2();
        $("#add-item").modal('show');
    });

    $("#holiday-items").on('click', '#btn_edit', function(){
        if ($(this).data('id') !== undefined){
            $.ajax({
                url: "{{ route('holidays.api') }}",
                method: 'POST',
                data: {
                    'id': $(this).data('id')
                },
                beforeSend: function(){
                    $(this).addClass('disabled').attr('disabled', true);

                },
                success: function(data){
                    $("#edit-item #description").val(data['description']);
                    $("#edit-item #date").val(data['date']);
                    $("#edit-item #id").val(data['id']);
                    $("#edit-item #coverage").val(data['coverage']).select2();
                    $("#edit-item #notes").val(data['notes']);
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
