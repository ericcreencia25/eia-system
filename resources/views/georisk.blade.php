<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ECCOnline</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->

  <!-- daterange picker -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="../../adminlte/bower_components/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="../../adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../adminlte/bower_components/jvectormap/jquery-jvectormap.css">

  <link rel="stylesheet" href="../../adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../adminlte/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <link rel="stylesheet" href="../../adminlte/dist/css/sweet-alert-2.css">

  <link rel="stylesheet" href="../../adminlte/dist/css/overlay-success.css">
  <link rel="stylesheet" href="https://api.georisk.gov.ph/css/attribution.css">
  <!-- <script src="https://api.georisk.gov.ph/css/attribution.css"></script> -->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="" class="navbar-brand"><b>ECC</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <!-- <ul class="nav navbar-nav">
            <li><a href="">For Action <span class="sr-only">(current)</span></a></li>
              <li><a href='' id="newApplication">New Application</a></li>
              <li><a href="">ECC Applications</a></li>
            
          </ul> -->
        </div>
        <div class="navbar-custom-menu">
          <!-- <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"> <i class="fa fa-fw fa-user"></i> Welcome </span>
            </a>
            <ul class="dropdown-menu">
              
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">Manage Account
                    </a>
                  </li>
                  <li>
                    <a href="#">User's Manual</a>
                  </li>
                  <li>
                    <a href="" >Sign out</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          </ul> -->
        </div>
      </div>
    </nav>
  </header>
  <!-- Full Width Column -->

  <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            @yield('header')

            <!-- Main content -->
            <section class="content container-fluid">
              <div class="box box-default">
                <div class="box-body">
                  <div class="col-md-12">
                    <center>
                      <div class="form-inline">
                        <label>Latitude: </label><input class="form-control mr-1" id="latitude" data-inputmask="'mask': '99.999999'" data-mask>
                        <label>Longitude: </label><input class="form-control mr-1" id="longitude" data-inputmask="'mask': '999.999999'" data-mask>
                        <button class="btn btn-success" id="Check_button">Check</button>
                        <button class="btn btn-danger" id="Clear_button">Clear</button>
                        <button class="btn btn-info" onclick="clickMe()">Map View</button>
                      </div>
                    </center>
                  </div>

                  <!-- <div class="col-md-12" hidden='hidden' id="googlemap_div">
                    <div>
                      <iframe id="googlemap"  width="1000" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                  </div> -->
                  <br/>
                  <!---Active Fault--->
                  <div class="col-md-12" style="padding-top: 30px">
                    <!---coordinates--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Coordinates</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">

                          <div id="coordinates">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---location--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Location</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="location">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Active Fault</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="activeFault">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---Ground Shaking--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Ground Shaking</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="groundShaking">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---EIL--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">EIL</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="EIL">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---liquefaction--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Liquefaction</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="liquefaction">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---fissure--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Fissure</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="fissure">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---tsunami--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Tsunami</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="tsunami">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---activeVolcano--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Active Volcano</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="activeVolcano">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---potentActiveVolcano--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Potent Active Volcano</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="potentActiveVolcano">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---inactiveVolcano--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Inactive Volcano</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="inactiveVolcano">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---ballisticProj--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">BallisticProj</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="ballisticProj">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---baseSurge--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Base Surge</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="baseSurge">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---lahar--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Lahar</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="lahar">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---lava--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Lava</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="lava">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---pyroclasticFlow--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Pyroclastic Flow</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="pyroclasticFlow">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->


                    <!---volcanicFissure--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Volcanic Fissure</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="volcanicFissure">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->


                    <!---volcanicTsunami--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Volcanic Tsunami</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="volcanicTsunami">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->


                    <!---pdz--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">PDZ</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="pdz">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->


                    <!---edz--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">EDZ</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="edz">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---kilometerRadius--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Kilometer Radius</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="kilometerRadius">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---ashFall--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Ash Fall</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="ashFall">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---flood--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Flood</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="flood">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---ril--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">RIL</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="ril">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---stormSurge--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Storm Surge</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="stormSurge">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---severeWinds--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Severe Winds</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="severeWinds">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---elementarySchool--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Elementary School</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="elementarySchool">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---secondarySchool--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Secondary School</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="secondarySchool">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---governmentHospital--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Government Hospital</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="governmentHospital">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---privateHospital--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Private Hospital</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="privateHospital">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---primaryRoadNetwork--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Primary Road Network</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="primaryRoadNetwork">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    <!---secondaryRoadNetwork--->
                    <div class="col-md-3">
                      <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">Secondary Road Network</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <div id="secondaryRoadNetwork">The body of the box</div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!---END--->

                    

                  </div>

                </div>

              </div>
            </section>
            <!-- /.content -->
        </div>
  
</div>
<!-- ./wrapper -->



<!-- jQuery 3 -->
<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- SlimScroll -->
<script src="../../adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../adminlte/bower_components/fastclick/lib/fastclick.js"></script>

<!-- InputMask -->
<script src="../../adminlte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>


<!-- jvectormap  -->
<script src="../../adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../adminlte/plugins/jvectormap/jquery-jvectormap-ph-mill-en.js"></script>

<!-- date-range-picker -->
<script src="../../adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="../../adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<!-- AdminLTE App -->
<script src="../../adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../adminlte/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!---sweetalert2--->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://api.georisk.gov.ph/js/attribution.js"></script>


</body>
</html>


<script>

  $(document).ready(function(){
    $('[data-mask]').inputmask();
    
    var data = localStorage.getItem("ReqStorage");
    var ReqStorage = data ? JSON.parse(data) : [];
    $('[data-mask]').inputmask();

    var stored = localStorage.getItem("ReqStorage");
        stored = JSON.parse(stored || '[]');

    if(stored.length > 0){
      $("#latitude").val(stored[0]['latitude']);
      $("#longitude").val(stored[0]['longitude']);

      var latitude = $("#latitude").val();
      var longitude = $("#longitude").val();
      
      $.ajax({
        url: "{{route('hazardAssessmentGeneration')}}",
        type: 'POST',
        data: {
          latitude : latitude,
          longitude : longitude,
          _token: '{{csrf_token()}}',
        },
        beforeSend: function() {
          // Swal.showLoading();
          Swal.fire({
            title: 'Please wait while fetching data from the database!',
            html: 'Press OK, when it done.',
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
            },
          });
        },
        success: function(response){
          Swal.hideLoading();

          putData(response);
        }
      });
    }

    $("#Check_button").on("click", function() {
      var latitude = $("#latitude").val();
      var longitude = $("#longitude").val();

      var req = {
        'latitude': latitude,
        'longitude': longitude,
      };

      ReqStorage.push(req);
      localStorage.setItem("ReqStorage", JSON.stringify(ReqStorage));  

      // location.reload();

      $.ajax({
        url: "{{route('hazardAssessmentGeneration')}}",
        type: 'POST',
        data: {
          latitude : latitude,
          longitude : longitude,
          _token: '{{csrf_token()}}',
        },
        beforeSend: function() {
          // Swal.showLoading();
          Swal.fire({
            title: 'Please wait while fetching data from the database!',
            html: 'Press OK, when it done.',
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
            },
          });
        },
        success: function(response){
          console.log(response);
          Swal.hideLoading();

          putData(response);
        }
      });
    });

    $("#Clear_button").on('click', function() {
      localStorage.clear();
      location.reload();
    });
  });


function putData(response)
{
  console.log(response);
  var activeFault = '<label>Nearest Active Fault :</label> &nbsp; ' + response['data']['activeFault']['nearest_active_fault'] + '<br>';
  activeFault += '<label>Segment Name :  </label> &nbsp; ' + response['data']['activeFault']['segment_name'] + '<br>';
  activeFault += '<label>Assessment :  </label> &nbsp; ' + response['data']['activeFault']['assessment'] + '<br>';
  activeFault += '<label>Distance :  </label> &nbsp; ' + response['data']['activeFault']['distance'] + ' ' + response['data']['activeFault']['units'] + '<br>';
  activeFault += '<label>Fault Name :  </label> &nbsp; ' + response['data']['activeFault']['fault_name'] + '<br>';


  var activeVolcano = '<label>Volcano Name :</label> ' + response['data']['activeVolcano']['volcano_name'] + '<br>';
  activeVolcano += '<label>Volcano Number :</label> ' + response['data']['activeVolcano']['volcano_no'] + '<br>';
  activeVolcano += '<label>Assessment :</label> ' + response['data']['activeVolcano']['assessment'] + '<br>';
  activeVolcano += '<label>Distance :</label> ' + response['data']['activeVolcano']['distance'] + ' ' + response['data']['activeFault']['units'] + '<br>';

  var groundShaking = '<label>Assessment :</label> ' + response['data']['groundShaking']['assessment'] + '<br>';

  var eil = '<label>Assessment :</label> ' + response['data']['eil']['assessment'] + '<br>';

  var liquefaction = '<label>Assessment :</label> ' + response['data']['liquefaction']['assessment'] + '<br>';

  var fissure = '<label>Assessment :</label> ' + response['data']['fissure']['assessment'] + '<br>';
  fissure += '<label>Distance :</label> ' + response['data']['fissure']['distance'] + ' ' + response['data']['fissure']['units'] + '<br>';
  fissure = '<label>Fault Name :</label> ' + response['data']['fissure']['fault_name'] + '<br>';
  fissure = '<label>Segment Name :</label> ' + response['data']['fissure']['segment_name'] + '<br>';

  
  var tsunami = '<label>Assessment :</label> ' + response['data']['tsunami']['assessment'] + '<br>';
  tsunami += '<label>Inundation :</label> ' + response['data']['tsunami']['inundation'] + '<br>';
  tsunami = '<label>Result :</label> ' + response['data']['tsunami']['result'] + '<br>';

  var potentActiveVolcano = '<label>Volcano Name :</label> ' + response['data']['potentActiveVolcano']['volcano_name'] + '<br>';
  potentActiveVolcano += '<label>Volcano Number :</label> ' + response['data']['potentActiveVolcano']['volcano_no'] + '<br>';
  potentActiveVolcano += '<label>Assessment :</label> ' + response['data']['potentActiveVolcano']['assessment'] + '<br>';
  potentActiveVolcano += '<label>Distance :</label> ' + response['data']['potentActiveVolcano']['distance'] + ' ' + response['data']['activeFault']['units'] + '<br>';


  var inactiveVolcano = '<label>Volcano Name :</label> ' + response['data']['inactiveVolcano']['volcano_name'] + '<br>';
  inactiveVolcano += '<label>Volcano Number :</label> ' + response['data']['inactiveVolcano']['volcano_no'] + '<br>';
  inactiveVolcano += '<label>Assessment :</label> ' + response['data']['inactiveVolcano']['assessment'] + '<br>';
  inactiveVolcano += '<label>Distance :</label> ' + response['data']['inactiveVolcano']['distance'] + ' ' + response['data']['activeFault']['units'] + '<br>';


  var ballisticProj = '<label>Assessment :</label> ' + response['data']['ballisticProj']['assessment'] + '<br>';
  ballisticProj += '<label>Code :</label> ' + response['data']['ballisticProj']['code'] + '<br>';
  ballisticProj += '<label>Susceptibility :</label> ' + response['data']['ballisticProj']['susceptibility'] + '<br>';


  var baseSurge = '<label>Assessment :</label> ' + response['data']['baseSurge']['assessment'] + '<br>';
  baseSurge += '<label>Code :</label> ' + response['data']['baseSurge']['code'] + '<br>';
  baseSurge += '<label>Susceptibility :</label> ' + response['data']['baseSurge']['susceptibility'] + '<br>';


  var lahar = '<label>Assessment :</label> ' + response['data']['lahar']['assessment'] + '<br>';
  lahar += '<label>Code :</label> ' + response['data']['lahar']['code'] + '<br>';
  lahar += '<label>Susceptibility :</label> ' + response['data']['lahar']['susceptibility'] + '<br>';

  var lava = '<label>Assessment :</label> ' + response['data']['lava']['assessment'] + '<br>';
  lava += '<label>Code :</label> ' + response['data']['lava']['code'] + '<br>';
  lava += '<label>Susceptibility :</label> ' + response['data']['lava']['susceptibility'] + '<br>';

  var pyroclasticFlow = '<label>Assessment :</label> ' + response['data']['pyroclasticFlow']['assessment'] + '<br>';
  pyroclasticFlow += '<label>Code :</label> ' + response['data']['pyroclasticFlow']['code'] + '<br>';
  pyroclasticFlow += '<label>Susceptibility :</label> ' + response['data']['pyroclasticFlow']['susceptibility'] + '<br>';


  var volcanicFissure = '<label>Assessment :</label> ' + response['data']['volcanicFissure']['assessment'] + '<br>';
  volcanicFissure += '<label>Distance :</label> ' + response['data']['volcanicFissure']['distance'] + ' ' + response['data']['volcanicFissure']['units'] + '<br>';


  var volcanicTsunami = '<label>Assessment :</label> ' + response['data']['volcanicTsunami']['assessment'] + '<br>';
  volcanicTsunami += '<label>Code :</label> ' + response['data']['volcanicTsunami']['code'] + '<br>';
  volcanicTsunami += '<label>Susceptibility :</label> ' + response['data']['volcanicTsunami']['susceptibility'] + '<br>';
  volcanicTsunami += '<label>Result :</label> ' + response['data']['volcanicTsunami']['result'] + '<br>';

  
  var pdz = '<label>Assessment :</label> ' + response['data']['pdz']['assessment'] + '<br>';
  pdz += '<label>Code :</label> ' + response['data']['pdz']['code'] + '<br>';
  pdz += '<label>Susceptibility :</label> ' + response['data']['pdz']['susceptibility'] + '<br>';


  var edz = '<label>Assessment :</label> ' + response['data']['edz']['assessment'] + '<br>';
  edz += '<label>Code :</label> ' + response['data']['edz']['code'] + '<br>';
  edz += '<label>Susceptibility :</label> ' + response['data']['edz']['susceptibility'] + '<br>';
  

  var kilometerRadius = '<label>Assessment :</label> ' + response['data']['kilometerRadius']['assessment'] + '<br>';
  kilometerRadius += '<label>Code :</label> ' + response['data']['kilometerRadius']['code'] + '<br>';
  kilometerRadius += '<label>Susceptibility :</label> ' + response['data']['kilometerRadius']['susceptibility'] + '<br>';
  kilometerRadius += '<label>Result :</label> ' + response['data']['kilometerRadius']['result'] + '<br>';

  var ashFall = '<label>Assessment :</label> ' + response['data']['kilometerRadius']['assessment'] + '<br>';

  var flood = '<label>Assessment :</label> ' + response['data']['flood']['assessment'] + '<br>';
  flood += '<label>Code :</label> ' + response['data']['flood']['code'] + '<br>';
  flood += '<label>Result :</label> ' + response['data']['flood']['result'] + '<br>';


  var ril = '<label>Assessment :</label> ' + response['data']['ril']['assessment'] + '<br>';
  ril += '<label>Code :</label> ' + response['data']['ril']['code'] + '<br>';
  ril += '<label>Result :</label> ' + response['data']['ril']['result'] + '<br>';

  var stormSurge = '<label>Assessment :</label> ' + response['data']['stormSurge']['assessment'] + '<br>';
  stormSurge += '<label>Code :</label> ' + response['data']['stormSurge']['code'] + '<br>';
  stormSurge += '<label>Result :</label> ' + response['data']['stormSurge']['result'] + '<br>';

  var severeWinds = '<label>Assessment :</label> ' + response['data']['severeWinds']['assessment'] + '<br>';

  var elementarySchool = '<label>School Name :</label> ' + response['data']['elementarySchool']['school_name'] + '<br>';
  elementarySchool += '<label>Distance :</label> ' + response['data']['elementarySchool']['distance'] + ' ' + response['data']['elementarySchool']['units'] + '<br>';
  elementarySchool += '<label>Assessment :</label> ' + response['data']['elementarySchool']['assessment'] + '<br>';
  

  var secondarySchool = '<label>School Name :</label> ' + response['data']['secondarySchool']['school_name'] + '<br>';
  secondarySchool += '<label>Distance :</label> ' + response['data']['secondarySchool']['distance'] + ' ' + response['data']['secondarySchool']['units'] + '<br>';
  secondarySchool += '<label>Assessment :</label> ' + response['data']['secondarySchool']['assessment'] + '<br>';


  var governmentHospital = '<label>School Name :</label> ' + response['data']['governmentHospital']['facility_name'] + '<br>';
  governmentHospital += '<label>Distance :</label> ' + response['data']['governmentHospital']['distance'] + ' ' + response['data']['governmentHospital']['units'] + '<br>';
  governmentHospital += '<label>Assessment :</label> ' + response['data']['governmentHospital']['assessment'] + '<br>';


  var privateHospital = '<label>School Name :</label> ' + response['data']['privateHospital']['facility_name'] + '<br>';
  privateHospital += '<label>Distance :</label> ' + response['data']['privateHospital']['distance'] + ' ' + response['data']['privateHospital']['units'] + '<br>';
  privateHospital += '<label>Assessment :</label> ' + response['data']['privateHospital']['assessment'] + '<br>';


  var primaryRoadNetwork = '<label>Road Name :</label> ' + response['data']['primaryRoadNetwork']['road_name'] + '<br>';
  primaryRoadNetwork += '<label>District :</label> ' + response['data']['primaryRoadNetwork']['district'] + '<br>';
  primaryRoadNetwork += '<label>Distance :</label> ' + response['data']['primaryRoadNetwork']['distance'] + ' ' + response['data']['privateHospital']['units'] + '<br>';
  primaryRoadNetwork += '<label>Assessment :</label> ' + response['data']['primaryRoadNetwork']['assessment'] + '<br>';
  

  var secondaryRoadNetwork = '<label>Road Name :</label> ' + response['data']['secondaryRoadNetwork']['road_name'] + '<br>';
  secondaryRoadNetwork += '<label>District :</label> ' + response['data']['secondaryRoadNetwork']['district'] + '<br>';
  secondaryRoadNetwork += '<label>Distance :</label> ' + response['data']['secondaryRoadNetwork']['distance'] + ' ' + response['data']['privateHospital']['units'] + '<br>';
  secondaryRoadNetwork += '<label>Assessment :</label> ' + response['data']['secondaryRoadNetwork']['assessment'] + '<br>';
  

  var coordinates = '<label>Latitude :</label> ' + response['data']['coordinates']['latitude'] + '<br>';
  coordinates += '<label>Longitude :</label> ' + response['data']['coordinates']['longitude'] + '<br>';

  var location = '<label>Municipality :</label> ' + response['data']['location']['munname'] + '<br>';
  location += '<label>Province :</label> ' + response['data']['location']['provname'] + '<br>';
  location += '<label>RegCode :</label> ' + response['data']['location']['regcode'] + '<br>';


  $("#activeFault").html(activeFault);
  $("#activeVolcano").html(activeVolcano);
  $("#groundShaking").html(groundShaking);
  $("#EIL").html(eil);
  $("#liquefaction").html(liquefaction);
  $("#fissure").html(fissure);
  $("#tsunami").html(tsunami);
  $("#potentActiveVolcano").html(potentActiveVolcano);
  $("#inactiveVolcano").html(inactiveVolcano);
  $("#ballisticProj").html(ballisticProj);
  $("#baseSurge").html(baseSurge);
  $("#lahar").html(lahar);
  $("#lava").html(lava);
  $("#pyroclasticFlow").html(pyroclasticFlow);
  $("#volcanicFissure").html(volcanicFissure);
  $("#volcanicTsunami").html(volcanicTsunami);
  $("#pdz").html(pdz);
  $("#edz").html(edz);
  $("#kilometerRadius").html(kilometerRadius);
  $("#ashFall").html(ashFall);
  $("#flood").html(flood);
  $("#ril").html(ril);
  $("#stormSurge").html(stormSurge);
  $("#severeWinds").html(severeWinds);
  $("#elementarySchool").html(elementarySchool);
  $("#secondarySchool").html(secondarySchool);
  $("#governmentHospital").html(governmentHospital);
  $("#privateHospital").html(privateHospital);
  $("#primaryRoadNetwork").html(primaryRoadNetwork);
  $("#secondaryRoadNetwork").html(secondaryRoadNetwork);
  $("#coordinates").html(coordinates);
  $("#location").html(location);

  clickMe();
}

function clickMe()
{
  var latitude = $("#latitude").val();
  var longitude = $("#longitude").val();
  var coords = latitude + "," + longitude;

  var url = 'https://maps.google.com/maps?q='+ coords +'&z=18&ie=UTF8&iwloc=&output=embed';
  var iframe = '<iframe id="googlemap"  src="'+url+'"width="1000" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';

  Swal.fire({
    html: iframe,
    showCloseButton: true,
    showCancelButton: false,
    focusConfirm: false,
    showConfirmButton: false,
    width: 1100,
  })
}
</script>