
    <div class="box-body">
      <div>
    <button type="button" class="btn btn-primary pull-right" id="check_step_1">Save <i class="fa fa-fw fa-save"></i></button>
  </div>
  <h4><b>1. PURPOSE:  
    <span id="proceed_1"></span>
  </b><br></h4>
  <i>In compliace with MC2019-003, all projects that fall under Category B of MC 2014-005 must be applied through the ECC Online Application System. Please answer the questions below then click the Next button. <span style=" color:red; font-style:italic;">For BARMM located project, please submit your application to BARMM environmental office</span></i><br><br>
  <div class="box">
          <div class="box-body no-padding">
            <table class="table table-condensed">
              <tbody>
                <tr>
                  <td>1.</td>
                  <td>Select the purpose of this application</td>
                  <td>
                    <select class="form-control" id="purpose_application">
                      @if ($project['Purpose'] == "New Application")
                        <option value="New Application" selected="selected">New Application</option>
                        <option value="Amendment">ECC Amendment</option>
                      @elseif ($project['Purpose'] == 'Ammendment')
                        <option value="New Application">New Application</option>
                        <option value="Amendment" selected="selected">ECC Amendment</option>
                      @else
                        <option value="New Application">New Application</option>
                        <option value="Amendment">ECC Amendment</option>
                      @endif
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>For ECC amendment, specify the Reference No of existing ECC</td>
                  <td>
                    @if ($project['PreviousECCNo'] != "")
                    <input type="text" class="form-control">
                    @else
                    <input type="text" disabled="disabled" class="form-control">
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Was the project established prior to 1982 WITH expansion or modification?</td>
                  <td>
                    <div class="form-group">
                      <div class="radio">
                        <label>
                          @if ($project['PriorTo1982'] == 1)
                            <input type="radio" name="PriorTo1982" id="PriorTo1982" value="1" checked>
                          @else
                            <input type="radio" name="PriorTo1982" id="PriorTo1982" value="0">
                          @endif
                        Yes</label>
                      </div>
                      <div class="radio">
                        <label>
                        @if ($project['PriorTo1982'] == 0)
                            <input type="radio" name="PriorTo1982" id="PriorTo1982" value="1" checked>
                          @else
                            <input type="radio" name="PriorTo1982" id="PriorTo1982" value="0" >
                          @endif
                        No</label>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Is the project located in a protected area under NIPAS?</td>
                  <td>
                    <div class="form-group">
                      <div class="radio">
                        <label>
                        @if ($project['PriorTo1982'] == 1)
                            <input type="radio" name="InNIPAS" id="InNIPAS" value="1" checked>
                          @else
                            <input type="radio" name="InNIPAS" id="InNIPAS" value="0">
                          @endif
                        Yes</label>
                      </div>
                      <div class="radio">
                        <label>
                        @if ($project['InNIPAS'] == 0)
                            <input type="radio" name="InNIPAS" id="InNIPAS" value="1" checked>
                          @else
                            <input type="radio" name="InNIPAS" id="InNIPAS" value="0">
                          @endif
                        No</label>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody></table>
            </div>
          </div>
        </div>

<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<!-- <script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- DataTables -->
<script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

