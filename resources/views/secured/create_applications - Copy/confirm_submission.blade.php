<style>
    /*--thank you pop starts here--*/
.thank-you-pop{
    width:100%;
    padding:20px;
    text-align:center;
}
.thank-you-pop img{
    width:76px;
    height:auto;
    margin:0 auto;
    display:block;
    margin-bottom:25px;
}

.thank-you-pop h1{
    font-size: 42px;
    margin-bottom: 25px;
    color:#5C5C5C;
}
.thank-you-pop p{
    font-size: 20px;
    margin-bottom: 27px;
    color:#5C5C5C;
}
.thank-you-pop h3.cupon-pop{
    font-size: 25px;
    margin-bottom: 40px;
    color:#222;
    display:inline-block;
    text-align:center;
    padding:10px 20px;
    border:2px dashed #222;
    clear:both;
    font-weight:normal;
}
.thank-you-pop h3.cupon-pop span{
    color:#03A9F4;
}
.thank-you-pop a{
    display: inline-block;
    margin: 0 auto;
    padding: 9px 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #8BC34A;
    border-radius: 17px;
}
.thank-you-pop a i{
    margin-right:5px;
    color:#fff;
}
#ignismyModal .modal-header{
    border:0px;
}
/*--thank you pop ends here--*/

</style>
<div class="box-body">
  <div>
    <button type="button" class="btn btn-primary pull-right" id="confirm_submission">Submit <i class="fa fa-fw fa-save"></i></button>
  </div>
  <h4><b>8. Confirm Submission: 
    <span></span>
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

<div class="row">
        <div class="modal fade" id="ignismyModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="" id="return_to_default"><span>×</span></button>
                     </div>
                    
                    <div class="modal-body">
                       
                        <div class="thank-you-pop">
                            <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                            <h1>Thank You!</h1>
                            <p>Your submission is received and we will contact you soon</p>
                            <!-- <h3 class="cupon-pop">Your Id: <span>12345</span></h3> -->
                            
                        </div>
                         
                    </div>
                    
                </div>
            </div>
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


        $("#confirm_submission").on('click', function() {
          if(confirm("Are you sure you want to submit? ")){
              var remarks = $("#remarks").val();

              $.ajax({
                url: "{{route('SubmitApplication')}}",
                type: 'POST',
                data: {
                  remarks : remarks,
                  ProjectGUID : NewGUID,
                  _token: '{{csrf_token()}}' ,
                },
                success: function(response){
                  $("#ignismyModal").modal('show');
                  
                }
              });
            }else{
                return false;
            }
        });

        $("#ignismyModal").on('hide.bs.modal', function () {
          window.location.href='/default';
        });
});
</script>