@extends('layouts.adminlte.default.layout')


@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container-fluid">
    <div class="box box-default">
      <!-- <div class="box-header with-border">
        <img id="" src="../img/Tools.jpg" style="width:38px;"> <b>Applications for Action - </b>
      </div> -->
      <div class="box-body">
        <div class="box-header">
          <small id="title"></small>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <div class="col-md-8 no-padding">
              <div id="pdf_view"></div>
             
            </div>
            <div class="col-md-4">
              <div style="padding-bottom:5px; font-size:9pt; ">Requirements</div>
              <div class="col-md-12" style="padding: 0px">
                <select class="form-control" id="project_description" style="font-size:Small;">
                  <option value="">--- Select Attachment ---</option>
                  @foreach($projectrequirements as $requirements)
                  <option value="{{ $requirements->Description}}">{{ $requirements->Description}}</option>
                  @endforeach
                </select>
              </div>
              <div style="padding-bottom:5px; font-size:9pt; ">Remarks</div>
              <div class="col-md-12" style="padding: 0px">
                <textarea id="remarks_textarea" rows="2" cols="20" style="font-family:Tahoma;font-size:Medium;height:200px;width:100%;padding: 13px;"></textarea>
              </div>
              <div class="col-md-12" style="padding: 0px">
                <small>
                  <input type="checkbox" id="Compliant"> 
                  The submitted documents passed the evaluation/review.
                </small>
                <input id="ProjectRequirementsGUID" hidden/>
              </div>
              <div class="col-md-12" style="padding: 0px">
                <button class="btn btn-primary" id="SaveAppReq" onclick="SaveAppReq()">Save</button>
                <button class="btn btn-warning" id="NextDescription">Next</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div id="overlay" style="display:none;">
  <div class="spinner"></div>
  <br/>
  <h3>Please wait while saving your data...</h3>
</div>
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

  var selectedIndex = document.getElementById("project_description").selectedIndex;
  selectedIndex = selectedIndex + 1;
  var selected = document.getElementById("project_description").options[selectedIndex].value;

  $("#NextDescription").attr('onClick', 'NextDesc("'+selected+'")');

  $("#project_description").on('change', function() {
    var description = $(this).val();
    $("#NextDescription").removeAttr('onClick');

    $("#remarks_textarea").val('');

    $.ajax({
      url: "{{route('reviewerPDF')}}",
      type: 'POST',
        data: {
        ProjectGUID : GUID,
        Description : description,
        _token: '{{csrf_token()}}' ,
      },
      success: function(response){
        $("#remarks_textarea").val(response['Remarks']);

        var embedded = '<embed type="application/pdf" src="'+response['FilePath']+'" width="100%" height="800" alt="pdf" />'

        if(response['Compliant'] === 1){
          $("#Compliant").attr('checked', 'checked');
        } else {
          $("#Compliant").removeAttr('checked');
        }

        $("#title").html(description);
        $("#pdf_view").html(embedded);

        $("#ProjectRequirementsGUID").val(response['PRID']);

        var selectedIndex = document.getElementById("project_description").selectedIndex;
          selectedIndex = selectedIndex + 1;
        var selected = document.getElementById("project_description").options[selectedIndex].value;

        $("#NextDescription").attr('onClick', 'NextDesc("'+selected+'")');
          
        
      }
    });
  });
});

function NextDesc(selectedDesc){
  
  var GUID = "{{$project['GUID']}}";
  
  $("#NextDescription").removeAttr('onClick');
  $("#remarks_textarea").val('');

  $.ajax({
    url: "{{route('reviewerPDF')}}",
    type: 'POST',
    data: {
      ProjectGUID : GUID,
      Description : selectedDesc,
      _token: '{{csrf_token()}}' ,
    },
    success: function(response){
      $("#remarks_textarea").val(response['Remarks']);
          
      $("#project_description").val(response['Description']);

      var embedded = '<embed type="application/pdf" src="'+response['FilePath']+'" width="100%" height="800" alt="pdf" />'

      if(response['Compliant'] === 1){
        $("#Compliant").attr('checked', 'checked');
      } else {
        $("#Compliant").removeAttr('checked');
      }

      var selectedIndex = document.getElementById("project_description").selectedIndex;
          selectedIndex = selectedIndex + 1;
      var selected = document.getElementById("project_description").options[selectedIndex].value;

      $("#NextDescription").attr('onClick', 'NextDesc("'+selected+'")');

      $("#title").html(response['Description']);

      $("#pdf_view").html(embedded);

      $("#ProjectRequirementsGUID").val(response['PRID']);
    }
  });
}

function SaveAppReq()
{
  var Remarks = $("#remarks_textarea").val();
  var Compliant = $('#Compliant').is(':checked');
  var PRID = $("#ProjectRequirementsGUID").val();

  $.ajax({
    url: "{{route('SaveAppReqApprover')}}",
    type: 'POST',
    data: {
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
}
</script>