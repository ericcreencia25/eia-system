@extends('layouts.adminlte.default.layout')

@section('css')
<link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@stop

@section('header')
<section class="content-header">
    <h1 class="hidden-sm">
        Applicant
        {{-- <small>Optional description</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i> Applicant</a></li>
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
            @can('update-applicant')
            <a class="btn btn-success" data-toggle="modal" data-target="#update-applicant"><span
                    class="glyphicon glyphicon-edit"></span> Update Profile</a>
            <a class="btn btn-warning" data-toggle="modal" data-target="#reset-password"><span
                    class="glyphicon glyphicon-refresh"></span> Reset Password</a>
            @endcan
            @can('login-as-applicant')
            @if (Auth::user()->id != $user->id)
            @csrf
            @method('POST')
            <button class="btn btn-primary">
                <span class="glyphicon glyphicon-log-in"></span> Login as this user
            </button>
            @endif
            @endcan
        </form>
        <div class="modal fade" id="update-applicant">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('applicant.update', ['id' => $user->id ]) }}"
                    enctype="multipart/form-data" class="modal-content">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-user"></i> Update Profile</h4>
                    </div>
                    <div class="modal-body">
                        <blockquote>
                            <p class="lead">New Password will be sent to the Applicant if the email has been changed.</p>
                        </blockquote>
                        <div class="form-horizontal">
                            <div class="form-group @error('first_name') has-error @enderror has-feedback">
                                <label class="col-sm-3"><i class="fa fa-fw fa-user"></i> First Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="first_name" maxlength="300" name="first_name"
                                        value="{{ $user->first_name }}" required autofocus type="text">
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
                                    <input class="form-control" id="last_name" maxlength="300" name="last_name"
                                        value="{{ $user->last_name }}" required autofocus type="text">
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
                                    <input class="form-control" id="email" maxlength="300" name="email"
                                        value="{{ $user->email }}" required autofocus type="email">
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
                                    <input class="form-control" id="mobile_number" maxlength="11" name="mobile_number"
                                        value="{{ $user->mobile_number }}" autofocus type="text">
                                    @error('mobile_number')
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
                        {{-- <div class="form-horizontal">
                            <div class="form-group  @error('digital_signature') has-error @enderror has-feedback">
                                <label class="col-sm-3"><i class="fa fa-fw fa-pencil"></i> Signature</label>
                                <div class="col-sm-9">
                                    <input type="file" name="digital_signature">
                                    @error('digital_signature')
                                    <span class="help-block"><b>{{ $message }}</b></span>
                        @enderror
                        @if ($user->employee->digital_signature)
                        <a href="{{ route('employee.signature.show', ['id' => $user->employee->id ]) }}"
                            target="_blank">Current Attachment</a>
                        <input type="checkbox" id="clear_digital_signature" name="clear_digital_signature">
                        <label for="clear_digital_signature">Clear</label>
                        @endif
                    </div>
            </div>
        </div> --}}
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
        <form method="POST" action="{{ route('applicant.password.reset', ['id' => $user->id]) }}" class="modal-content">
            @csrf
            @method('PATCH')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-refresh"></i> Reset Password</h4>
            </div>
            <div class="modal-body">
                <blockquote>
                    <p class="lead">New Password will be sent to the Applicant's email address.</p>
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
            <li class="active"><a href="#profile" role="tab" data-toggle="tab" aria-expanded="true">Applicant
                    Profile</a></li>
            <li class=""><a href="#activity" role="tab" data-toggle="tab" aria-expanded="false">Recent Activity</a></li>
            <li class=""><a href="#application" role="tab" data-toggle="tab" aria-expanded="false">Applications</a>
            <li class=""><a href="#company" role="tab" data-toggle="tab" aria-expanded="false">Companies</a>
            </li>
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
                            @foreach ($attachments as $attachment)
                            <tr>
                                <th>{{ $attachment->name }}</th>
                                @foreach ($user->ActiveAttachments as $user_attachment)
                                @if ($user_attachment->attachment_id == $attachment->id)
                                <td><a target="_blank"
                                        href="{{ route('applicant.attachment.view', ['userid' => $user->id, 'id' => $user_attachment->id ]) }}">{{ $user_attachment->path }}</a>
                                </td>
                                @else
                                <td></td>
                                @endif
                                @endforeach
                            </tr>
                            @endforeach
                            {{-- <tr>
                                    <th>Digital Signature</th>
                                    <td>
                                    @if ($user->employee->digital_signature)
                                    <a href="{{ route('employee.signature.show', ['id' => $user->employee->id ]) }}"
                            target="_blank">{{ $user->employee->digital_signature }}</a>
                            @endif
                            </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane" id="activity">
                <table id="tbl_actvity" class="table table-bordered table-hover">
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
                            <td><a class="btn btn-sm btn-primary"
                                    href="{{ route('log.view', ['id' => $log->id]) }}">View</a></td>
                            <td>{{ ++$key }}</td>
                            <td>{{ date("F d, Y h:i a", strtotime($log->created_at)) }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->getExtraProperty('ip') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="application">
                <table id="tbl_aplication" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td style="width: 40px;">#</td>
                            <td>Company</td>
                            <td>Type</td>
                            <td>Status</td>
                            <td>Date Created</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (sizeof($applications) > 0)
                        @foreach ($applications as $application)
                        <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->Details->Company->CompanyName() }}</td>
                        <td>
                            @foreach ($application_types as $key => $val)
                            @if ($key == $application->type->id)
                            {{ $val['name'] }}
                            @endif
                            @endforeach
                        </td>
                        <td>{{ $application->Status() }}</td>
                        <td>{{ $application->created_at->format("M d, Y - h:i A") }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center">No applications</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="company">
                <table id="tbl_company" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Role</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (sizeof($companies) > 0)
                        @foreach ($companies as $key => $company)
                            <tr>
                                <td>{{ $company->CompanyName() }}</td>
                                <td>{{ ($company->Owner->id == $user->id) ? 'Owner' : 'Member' }}</td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="2" class="text-center">No companies associated</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <a href="@if (url()->previous() == url()->current()) {{ route('applicants') }} @else {{ url()->previous() }} @endif"
        class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
</div>
</div>

@stop

@section('js')
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
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

        @if (count($errors) > 0)
            $('#update-applicant').modal('show');
        @endif
    });


</script>
@endsection
