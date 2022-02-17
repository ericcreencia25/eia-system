@extends('layouts.adminlte.default.layout')

@section('header')
    <!-- <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>Project Application</a></li>
        </ol>
    </section> -->
@stop

<style>
    #pointer {cursor: pointer;}
</style>
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-default">
            <div style="padding:10px;">
                <div class='col-md-12'>
                    <div class="col-md-1">
                        <img src="../../img/gear.jpeg" style="width:80px;">
                    </div>
                    <div class="col-md-11">
                        <h3><b id="header-title"></b></h3>
                    </div>
                </div>

                <div style="width: 70%; background-color: white; display: none; position: fixed;">
                    <div style="background-color:RGB(16,106,154); padding:5px; color:White;">
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td>Click the the link below to view the attachment.</td>
                                    <td style="width:40px;">
                                        <input type="submit" style="color:White;background-color:#1E8CBE;border-style:None;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="padding:10px;">
                        <div style="height:320px;overflow-y:scroll;">
                        </div>
                    </div>
                </div>
                <div class="dvinfo">
                    <div style="  padding-bottom:10px; padding-top:5px; font-size:9pt; border-bottom:Solid 1px Silver;">Instruction: Scroll down to review the project information/requirements below. Use Endorse Application to forward the application to the concerned for appropriate action. You can view the routing history and previous attachments at the bottom of the page.
                    </div>
                    
                    <div>
                        <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;  cursor:pointer;">APPLICATION REQUIREMENTS
                        </div>
                        <div>
                            <table class="table table-bordered" id="application_requirements">
                                <thead>
                                    <th style="width: 10px;">Complied</th>
                                    <th>Description</th>
                                </thead>
                                <tbody id="application_requirements_body" >
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><center>
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                    </label>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="col-md-12">
                                                <div class="col-md-11">
                                                    <select class="form-control" id="Requirements">
                                                        <option selected="selected" value=""></option>
                                                        
                                                        <option value="Area status clearance for quarry project">Area status clearance for quarry project</option>
                                                        
                                                        <option value="CENRO certification on the status of project area">CENRO certification on the status of project area</option>
                                                        
                                                        <option value="Certificate of compliance on the easement from Boracay Redevelopment Task Force">Certificate of compliance on the easement from Boracay Redevelopment Task Force</option>
                                                        
                                                        <option value="Certificate of connection from BWSS (for Boracay Projects)">Certificate of connection from BWSS (for Boracay Projects)</option>
                                                        
                                                        <option value="Certification from Biodiversity Management Bureau (BMB) that it has undergone their review consistent with the objectives of DENR MC No. 2016-745">Certification from Biodiversity Management Bureau (BMB) that it has undergone their review consistent with the objectives of DENR MC No. 2016-745</option>
                                                        
                                                        <option value="Certification of non-overlapped on ancestral domain">Certification of non-overlapped on ancestral domain</option>
                                                        
                                                        <option value="Clearance from DENR Secretary">Clearance from DENR Secretary</option>
                                                        
                                                        <option value="Clearance from the DENR Regional Director that the project is consistent with the classification established by Law">Clearance from the DENR Regional Director that the project is consistent with the classification established by Law</option>
                                                        
                                                        <option value="Clearance from the Regional Executive Director (for Tagaytay Projects)">Clearance from the Regional Executive Director (for Tagaytay Projects)</option>
                                                        
                                                        <option value="Department of Tourism endorsement (for Boracay Projects)">Department of Tourism endorsement (for Boracay Projects)</option>
                                                        
                                                        <option value="Geohazard Identification Report">Geohazard Identification Report</option>
                                                        
                                                        <option value="MARO/PARO Certification that the area is not suitable for agricultural purposes">MARO/PARO Certification that the area is not suitable for agricultural purposes</option>
                                                        
                                                        <option value="PAMB resolution for projects in protected area">PAMB resolution for projects in protected area</option>
                                                        
                                                        <option value="Proof of Payment for Operating without ECC">Proof of Payment for Operating without ECC</option>
                                                        
                                                        <option value="Resource use plan for forestry project">Resource use plan for forestry project</option>
                                                        
                                                        <option value="SEP Clearance (for Palawan Projects)">SEP Clearance (for Palawan Projects)</option>

                                                    </select>
                                                </div>
                                                <div class="col-md-1"><button class="btn btn-default" id="AddRequirements">Add</button></div>
                                            </div>
                                        </th>
                                    </tr>
                                    </tfoot>
                            </table>
                        <div>
                            <span id="accepted">
                                @if($project['AcceptedBy'] != NULL)
                                This application had been accepted by {{$project['AcceptedBy']}} on {{date("m/d/Y h:i:s A", strtotime($project['AcceptedDate']))}}
                                @endif
                            </span>
                        </div>
                            <button type="button" class="btn btn-default btn-flat" style="width: 200px" id="generate_evaluation_report">Generate Evaluation Report</button>

                            <button type="button" class="btn btn-default btn-flat" style="width: 200px" id="generate_order_of_payment">Generate Order of Payment</button>

                            @if($project['AcceptedBy'] == NULL && $project['AcceptedDate'] == NULL)
                            <button type="button" class="btn btn-default btn-flat" style="width: 200px" onclick="acceptApplication()">Accept Application</button>
                            @else
                            <button type="button" class="btn btn-default btn-flat" style="width: 200px" onclick="acceptApplication()" disabled>Accept Application</button>

                            @endif

                            <button type="button" class="btn btn-default btn-flat" style="width: 200px" id="generate_draft_certificate">Draft Certificate</button>

                            <button type="button" class="btn btn-default btn-flat" style="width: 200px" id="generate_denial_letter">Draft Denial Letter</button>
                            

                            <!--Endorse Application -->
                            <div style="padding-top:20px; padding-bottom:20px;">
                                <b>Recent Activity/Comments:</b> <a  href="" style="text-decoration:none;" id="remarks"></a> <span id="name_date"></span>
                            </div>
                            <!---IF ELSE --->
                            @if(strtolower($project['RoutedTo']) == strtolower(Session::get('data')['UserName']))
                            <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">ENDORSE APPLICATION
                            </div>
                            
                            <b>1. Attach the required documents</b><div style="padding-bottom:10px; padding-top:10px;"><span style="font-size:smaller;">Select from the list or specify the description of the document and browse to locate the electronic copy. Click the upload icon to attach the file. Size of the file should be no larger than   <span id="" style="color:Red;font-weight:bold;">10</span>&nbsp;
                             <span><strong>MEGABYTES in PDF format</strong></span>.
                         </span></div>
                     </div>
                         <table cellspacing="0" cellpadding="5" width="100%">
                            <tbody><tr>
                                <td style="width:600px;">
                                    <select class="form-control" id="Attachments">
                                        @foreach($attachments as $attach)
                                        <option value="{{$attach->Description}}">
                                            {{$attach->Description}}
                                        </option> 
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width: 10px"></td>
                                <td style="vertical-align:top;width:500px;">
                                    <input type="file" style="border-width:0px;border-style:None;font-size:Medium;" id="InputFile"> 
                                </td>
                                <td style="width:80px; vertical-align:top;">
                                    <button type="button" class="btn btn-default btn-sm" name="submit" id="Uploads"><img src="../../img/upload.png" style="width:15px;" /></button>
                                </td>
                            </tr>
                            <tr id="Other_attachment" hidden="hidden">
                                <td>
                                    <input type="text" class="form-control" id="Others">
                                </td>
                            </tr>
                            </tr>
                            <tr id="UploadedFile">
                                
                            </tr>
                        </tbody></table>
                        <br>
                        <br>
                        <b>2. Routing</b><div style="padding-bottom:10px; padding-top:10px;"><span style="font-size:smaller;">Select the destination, action required and provide the remarks.
                        </span></div>
                        <table style="width:100%; vertical-align:top;" cellpadding="0" cellspacing="0" class="tablecs">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="col-md-2">Destination</div>
                                            <div class="col-md-5">
                                                <select class="form-control" id="destination"> 
                                                    <option value="Proponent">
                                                        Proponent
                                                    </option> 
                                                    <option value="{{ $project['Region']}}">
                                                        {{ $project['Region']}}
                                                    </option>  
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <select class="form-control" id="user_list">
                                                    <option value="{{$project['CreatedBy']}}">
                                                        {{$project['CreatedBy']}} (Applicant)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="col-md-2">Action Required</div>
                                            <div class="col-md-10">
                                                <select class="form-control" id="ActionRequired">
                                                    <option value="For Submission of Basic Requirements"> For Submission of Basic Requirements</option>
                                                    <option value="For Submission of Additional Information">For Submission of Additional Information</option>
                                                    <option value="For Clarification of Information">For Clarification of Information</option>
                                                    <option value="For Payment of ECC Application">For Payment of ECC Application</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="col-md-2">Remarks</div>
                                            <div class="col-md-10">
                                                <textarea id="RoutingRemarks"rows="2" cols="20" style="font-family:Tahoma;font-size:Medium;height:100px;width:100%;"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="IncludeAttachment"> Include attachments
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4">
                                                <span id="" style="color:Red;font-size:smaller">Make sure local <a><u>holidays</u></a> were already entered before routing</span>    
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-flat btn-default" id="Endorse">Endorse</button>
                                                <button class="btn btn-flat btn-default">Cancel</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <br>
                    </div>
                    @endif
                    <!--Routing History-->
                    <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">ROUTING HISTORY
                    </div>
                    <table class="table table-bordered" id="RoutingHistoryTable">
                      <thead>
                          <th style="width: 300px">Routing</th>
                          <th style="width: 50px">Accumulated Days</th>
                          <th style="width: 100px">Status/Location</th>
                          <th style="width: 280px">Remarks</th>
                          <th>Posted on</th>
                          <th>By</th>
                          <th style="width: 50px"><button class="btn btn-block btn-flat disabled"><i class="fa fa-folder-o"></i></button></th>
                      </thead>
                      <tbody></tbody>
                    </table> 
                    <!-- Attachments-->
                    <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">ATTACHMENTS
                    </div>
                    <table class="table table-bordered" id="attachments_list">
                      <thead>
                          <th>Description</th>
                          <th style="width:200px">Posted on</th>
                          <th style="width:150px">By</th>
                      </thead>
                      <tbody></tbody>
                    </table>
                    <br>

                    <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">PROCESSING DAYS
                    </div>
                    <table class="table table-bordered" id="processing_days">
                      <thead>
                          <th>Routing</th>
                          <th style="width:150px">Elapsed</th>
                          <th style="width:150px">Holidays</th>
                          <th style="width:150px">Incurred</th>
                          <th style="width:150px">Accumulated</th>
                      </thead>
                      <tbody></tbody>
                    </table>
                    <br>

                    <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">REGISTERED ACCOUNT
                    </div>

                    <div>
                        <h4 id="registered_account"></h4>
                        <h5>
                            &nbsp; 
                            <a id="government_issued_id" target="_blank">Government Issued ID</a>, 
                            <a id="authorization_letter" target="_blank">Authorization Letter</a>, 
                            <a id="sec_dti_registration" target="_blank">SEC/DTI Registration</a>
                        </h5>
                    </div>
                </div>
                <div id="" class="modalBackgroundgray" style="display: none; position: fixed; left: 0px; top: 0px;">
                </div></div>
            </section>
        </div>


        <div class="modal fade" id="list-of-attachments-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Click the the link below to view the attachment.</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box-body no-padding">
                                <table class="table table-bordered" id="list-of-attachments" style="width: 100%;  display: table; table-layout: fixed;" >
                                    <thead>
                                        <th hidden></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-evaluation">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h5 class="modal-title">Click the the link below to view the attachment and provide remarks if it did not pass the screening/evaluation/review</h5>
                        </div>
                        <div class="modal-body">
                            <div class="box-body no-padding">
                                <div class="col-md-12" style="padding: 0px">
                                    <div class="col-md-10"  style="padding-left: 0px">
                                        <h4>Attachment: <a id="description">Project Description</a></h4>
                                    </div>
                                    <div class="col-md-2"  style="padding-right: 0px">
                                        <h4><input type="checkbox" id="Required"> Required</h4>
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding: 0px">
                                    <textarea id="remarks_textarea" rows="2" cols="20" style="font-family:Tahoma;font-size:Medium;height:200px;width:100%;"></textarea>
                                </div>
                                <div class="col-md-12" style="padding: 0px">
                                    <h4><input type="checkbox" id="Compliant"> The submitted documents passed the screening/evaluation/review.</h4>
                                    <input id="ProjectRequirementsGUID" hidden/>
                                </div>
                                <div class="col-md-12" style="padding: 0px">
                                    <button class="btn btn-primary" style="width: 10%" id="SaveAppReq">Save</button>
                                    <button class="btn btn-default" style="width: 10%">Cancel</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="overlay" style="display:none;">
                <div class="spinner"></div>
                <br/>
                <h3>Please wait while saving your data...</h3>
            </div>

<!-- /.modal -->
@stop

<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<!-- <script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- DataTables -->
<script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="../../adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../adminlte/dist/js/demo.js"></script>

<script>
var GUID = "{{$project['GUID']}}";
var ActivityGUID = "{{$project['ActivityGUID']}}";
var CreatedBy = "{{$project['CreatedBy']}}";

var AdditionalRequirements = [];

$(document).ready(function(){
    var data = localStorage.getItem("ReqStorage");
    var ReqStorage = data ? JSON.parse(data) : [];
  
    var ProjectName = "{{ $project['ProjectName']}}";
    var ProjectAddress = "{{$project['Address']}}";
    var ProjectMunicipality = "{{$project['Municipality']}}";
    var ProjectProvince = "{{$project['Province']}}";
    var ProjectPurpose = "{{$project['Purpose']}}";
    var PreviousECCNo = "{{$project['PreviousECCNo']}}";
    var ProponentName = "{{$project['ProponentName']}}";
    var check = "{{ Session::has('NewActivityGUID') ? Session::get('NewActivityGUID') : ''}}";

    var AcceptedBy = "{{ $project['AcceptedBy']}}";
    var AcceptedDate = "{{ $project['AcceptedDate']}}";

    console.log(AcceptedBy);
 
    
    $.ajax({
        url: "{{route('getUploadedFile')}}",
        type: 'POST',
        data: {
          ProjectGUID : GUID,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
            $("#Uploads").removeAttr("disabled"); 
            if(response != ''){
                var url=window.location.origin;
                var filepath = response['FilePath'];
                var link = url + '/' + filepath;

                var details = '<td style="width:50%;"><p class="help-block">Uploaded file here: <br> <a href="'+ link +'" target="_blank" id="filesCheck">'+  response['Description']  +'</a>( ' + response['FileSizeInKB'] + ' ) </p></td>';
                details += '<td style="width: 10px"></td>';
                details += '<td></td>';
                details += '<td style="width: 80px;"><button type="button" class="btn btn-default btn-sm" onclick="deleteUploadedFile('+"'"+response['ID']+"'"+')"><img src="../../img/trashbin.jpg" style="width:15px;" /></button></td>';


                $("#UploadedFile").html(details);
                $("#Uploads").attr('disabled', 'disabled');

            }
        }
      });

    if(check == ''){
        $.ajax({
        url: "{{route('addNewActivityGUID')}}",
        type: 'POST',
        data: {
          ProjectGUID : GUID,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
        }
      });
    }

    if(ProjectPurpose == "New Application"){
        var Purpose = "New ECC Application";
    } else {
        var Purpose = ProjectPurpose + ' of ECC No. ' + PreviousECCNo;
    }

    var text = ProjectName + ' - ' + ProjectAddress + ', ' + ProjectMunicipality + ', ' + ProjectProvince +
    "<br/>" +'Proponent: ' + ProponentName + ' ( ' + Purpose + ' ) ';
    $("#header-title").html(text);

    $('#application_requirements').DataTable({
        destroy:true,
        processing:true,
        info:true,
        searching: false,
        ordering: false,
        bPaginate: false,
        bLengthChange: true,
        bFilter: true,
        bInfo: false,
        bAutoWidth: false,
        ajax: {
            "url": "{{route('getApplicationRequirementLists')}}",
            "type": "POST",
            "data": {
                ProjectGUID : GUID,
                _token: '{{csrf_token()}}',
            },
            complete:function(data){
                AdditionalRequirementsSession(ReqStorage);
                // Do whatever you want.
              }
        },
        columns: [
        {
            data: 'Complied', name: 'Complied'
        },
        {
            data: 'Description', name: 'Description', orderable: false
        },
        ]
    });

    $('#RoutingHistoryTable').DataTable({
        destroy:true,
        processing:true,
        info:true,
        searching: false,
        ordering: false,
        bPaginate: false,
        bLengthChange: true,
        bFilter: true,
        bInfo: false,
        bAutoWidth: false,
        ajax: {
            "url": "{{route('getRoutingHistoryCaseHandler')}}",
            "type": "POST",
            "data": {
                data : GUID,
                _token: '{{csrf_token()}}',
            },
        },
        columns: [
        {
            data: 'Routing', name: 'Routing'
        },
        {
            data: 'AccumulatedDays', name: 'AccumulatedDays'
        },
        {
            data: 'Status', name: 'Status', orderable: false
        },
        {
            data: 'Remarks', name: 'Remarks', orderable: false
        },
        {
            data: 'PostedOn', name: 'PostedOn', orderable: false
        },
        {
            data: 'By', name: 'By', orderable: false
        },
        {
            data: 'Action', name: 'Action', orderable: false
        },
        ]
    });


    $('#processing_days').DataTable({
        destroy:true,
        processing:true,
        info:true,
        searching: false,
        ordering: false,
        bPaginate: false,
        bLengthChange: true,
        bFilter: true,
        bInfo: false,
        bAutoWidth: false,
        ajax: {
            "url": "{{route('getProcessingDays')}}",
            "type": "POST",
            "data": {
                ProjectGUID : GUID,
                _token: '{{csrf_token()}}',
            },
        },
        columns: [
        {
            data: 'Routing', name: 'Routing'
        },
        {
            data: 'Elapsed', name: 'Elapsed'
        },
        {
            data: 'Holidays', name: 'Holidays', orderable: false
        },
        {
            data: 'Incurred', name: 'Incurred', orderable: false
        },
        {
            data: 'Accumulated', name: 'Accumulated', orderable: false
        },
        ]
    });

    

    $.ajax({
        url: "{{route('getProjectActivity')}}",
        type: 'POST',
        data: {
            ProjectGUID : GUID,
            _token: '{{csrf_token()}}' ,
        },    
        success: function(response){
            var text = response['Status'] + ' - ' + response['Details'] + ' - ';
            var name_date = response['UpdatedBy'] + ' on ' + response['UpdatedDate'];
            $("#remarks").html(text);
            $("#name_date").html(name_date);

            listOfAttachments(response['GUID']);
        }
    });


    $.ajax({
        url: "{{route('getRegisteredAccount')}}",
        type: 'POST',
        data: {
            CreatedBy : CreatedBy,
            _token: '{{csrf_token()}}' ,
        },    
        success: function(response){
            var text = '&nbsp;' + response['UserName'] + ' ( ' + response['UserRole'] + ' ) ' + ' - ' + response['Email'] + '/' + response['AlternateEmail'];
            $("#registered_account").html(text);


            $("#government_issued_id").attr("href",response['GovernmentID']);
            $("#authorization_letter").attr("href",response['AuthorizationLetter']);
            $("#sec_dti_registration").attr("href",response['SecDTIRegistration']);
        }
    });


    $("#destination").on('change', function() {
        var destination = $("#destination").val();

        if(destination == 'Proponent') {
            var option = '<option value="For Submission of Basic Requirements"> For Submission of Basic Requirements</option>'; 
            option += '<option value="For Submission of Additional Information">For Submission of Additional Information</option>';
            option += '<option value="For Clarification of Information">For Clarification of Information</option>';
            option += '<option value="For Payment of ECC Application">For Payment of ECC Application</option>';
            $("#user_office").html(option);

            var users = '<option value="'+ CreatedBy  +'">'+ CreatedBy +'</option>'; 

            $("#user_list").html(users);
        } else {
            var option = '<option value="For Review"> For Review</option>'; 
            option += '<option value="For Evaluation">For Evaluation</option>';
            $("#user_office").html(option);

            UserListsOnRegion();

            $("#user_list").html('');
        }
    });

    $("#user_list").on('change', function() {
        var selected_user = $(this).val().toLowerCase();

        $.ajax({
            url: "{{route('getActionRequired')}}",
            type: 'POST',
            data: {
                selected_user : selected_user,
                _token: '{{csrf_token()}}',
            },
            success: function(result){
                $("#ActionRequired").html(result);
            }
        });
    });



    $("#SaveAppReq").on('click', function() {
        var Required = $('#Required').is(':checked'); 
        var Remarks = $("#remarks_textarea").val();
        var Compliant = $('#Compliant').is(':checked');
        var PRID = $("#ProjectRequirementsGUID").val();

        $.ajax({
            url: "{{route('SaveAppReq')}}",
            type: 'POST',
            data: {
                Required : Required,
                Remarks : Remarks,
                Compliant : Compliant,
                PRID : PRID,
                ProjectGUID : GUID,
                _token: '{{csrf_token()}}',
            },
            beforeSend: function() {
                $('#overlay').show();
            },
            success: function(response){
                $('#overlay').fadeOut(2000, () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500,
                        width: '800px'
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    });
                });
            }
        });
    });


    $("#Endorse").on('click', function() {
        var UpdatedDate = "{{$project['UpdatedDate']}}";
        var Destination = $("#destination").val();
        var UserDestination = $("#user_list").val();
        var ActionRequired = $("#ActionRequired option:selected").val();
        var Remarks = $("#RoutingRemarks").val();
        var NewActivityGUID = "{{Session::get('NewActivityGUID')}}";
        
        var IncludeAttachment = $('#IncludeAttachment').is(':checked'); 
        
        ///undefined
        var filesCheck = $('#filesCheck').text();

        var stored = localStorage.getItem("ReqStorage");
        stored = JSON.parse(stored || '[]');
        localStorage.setItem("ReqStorage", JSON.stringify(ReqStorage));
        if(Remarks == ''){
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: 'Remarks can not be empty',
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        } else if(UserDestination === 'OnLeaveReceiver'){
            Swal.fire({
                icon: 'warning',
                title: 'Notifications!',
                text: 'Cannot forward to receiver with on-leave status.',
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
            });
        } else if(ActionRequired === 'For Payment of ECC Application' && filesCheck != 'Order of Payment - Application') {
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: 'You need to attach the Order of Payment - Application',
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        } else if(ActionRequired === 'For Recommendation' && AcceptedBy == '') {
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: 'The application must be accepted first before you can route for recommendation/approval.',
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        } else if(ActionRequired === 'For Recommendation' && filesCheck != 'Draft ECC') {
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: 'You need to attach the draft ECC or Draft denied letter for this project when forwarding for recommendation.',
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        } else if(ActionRequired === 'For Recommendation' && filesCheck != 'Draft Denial Letter') {
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: 'You need to attach the draft ECC or Draft denied letter for this project when forwarding for recommendation.',
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        } else if(ActionRequired === 'For Approval' && AcceptedBy === '') {
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: 'The application must be accepted first before it can be routed for recommendation/approval.',
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        } else if(ActionRequired === 'For Denial' && AcceptedBy === '') {
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: 'The application must be accepted first before it can be routed for recommendation/approval.',
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        } else if(ActionRequired === 'For Approval' && filesCheck != 'Draft ECC') {
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: "The draft ECC is required. Click the 'Draft Certificate' button above to generate from the template.",
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        } else if(ActionRequired === 'For Denial' && filesCheck != 'Draft Denial Letter') {
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: "The draft denied letter is required. Click the 'Draft Denial Letter' button above to generate from the template.",
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        } else {
            if(IncludeAttachment === true){
                if(filesCheck != ''){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to endorse this application?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{route('EndorseApplication')}}",
                                type: 'POST',
                                data: {
                                    UpdatedDate : UpdatedDate,
                                    ProjectGUID : GUID,
                                    ActivityGUID : ActivityGUID,
                                    Destination : Destination,
                                    UserDestination : UserDestination,
                                    ActionRequired : ActionRequired,
                                    Remarks : Remarks,
                                    NewActivityGUID : NewActivityGUID,
                                    IncludeAttachment : IncludeAttachment,
                                    AdditionalRequirements : stored,
                                    _token: '{{csrf_token()}}',
                                },  
                                beforeSend: function() {
                                    $('#overlay').show();
                                },  
                                success: function(response){
                                    $('#overlay').fadeOut(2000, () => {
                                        Swal.fire({
                                            icon: 'success',
                                            title: "This application was successfully endorsed!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                            width: '850px'
                                        }).then((result) => {
                                            /* Read more about handling dismissals below */
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                window.location.href='/default';
                                            }
                                        });
                                    });
                                }
                            });
                        }
                    });
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Notifications!',
                        text: 'File is empty',
                        // footer: '<a href="">Why do I have this issue?</a>',
                        width: '850px'
                      });
                }
            }else{
                Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to endorse this application?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{route('EndorseApplication')}}",
                                type: 'POST',
                                data: {
                                    UpdatedDate : UpdatedDate,
                                    ProjectGUID : GUID,
                                    ActivityGUID : ActivityGUID,
                                    Destination : Destination,
                                    UserDestination : UserDestination,
                                    ActionRequired : ActionRequired,
                                    Remarks : Remarks,
                                    NewActivityGUID : NewActivityGUID,
                                    IncludeAttachment : IncludeAttachment,
                                    AdditionalRequirements : stored,
                                    _token: '{{csrf_token()}}',
                                },  
                                beforeSend: function() {
                                    $('#overlay').show();
                                },  
                                success: function(response){
                                    $('#overlay').fadeOut(2000, () => {
                                        Swal.fire({
                                            icon: 'success',
                                            title: "This application was successfully endorsed!",
                                            showConfirmButton: false,
                                            timer: 1500,
                                            width: '850px'
                                        }).then((result) => {
                                            /* Read more about handling dismissals below */
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                window.location.href='/default';
                                            }
                                        });
                                    });
                                }
                            });
                        }
                    });
            }
            
        }
        
    });

    $("#AddRequirements").on('click', function() {
        var Requirements = $("#Requirements").val();

        if(confirm("Add this requirement?")){

          var req = {
                'description': Requirements,
            };

            ReqStorage.push(req);

            ///put additional requirements into local storage
            localStorage.setItem("ReqStorage", JSON.stringify(ReqStorage));  var req = {
                'description': Requirements,
            };

            ReqStorage.push(req);

            ///put additional requirements into local storage
            localStorage.setItem("ReqStorage", JSON.stringify(ReqStorage));

            var details = '<tr role="row" class="odd"><td><center><div class="form-group">';
            details += '<div class="checkbox">';
            details += '<label><input type="checkbox" disabled=""></label></div></div></center></td>';
            details += '<td><a id="pointer">'+ Requirements + ' </a></td></tr>';
            
            $("#application_requirements_body").append(details);
            $("#Requirements").val('');
        }else{
            return false;
        }

    });

    $("#Uploads").on('click', function() {
        var Documents = $("#Attachments").val();
        var files = $("#InputFile")[0].files;
        var OthersAttachment = $("#Others").val();

        if(files.length > 0){
            var fd = new FormData();

            // Append data 
            fd.append('Documents', Documents);
            fd.append('OthersAttachment', OthersAttachment);
            fd.append('file',files[0]);
            fd.append('_token','{{csrf_token()}}');

            // Hide alert
            $('#responseMsg').hide();

            // AJAX request 
            $.ajax({
                url: "{{route('uploadFileEndorseApp')}}",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: response['message'],
                        showConfirmButton: false,
                        timer: 1500,
                        width: '850px'
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    });
                },
                error: function(response){
                    console.log("error : " + JSON.stringify(response) );
                }
            });
        }else{
            Swal.fire({
                icon: 'warning',
                title: 'Please select a file.',
                showConfirmButton: false,
                timer: 1300,
                width: '850px'
            });
        }
    });

    $("#generate_evaluation_report").on('click', function() {
        var url = '/dynamic_pdf/EvaluationReport/' + GUID;

        Swal.fire({
          // title: 'Are you sure?',
          text: "Do you want to generate a report based on the evaluation of the above requirements? The generated report will be open in another tab.",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Okay'
        }).then((result) => {
          if (result.isConfirmed) {
            window.open(url,'_blank');

            Swal.fire(
              // '|Downloaded!|',
              'Your file has been opened.',
              'success'
            )
          }
        });
    });

    $("#generate_order_of_payment").on('click', function() {
        var url = '/dynamic_pdf/OrderOfPayment/' + GUID;
        
        Swal.fire({
          // title: 'Are you sure?',
          text: "Order of Payment for ECC Application was generated successfully and was added to the attachments below. Please make sure you've reviewed/updated the amount in the Order of Payment to correspond to the fee/s appropriate for this application. See EMB Manual of Fees for reference.",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Okay'
        }).then((result) => {
          if (result.isConfirmed) {

            window.open(url,'_blank');

            Swal.fire(
              // '|Downloaded!|',
              'Your file has been opened.',
              'success'
            )
          }
        });
    });

    $("#generate_draft_certificate").on('click', function() {
        var filesCheck = $('#filesCheck').text();

        if(filesCheck != ''){
            Swal.fire({
                    icon: 'info',
                    title: 'You need to delete the file first.',
                    showConfirmButton: false,
                    timer: 1300,
                    width: '850px'
                });

            
        } else {
            if(AcceptedDate == '' && AcceptedBy == ''){
                Swal.fire({
                    icon: 'warning',
                    title: 'You need to accept the application before drafting an ECC.',
                    showConfirmButton: false,
                    timer: 1300,
                    width: '850px'
                });
            }else{
                Swal.fire({
                  // title: 'Are you sure?',
                  text: "Do you want to generate a draft ECC for this application? The generated draft document  will be in docx format for editing purposes and will be downloaded automatically. Please make sure you have word editor installed in your machine.",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Okay'
                }).then((result) => {
                  if (result.isConfirmed) {

                    window.location.href = '/dynamic_pdf/DraftCerticate/' + GUID + '/' + ActivityGUID;

                    Swal.fire(
                      // '|Downloaded!|',
                      'Your file has been downloaded.',
                      'success'
                    )
                  }
                });
            }
        }
        
    });

    $("#generate_denial_letter").on('click', function() {
        var filesCheck = $('#filesCheck').text();

        if(filesCheck != ''){
            Swal.fire({
                    icon: 'info',
                    title: 'You need to delete the file first.',
                    showConfirmButton: false,
                    timer: 1300,
                    width: '850px'
                });

            
        } else {
            if(AcceptedDate == '' && AcceptedBy == ''){
                Swal.fire({
                    icon: 'warning',
                    title: 'You need to accept the application before drafting an ECC.',
                    showConfirmButton: false,
                    timer: 1300,
                    width: '850px'
                });
            }else{
                Swal.fire({
                  // title: 'Are you sure?',
                  text: "Do you want to generate a draft denial letter for this application? The generated draft document will be in docx format for editing purposes and will be downloaded automatically. Please make sure you have word editor installed in your machine.",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Okay'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = '/dynamic_pdf/DraftDenialLetter/' + GUID + '/' + ActivityGUID;


                    Swal.fire(
                      // '|Downloaded!|',
                      'Your file has been downloaded.',
                      'success'
                    )
                  }
                });
            }
        }
        
    });


    $("#Attachments").on('change', function() {
        if($(this).val() == 'Others, specify'){
            $("#Other_attachment").removeAttr("hidden");
        }
    });

    $("#user_list").on('change', function(){
        var OnLeave = $(this).val();

        if(OnLeave === 'OnLeaveReceiver'){
            OnLeaveFunction();
        }

    })
});

function AdditionalRequirementsSession(ReqStorage)
{
    ///Additional Requirements Session
    var stored = localStorage.getItem("ReqStorage");
    stored = JSON.parse(stored || '[]');
    ReqStorage.concat(stored);
    localStorage.setItem("ReqStorage", JSON.stringify(ReqStorage));

    $.each(stored, function(index, value ) {
        //now you can access properties using dot notation

        var details = '<tr role="row" class="odd"><td><center><div class="form-group">';
            details += '<div class="checkbox">';
            details += '<label><input type="checkbox" disabled=""></label></div></div></center></td>';
            details += '<td><a id="pointer">'+ value['description'] + ' </a></td></tr>';

        $("#application_requirements_body").append(details);
    });
}



function listOfAttachments(ActivityGUID)
{   
    $('#attachments_list').DataTable({
        destroy:true,
        processing:true,
        info:true,
        searching: false,
        ordering: false,
        // bPaginate: false,
        // bLengthChange: true,
        // bFilter: true,
        // bInfo: false,
        // bAutoWidth: false,
        ajax: {
            "url": "{{route('getActivityAttachmentsList')}}",
            "type": "POST",
            "data" : {
                ActivityGUID : ActivityGUID,
                _token: '{{csrf_token()}}',
            }
        },
        columns: [
        {
            data: 'Details', name: 'Details'
        },
        {
            data: 'CreatedDate', name: 'CreatedDate'
        },
        {
            data: 'CreatedBy', name: 'CreatedBy'
        },
        ]
    });
}

function getlistOfAttachments(CreatedBy, ActivityGUID)
{   
    $('#list-of-attachments').DataTable({
        destroy:true,
        processing:true,
        info:true,
        searching: false,
        ordering: false,
        // bPaginate: false,
        // bLengthChange: true,
        // bFilter: true,
        // bInfo: false,
        // bAutoWidth: false,
        ajax: {
            "url": "{{route('getListOfAttachments')}}",
            "type": "POST",
            "data" : {
                CreatedBy : CreatedBy,
                ActivityGUID : ActivityGUID,
                _token: '{{csrf_token()}}',
            }
        },
        columns: [
        {
            data: 'Details', name: 'Details'
        },
        ]
    });

    $('#list-of-attachments-modal').modal();
}


function UserListsOnRegion()
{
    // user_list
    var Region = "{{$project['Region']}}"; 

    $.ajax({
        url: "{{route('UserListsOnRegion')}}",
        type: 'POST',
        data: {
            Region : Region,
            _token: '{{csrf_token()}}' ,
        },    
        success: function(response){
            $.each(response, function(index, itemData) {
                if(itemData['OnLeaveReceiver'] == 1){
                    var option = '<option value="OnLeaveReceiver">' + itemData['UserName'] + ' ('+ itemData['UserRole'] + ') -- On Leave -- ' +'</option>';
                } else {
                    var option = '<option value="'+itemData['UserName']+'">' + itemData['UserName'] + ' ('+ itemData['UserRole'] + ') ' +'</option>';
                }
              
              $("#user_list").append(option);
            });
        }
    });
}

function modalEvaluation(ProjectGUID, ID, Description)
{   
    var url=window.location.origin;

    // user_list
    $.ajax({
        url: "{{route('getApplicationRequirementsModal')}}",
        type: 'POST',
        data: {
            ID : ID,
            ProjectGUID : ProjectGUID,
            Description : Description,
            _token: '{{csrf_token()}}' ,
        },    
        success: function(response){
            var FilePath = url + '/' + response['FilePath'];

            $("#description").html(Description);
            $("#description").attr("href", FilePath);
            $("#description").attr("target", "_Blank");

            if(response['Required'] == 1){
                $('#Required').prop('checked', true);    
            }else{
                $('#Required').prop('checked', false);
            }

            if(response['Compliant'] == 1){
                $('#Compliant').prop('checked', true); 
            } else {
                $('#Compliant').prop('checked', false);
            }
            
            $("#ProjectRequirementsGUID").val(response['PRID']);


            $("#remarks_textarea").text(response['Remarks']);

            $("#modal-evaluation").modal();
        }
    });
    
}

function acceptApplication()
{
    Swal.fire({
        // title: 'Are you sure?',
        text: "By clicking OK, you confirm that the submitted application and required documents (INCLUDING ECC APPLICATION FEE) were screened and found complete and accepted for processing.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Okay'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{route('acceptApplication')}}",
                type: 'POST',
                data: {
                    ProjectGUID : GUID,
                    _token: '{{csrf_token()}}' ,
                },
                beforeSend: function() {
                    $('#overlay').show();
                },  
                success: function(response){
                    $('#overlay').fadeOut(2000, () => {
                        Swal.fire({
                            icon: 'success',
                            title: "This application was accepted!",
                            showConfirmButton: false,
                            timer: 1500,
                            width: '850px'
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.reload();
                            }
                        });
                    });
                }
            });
        }
    });
}

function deleteUploadedFile(ID)
{
    Swal.fire({
        // title: 'Are you sure?',
        text: "Are you sure you want to delete this file?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Okay'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{route('deleteTempAttachment')}}",
                type: 'POST',
                data: {
                    ID : ID,
                    _token: '{{csrf_token()}}' ,
                },
                beforeSend: function() {
                    $('#overlay').show();
                },  
                success: function(response){
                    $('#overlay').fadeOut(2000, () => {
                        Swal.fire({
                            icon: 'success',
                            title: "Deleted!",
                            showConfirmButton: false,
                            timer: 1500,
                            width: '850px'
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.reload();
                            }
                        });
                    });
                }
            });
        }
    });
}

function OnLeaveFunction(){
    Swal.fire({
        icon: 'warning',
        title: 'Notifications!',
        text: 'This user is on leave',
        // footer: '<a href="">Why do I have this issue?</a>',
        width: '850px'
    });
}


///By clicking OK, you confirm that the submitted application and required documents (INCLUDING ECC APPLICATION FEE) were screened and found complete and accepted for processing.
</script>
