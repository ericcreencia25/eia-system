@extends('layouts.adminlte.default.layout')

@section('css')
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@stop

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
            Employee
            {{-- <small>Optional description</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> Employee</a></li>
            <li class="active"><i class="fa fa-user"></i> {{ $user->first_name . " " . $user->last_name }}</li>
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

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $user->first_name . ' ' . $user->last_name }}</h3>
        <form method="POST" action="{{ route('employee.loginas', ['id' => $user->id]) }}" class="btn-group pull-right">
            @can('update-employee')
            <a class="btn btn-success" data-toggle="modal" data-target="#update-employee"><span class="glyphicon glyphicon-edit"></span> Update Profile</a>
            <a class="btn btn-warning" data-toggle="modal" data-target="#reset-password"><span class="glyphicon glyphicon-refresh"></span> Reset Password</a>
            @endcan
            @can('login-as-employee')
            @if (Auth::user()->id != $user->id)
                @csrf
                @method('POST')
                <button class="btn btn-primary">
                    <span class="glyphicon glyphicon-log-in"></span> Login as this user
                </button>
            @endif
            @endcan
        </form>
        <div class="modal fade" id="update-employee">
            <div class="modal-dialog">
            <form method="POST" action="{{ route('employee.update', ['id' => $user->id ]) }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><i class="fa fa-user"></i> Update Profile</h4>
                </div>
                <div class="modal-body">
                        <blockquote>
                            <p class="lead">New Password will be sent to the Employee if the email has been changed.</p>
                        </blockquote>
                        <div class="form-horizontal">
                            <div class="form-group @error('first_name') has-error @enderror has-feedback">
                                <label class="col-sm-3"><i class="fa fa-fw fa-user"></i> First Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="first_name" maxlength="300" name="first_name"  value="{{ $user->first_name }}" required autofocus
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
                                    <input class="form-control" id="last_name" maxlength="300" name="last_name" value="{{ $user->last_name }}" required autofocus
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
                                    <input class="form-control" id="email" maxlength="300" name="email"  value="{{ $user->email }}" required autofocus type="email">
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
                                    <input class="form-control" id="mobile_number" maxlength="11" name="mobile_number" value="{{ $user->mobile_number }}" autofocus
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
                                        <option value="{{ $region->id }}" @if ($user->employee->region->id == $region->id) selected="selected" @endif>{{ $region->name }}</option>
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
                                    <select id="group" name="group" class="form-control">

                                    @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" @if ($user->employee->group->id == $group->id) selected="selected" @endif>{{ $group->name }}</option>
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
                                    <select id="position" name="position" class="form-control">
                                    @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" @if ($user->employee->position->id == $position->id) selected="selected" @endif>{{ $position->name }}</option>
                                    @endforeach
                                    </select>
                                    @error('position')
                                    <span class="help-block"><b>{{ $message }}</b></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-horizontal">
                            <div class="form-group  @error('active') has-error @enderror has-feedback">
                                <label class="col-sm-3"><i class="fa fa-fw fa-pencil"></i> Account Status</label>
                                <div class="col-sm-9">
                                    <select name="active" id="active" class="form-control">
                                        <option value="1" @if ($user->isActive()) selected @endif>Active</option>
                                        <option value="0" @if (!$user->isActive()) selected @endif>Deactivated</option>
                                    </select>
                                    @error('active')
                                    <span class="help-block"><b>{{ $message }}</b></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-horizontal">
                            <div class="form-group  @error('digital_signature') has-error @enderror has-feedback">
                                <label class="col-sm-3"><i class="fa fa-fw fa-pencil"></i> Signature</label>
                                <div class="col-sm-9">
                                    <input type="file" name="digital_signature">
                                    @error('digital_signature')
                                    <span class="help-block"><b>{{ $message }}</b></span>
                                    @enderror
                                    @if ($user->employee->digital_signature)
                                    <a href="{{ route('employee.signature.show', ['id' => $user->employee->id ]) }}" target="_blank">Current Attachment</a>
                                        <input type="checkbox" id="clear_digital_signature" name="clear_digital_signature">
                                                <label for="clear_digital_signature">Clear</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </form>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          <div class="modal fade" id="reset-password">
            <div class="modal-dialog">
            <form method="POST" action="{{ route('employee.password.reset', ['id' => $user->id]) }}" class="modal-content">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><i class="fa fa-refresh"></i> Reset Password</h4>
                </div>
                <div class="modal-body">
                    <blockquote>
                        <p class="lead">New Password will be sent to the Employee's email address.</p>
                    </blockquote>
                    <h4>Are you sure you want to do this action?</h4>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Reset password</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </form>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

    </div>
    <div class="box-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#profile" role="tab" data-toggle="tab" aria-expanded="true">Employee Profile</a></li>
                <li class=""><a href="#activity" role="tab" data-toggle="tab" aria-expanded="false">Recent Activity</a></li>
                <li class=""><a href="#processed" role="tab" data-toggle="tab" aria-expanded="false">Processed Applications</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="profile">
                    <br>
                     <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <table class="table table-bordered table-hover table-striped">
                            <colgroup>
                                <col width="20%">
                                <col width="80%">
                            </colgroup>

                            <tbody>
                                <tr>
                                    <th>First Name</th>
                                    <td>{{ $user->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td>{{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Region</th>
                                    <td>{{ $user->employee->region->name }}</td>
                                </tr>
                                <tr>
                                    <th>Section</th>
                                    <td>{{ $user->employee->group->name }}</td>
                                </tr>
                                <tr>
                                    <th>Position</th>
                                    <td>{{ $user->employee->position->name }}</td>
                                </tr>
                                <tr>
                                    <th>Digital Signature</th>
                                    <td>
                                    @if ($user->employee->digital_signature)
                                    <a href="{{ route('employee.signature.show', ['id' => $user->employee->id ]) }}" target="_blank">{{ $user->employee->digital_signature }}</a>
                                    @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="activity">
                    <table id="tbl_actvity" class="table table-bordered table-hover" style="width: 100% !important;">
                        <thead>
                            <tr>
                                <td style="width: 40px;"></td>
                                <td>#</td>
                                <td>Timestamp</td>
                                <td>Action</td>
                                <td>User IP</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $key => $log)
                                <tr>
                                <td><a class="btn btn-sm btn-primary" href="{{ route('log.view', ['id' => $log->id]) }}">View</a></td>
                                <td>{{ ++$key }}</td>
                                <td>{{ date("F d, Y h:i:s a", strtotime($log->created_at)) }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->getExtraProperty('ip') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="processed">
                    <table id="tbl_processed" class="table table-bordered table-hover" style="width: 100% !important;">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Application ID</td>
                                <td>Type</td>
                                <td>Status</td>
                                <td>Owner</td>
                                <td>Company</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                <tr>
                                    <td></td>
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application_types[$application->Type->id]['name'] }}</td>
                                    <td>{{ $application->Status() }}</td>
                                    <td>{{ $application->Owner->FullName() }}</td>
                                    <td>{{ $application->Details->Company->CompanyName() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <a href="@if (url()->previous() == url()->current()) {{ route('employees') }} @else {{ url()->previous() }} @endif" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
    </div>
</div>

@stop

@section('js')
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    var section_initial = "<option>----------------</option>";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })

    $(document).ready(function(){

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

        $("#tbl_processed").DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "order": [[1, 'asc']],
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
