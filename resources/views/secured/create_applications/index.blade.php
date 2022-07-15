<div class="box-body">
  <div class="callout callout-default" style="background: #ccc; margin-bottom: 0px">
    <div>
      <button type="button" class="btn btn-primary pull-right" id="check_step_1">Confirm <i class="fa fa-fw fa-save"></i></button>
    </div>
    <h4><b>1. PURPOSE:  
      <span id="proceed_1"></span>
    </b><br></h4>
    <i>In compliace with MC2019-003, all projects that fall under Category B of MC 2014-005 must be applied through the ECC Online Application System. Please answer the questions below then click the 'Confirm' button. <span style=" color:red; font-style:italic;">For BARMM located project, please submit your application to BARMM environmental office</span></i><br><br>
  </div>
  <div class="box" style="padding-top: 0px">
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
            <td>Is the project within the protected area under National Integrated Protected Areas System (NIPAS)? <br> <a href="{{ url("NIPAS") }}" target="_blank"> Click here to determine if your proposed project is under NIPAS. </a></td>
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
          <tr>
            <td>5.</td>
            <td>Is the project within DENR tenurial instruments (ie. Forest Land Use Agreement (FLAg), <br>Forest Land Use Agreement for Tourism Purposes (FLAgT), Foreshore Lease Agreement (FLA), <br> Special Use Agreement in Protected Area (SAPA)?
            </td>
            <td>
              <div class="form-group">
                <div class="radio" id="InTenInstrument">
                  <label><input type="radio" name="InTenInstrument" value="1">Yes</label>
                  <br>
                  <label><input type="radio" name="InTenInstrument" value="0">No</label>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>6.</td>
            <td>Is the project within the ancestral domain?</td>
            <td>
              <div class="form-group">
                <div class="radio" id="IsAncestralDomain">
                  <label><input type="radio" name="IsAncestralDomain" value="1">Yes</label>
                  <br>
                  <label><input type="radio" name="IsAncestralDomain" value="0">No</label>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>7.</td>
            <td>Is this a goverment project?  </td>
            <td>
              <div class="form-group">
                <div class="radio" id="IsGovProject">
                  <label><input type="radio" name="IsGovProject" value="1">Yes</label>
                  <br>
                  <label><input type="radio" name="IsGovProject" value="0">No</label>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- <div id="overlay" style="display:none;">
    <div class="spinner"></div>
    <br/>
    <h3 style="font-family: Arial, Sans; color: white;" id="overlay-message">Saving your changes. Please be patient</h3>
  </div> -->

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

        var InTenInstrument = $("input[type='radio'][name='InTenInstrument']:checked").val();
        var IsAncestralDomain = $("input[type='radio'][name='IsAncestralDomain']:checked").val();
        var IsGovProject = $("input[type='radio'][name='IsGovProject']:checked").val();

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
              IsGovProject : '',
              InTenInstrument : '',
              IsAncestralDomain : '',
              first : 0,
              _token: '{{csrf_token()}}' ,
            },
            beforeSend: function() {
              $('#overlay').show();
            },
            success: function(response){
              

              $('#overlay').fadeOut(2000, () => {

                Swal.fire({
                  title: 'Step 1 is already saved in the session.',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Confirm'
                }).then((result) => {
                  if (result.dismiss || result.isConfirmed) {
                    var next = $('#mytabs li.active').next()
                    next.length?
                    next.find('a').click():
                    $('#myTab li a')[1].click();


                  }
                })

                $("#step_1").css({"background-color":"#dd4b39", "color": "#ffffff"});

              });

              

              
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
          IsGovProject : IsGovProject,
          InTenInstrument : InTenInstrument,
          IsAncestralDomain : IsAncestralDomain,
          first : 1,
          _token: '{{csrf_token()}}' ,
        },
        beforeSend: function() {
          $('#overlay').show();
        },
        success: function(response){

          if(response == 'Success'){
            $('#overlay').fadeOut(2000, () => {
              Swal.fire({
                title: 'Step 1 is already saved in the session.',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
              }).then((result) => {
                if (result.dismiss || result.isConfirmed) {
                  var next = $('#mytabs li.active').next()
                  next.length?
                  next.find('a').click():
                  $('#myTab li a')[1].click();

                  
                }
              })
            });

          } else {
            $('#overlay').fadeOut(2000, () => {
              Swal.fire({
                html: 'Please provide a valid ECC Number. If problem persists, you may have to coordinate with the office where the ECC was issued. You may visit the emb.gov.ph website or request assistance from support@emb.gov.ph.',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
              }).then((result) => {
                if (result.dismiss || result.isConfirmed) {

                      // location.reload();
                      $("#step_1").css({"background-color":"#dd4b39", "color": "#ffffff"});
                    }
                  })
            });
          }
          
          
        }
      });
    }
  });

  ///check if the input session exist
  var purpose_check = "{{ Session::has('step_1') ? session('step_1')['purpose'] : '' }}";
  var prior_to_1982_check = "{{ Session::has('step_1') ? session('step_1')['prior_to_1982'] : '' }}";
  var In_NIPAS_check = "{{ Session::has('step_1') ? session('step_1')['In_NIPAS'] : '' }}";
  var ecc_amendment_check = "{{ Session::has('step_1') ? session::get('step_1')['ecc_amendment'] : '' }}";

  var IsGovProject = "{{ Session::has('step_1') ? session::get('step_1')['IsGovProject'] : '' }}";
  var IsAncestralDomain = "{{ Session::has('step_1') ? session::get('step_1')['IsAncestralDomain'] : '' }}";
  var InTenInstrument = "{{ Session::has('step_1') ? session::get('step_1')['InTenInstrument'] : '' }}";
  
  if(purpose_check != null){$("#purpose_application").val(purpose_check)}
    if(ecc_amendment_check != ''){
      $("#ecc_amendment").val(ecc_amendment_check);
      $("#ecc_amendment").removeAttr("disabled");
    }
    if(prior_to_1982_check != null){$("input[name=prior_to_1982][value='" + prior_to_1982_check + "']").prop('checked', true)}
      if(In_NIPAS_check != null){$("input[name=In_NIPAS][value='" + In_NIPAS_check + "']").prop('checked', true)}

        if(IsGovProject != null){$("input[name=IsGovProject][value='" + IsGovProject + "']").prop('checked', true)}
          if(IsAncestralDomain != null){$("input[name=IsAncestralDomain][value='" + IsAncestralDomain + "']").prop('checked', true)}
            if(InTenInstrument != null){$("input[name=InTenInstrument][value='" + InTenInstrument + "']").prop('checked', true)}

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