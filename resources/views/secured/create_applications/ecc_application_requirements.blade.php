<div class="box-body">
    <div>
        <button type="button" class="btn btn-primary pull-right" id="check_step_7">Confirm <span class="glyphicon glyphicon-circle-arrow-right"></span></button>
    </div>
    <h4><b>7. ECC Application Requirements</b><br></h4>
    <i>Click the browse button to select the scanned copy of the requirement then click the 'Upload' arrow to attach the file or the bin icon to remove the uploaded file. You can click the description to view the uploaded file. Only PDF file is allowed not larger than 10MB.</i>
    <br><br>
    <div class="box-body no-padding">
        <table class="table table-bordered" id="ApplicationRequirements" style="width: 100%;  display: table; table-layout: fixed;" >
            <thead>
                <th style="width: 10%">Count</th>
                <th style="width: 50%">Requirements</th>
                <th style="width: 40%">Files</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
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
                if($(count_file).text() == 0){
                    error_message.push(ctr);
                }
            }  

            if(error_message.length == 0){
                $("#li_step_8").attr("class", "able");
                $("#step_8").attr("data-toggle", "tab");

                toastr.success("Proceed to last step.");
            } else {
                toastr.error("You need to attach the electronic copy of the requirements.");
            }
        });
    });


    function uploadFile(description, id){

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
            fd.append('_token','{{csrf_token()}}');

            // Hide alert
            $('#responseMsg').hide();

            // AJAX request 
            $.ajax({
                url: "{{route('uploadFile')}}",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    toastr.success(response['message']);
                    location.reload();
                },
                error: function(response){
                    console.log("error : " + JSON.stringify(response) );
                }
            });
        }else{
            toastr.warning("Please select a file.");
        }
    }

    function deleteFile(TempGUID){
        var fd = new FormData();

            // Append data 
            fd.append('TempGUID', TempGUID);
            fd.append('_token','{{csrf_token()}}');


        if(confirm("Remove the updated file?")){
            // alert("Successfully removed");
            $.ajax({
                url: "{{route('deleteFile')}}",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    toastr.success(response['message']);
                    location.reload();
                },
                error: function(response){
                    console.log("error : " + JSON.stringify(response) );
                }
            });
        }
        else{
            toastr.error("Nope! ");
            // return false;
        }
        

    }
</script>