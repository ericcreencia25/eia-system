@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>Project Application</a></li>
        </ol>
    </section>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-default">
            <div style="padding:10px;">
                <div class='col-md-12'>
                    <div class="col-md-1">
                        <img src="../img/gear.jpeg" style="width:80px;">
                    </div>
                    <div class="col-md-11">
                        <h3><b id="header-title"></b></h3>
                    </div>
                </div>

                <div id="ContentPlaceHolder1_pnAttachments" style="width: 70%; background-color: white; display: none; position: fixed;">
                    <div style="background-color:RGB(16,106,154); padding:5px; color:White;">
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td>Click the the link below to view the attachment.</td>
                                    <td style="width:40px;">
                                        <input type="submit" name="ctl00$ContentPlaceHolder1$btnClose" value="X" id="ContentPlaceHolder1_btnClose" style="color:White;background-color:#1E8CBE;border-style:None;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="padding:10px;">
                        <div id="ContentPlaceHolder1_Panel1" style="height:320px;overflow-y:scroll;">
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
                    <div id="ContentPlaceHolder1_dvRouting">
                        <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;  cursor:pointer;">RETURN THIS APPLICATION TO EMB</div>
                        <br>
                        <div>
                            <b>1. Attach the required documents</b><div style="padding-bottom:10px; padding-top:10px;"><span style="font-size:smaller;">Listed in the dropdownlist below are the documents that need uploaded. Select from the list then browse for the scanned/electronic copy of the document and click the upload icon. Size of the file should be no larger than  <span id="" style="color:Red;font-weight:bold;">30</span>&nbsp;
                             <span class="failureNotification"><strong>MEGABYTES in PDF format</strong></span>.
                         </span></div></div>
                         <table cellspacing="0" cellpadding="5" width="100%">
                            <tbody><tr>
                                <td style="width:50%;">
                                    <select id='activitiyAttachments' name='activitiyAttachments'>
                                    </select>
                                </td>
                                <td style="vertical-align:top;">
                                    <input type="file" name="ctl00$ContentPlaceHolder1$fUpload" id="ContentPlaceHolder1_fUpload" style="border-width:0px;border-style:None;font-size:Medium;width:98%;"> 
                                </td>
                                <td style="width:2%; text-align:right; vertical-align:top;">
                                    <button type="button" class="btn btn-default btn-sm" name="submit"><img src="../img/upload.png" style="width:15px;" /></button>
                                </td>
                            </tr>
                        </tbody></table>
                        <br>
                        <br>
                        <b>2. Add Remarks</b><div style="padding-bottom:10px; padding-top:10px;"><span style="font-size:smaller;">Provide the remarks below.
                        </span></div>
                        <table style="width:100%; vertical-align:top;" cellpadding="0" cellspacing="0" class="tablecs">
                            <tbody><tr>
                                <td>
                                    <textarea name="ctl00$ContentPlaceHolder1$Details" rows="2" cols="20" id="ContentPlaceHolder1_Details" style="font-family:Tahoma;font-size:Medium;height:50px;width:99.5%;"></textarea>
                                </td>
                            </tr>
                        </tbody></table>
                        <div style=" padding-top:10px;">
                            <input type="submit" name="ctl00$ContentPlaceHolder1$btnPostRouting" value="Return" onclick="return confirm('Return this application to EMB Regional Office?');" id="ContentPlaceHolder1_btnPostRouting" style="width:100px;">
                            <input type="submit" name="ctl00$ContentPlaceHolder1$btnCancelRouting" value="Cancel" id="ContentPlaceHolder1_btnCancelRouting" style="width:100px;">
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                    <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;">Routing History
                    </div>
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
                
                <div id="" class="modalBackgroundgray" style="display: none; position: fixed; left: 0px; top: 0px;"></div></div>
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
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
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

$(document).ready(function(){
    var ProjectName = "{{ $project['ProjectName']}}";
    var ProjectAddress = "{{$project['Address']}}";
    var ProjectMunicipality = "{{$project['Municipality']}}";
    var ProjectProvince = "{{$project['Province']}}";
    var ProjectPurpose = "{{$project['Purpose']}}";
    var PreviousECCNo = "{{$project['PreviousECCNo']}}";

    if(ProjectPurpose == "New Application"){
        var Purpose = "New ECC Application";
    } else {
        var Purpose = ProjectPurpose + ' of ECC No. ' + PreviousECCNo;
    }

    var text = ProjectName + ' - ' + ProjectAddress + ', ' + ProjectMunicipality + ', ' + ProjectProvince +
    "<br/>" +'Purpose: ' + Purpose;
    $("#header-title").html(text);

    $('#RoutingHistoryTable').DataTable({
      destroy:true,
        processing:true,
        info:true,
        searching: true,
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
                   var GUID = response['data'][i].GUID;
                   var Description = response['data'][i].Description;

                   var option = "<option value='"+GUID+"'>"+Description+"</option>";

                   $("#activitiyAttachments").append(option); 
                }
             }
        }
    });

    console.log(GUID);
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
