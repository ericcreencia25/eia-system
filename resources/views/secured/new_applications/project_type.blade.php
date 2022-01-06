<style>
span.limit {
    /*display: block;*/
    word-wrap:break-word;
    width: 150px;
    white-space: normal
}
</style>

<div class="box-body">
  <h4><b>2. PROJECT TYPE:  <span id="proceed_2"></span></b><br></h4>
  <i>Search the project type below by providing the keyword and click the search icon. From the search results, locate the appropriate type and provide the corresponding proposed size. Then, click the select arrow icon to proceed to next step. FOR EXPLANSION, PROVIDE THE TOTAL (ORIGINAL + INCREASE) SIZE.</i>
  <br><br>
  <div class="box">
    <div class="box-body no-padding">
      <table class="table" id="projectType" style="width: 100%;  display: table; ">
        <thead>
          <th>Category</th>
          <th>Specific Type</th>
          <th>Proposed Project Size <br> <span style="color:red;">(DO NOT SPLIT SIZE)</span> </th>
          <th></th>
        </thead>
        <tbody>
        </tbody>
      </table> 
    </div>
  </div>
</div>

<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<!-- <script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- DataTables -->
<script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script>
var ComponentGUID = "{{$project['ComponentGUID']}}";
var ProjectSize = "{{$project['ProjectSize']}}";
  $(document).ready(function(){
   $('#projectType').DataTable({
      processing:true,
      info:true,
      ajax: {
            "url": "{{route('getProjectType')}}",
            "type": "POST",
            "data": {
                ComponentGUID : ComponentGUID,
                ProjectSize : ProjectSize,
                _token: '{{csrf_token()}}' ,
            }, 
        },
      columns: [
        {data: 'Category', name: 'Category'},
        {data: 'SpecificType', name: 'SpecificType'},
        {data: 'ProjectSize', name: 'ProjectSize'},
        {data: 'Action', name: 'Action'}
      ]
    });
  });
</script>