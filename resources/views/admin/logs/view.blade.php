@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
            Log
            {{-- <small>Optional description</small> --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i> System</a></li>
            <li class="active"><i class="fa fa-book"></i> Log</li>
            <li class="active">{{ $log->id }}</li>
        </ol>
    </section>
@stop

@section('content')
<div class="box box-solid">
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped table-responsive">
            <tbody>
                <tr>
                    <th>Timestamp</th>
                    <td>{{ date("F d Y, h:i:s a", strtotime($log->created_at)) }}</td>
                </tr>
                <tr>
                    <th>Action</th>
                    <td>{{ $log->description }}</td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td>{{ ($log->causer) ? $log->causer->FullName() : null }}</td>
                </tr>
                <tr>
                    <th>User Type</th>
                    <td>{{ ($log->causer) ? ($log->causer->type == 1) ? 'Applicant' : 'Employee' : null }}</td>
                </tr>
                <tr>
                    <th>URL</th>
                    <td>{{ $log->getExtraProperty('url') }}</td>
                </tr>
                <tr>
                    <th>Method</th>
                    <td>{{ $log->getExtraProperty('method') }}</td>
                </tr>
                <tr>
                    <th>User IP</th>
                    <td>{{ $log->getExtraProperty('ip') }}</td>
                </tr>
                <tr>
                    <th>User Agent</th>
                    <td>{{ $log->getExtraProperty('user-agent') }}</td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td style=" max-width: 100px;"><pre><code>{{ $log->getExtraProperty('content') }}</code></pre></td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <a href="@if (url()->previous() == url()->current()) {{ route('logs') }} @else {{ url()->previous() }} @endif" class="btn btn-warning"><span
                        class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
            </div>
        </div>

    </div>
</div>
@endsection
