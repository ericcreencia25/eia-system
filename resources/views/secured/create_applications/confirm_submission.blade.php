<link rel="stylesheet" href="../../adminlte/dist/css/alert-modal.css">
<!-- <link rel="stylesheet" href="../../adminlte/dist/css/overlay-success.css"> -->
<div class="box-body">
  <div class="callout callout-default" style="background: #ccc; margin-bottom: 0px">
  <div>
    <button type="button" class="btn btn-primary pull-right" id="confirm_submission">Submit <i class="fa fa-fw fa-save"></i></button>
  </div>
  <h4><b>8. Confirm Submission: 
    <span></span></b><br>
  </h4>
  <i style="color: red">PLEASE REVIEW AND CHECK THAT THE CORRECT AND CLEAR VERSION OF THE PDF FILE WAS ATTACHED FOR EACH REQUIREMENT</i> <i>before clicking 'Next' button to confirm the submission of this application FOR SCREENING. The submitted documents are automatically forwarded to the EMB Regional Office having jurisdiction of the project. Once screened, you will be advised to pay the corresponding application fee or submit additional document/provide clarification. Returned applications will appear in the 'For Action' page.</i>
  <br><br>
</div>
  <h4><label>Purpose: New ECC Application</label></h4>
    <label>Documents Uploaded:</label>
    <table class="table" id="documents_uploaded" style="width: 100%;  display: table; ">
      <thead>
        <th style="width:2%;"></th>
        <th></th>
      </thead>
      <tbody>
      </tbody>
    </table>
    <label>Remarks/Additional Notes</label>
    <div style="border:Solid 1px Silver;">
      <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:Small;height:200px;width:98.3%;padding:10px; border:none;" id="remarks"></textarea>
    </div>
    <div class="row">
      <div class="modal fade" id="ignismyModal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="" id="return_to_default"><span>×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="thank-you-pop">
                <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                <h1>Thank You!</h1>
                <p>Your submission is received and we will contact you soon</p>
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
        _token: '{{csrf_token()}}',
      },
    },
    columns: [
    {data: 'Check', name: 'Check'},
    {data: 'Description', name: 'Description'},
    ]
  });

  $("#confirm_submission").on('click', function() {

    Swal.fire({
      title: 'Are you sure?',
      text: "Are you sure you want to submit? ",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm'
    }).then((result) => {
      if (result.isConfirmed) {
        var remarks = $("#remarks").val();

        $.ajax({
          url: "{{route('SubmitApplication')}}",
          type: 'POST',
          data: {
            remarks : remarks,
            ProjectGUID : NewGUID,
            _token: '{{csrf_token()}}',
          },  
          beforeSend: function() {
            let timerInterval

            Swal.fire({
              html: 'Please wait while saving your data...',
              timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
              },
              willClose: () => {
                clearInterval(timerInterval)
              }
            })
          },  
          success: function(response){

            var text = '<small>Your application was forwarded FOR SCREENING to '+ response +'</small><br><br>';
                text += 'For complaints and suggestions, you may send your letter to:<br>';
                text += '<b>ENGR. WILLIAM P. CUÑADO</b><br>';
                text += 'OIC-EMB Director<br>';
                text += 'Environmental Management Bureau<br>';
                text += 'DENR Compound, Diliman, Quezon City <br>';

                Swal.fire({
                  icon: 'success',
                  title: "APPLICATION WAS SUBMITTED SUCCESSFULLY FOR SCREENING!",
                  html : text,
                  showConfirmButton: true,
                  confirmButtonText: 'Confirm',
                  width: '850px'
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss || result.isConfirmed) {
                    window.location.href='/default';
                  }
                });
              }
            });
      }
    });

          // if(confirm("Are you sure you want to submit? ")){
          //     var remarks = $("#remarks").val();

          //     $.ajax({
          //       url: "{{route('SubmitApplication')}}",
          //       type: 'POST',
          //       data: {
          //         remarks : remarks,
          //         ProjectGUID : NewGUID,
          //         _token: '{{csrf_token()}}' ,
          //       },
          //       beforeSend: function() {
          //           $('#overlay').show();
          //       },
          //       success: function(response){
          //           $('#overlay').delay(2000).fadeOut();
          //           $("#ignismyModal").modal('show');
          //       }
          //     });
          //   }else{
          //       return false;
          //   }
        });

        $("#ignismyModal").on('hide.bs.modal', function () {
          window.location.href='/default';
        });
});
</script>