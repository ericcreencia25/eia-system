<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../adminlte/dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../adminlte/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
  <link rel="stylesheet" href="../../adminlte/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="../../adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">EIAMD<span class="sr-only"></span></a></li>
            <li><a href="#">HELP</a></li>
          </ul>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a>
                <span class="hidden-xs"><b>For technical assistance, please email your concerns to support@emb.gov.ph</b></span>
              </a>
              
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Full Width Column -->

  <div class="content-wrapper">
    <section class="content container-fluid">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p class="text-center">
                <strong></strong>
              </p>
              <center>
                <img class="img-responsive" src="../../img/denr.png" alt="Photo" width="175" height="178">
                <h2 style="font-size:20pt; font-weight:bold;">ECC Online Application System</h2>
                <p style="font-size:16pt;">Environmental Impact Assessment & Management Division
                <p style="font-size:16pt;">Environmental Management Bureau<br />
                  <button type="button" class="btn btn-primary btn-sm" 
                    onclick="window.location='{{ url("login/$GUID") }}' ">Continue
                  </button><br />
              </center>
              <div style="padding:15px; background-color:WhiteSmoke; border:Solid 1px Gray; font-size:small;">
                NOTE:
                <br />
                For security purposes, make sure that you've loaded this page from emb website (https://emb.gov.ph). You can also verify authenticity of the site by clicking the <a> SSL Secure GlobalSign logo </a>located on the next page. The Organization Name of the SSL Cerficate Information should be Environmental Management Bureau (EMB). For further clarification, you may reach us using the above contact information.
              </div>
              <br />
              <center><u><h4>Project Grouping Matrix for Determination of EIA Report Types for New Single & Co-Located Projects</h4></u>
                  <div class="input-group col-xs-8" style="padding-bottom: 15px;">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Keyword">
                    <div class="input-group-btn">
                      <button type="button" id="search_button"name="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
              </center>

              <table class="table table-bordered" id="ProjectTypeTable" style="width: 100%;  display: table; table-layout: fixed;">
                <thead>
                  <tr>
                    <th rowspan="2" style="width: 5%"></th>
                    <th rowspan="2" style="width: 20%">Project Type</th>
                    <th rowspan="2" style="width: 15%">Project SubType</th>
                    <th rowspan="2" style="width: 15%">Project Size Parameter</th>
                    <th colspan="3" style="width: 45%; text-align: center">EIA Report Type for Corresponding Project Size/Threshold</th>
                  </tr>
                  <tr>
                    <th>Environmental Impact Statement (EIS)</th>
                    <th>Initial Environment Examination (IEE Report, IEER or IEE Checklist: IEEC)</th>
                    <th>Project Description Report</th>
                  </tr>
                </thead>

                <tbody></tbody>
              </table>
              <h4><a>Download Users' Guide</a></h4>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2021 <a href="">Erik's Studio</a>.</strong> All rights reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../adminlte/dist/js/demo.js"></script>

<!-- iCheck -->
<script src="../../adminlte/plugins/iCheck/icheck.min.js"></script>
<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

    
  });

  $(document).ready(function(){
    $("#search_button").on('click', function() {
      alert('hi');
      window.location.href='/ProjectTypeTable';
    });

    var search = $('#search').val();

    $('#ProjectTypeTable').DataTable({
      processing:true,
      info:true,
      searching: false,
      ajax: {
            "url": "{{route('ProjectTypeTable')}}",
            "type": "POST",
            "data": {
                search : search,
                _token: '{{csrf_token()}}' ,
            }, 
        },
      columns: [
        {data: 'ReferenceID', name: 'ReferenceID'},
        {data: 'ProjectType', name: 'ProjectType'},
        {data: 'ProjectSubType', name: 'ProjectSubType'},
        {data: 'ProjectSize', name: 'ProjectSize'},
        {data: 'EIS', name: 'IEE'},
        {data: 'PDR', name: 'PDR'}
      ]
    });
  });



  //   
  // });
</script>
</body>
</html>
