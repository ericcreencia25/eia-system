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
  <h4><b>5.  BASIC PROJECT INFORMATION: </b><br></h4>
  <i>
    Provide below the proponent and project information. All fields below are required.
  </i>
  <br><br>
  <h4><b>Proponent Information</b></h4>
            <div class="col-md-12">
              <!---Left side--->
              <div class="col-md-6">
                <div class="col-md-12">
                  Proponent Name
                  <input type="text" class="form-control" placeholder="" value="{{$project['ProponentName'] }}">
                </div>
                <div class="col-md-6">
                  Landline No.
                  <input type="text" class="form-control" value="{{$project['ContactPersonNo'] }}">
                </div>
                <div class="col-md-6">
                  Fax No
                  <input type="text" class="form-control" placeholder="">
                </div>
              </div>
              <!----right--->
              <div class="col-md-6">
                <div class="col-md-6">
                  Represented By
                  <input type="text" class="form-control" value="{{$project['ContactPerson'] }}">
                </div>
                <div class="col-md-6">
                  Designation
                  <select class="form-control" value="{{$project['Designation'] }}">
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
                  <input type="text" class="form-control" value="{{$project['MobileNo'] }}">
                </div>
                <div class="col-md-6">
                  Email Address
                  <input type="text" class="form-control" value="{{$project['ContactPersonEmailAddress'] }}">
                </div>
              </div>
            </div>
            <h4><b>Project Information</b></h4>
            <div class="col-md-12">
              <!---Left side--->
              <div class="col-md-6">
                <div class="col-md-12">
                  Project Name
                  <input type="text" class="form-control" value="{{$project['ProjectName'] }}">
                </div>
                <div class="col-md-6">
                  Project Location: Specific Address
                  <input type="text" class="form-control" value="{{$project['Address'] }}">
                </div>
                <div class="col-md-6">
                  Municipality
                  <select class="form-control" id='municipality' name='municipality'>
                  </select>
                </div>
                <div class="col-md-6">
                  Total Project Land Area (sq. m.)
                  <input type="text" class="form-control" value="{{$project['LandAreaInSqM'] }}">
                </div>
                <div class="col-md-6">
                  Total Projects/Building Footprint Area (sq. m)
                  <input type="text" class="form-control" value="{{$project['FootPrintAreaInSqM'] }}">
                </div>
              </div>
              <!---right side--->
              <div class="col-md-6">
                <div class="col-md-12">
                  Mailing Address
                  <input type="text" class="form-control" value="{{$project['MailingAddress'] }}">
                </div>
                <div class="col-md-6">
                  Province
                  <select class="form-control" id="province" name="province">
                  </select>
                </div>
                <div class="col-md-6  mb-3">
                  Zone Classification (i.e. industrial, residential)
                  <input type="text" class="form-control" value="{{$project['ZoneClassification'] }}">
                </div>
                <div class="col-md-6">
                  No. of Employees
                  <input type="text" class="form-control" value="{{$project['NoOfEmployees'] }}">
                </div>
                <div class="col-md-6">
                  Total Project Cost (Php)
                  <input type="text" class="form-control" value="{{$project['ProjectCost'] }}">
                </div>
              </div>
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
var ProponentGUID = "{{$project['ProponentGUID']}}";
var SelectedMunicipality = "{{$project['Municipality']}}";
var SelectedProvince = "{{$project['Province']}}";

  $(document).ready(function(){
    $.ajax({
        url: "{{route('getMunicipalities')}}",
        type: 'POST',
        data: {
            data : ProponentGUID,
            _token: '{{csrf_token()}}' ,
        },    
        success: function(response){
            var len = 0;
             if(response['data'] != null){
                len = response['data'].length;
             }
             console.log(response['data'][i]);
             if(len > 0){
                // Read data and create <option >
                for(var i=0; i<len; i++){
                   var ID = response['data'][i].ID;
                   var Municipality = response['data'][i].Municipality;
                   var Province = response['data'][i].Province;

                   if(Municipality == SelectedMunicipality){
                      var option = "<option value='"+ID+"' selected>"+Municipality+"</option>";
                      var option1 = "<option value='"+ID+"' selected>"+Province+"</option>";
                      $("#province").append(option1);
                   }else{
                      var option = "<option value='"+ID+"'>"+Municipality+"</option>";
                      var option1 = "<option value='"+ID+"'>"+Province+"</option>";
                   }
                   
                   $("#municipality").append(option); 

                }
             }
        }
    });

  });
</script>