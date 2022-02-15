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
                        <img src="../../img/gear.jpeg" style="width:80px;">
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

                @if($project['RoutedTo'] == Session::get('data')['UserName'])
                    
                    <div id="ContentPlaceHolder1_dvRouting">
                        <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:10px;  cursor:pointer;">RETURN THIS APPLICATION TO EMB</div>
                        <br>
                        <div>
                            <b>1. Attach the required documents</b><div style="padding-bottom:10px; padding-top:10px;"><span style="font-size:smaller;">Listed in the dropdownlist below are the documents that need uploaded. Select from the list then browse for the scanned/electronic copy of the document and click the upload icon. Size of the file should be no larger than  <span id="" style="color:Red;font-weight:bold;">30</span>&nbsp;
                             <span class="failureNotification"><strong>MEGABYTES in PDF format</strong></span>.
                         </span></div>
                     </div>
                         <table cellspacing="0" cellpadding="5" width="100%">
                            <tbody><tr>
                                <td style="width:50%;">
                                    <select id='activitiyAttachments' name='activitiyAttachments'>
                                    </select>

                                    <!-- <select class="form-control" id="Attachments">
                                        @foreach($attachments as $attach)
                                        <option value="{{$attach->Description}}">
                                            {{$attach->Description}}
                                        </option> 
                                        @endforeach
                                    </select> -->
                                </td>
                                <td style="vertical-align:top;">
                                    <input type="file" style="border-width:0px;border-style:None;font-size:Medium;width:98%;" id="InputFile"> 
                                </td>
                                <td style="width:2%; text-align:right; vertical-align:top;">
                                    <button type="button" class="btn btn-default btn-sm" name="submit" id="Uploads"><img src="../../img/upload.png" style="width:15px;" /></button>
                                </td>
                            </tr>
                        </tbody></table>
                        <div style="padding-bottom:3px; padding-top:3px;">
                            <table class="table table-bordered dataTable no-footer" width="100%" cellspacing="0" cellpadding="5" role="grid">
                                <tbody id="attachRequirementsTable">
                                </tbody>
                            </table>
                         </div>
                        <br>
                        <br>
                        <b>2. Add Remarks</b><div style="padding-bottom:10px; padding-top:10px;"><span style="font-size:smaller;">Provide the remarks below.
                        </span></div>
                        <table style="width:100%; vertical-align:top;" cellpadding="0" cellspacing="0" class="tablecs">
                            <tbody><tr>
                                <td>
                                    <textarea rows="2" cols="20" id="Remarks" style="font-family:Tahoma;font-size:Medium;height:50px;width:99.5%;" id="Remarks"></textarea>
                                </td>
                            </tr>
                        </tbody></table>
                        <div style=" padding-top:10px;">
                            <input type="submit"  value="Return" id="Return" style="width:100px;">
                            <input type="submit" value="Cancel"  style="width:100px;">
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                    @endif
                    <!--- END IF ELSE ---->
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
var ActivityGUID = "{{$project['ActivityGUID']}}";
var CreatedBy = "{{$project['CreatedBy']}}";

$(document).ready(function(){
    var ProjectName = "{{ $project['ProjectName']}}";
    var ProjectAddress = "{{$project['Address']}}";
    var ProjectMunicipality = "{{$project['Municipality']}}";
    var ProjectProvince = "{{$project['Province']}}";
    var ProjectPurpose = "{{$project['Purpose']}}";
    var PreviousECCNo = "{{$project['PreviousECCNo']}}";
    var NewActivityGUID;

    if(ProjectPurpose == "New Application"){
        var Purpose = "New ECC Application";
    } else {
        var Purpose = ProjectPurpose + ' of ECC No. ' + PreviousECCNo;
    }

    var text = ProjectName + ' - ' + ProjectAddress + ', ' + ProjectMunicipality + ', ' + ProjectProvince +
    "<br/>" +'Purpose: ' + Purpose;
    $("#header-title").html(text);


    var check = "{{ Session::has('NewActivityGUID') ? Session::get('NewActivityGUID') : ''}}";


    var attachedDocuments = [];

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
        }
      });
    }

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
                   var ID = response['data'][i].ID;
                   var Description = response['data'][i].Description;

                   var option = "<option value='"+Description+"'>"+Description+"</option>";

                   $("#activitiyAttachments").append(option); 
                }
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
            var fd = new FormData();

            // Append data 
            fd.append('Documents', Documents);
            fd.append('file',files[0]);
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

                    $('#activitiyAttachments option:selected').remove();

                    $("#InputFile").val(''); 

                    var details = '<tr role="row" class="odd">';
                    details += '<td><a id="pointer" href="'+ link +'" target="_blank">'+ response['Description'] + ' </a> ( '+ response['FileSizeInKB'] +' ) </td>';

                    details += '<td><button type="button" class="btn btn-default" id="remove" value="'+arrayCount+'"><img src="../../img/trashbin.jpg" style="width:15px;" /></button></td></tr>';

                    $("#attachRequirementsTable").append(details);
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

    $('.table tbody').on('click', '#remove', function() { 
        $(this).closest('tr').remove();
        var ID = $(this).val();
        attachedDocuments.splice(ID, 1);
      });

    $("#Return").on('click', function() {
        var UpdatedDate = "{{$project['UpdatedDate']}}";
        var Status = "{{$project['Status']}}";

        var RoutedToOffice = "{{$project['RoutedFromOffice']}}";
        var RoutedTo = "{{$project['RoutedFrom']}}";
        var RoutedFromOffice = "{{$project['RoutedToOffice']}}";
        var RoutedFrom = "{{$project['RoutedTo']}}";

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
                            NewActivityGUID : NewActivityGUID,

                            attachedDocuments : attachedDocuments,

                            Status : Status,

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
