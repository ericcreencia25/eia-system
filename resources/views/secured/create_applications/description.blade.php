<div class="box-body">
  <div class="callout callout-default" style="background: #ccc; margin-bottom: 0px">
  <div>
    <button type="button" class="btn btn-primary pull-right" id="check_step_3">Confirm <i class="fa fa-fw fa-save"></i></button>
  </div>
  <h4><b>3. DESCRIPTION OF PROPOSED PROJECT: 
    <span id="proceed_3"></span>
  </b><br></h4>
    <i>Provide below the description of the proposed project type and other details.For amendment application, indicate the item/s that need updated such as the Project Area, Project type, Size, etc</i>
    <br><br>
  </div>
    <div style="border:Solid 1px Silver;">
      <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:Small;height:200px;width:98.3%;padding:10px; border:none;" id="description_input">{{ Session::has("step_3") ? session::get("step_3")["description"] : "" }}</textarea>
      </div>
    </div>

<script>

$(document).ready(function(){
  $('#check_step_3').on("click", function() {
    var description = $("#description_input").val();
    Pace.restart()
    if(description != ''){
      // Pace.on('done', function() {
        $.ajax({
          url: "{{route('ThirdStep')}}",
          type: 'POST',
          data: {
            description : description,
            third:1,
            _token: '{{csrf_token()}}' ,
          },
          success: function(response){
            Swal.fire({
              icon: 'success',
              title: 'Step 3 is already saved in the session.',
              showConfirmButton: false,
              timer: 1500,
              width: '850px'
            }).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                $("#step_3").css({"background-color":"#3c8dbc", "color": "#ffffff"});

                // var next = $('#mytabs li.active').next()
                // next.length?
                // next.find('a').click():
                $('#myTab li a')[3].click();
                $("#li_step_4").attr("class", "able");
                $("#step_4").attr("data-toggle", "tab");

                location.reload();
                
              }
            });
          }
        });
      // });
      
    }else{
      // Pace.on('done', function() {
        $.ajax({
          url: "{{route('ThirdStep')}}",
          type: 'POST',
          data: {
            description : description,
            third:0,
            _token: '{{csrf_token()}}' ,
          },
          success: function(response){
            Swal.fire({
              icon: 'error',
              title: 'Notifications!',
              text: 'You need to provide the description of the proposed project.',
              // footer: '<a href="">Why do I have this issue?</a>',
              width: '850px'
            });

            $("#step_3").css({"background-color":"#dd4b39", "color": "#ffffff"});
          }
        });
      // });
    }
  });



  var step3_check = "{{ Session::has('step_3') ? Session::get('step_3')['third'] : 'N/A' }}";

  if(step3_check == 1){
    $("#step_3").css({"background-color":"#3c8dbc", "color": "#ffffff"});

    $("#li_step_4").attr("class", "able");
    $("#step_4").attr("data-toggle", "tab");
  } else if (step3_check == 0){
    $("#step_3").css({"background-color":"#dd4b39", "color": "#ffffff"});
  } else if (step3_check == "N/A"){
    // $("#step_3").css({"background-color":"#fff", "color": "#444"});
  }
});
  


  

  
</script>