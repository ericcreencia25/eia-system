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
            <button type="button" class="pull-right btn btn-default" id="sendEmail">Next    <i class="fa fa-arrow-circle-right" onclick="window.location='{{ url("new_applications/1") }}'"></i></button>
            <button type="button" class="pull-right btn btn-default" id="sendEmail"><i class="fa fa-arrow-circle-left" onclick="window.location='{{ url("new_applications/1") }}'"></i>Previous</button>

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
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  Landline No.
                  <input type="text" class="form-control" placeholder="">
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
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  Designation
                  <select class="form-control">
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
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  Email Address
                  <input type="text" class="form-control" placeholder="">
                </div>
              </div>
            </div>
            <h4><b>Project Information</b></h4>
            <div class="col-md-12">
              <!---Left side--->
              <div class="col-md-6">
                <div class="col-md-12">
                  Project Name
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  Project Location: Specific Address
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  Municipality
                  <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                  </select>
                </div>
                <div class="col-md-6">
                  Total Project Land Area (sq. m.)
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  Total Projects/Building Footprint Area (sq. m)
                  <input type="text" class="form-control" placeholder="">
                </div>
              </div>
              <!---right side--->
              <div class="col-md-6">
                <div class="col-md-12">
                  Mailing Address
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  Province
                  <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                  </select>
                </div>
                <div class="col-md-6  mb-3">
                  Zone Classification (i.e. industrial, residential)
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  No. of Employees
                  <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  Total Project Cost (Php)
                  <input type="text" class="form-control" placeholder="">
                </div>
              </div>
            </div>
        </div>