<div class="box-body">
  <div class="callout callout-default" style="background: #ccc; margin-bottom: 0px">
    <div>
    <button type="button" class="btn btn-primary pull-right" id="check_step_2">Confirm <i class="fa fa-fw fa-save"></i></button>
  </div>
  <h4><b>2. PROJECT TYPE:  <span id="proceed_2"></span></b><br></h4>
  <i>Search the project type below by providing the keyword and click the search icon. From the search results, locate the appropriate type and provide the corresponding proposed size. Then, click the select arrow icon to proceed to next step. FOR EXPLANSION, PROVIDE THE TOTAL (ORIGINAL + INCREASE) SIZE.</i>
  <br><br>
</div>
  <div class="box">
    <div class="box-body no-padding">
      <!-- <form class="search-form"> -->
            <!-- <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Type in here the project keyword..." id="search_project_type">

              <div class="input-group-btn">
                <button type="button" name="submit" class="btn btn-primary" style="width: 50px; height: 35px" id="submit_project_type"><i class="fa fa-search"></i>
                </button>
              </div>
            </div> -->
            <!-- /.input-group -->
          <!-- </form> -->
      <table class="table" id="projectType" style="width: 100%;  display: table;">
        <thead style=" background-color: #f5f6f8">
          <th width="30%">CATEGORY</th>
          <th width="30%">SPECIFIC TYPE</th>
          <th width="40%"><small>PROPOSED PROJECT SIZE <br> <span style="color:red;">(DO NOT SPLIT SIZE)</span> </small></th>
        </thead>
        <tbody>
        </tbody>
      </table> 
    </div>
  </div>
</div>


<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<script>
$(document).ready(function(){
  var ComponentGUID_check = "{{ Session::has('step_2') ? session::get('step_2')['ComponentGUID'] : '' }}";
  var input_size_check = "{{ Session::has('step_2') ? session::get('step_2')['input_size'] : '' }}";

  if(ComponentGUID_check != ''){
    $('#projectType').DataTable({
      processing:true,
      serverSide: true,
            info:true,
            searching: false,
            ordering: false,
            bPaginate: false,
            bLengthChange: false,
            bFilter: true,
            bInfo: false,
            bAutoWidth: false,
            ajax: {
              "url": "{{route('getProjectTypeStep2')}}",
              "type": "POST",
              "data": {
                  ComponentGUID : ComponentGUID_check,
                  search : '',
                  ProjectSize : input_size_check,
                  _token: '{{csrf_token()}}' ,
              }, 
          },
          columns: [
          {data: 'Category', name: 'Category'},
          {data: 'SpecificType', name: 'SpecificType'},
          {data: 'ProjectSize', name: 'ProjectSize'}
          ]
    });
  }
  

  $('#submit_project_type').on("click", function() {
    var table = $('#projectType').DataTable();
    table.destroy();

    var search = $("#search_project_type").val();

    $('#projectType').DataTable({
      processing:true,
      info:true,
      searching: false,
      ajax: {
            "url": "{{route('getProjectType')}}",
            "type": "POST",
            "data": {
                ComponentGUID : '',
                search : search,
                ProjectSize : '',
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

  var step2_check = "{{ Session::has('step_2') ? Session::get('step_2')['second'] : 'N/A' }}";

  if(step2_check == 1){
    $("#li_step_3").attr("class", "able");
    $("#step_3").attr("data-toggle", "tab");

    $("#step_2").css({"background-color":"#3c8dbc", "color": "#ffffff"});
  } else if(step2_check == 0) {
    $("#step_2").css({"background-color":"#dd4b39", "color": "#ffffff"});
  } else if(step2_check == "N/A"){
    // $("#step_2").css({"background-color":"#fff", "color": "#444"});
  }

  $("#check_step_2").on("click", function() {
    Swal.fire({
            icon: 'success',
            title: 'Step 2 is already saved in the session.',
            showConfirmButton: false,
            timer: 1500,
            width: '850px'
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              $("#step_2").css({"background-color":"#3c8dbc", "color": "#ffffff"});
              var next = $('#mytabs li.active').next()
              next.length?
              next.find('a').click():
              $('#myTab li a')[2].click();

              $("#li_step_3").attr("class", "able");
              $("#step_3").attr("data-toggle", "tab");
              location.reload();
            }
          });

    
  });
    
});
function ProjectSize(ComponentGUID, Category) {
    var id = "#input_project_size_" + ComponentGUID;
    var input_size = $(id).val();

    var min = $(id).attr("min");

    var max= $(id).attr("max");

    if(Category == 'ECP'){
      Swal.fire({
        icon: 'warning',
        title: 'Notifications!',
        text: 'This type of project and its size falls under the Environmentally Critical Projects (ECPs). The ECC Online Application System covers only the Non-Environmentally Critical Projects (NECPs). For ECP Project, please coordinate with EMB Central Office - Environmnetal Impact Assessment and Management Division.',
            // footer: '<a href="">Why do I have this issue?</a>',
          width: '850px'
        });
    } else {
      if(input_size != ''){
        if(inRange(input_size, min, max))
        {
          $.ajax({
            url: "{{route('SecondStep')}}",
            type: 'POST',
            data: {
              input_size : input_size,
              second : 1,
              ComponentGUID : ComponentGUID,
              _token: '{{csrf_token()}}',
            },
            success: function(response)
            {
              Swal.fire({
                icon: 'success',
                title: 'Step 2 is already saved in the session.',
                showConfirmButton: false,
                timer: 1500,
                width: '850px'
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  $("#step_2").css({"background-color":"#3c8dbc", "color": "#ffffff"});
                  var next = $('#mytabs li.active').next()
                  next.length?
                  next.find('a').click():
                  $('#myTab li a')[2].click();

                  $("#li_step_3").attr("class", "able");
                  $("#step_3").attr("data-toggle", "tab");
                  location.reload();
                }
              });
              
            }
          });
        } else {
          Swal.fire('Your value is out of range');
        }
      }else{
        $.ajax({
          url: "{{route('SecondStep')}}",
          type: 'POST',
          data: {
            input_size : input_size,
            second : 0,
            ComponentGUID : ComponentGUID,
            _token: '{{csrf_token()}}',
          },
          success: function(response)
          {
            Swal.fire({
              icon: 'error',
              title: 'Notifications!',
              text: 'Proposed Project Size accepts numeric value only.',
              // footer: '<a href="">Why do I have this issue?</a>',
              width: '850px'
            });

            $("#step_2").css({"background-color":"#dd4b39", "color": "#ffffff"});
          }
        });
      }
    }
  }

function inRange(x, min, max) {
    return ((x-min)*(x-max) <= 0);
}
</script>