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
                                        <input type="submit" value="X" style="color:White;background-color:#1E8CBE;border-style:None;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="padding:10px;">
                        <div  style="height:320px;overflow-y:scroll;">
                        </div>
                    </div>
                </div>
                <div class="dvinfo">
                    <div style="  padding-bottom:10px; padding-top:5px; font-size:9pt; border-bottom:Solid 1px Silver;">
                        Instruction: Review the comments below or click the same to view the related attachments. To return the Application to EMB, make sure you attached the required documents. 
                    </div>
                    <div style="padding-top:20px; padding-bottom:20px;">
                        <b>Recent Activity:</b> <a  href="" style="text-decoration:none;" id="remarks"></a> 
                    </div>

                    <div class="box box-primary">
                        <div class="box-header with-border" style="background-color:#106A9A; color:White; padding:10px;  cursor:pointer;">
                            <h3 class="box-title" style="font-weight:bold;" >UPDATE BASIC PROJECT INFO</h3>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12" style="padding: 5px">
                                    <label>Project Name</label>
                                    <input type="text" class="form-control" id="project-name" placeholder="Project Name" value="{{ $project->ProjectName }}">
                                </div>

                                <div class="col-md-6" style="padding: 5px">
                                    <label>Represented By</label>
                                    <input type="text" class="form-control" id="represented-by" placeholder="Represented By" value="{{ $project->Representative }}">
                                </div>

                                <!---->
                                <div class="col-md-3" style="padding: 5px">
                                    <label>Designation</label>
                                    <select class="form-control" id="designation">
                                      <option>Owner</option>
                                      <option>Director</option>
                                      <option>Regional Director</option>
                                      <option>Mayor</option>
                                      <option>President</option>
                                      <option>Vice-President</option>
                                      <option>Manager</option>
                                      <option>General Manager</option>
                                      <option>CEO/COO</option>
                                      <option>District Engineer</option>
                                    </select>
                                </div>

                                <div class="col-md-3" style="padding: 5px">
                                    <label>Total Project Land Area (sq. m.)</label>
                                    <input type="text" class="form-control" id="land-area-in-sqm" placeholder="Total Project Land Area (sq. m.)" value="{{ $project->LandAreaInSqM }}">
                                </div>

                                <!---->

                                <div class="col-md-6" style="padding: 5px">
                                    <label>Total Projects/Building Footprint Area (sq. m)</label>
                                    <input type="text" class="form-control" id="foot-print-area-in-sqm" placeholder="Total Projects/Building Footprint Area (sq. m)" value="{{ $project->FootPrintAreaInSqM }}">
                                </div>

                                <div class="col-md-3" style="padding: 5px">
                                    <label>No. of Employees</label>
                                    <input type="text" class="form-control" id="no-of-employees" placeholder="No. of Employees" value="{{ $project->NoOfEmployees }}">
                                </div>

                                <div class="col-md-3" style="padding: 5px">
                                    <label>Total Project Cost (Php)</label>
                                    <input type="text" class="form-control" id="project-cost" placeholder="Total Project Cost (Php)" value="{{ $project->ProjectCost }}">
                                </div>

                                <div class="col-md-12" style="padding-top: 35px">
                                    <div class="col-md-8">
                                        <a id="convert-pdf-updated" style="text-decoration:none; cursor: pointer" class="pull-right"> Click here to download the updated Project Description</a>
                                    </div>
                                    <div class="btn-group col-md-4">
                                        <button type="button" class="btn btn-default btn-md" style="width: 200px" id="update-project-info">Save</button>
                                        <button type="button" class="btn btn-default btn-md" style="width: 200px" id="cancel-update">Cancel</button>
                                    
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                @if($project->RoutedTo == Session::get('data')['UserName'])

                <div class="box box-primary">
                    <div class="box-header with-border" style="background-color:#106A9A; color:White; padding:10px;  cursor:pointer;">
                        <h3 class="box-title" style="font-weight:bold; ">RETURN THIS APPLICATION TO EMB</h3>
                    </div>

                    <div class="box-body">
                        <div>
                            <b>1. Attach the required documents</b>
                            <div style="padding-bottom:10px; padding-top:10px;">
                                <span style="font-size:smaller;">Listed in the dropdownlist below are the documents that need uploaded. Select from the list then browse for the scanned/electronic copy of the document and click the upload icon. Size of the file should be no larger than
                                    <span id="" style="color:Red;font-weight:bold;">30</span>&nbsp;
                                    <span class="failureNotification"><strong>MEGABYTES in PDF format</strong></span>.
                                </span>
                            </div>
                        </div>
                        <div>
                            <table cellspacing="0" cellpadding="5" width="100%">
                                <tbody>
                                    <tr>
                                        <td style="width:600px;">
                                            <select class='form-control' id='activitiyAttachments' name='activitiyAttachments'>
                                                @if($project->Status == 'Approved')
                                                    <option value="Notarized ECC">
                                                       Notarized ECC
                                                    </option> 
                                                @endif
                                            </select>
                                        </td>
                                        <td style="width:250px;">
                                            <input type="file" style="border-width:0px;border-style:None;font-size:Medium; width: 300px;" id="InputFile"> 
                                        </td>
                                        <td style="width:80px; vertical-align:top;">
                                            <button type="button" class="btn btn-default btn-md" name="submit" id="Uploads" style="width: 200px"><img src="../../img/upload.png" style="width:15px;" /></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>      
                        <br>

                        <div>
                            <label>Payment Information - Application Fee</label>
                            <br/>
                            <div class="row">
                                <div class="col-xs-4">
                                    Bank Branch
                                    <input type="text" class="form-control" placeholder="" id="bank-branch">
                                </div>

                                <div class="col-xs-3">
                                    Bank Sequence No.
                                    <input type="text" class="form-control" placeholder="" id="bank-sequence-no">
                                </div>
                                
                                <div class="col-xs-3">
                                    Payment Date
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker" placeholder="mm/dd/yyyy">
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    Amouunt
                                    <input type="text" class="form-control" value="5070.00" disabled>
                                </div>
                            </div>
                        </div>

                         <div style="padding-bottom:3px; padding-top:3px;">
                            <table class="table table-bordered dataTable no-footer" width="100%" cellspacing="0" cellpadding="5" role="grid">
                                <tbody id="attachRequirementsTable"></tbody>
                            </table>
                        </div>
                        <br>
                        <b>2. Add Remarks</b>
                        <div style="padding-bottom:10px; padding-top:10px;">
                            <span style="font-size:smaller;">Provide the remarks below.</span>
                        </div>

                        <table style="width:100%; vertical-align:top;" cellpadding="0" cellspacing="0" class="tablecs">
                            <tbody>
                                <tr>
                                    <td>
                                        <textarea rows="2" cols="20" id="Remarks" style="font-family:Tahoma;font-size:Medium;height:50px;width:99.5%;" id="Remarks"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style=" padding-top:10px;">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-md" style="width: 200px" value="Return" id="Return" >Return</button>
                                <button type="button" class="btn btn-default btn-md" style="width: 200px">Cancel</button>
                            </div>
                        </div>

                    </div>

                </div>

                @endif
                <!--- END IF ELSE ---->

                <div class="box box-primary">
                    <div class="box-header with-border"  style="background-color:#106A9A; color:White; padding:10px;">
                        <h3 class="box-title" style="font-weight:bold;">ROUTING HISTORY</h3>
                    </div>

                    <div class="box-body">
                        <table class="table table-bordered" id="RoutingHistoryTable">
                            <thead>
                                <th>Routing</th>
                                <th>Status/Location</th>
                                <th style="width: 280px">Remarks</th>
                                <th>Date and Time</th>
                                <th style="width: 50px"><button class="btn btn-block btn-flat disabled"><i class="fa fa-folder-o"></i></button></th>
                            </thead>
                            <tbody></tbody>
                        </table> 
                    </div>

                </div>
            </div>

            <div id="" class="modalBackgroundgray" style="display: none; position: fixed; left: 0px; top: 0px;"></div>
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

    <!-- /.modal -->
    <div id="overlay" style="display:none;">
        <div class="spinner"></div>
        <br/>
        <h3>Please wait while saving your data...</h3>
    </div>

    <input id="NewActivityGUID" hidden>
@stop
<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
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

var GUID = "{{$project->GUID}}";
var ActivityGUID = "{{$project->ActivityGUID}}";
var CreatedBy = "{{$project->CreatedBy}}";



$(document).ready(function(){
    var ProjectName = "{{ $project->ProjectName}}";
    var ProjectAddress = "{{$project->Address}}";
    var ProjectMunicipality = "{{$project->Municipality}}";
    var ProjectProvince = "{{$project->Province}}";
    var ProjectPurpose = "{{$project->Purpose}}";
    var PreviousECCNo = "{{$project->PreviousECCNo}}";

    $('#datepicker').datepicker({
       todayBtn: "linked",
       language: "it",
       autoclose: true,
       todayHighlight: true,
       format: 'yyyy-mm-dd' 
   });

    $("#designation").val("{{ $project->Designation }}");

    if(ProjectPurpose == "New Application"){
        var Purpose = "New ECC Application";
    } else {
        var Purpose = ProjectPurpose + ' of ECC No. ' + PreviousECCNo;
    }

    var text = ProjectName + ' - ' + ProjectAddress + ', ' + ProjectMunicipality + ', ' + ProjectProvince +
    "<br/>" +'Purpose: ' + Purpose;
    $("#header-title").html(text);

    var attachedDocuments = [];

    var check = "{{ Session::has('NewActivityGUID') ? Session::get('NewActivityGUID') : ''}}";

    $("#convert-pdf-updated").on('click', function() {
        var url = window.location.origin + '/dynamic_pdf/ProjectDescription/' + GUID;

        window.open(url, '_blank')

        // window.location.href = '/dynamic_pdf/ProjectDescription/' + GUID;
    });
    

    if(check === ''){
        $.ajax({
            url: "{{route('addNewActivityGUID')}}",
            type: 'POST',
            data: {
              ProjectGUID : GUID,
              _token: '{{csrf_token()}}' ,
            },
            success: function(response){
                // alert(response);
                NewActivityGUID = response;

                $("#NewActivityGUID").val(response);
            }
          });
        } else {
            $("#NewActivityGUID").val("{{ Session::get('NewActivityGUID') }}");
        }

    var NewActivityGUID = $("#NewActivityGUID").val();
    

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
        "url": "{{route('get.routing.history')}}",
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
        data: 'Status', name: 'Status', orderable: false
    },
    {
        data: 'Remarks', name: 'Remarks', orderable: false
    },
    {
        data: 'Date', name: 'Date', orderable: false
    },
    {
        data: 'Action', name: 'Action', orderable: false
    },
    ]
});

    $.ajax({
        url: "{{route('getActivityAttachments')}}",
        type: 'POST',
        data: {
            data : GUID,
            _token: '{{csrf_token()}}' ,
        },    
        success: function(response){
            var len = 0;
            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                // Read data and create <option >
                for(var i=0; i<len; i++){
                    var ID = response['data'][i].ID;
                    var Description = response['data'][i].Description;

                    var option = "<option value='"+Description+"'>"+Description+"</option>";

                    $("#activitiyAttachments").append(option); 
                }
            } else {
                var option = "<option> </option>";

                $("#activitiyAttachments").append(option); 

            }
        }
    });


    $.ajax({
        url: "{{route('getProjectActivity')}}",
        type: 'POST',
        data: {
            ProjectGUID : GUID,
            _token: '{{csrf_token()}}' ,
        },    
        success: function(response){
            $("#remarks").html(response['Details']);
        }
    });

    $("#Uploads").on('click', function() {
        var Documents = $("#activitiyAttachments").val();
        var files = $("#InputFile")[0].files;

        if(files.length > 0){
            Swal.fire({
                title: '<small>Are you sure you want to upload this file?</small>',
                // text: 'Confirm the REVERT of this application?',
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    var fd = new FormData();

                    // Append data 
                    fd.append('Documents', Documents);
                    fd.append('file',files[0]);
                    fd.append('ProjectGUID',GUID);
                    fd.append('_token','{{csrf_token()}}');

                    // Hide alert
                    $('#responseMsg').hide();

                    // AJAX request 
                    $.ajax({
                        url: "{{route('uploadFileEndorseApplicant')}}",
                        method: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response){
                            var arrayCount = attachedDocuments.length;
                            attachedDocuments.push(response);

                            var url=window.location.origin;
                            var filepath = response['FilePath'];
                            var link = url + '/' + filepath;

                            // $('#activitiyAttachments option:selected').remove();

                            $("#InputFile").val(''); 

                            var details = '<tr role="row" class="odd">';
                            details += '<td><a id="pointer" href="'+ link +'" target="_blank">'+ response['Description'] + ' </a> ( '+ response['FileSizeInKB'] +' ) </td>';

                            details += '<td><button type="button" class="btn btn-default" id="remove" value="'+arrayCount+'"><img src="../../img/trashbin.jpg" style="width:15px;" /></button></td></tr>';

                            $("#attachRequirementsTable").append(details);
                        },
                        error: function(response){
                            alert("There's an error while uploading your file.");
                            console.log("error : " + JSON.stringify(response) );
                        }
                    });
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

    $('.table tbody').on('click', '#remove', function() { 
        $(this).closest('tr').remove();

        var ID = $(this).val();
        attachedDocuments.splice(ID, 1);
    });

    $("#Return").on('click', function() {
        var UpdatedDate = "{{$project->UpdatedDate}}";
        var Status = "{{$project->Status}}";

        var RoutedToOffice = "{{$project->RoutedFromOffice}}";
        var RoutedTo = "{{$project->RoutedFrom}}";
        var RoutedFromOffice = "{{$project->RoutedToOffice}}";
        var RoutedFrom = "{{$project->RoutedTo}}";

        var BankBranch = $("#bank-branch").val();
        var BankSequenceNo = $("#bank-sequence-no").val(); 
        var Datepicker = $("#datepicker").val();
        var Remarks = $("#Remarks").val();

        if(Remarks === ''){
            Swal.fire({
                icon: 'error',
                title: 'Notifications!',
                text: 'Remarks can not be empty',
                // footer: '<a href="">Why do I have this issue?</a>',
                width: '850px'
              });
        }else{
            Swal.fire({
                title: 'Are you sure?',
                text: "Return this application to EMB Regional Office?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('ReturnApplication')}}",
                        type: 'POST',
                        data: {
                            UpdatedDate : UpdatedDate,
                            ProjectGUID : GUID,
                            ActivityGUID : ActivityGUID,

                            RoutedToOffice : RoutedToOffice,
                            RoutedTo : RoutedTo,
                            RoutedFromOffice : RoutedFromOffice,
                            RoutedFrom : RoutedFrom, 

                            Remarks : Remarks,
                            NewActivityGUID : $("#NewActivityGUID").val(),

                            attachedDocuments : attachedDocuments,

                            Status : Status,

                            BankBranch : BankBranch,
                            Datepicker : Datepicker,
                            BankSequenceNo : BankSequenceNo,

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
                                    width: '450px'
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
        
    });


    $("#update-project-info").on('click', function() {
        var ProjectName = $('#project-name').val();
        var RepresentBy = $('#represented-by').val();
        var Designation = $('#designation').val();
        var LandAreaInSqM = $('#land-area-in-sqm').val();
        var FootPrintAreaInSqM = $('#foot-print-area-in-sqm').val();
        var NoOfEmployees = $('#no-of-employees').val();
        var ProjectCost = $('#project-cost').val();


        Swal.fire({
            title: 'Are you sure?',
            text: "You want to update project information?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{route('updateBasicProjectInformation')}}",
                    type: 'POST',
                    data: {
                        ProjectGUID : GUID,
                        ProjectName : ProjectName,
                        RepresentBy : RepresentBy,
                        Designation : Designation,
                        LandAreaInSqM : LandAreaInSqM,
                        FootPrintAreaInSqM : FootPrintAreaInSqM,
                        NoOfEmployees : NoOfEmployees,
                        ProjectCost : ProjectCost,
                        _token: '{{csrf_token()}}',
                    },
                    beforeSend: function() {
                        $('#overlay').show();

                        $('#overlay-message').html('Updating your information. Please be patient.')
                    },
                    success: function(response){
                        $('#overlay').fadeOut(2000, () => {
                            Swal.fire({
                                icon: 'success',
                                title: "Successfully updated!",
                                showConfirmButton: false,
                                timer: 1500,
                                width: '850px'
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.reload();
                                }
                            });
                        });
                    }
                });
            }
        });
    });
});

function listOfAttachments(CreatedBy, ActivityGUID)
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

</script>