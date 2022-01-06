<div class="box-body">
  <div>
    <button type="button" class="btn btn-primary pull-right" id="check_step_3">Submit <i class="fa fa-fw fa-save"></i></button>
  </div>
  <h4><b>8. Confirm Submission: 
    <span id="proceed_3"></span>
  </b><br></h4>
    <i>Please review your entries by navigating to previous pages or click the 'Next' button to confirm the submission of this application FOR SCREENING. The submitted documents are automatically forwarded to the EMB Regional Office having jurisdiction of the project. Once screened, you will be advised to pay the corresponding application fee or submit additional document/provide clarification. Returned applications will appear in the 'For Action' page.</i>
    <br><br>
    <h4><Label>Purpose: New ECC Application</label></h4>
    <Label>Documents Uploaded:</label>
      <table class="table" id="documents_uploaded" style="width: 100%;  display: table; ">
        <thead>
          <th style="width:2%;"></th>
          <th></th>
        </thead>
        <tbody>
        </tbody>
      </table> 
    <Label>Remarks/Additional Notes</label>
    <div style="border:Solid 1px Silver;">
      <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:Small;height:200px;width:98.3%;padding:10px; border:none;" id="remarks"></textarea>
      </div>
    </div>

<script>

$(document).ready(function(){
  var url=window.location.pathname;
        var arr=url.split('/');
        var NewGUID=arr[2];

        $('#documents_uploaded').DataTable({
          processing:true,
          info:true,
          searching: false,
          ordering: false,
          bPaginate: false,
          bLengthChange: false,
          bFilter: true,
          bInfo: false,
          bAutoWidth: false,
          ajax: {
            "url": "{{route('getDocumentsUploaded')}}",
            "type": "POST",
            "data": {
                ProjectGUID : NewGUID,
                _token: '{{csrf_token()}}' ,
            }, 
        },
            columns: [
            {data: 'Check', name: 'Check'},
            {data: 'Description', name: 'Description'},
            ]
        });
});
</script>