
<div class="box-body">
    <h4><b>7. ECC Application Requirements</b><br></h4>
    <i>Click the browse button to select the scanned copy of the requirement then click the 'Upload' arrow to attach the file or the bin icon to remove the uploaded file. You can click the description to view the uploaded file. Only PDF file is allowed not larger than 10MB.</i>
    <br><br>
    <div class="box-body no-padding">
        <table class="table table-bordered" id="ApplicationRequirements" style="width: 100%;  display: table; table-layout: fixed;" >
            <thead>
                <th style="width: 5%">Count</th>
                <th style="width: 45%"> Requirements</th>
                <th style="width: 30%">Files</th>
                <th style="width: 20%">Action</th>
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
    $('#ApplicationRequirements').DataTable({
      processing:true,
      info:true,
      ajax: "{{route('getApplicationRequirements')}}",
      columns: [
          {data: 'Counts', name: 'Counts'},
          {data: 'Requirements', name: 'Requirements'},
          {data: 'Files', name: 'Files'},
          {data: 'Action', name: 'Action'},
      ]
    })

  });
</script>