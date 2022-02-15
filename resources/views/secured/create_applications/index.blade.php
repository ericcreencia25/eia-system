<div class="box-body">
  <div>
    <button type="button" class="btn btn-primary pull-right" id="check_step_1">Save <i class="fa fa-fw fa-save"></i></button>
  </div>
  <h4><b>1. PURPOSE:  
    <span id="proceed_1"></span>
  </b><br></h4>
  <i>In compliace with MC2019-003, all projects that fall under Category B of MC 2014-005 must be applied through the ECC Online Application System. Please answer the questions below then click the Next button. <span style=" color:red; font-style:italic;">For BARMM located project, please submit your application to BARMM environmental office</span></i><br><br>
  <div class="box" >
    <div class="box-body no-padding">
      <table class="table table-condensed">
        <tbody>
          <tr>
            <td>1.</td>
            <td>Select the purpose of this application</td>
            <td>
              <select class="form-control purpose" id="purpose_application" >
                <option value=""></option>
                <option value="New Application">New Application</option>
                <option value="Amendment">ECC Amendment</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>2.</td>
            <td>For ECC amendment, specify the Reference No of existing ECC</td>
            <td>
              <input type="text" class="form-control" id="ecc_amendment" disabled>
            </td>
          </tr>
          <tr>
            <td>3.</td>
            <td>Was the project established prior to 1982 WITH expansion or modification?</td>
            <td>
              <div class="form-group">
                <div class="radio prior_to_1982" id="prior_to_1982">
                  <label><input type="radio" name="prior_to_1982" value="1">Yes</label>
                  <br>
                  <label><input type="radio" name="prior_to_1982" value="0" >No</label>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>4.</td>
            <td>Is the project located in a protected area under NIPAS?</td>
            <td>
              <div class="form-group">
                <div class="radio" id="In_NIPAS">
                  <label><input type="radio" name="In_NIPAS" value="1">Yes</label>
                  <br>
                  <label><input type="radio" name="In_NIPAS" value="0">No</label>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $("#purpose_application").on('change', function(){
    var purpose = $("#purpose_application").val();

    if(purpose == 'Amendment'){
      $("#ecc_amendment").removeAttr("disabled");
    }else{
      $("#ecc_amendment").attr("disabled", true);
      $("#ecc_amendment").val('');
    }
  });


  $('#check_step_1').on("click", function() {
    var purpose = $("#purpose_application").val();
    var prior_to_1982 = $("input[type='radio'][name='prior_to_1982']:checked").val();
    var In_NIPAS = $("input[type='radio'][name='In_NIPAS']:checked").val();

    var ecc_amendment = $("#ecc_amendment").val();

    const error_message = [];
    if(purpose == ''){
      error_message.push('Purpose');
    } if(prior_to_1982 == ''){
      error_message.push('Prior to 1982');
    } if(In_NIPAS == ''){
      error_message.push('In NIPAS');
    }

    var check_error_message = error_message.length;

    if(check_error_message > 0){

      $.ajax({
        url: "{{route('FirstStep')}}",
        type: 'POST',
        data: {
          purpose : '',
          prior_to_1982 : '',
          In_NIPAS : '',
          ecc_amendment : '',
          first : 0,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){

          Swal.fire({
            icon: 'error',
            title: 'Notifications!',
            text: 'You need to select the purpose of the application and other information.',
            // footer: '<a href="">Why do I have this issue?</a>',
            width: '850px'
          });

          $("#step_1").css({"background-color":"#dd4b39", "color": "#ffffff"});
        }
      });
    }else{
      $("#li_step_2").attr("class", "able");
      $("#step_2").attr("data-toggle", "tab");

      $("#step_1").css({"background-color":"#3c8dbc", "color": "#ffffff"});

      ///put inputs into session
      $.ajax({
        url: "{{route('FirstStep')}}",
        type: 'POST',
        data: {
          purpose : purpose,
          prior_to_1982 : prior_to_1982,
          In_NIPAS : In_NIPAS,
          ecc_amendment : ecc_amendment,
          first : 1,
          _token: '{{csrf_token()}}' ,
        },
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Step 1 is already saved in the session.',
            showConfirmButton: false,
            timer: 1500,
            width: '800px'
          });

        }
      });

      var next = $('#mytabs li.active').next()
          next.length?
          next.find('a').click():
          $('#myTab li a')[1].click();
    }
  });

  ///check if the input session exist
  var purpose_check = "{{ Session::has('step_1') ? session('step_1')['purpose'] : '' }}";
  var prior_to_1982_check = "{{ Session::has('step_1') ? session('step_1')['prior_to_1982'] : '' }}";
  var In_NIPAS_check = "{{ Session::has('step_1') ? session('step_1')['In_NIPAS'] : '' }}";
  var ecc_amendment_check = "{{ Session::has('step_1') ? session::get('step_1')['ecc_amendment'] : '' }}";

  if(purpose_check != null){$("#purpose_application").val(purpose_check)}
    if(ecc_amendment_check != ''){
      $("#ecc_amendment").val(ecc_amendment_check);
      $("#ecc_amendment").removeAttr("disabled");
    }
  if(prior_to_1982_check != null){$("input[name=prior_to_1982][value='" + prior_to_1982_check + "']").prop('checked', true)}
  if(In_NIPAS_check != null){$("input[name=In_NIPAS][value='" + In_NIPAS_check + "']").prop('checked', true)}

  var step1_check = "{{ Session::has('step_1') ? Session::get('step_1')['first'] : 'N/A' }}";
  if(step1_check == 1){
    $("#li_step_2").attr("class", "able");
    $("#step_2").attr("data-toggle", "tab");

    $("#step_1").css({"background-color":"#3c8dbc", "color": "#ffffff"});
  } else if(step1_check == 0) {
    $("#step_1").css({"background-color":"#dd4b39", "color": "#ffffff"});
  } else if(step1_check == "N/A"){
    $("#step_1").css({"background-color":"#fff", "color": "#444"});
  }
});
</script>