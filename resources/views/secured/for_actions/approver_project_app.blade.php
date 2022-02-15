@extends('layouts.adminlte.default.layout')

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
                    <div style="  padding-bottom:10px; padding-top:5px; font-size:9pt; border-bottom:Solid 1px Silver;">Instruction: Please review and information below and click the appropriate action button. You can click on the remarks to view the attachments.
                    </div>
                    
                    <div>
                        <div>
                            <!--Endorse Application -->
                            <div style="padding-top:20px; padding-bottom:20px;">
                                <b>Recent Activity/Comments:</b> <a  href="" style="text-decoration:none;" id="remarks"></a> <span id="name_date"></span>
                            </div>
                            <div style="padding-top:20px; padding-bottom:20px;" id="button_approver">
                                
                            </div>
                     </div>
                    <!--Routing History-->
                    <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">ROUTING HISTORY
                        <button class="btn btn-warning btn-md pull-right no-padding" id="review_requirements">Review Requirements</button>
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
                </div>
            </div>
        </section>

        <div class="modal fade" id="list-of-attachments-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                            <span aria-hidden="true">&times;</span>
                        </button>
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

    var textProject = ProjectName + ' - ' + ProjectAddress + ', ' + ProjectMunicipality + ', ' + ProjectProvince +
    "<br/>" +'Proponent: ' + ProponentName + ' ( ' + Purpose + ' ) ';
    $("#header-title").html(textProject);

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

            if(response['Status'] === 'For Denial'){
                var button = '<button class="btn btn-warning btn-md" onclick="ProcessApplication('+"'Denied'"+', '+"'"+textProject+"'"+')">Deny Application</button>&nbsp;<button class="btn btn-default btn-md">Revert</button>';
            }else{
                var button = '<button class="btn btn-primary btn-md" onclick="ProcessApplication('+"'Denied'"+', '+"'"+textProject+"'"+')">Approve Application</button>&nbsp;<button class="btn btn-default btn-md">Revert</button>';
            }
            
            $("#button_approver").html(button);

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

    $("#review_requirements").on('click', function() {
        window.location.href = '/reviewer/' + GUID;
    });
});

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

function ProcessApplication(Status, text)
{
    var UpdatedDate = "{{$project['UpdatedDate']}}";
    var Project = '<b>' + text + '</b>'; 
    if(Status === 'Denied'){
        Swal.fire({
            title: '<small style="font-size:10pt">Click the button below to confirm the approval of the application:</small>',
            html: Project,
            // icon: 'info',
            showCancelButton: false,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Deny ECC Issuance'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '<small>Are you sure?</small>',
                    text: 'Confirm the APPROVAL of this application?',
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('decideApplication')}}",
                            type: 'POST',
                            data: {
                                ProjectGUID : GUID,
                                Status: 'Denied',
                                _token: '{{csrf_token()}}' ,
                            },
                            beforeSend: function() {
                                $('#overlay').show();
                            },  
                            success: function(response){
                                $('#overlay').fadeOut(2000, () => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: "This application was denied!",
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
        });
    } else {
        Swal.fire({
            title: '<small style="font-size:10pt">Click the button below to confirm the approval of the application:</small>',
            html: Project,
            // icon: 'info',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve ECC Issuance'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '<small>Are you sure?</small>',
                    text: 'Confirm the APPROVAL of this application?',
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('decideApplication')}}",
                            type: 'POST',
                            data: {
                                ProjectGUID : GUID,
                                Status: 'Approved',
                                _token: '{{csrf_token()}}' ,
                            },
                            beforeSend: function() {
                                $('#overlay').show();
                            },  
                            success: function(response){
                                $('#overlay').fadeOut(2000, () => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: "This application was approved!",
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
        });
    }


    ///Approve: Confirm the APPROVAL of this application? Yes, Approve ECC Issuance

    ///Approve: Confirm the DENIAL of this application? Yes, Deny ECC Issuance  

    ///Denial: This action will generate a Signed Denial Letter in pdf based on the latest Draft of the Denial Letter. 

}


/// ReferenceNoSeries: Max of ReferenceNoSeries
/// ReferenceNo : ECC-OL-{Region}-{Year}-{ReferenceNoSeries}


///By clicking OK, you confirm that the submitted application and required documents (INCLUDING ECC APPLICATION FEE) were screened and found complete and accepted for processing.
</script>
