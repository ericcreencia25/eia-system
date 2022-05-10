<!-- <link rel="stylesheet" href="../../adminlte/dist/css/overlay-success.css"> -->
<style>
    .modal-dialog {
        position: absolute;
        top: 150px;
        right: 100px;
        bottom: 0;
        left: 0;
        z-index: 10040;
        overflow: auto;
        overflow-y: auto;
    }

</style>

<div class="box-body">
    <div class="callout callout-default" style="background: #ccc; margin-bottom: 0px">
    <div>
        <button type="button" class="btn btn-primary pull-right" id="check_step_7">Confirm <span class="glyphicon glyphicon-circle-arrow-right"></span></button>
    </div>
    <h4><b>7. ECC Application Requirements</b><br></h4>
    <i>Click the browse button to select the scanned copy of the requirement then click the 'Upload' arrow to attach the file or the bin icon to remove the uploaded file. You can click the description to view the uploaded file. Only PDF file is allowed not larger than 10MB.</i>
    <br><br>
</div>
    <div class="box-body no-padding">
        <table class="table table-bordered" id="ApplicationRequirements" style="width: 100%;  display: table; table-layout: fixed;" >
            <thead>
                <th style="width: 5%; text-align: center"></th>
                <th style="width: 50%">Requirements</th>
                <th style="width: 45%">Files</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>


<div id="overlay" style="display:none;">
    <div class="spinner"></div>
    <br/>
    <h3>Please wait while saving your data...</h3>
</div>

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
    $(document).ready(function(){
        var url=window.location.pathname;
        var arr=url.split('/');
        var NewGUID=arr[2];

        $('#ApplicationRequirements').DataTable({
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
                "url": "{{route('getApplicationRequirements')}}",
                "type": "POST",
                "data" : {
                    ProjectGUID : NewGUID,
                     _token: '{{csrf_token()}}' ,
                }
            },
            columns: [
            {data: 'Counts', name: 'Counts'},
            {data: 'Requirements', name: 'Requirements'},
            {data: 'Files', name: 'Files'},
            ]
        });

        const error_message = [];
        $("#check_step_7").on('click', function() {
            for(let ctr = 1; ctr <= 17; ctr++){
                var count_file = "#count_files_" + ctr;
                if($(count_file).data("id") == 0){
                    error_message.push(ctr);
                }
            }  

            if(error_message.length == 0){
                $("#li_step_8").attr("class", "able");
                $("#step_8").attr("data-toggle", "tab");
                $('#myTab li a')[7].click();

                Swal.fire({
                    icon: 'success',
                    title: 'Proceed to last step.',
                    showConfirmButton: false,
                    timer: 1500,
                    width: '850px'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Notifications!',
                    text: 'You need to attach the electronic copy of the requirements.',
                    // footer: '<a href="">Why do I have this issue?</a>',
                    width: '850px'
                  });
            }
        });
    });


    function uploadFile(description, id)
    {
        var url=window.location.pathname;
        var arr=url.split('/');
        var NewGUID=arr[2];
        var input_id = "#files_" + id;


        // Get the selected file
        var files = $(input_id)[0].files;

        if(files.length > 0){
            var fd = new FormData();

            // Append data 
            fd.append('description', description);
            fd.append('file',files[0]);
            fd.append('ProjectGUID',NewGUID);
            fd.append('_token','{{csrf_token()}}');

            // Hide alert
            $('#responseMsg').hide();

            Swal.fire({
              title: 'Are you sure?',
              text: "You want to upload this file",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Confirm'
            }).then((result) => {
              if (result.isConfirmed) {
                 // $("#modal-default").modal('show');
                // AJAX request 
                $.ajax({
                    url: "{{route('uploadFile')}}",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();

                        xhr.upload.addEventListener('progress', function(e) {

                            if (e.lengthComputable) {
                                console.log('Bytes Loaded: ' + e.loaded);
                                console.log('Total Size: ' + e.total);
                                console.log('Percentage Uploaded: ' + (e.loaded / e.total));

                                var percent = Math.round((e.loaded / e.total) * 100);

                                $('#progressBar_' + id).attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                            }
                        });

                        return xhr;

                    },
                    // beforeSend: function() {
                    //     let timerInterval
                    //     Swal.fire({
                    //       // title: 'Auto close alert!',
                    //       html: 'Uploading attachment...',
                    //       timer: 2000,
                    //       timerProgressBar: true,
                    //       didOpen: () => {
                    //         Swal.showLoading()
                    //       },
                    //       willClose: () => {
                    //         clearInterval(timerInterval)
                    //       }
                    //     })
                    // },
                    success: function(response){

                        if(response['success'] == 1){

                            Swal.fire({
                                icon: 'success',
                              title: response['message'],
                              showDenyButton: false,
                              showCancelButton: false,
                              confirmButtonText: 'Confirm',
                              // denyButtonText: `Don't save`,
                            }).then((result) => {
                              /* Read more about isConfirmed, isDenied below */
                              if (result.isConfirmed) {
                                location.reload();
                              } else if (result.isDenied) {
                                Swal.fire('Changes are not saved', '', 'info')
                              }
                            })

                        } else {
                            alert("error : " + JSON.stringify(response['error']) );
                        }
                        
                    },
                    error: function(response){
                        alert("error : " + JSON.stringify(response) );
                    }
                });
              }

              // $('#modal-default').on('hidden.bs.modal', function () {
              //   location.reload();
              //     // do something…
              //   })
            })
        }else{
            Swal.fire({
                icon: 'warning',
                title: 'Please select a file.',
                showConfirmButton: false,
                timer: 1300,
                width: '850px'
            });
        }
    }

    function deleteFile(TempGUID){
        var fd = new FormData();

            // Append data 
            fd.append('TempGUID', TempGUID);
            fd.append('_token','{{csrf_token()}}');


        Swal.fire({
            title: 'Are you sure?',
          text: "You want to remove the updated file?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Confirm'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                url: "{{route('deleteFile')}}",
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
                    });
                    location.reload();
                },
                error: function(response){
                    console.log("error : " + JSON.stringify(response) );
                }
            });
          }
        })

        // if(confirm("Remove the updated file?")){
        //     // alert("Successfully removed");
        //     $.ajax({
        //         url: "{{route('deleteFile')}}",
        //         method: 'post',
        //         data: fd,
        //         contentType: false,
        //         processData: false,
        //         dataType: 'json',
        //         success: function(response){
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: response['message'],
        //                 showConfirmButton: false,
        //                 timer: 1500,
        //                 width: '850px'
        //             });
        //             location.reload();
        //         },
        //         error: function(response){
        //             console.log("error : " + JSON.stringify(response) );
        //         }
        //     });
        // }
        // else{
        //    Swal.fire({
        //     icon: 'error',
        //     title: 'Notifications!',
        //     text: 'Something went wrong while uploading your files!',
        //     // footer: '<a href="">Why do I have this issue?</a>',
        //     width: '850px'
        //   });
        //     // return false;
        // }
        

    }
</script>