<style>
div.col-md-12 {
  padding-right: 0px;
  padding-left: 0px; 
}

div.col-md-6 {
  padding-right: 1px;
  padding-left: 1px; 
}
</style>

<div class="box-body">
  <div>
    <button type="button" class="btn btn-primary pull-right" id="check_step_5">Save <i class="fa fa-fw fa-save"></i></button>
  </div>
  <h4><b>5.  BASIC PROJECT INFORMATION: 
    <span id="proceed_5"></span>
  </b><br></h4>
  <i>Provide below the proponent and project information. All fields below are required.</i>
  <br><br>
  <h4><b>Proponent Information</b></h4>
  <div class="col-md-12">
    <!---Left side--->
    <div class="col-md-6">
      <div class="col-md-12">
        Proponent Name
        <input type="text" class="form-control" placeholder="" id="proponent_name" disabled>
      </div>
      <div class="col-md-6">
        Landline No.
        <input type="text" class="form-control" placeholder="" id="landline_no">
      </div>
      <div class="col-md-6">
        Fax No
        <input type="text" class="form-control" placeholder="" id="fax_no">
      </div>
    </div>
    <!----right--->
    <div class="col-md-6">
      <div class="col-md-6">
        Represented By
        <input type="text" class="form-control" placeholder="" id="represented_by">
      </div>
      <div class="col-md-6">
        Designation
        <select class="form-control" id="designation">
          <option>Owner</option>
          <option>Director</option>
          <option>Regional Director</option>
          <option>Mayor</option>
          <option>President</option>
          <option>Vice-President</option>
          <option>Manager</option>
          <option>General Manager</option>
          <option>CEO/COO</option>
          <option>District Engineer</option>
        </select>
      </div>
      <div class="col-md-6">
        Mobile No.
        <input type="text" class="form-control" placeholder="" id="mobile_number">
      </div>
      <div class="col-md-6">
        Email Address
        <input type="text" class="form-control" placeholder="" id="email_address">
      </div>
    </div>
  </div>
  <h4><b>Project Information</b></h4>
  <div class="col-md-12">
    <!---Left side--->
    <div class="col-md-6">
      <div class="col-md-12">
        Project Name
        <input type="text" class="form-control" placeholder="" id="project_name" required>
      </div>
      <div class="col-md-6">
        Project Location: Specific Address
        <input type="text" class="form-control" placeholder="" id="project_location">
      </div>
      <div class="col-md-6">
        Municipality
        <select class="form-control select2" id='municipality' name='municipality' style="width: 100%;">
        </select>
      </div>
      <div class="col-md-6">
        Total Project Land Area (sq. m.)
        <input type="text" class="form-control" placeholder="" id="project_landarea">
      </div>
      <div class="col-md-6">
        Total Projects/Building Footprint Area (sq. m)
        <input type="text" class="form-control" placeholder="" id="project_footprintarea">
      </div>
    </div>
    <!---right side--->
    <div class="col-md-6">
      <div class="col-md-12">
        Mailing Address
        <input type="text" class="form-control" placeholder="" id="mailing_address">
      </div>
      <div class="col-md-6">
        Province
        <select class="form-control" id="province" name="province">
        </select>
      </div>
      <div class="col-md-6  mb-3">
        Zone Classification (i.e. industrial, residential)
        <input type="text" class="form-control" placeholder="" id="zone_classification">
      </div>
      <div class="col-md-6">
        No. of Employees
        <input type="text" class="form-control" placeholder="" id="no_of_employees">
      </div>
      <div class="col-md-6">
        Total Project Cost (Php)
        <input type="text" class="form-control" placeholder="" id="total_project_cost">
      </div>
    </div>
  </div>
</div>



<script>
  $(document).ready(function(){
    $('.select2').select2();

    var municipality_check = "{{ Session::has('step_5') ? Session::get('step_5')['municipality'] : '' }}";
    var url=window.location.pathname;
    var arr=url.split('/');
    var NewGUID=arr[2];

      $.ajax({
        url: "{{route('getMunicipalities')}}",
        type: 'POST',
        data: {
          data : municipality_check,
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
              var Municipality = response['data'][i].Municipality;
              var Province = response['data'][i].Province;

              var option = "<option value='"+ID+"'>"+Municipality+"</option>";
              var option1 = "<option value='"+ID+"'>"+Province+"</option>";
              
              $("#province").append(option1);
              $("#municipality").append(option); 
            }
          }
        }
      });
    ///Get Proponent Information
    var ProponentGUID = "{{session('data')['ProponentGUID']}}";
    
    $.ajax({
      url: "{{route('getProponentInformation')}}",
      type: 'POST',
      data: {
        ProponentGUID : ProponentGUID,
        _token: '{{csrf_token()}}' ,
      },
      success: function(response){
        $("#proponent_name").val(response['ProponentName']);
        $("#landline_no").val(response['ContactPersonNo']);
        $("#fax_no").val(response['']);
        $("#represented_by").val(response['ContactPerson']);
        $("#mobile_number").val(response['MobileNo']);
        $("#email_address").val(response['ContactPersonEmailAddress']);
        $("#designation").val(response['Designation']);
      }
    });

    ///municipalities
    $('#municipality').on('change', function() {
      var municipality = $("#municipality").val();

      $.ajax({
        url: "{{route('onChangeMunicipalities')}}",
        type: 'POST',
        data: {
          data : municipality,
          _token: '{{csrf_token()}}',
        },
        success: function(response){
          $('#province').empty();

          // Read data and create <option >
          var ID = response['data'].ID;
          var Municipality = response['data'].Municipality;
          var Province = response['data'].Province;

          var option = "<option value='"+ID+"'>"+Municipality+"</option>";
          var option1 = "<option value='"+ID+"'>"+Province+"</option>";

          $("#province").append(option1);
        }
      });
    }); 

    ///Check
    $('#check_step_5').on("click", function() {
      var proponent_name = $("#proponent_name").val();
      var landline_no = $("#landline_no").val();  
      var fax_no = $("#fax_no").val();  
      var represented_by = $("#represented_by").val();  
      var mobile_number = $("#mobile_number").val();  
      var email_address = $("#email_address").val();  
      var designation = $("#designation :selected").text();

      var project_name = $("#project_name").val();  
      var project_location = $("#project_location").val();  
      var municipality = $("#municipality :selected").text(); 
      var project_landarea = $("#project_landarea").val(); 
      var project_footprintarea = $("#project_footprintarea").val(); 
      var mailing_address = $("#mailing_address").val(); 
      var province = $("#province :selected").text(); 
      var zone_classification = $("#zone_classification").val(); 
      var no_of_employees = $("#no_of_employees").val(); 
      var total_project_cost = $("#total_project_cost").val(); 

      const error_message = [];
      if(project_name == ''){
        error_message.push('Project Name');
      } if(project_location == ''){
        error_message.push('Project Location');
      } if(municipality == ''){
        error_message.push('Municipality');
      } if(project_landarea == ''){
        error_message.push('Project Land Area');
      } if(project_footprintarea == ''){
        error_message.push('Project Footprint Area');
      } if(mailing_address == ''){
        error_message.push('Mailing Address');
      } if(province == ''){
        error_message.push('Province');
      } if(zone_classification == ''){
        error_message.push('Zone Classification');
      } if(no_of_employees == ''){
        error_message.push('No. of Employees');
      } if(total_project_cost == ''){
        error_message.push('Total Project Cost');
      }

      var check_error_message = error_message.length;
      if(check_error_message > 0){
        $.ajax({
        url: "{{route('FifthStep')}}",
        type: 'POST',
        data: {
          data,
          fifth : 0,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
          toastr.error('You need to completely fill-up the proponent and project information.');
          $("#step_5").css({"background-color":"#dd4b39", "color": "#ffffff"});
        }
      });
      } else {
        var data = {
        proponent_name : proponent_name,
        landline_no : landline_no,
        fax_no : fax_no,
        represented_by : represented_by,
        mobile_number : mobile_number,
        email_address : email_address,
        designation : designation,

        project_name : project_name,
        project_location : project_location,
        municipality : municipality,
        project_landarea : project_landarea,
        project_footprintarea : project_footprintarea,
        mailing_address : mailing_address,
        province : province,
        zone_classification : zone_classification,
        no_of_employees : no_of_employees,
        total_project_cost : total_project_cost,
        ProjectGUID : NewGUID
      }

      /// insert in session
      $.ajax({
        url: "{{route('FifthStep')}}",
        type: 'POST',
        data: {
          data, 
          fifth : 1,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
          toastr.success('Saved');
          $("#step_5").css({"background-color":"#3c8dbc", "color": "#ffffff"});
          location.reload();
        }
      });

      $("#step_6").css({"background-color":"#3c8dbc", "color": "#ffffff"});

      $("#li_step_6").attr("class", "able");
      $("#step_6").attr("data-toggle", "tab");

      /// last step active
      $("#li_step_7").attr("class", "able");
      $("#step_7").attr("data-toggle", "tab");

      $("#step_7").css({"background-color":"#3c8dbc", "color": "#ffffff"});
    }
  });

    ///check if there's existing session
    var step5_check = "{{ Session::has('step_5_status') ? Session::get('step_5_status') : 'N/A' }}";

    if(step5_check == 1){
      $("#step_5").css({"background-color":"#3c8dbc", "color": "#ffffff"});

      ///step 6
      $("#step_6").css({"background-color":"#3c8dbc", "color": "#ffffff"});

      $("#li_step_6").attr("class", "able");
      $("#step_6").attr("data-toggle", "tab");

      /// last step active
      $("#li_step_7").attr("class", "able");
      $("#step_7").attr("data-toggle", "tab");

      $("#step_7").css({"background-color":"#3c8dbc", "color": "#ffffff"});

      var project_name_check = "{{ Session::has('step_5') ? Session::get('step_5')['project_name'] : '' }}";
      var project_location_check = "{{ Session::has('step_5') ? Session::get('step_5')['project_location'] : '' }}";
      var project_landarea_check = "{{ Session::has('step_5') ? Session::get('step_5')['project_landarea'] : '' }}";
      var project_footprintarea_check = "{{ Session::has('step_5') ? Session::get('step_5')['project_footprintarea'] : '' }}";
      var mailing_address_check = "{{ Session::has('step_5') ? Session::get('step_5')['mailing_address'] : '' }}";
      var province_check = "{{ Session::has('step_5') ? Session::get('step_5')['province'] : '' }}";
      var zone_classification_check = "{{ Session::has('step_5') ? Session::get('step_5')['zone_classification'] : '' }}";
      var no_of_employees_check = "{{ Session::has('step_5') ? Session::get('step_5')['no_of_employees'] : '' }}";
      var total_project_cost_check = "{{ Session::has('step_5') ? Session::get('step_5')['total_project_cost'] : '' }}";


      $("#project_name").val(project_name_check);  
      $("#project_location").val(project_location_check);  
      $("#municipality").val(municipality_check); 
      $("#project_landarea").val(project_landarea_check); 
      $("#project_footprintarea").val(project_footprintarea_check); 
      $("#mailing_address").val(mailing_address_check); 
      $("#province").val(province_check); 
      $("#zone_classification").val(zone_classification_check); 
      $("#no_of_employees").val(no_of_employees_check); 
      $("#total_project_cost").val(total_project_cost_check);
    } else if(step5_check == 0){ 
      $("#step_5").css({"background-color":"#dd4b39", "color": "#ffffff"});

    } else if(step5_check == "N/A"){ 
      // $("#step_5").css({"background-color":"#fff", "color": "#444"});
    }
  });
</script>