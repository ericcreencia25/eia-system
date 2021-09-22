@extends('layouts.adminlte.default.layout')

@section('header')

<section class="content-header">
        <h1 class="hidden-sm">
            Add New Employee
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i>Users</a></li>
            <li>Employees</li>
            <li class="active">Add</li>
        </ol>
    </section>

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

<div class="box">
    <div class="box-body">
            <form method="POST" action="{{ route('employee.add') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-horizontal">
                <div class="form-group @error('first_name') has-error @enderror has-feedback">
                    <label class="col-sm-3"><i class="fa fa-fw fa-user"></i> First Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="first_name" maxlength="300" name="first_name"  value="{{ old('first_name') }}" required autofocus
                            type="text">
                        @error('first_name')
                        <span class="help-block"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group @error('last_name') has-error @enderror has-feedback">
                    <label class="col-sm-3"><i class="fa fa-fw fa-user"></i> Last Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="last_name" maxlength="300" name="last_name" value="{{ old('last_name') }}" required autofocus
                            type="text">
                        @error('last_name')
                        <span class="help-block"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group  @error('email') has-error @enderror has-feedback">
                    <label class="col-sm-3"><i class="fa fa-fw fa-envelope"></i> E-mail address</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="email" maxlength="300" name="email"  value="{{ old('email') }}" required autofocus type="email">
                        @error('email')
                        <span class="help-block"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group @error('mobile_number') has-error @enderror has-feedback">
                    <label class="col-sm-3"><i class="fa fa-fw fa-mobile"></i> Mobile Number</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="mobile_number" maxlength="11" name="mobile_number" value="{{ old('mobile_number') }}" autofocus
                            type="text">
                        @error('mobile_number')
                        <span class="help-block"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group  @error('region') has-error @enderror has-feedback">
                    <label class="col-sm-3"><i class="fa fa-fw fa-globe"></i> Region</label>
                    <div class="col-sm-9">
                        <select id="region" name="region" class="form-control">
                            @foreach ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                        @error('region')
                        <span class="help-block"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group  @error('group') has-error @enderror has-feedback">
                    <label class="col-sm-3"><i class="fa fa-fw fa-users"></i> Group</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="group" name="group">
                            @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @error('group')
                        <span class="help-block"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group  @error('position') has-error @enderror has-feedback">
                    <label class="col-sm-3"><i class="fa fa-fw fa-users"></i> Position</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="position" name="position">
                            @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                        @error('position')
                        <span class="help-block"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                </div>
            </div>
            {{-- <div class="form-horizontal">
                <div class="form-group  @error('digital_signature') has-error @enderror has-feedback">
                    <label class="col-sm-3"><i class="fa fa-fw fa-pencil"></i> Digital Signature</label>
                    <div class="col-sm-9">
                        <input type="file" name="digital_signature">
                        @error('digital_signature')
                        <span class="help-block"><b>{{ $message }}</b></span>
                        @enderror
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-xs-12">
                        <a href="@if (url()->previous() == url()->current()) {{ route('employees') }} @else {{ url()->previous() }} @endif" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
                    <button class="btn btn-md btn-primary pull-right">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

@stop

@section('js')
<script type="text/javascript">
    var section_initial = "<option>----------------</option>";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })

    $(document).ready(function(){
        $("#region").change();

        $("#tbl_actvity").DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "order": [[1, 'desc']],
            'columnDefs': [
                {"targets": [0], "orderable": false}
            ]
        });

        @if (count($errors) > 0)
            $('#update-employee').modal('show');
        @endif
    });

    $("#region").change(function(){
        if ($(this).val() !== undefined){
            $.ajax({
                url: "{{ url('/admin/employee/getgroupbyregion') }}",
                method: 'POST',
                data: {
                    'region_id': $(this).val()
                },
                beforeSend: function(){
                    $(this).attr('disabled', true);
                    $("#group").empty();
                },
                success: function(data){
                    var data = JSON.parse(data);
                    $.each(data, function(index, value){
                        var append = '<option value="'+value['id']+'">'+value['name']+'</option>';
                        $("#group").append(append);
                    });
                },
                error: function(){
                    $("#group").append(section_initial);
                },
                complete: function(){
                    $(this).removeAttr('disabled');
                },
            });
        }
    });

</script>
@endsection
