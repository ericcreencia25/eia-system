<!doctype html>
  <html lang="en">
  <head>

    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <title>ECC DRAFT </title>

    

    

  -->

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ECC DRAFT </title>

  <link rel = "icon" type = "image/png" href="../../img/denr1.png">

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
     <link rel="stylesheet" href="../../adminlte/plugins/iCheck/flat/blue.css">
     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script src="https://cdn.tiny.cloud/1/u1zby00l4hbcsuf7u8q6mm6iekqmrs3txm1ih2nk2x23fy21/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: 'textarea#editor', 
      });
    </script>

    <style>
      #pointer {cursor: pointer;}

      p {
        font-size: 20px;
      }
    </style>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <!-- /.container-fluid -->
            <div class="navbar-header">
              <a href="" class="navbar-brand" style="padding-top: 5px; padding-left: 0px;">
                <img src="../../img/denr1.png" width="40" height="40" class="d-inline-block align-top" alt="">
              </a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Statistics <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Status Per Region</a></li>
                    <li><a href="#">Collection Per Region</a></li>
                    <li><a href="#">Performance Per Region</a></li>
                  </ul>
                </li>

                <li><a href="#">Email Notifications</a></li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Tools <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Manage ECC</a></li>
                    <li><a href="#">Manage Proponents</a></li>
                    <li><a href="{{ url("administration/default") }}">Manage Users</a></li>
                    <li><a href="{{ url("administration/signatories") }}">Manage Signatories</a></li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Reports <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">ECC Issued</a></li>
                    <li><a href="#">CNC Issued</a></li>
                    <li><a href="#">Approval Exemption</a></li>
                  </ul>
                </li>

              </ul>
            </div>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="dropdown tasks-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs"> <i class="fa fa-fw fa-user"></i> Welcome {{session('data')['UserName']}} </span>
                  </a>
                  <ul class="dropdown-menu">

                    <li>
                      <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        @if(session('data')['UserRole'] != 'Sysad')
                        <li>
                          <a href="#">Manage Account
                          </a>
                        </li>
                        <li>
                          <a href="#">User's Manual</a>
                        </li>
                        <li>
                          <a href="{{ url("logout") }}" >Sign out</a>
                        </li>
                        @else
                        <li>
                          <a href="#">Manage Users</a>
                        </li>

                        <li>
                          <a href="{{ url("administration/signatories") }}">Manage Signatories
                          </a>
                        </li>

                        <li>
                          <a href="#">Manage Account</a>
                        </li>

                        <li>
                          <a href="#">Statistics</a>
                        </li>

                        <li>
                          <a href="#">Bank Reports</a>
                        </li>

                        <li>
                          <a href="#">User's Manual</a>
                        </li>
                        <li>
                          <a href="{{ url("logout") }}" >Sign out</a>
                        </li>

                        @endif
                        <!-- end task item -->
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      <!-- Full Width Column -->
      <div class="content-wrapper">
        <section class="content">
          <h2 class="page-header">
            <div class="box-header with-border" style="background-color:#106A9A; color:White; padding:10px;">
              <h3 class="box-title" style="font-weight:bold;">ECC DRAFT CERTIFICATE - ADMIN</h3>
            </div>
          </h2>

          <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="row">
                  <div class="col-md-2">
                    <form method="GET" action="{{ url("administration/ECCDraftCertficate") }}">
                      <div class="box">
                        <label>Template</label>
                        <select class="form-control" id="Template" name="Template">
                          <option>NFMP</option>
                          <option>SH</option>
                          <option>GT</option>
                          <option>ID</option>
                          <option>WM</option>
                          <option>BP</option>
                          <option>APPF</option>
                          <option>PP</option>
                          <option>RE</option>
                          <option>LAI</option>
                          <option>RB</option>
                          <option>APAFM</option>
                          <option>PFS</option>
                          <option>BC</option>
                          <option>WS</option>
                          <option>CRM</option>
                          <option>FA</option>
                          <option>CM</option>
                          <option>ROT</option>
                          <option>WTE</option>
                        </select>

                        <label>Type</label>
                        <select class="form-control" id="ApplicationType" name="ApplicationType">
                          <option value="New Application">New Application</option>
                          <option value="Ammendment">Ammendment</option>
                        </select>

                        <br>
                        <button class="btn btn-primary btn-block" id="Search" type="submit">Search</button>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-10">
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#tab_1" data-toggle="tab">First Page</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Second Page</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Sworn Accountability Statement</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Environmental Management</a></li>
                        <li><a href="#tab_5" data-toggle="tab">General Conditions</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Restrictions</a></li>
                        <li><a href="#tab_7" data-toggle="tab">Project Assessment Planning Tool</a></li>
                      </ul>
                      <div class="tab-content">
                        <!--FIRST TAB EDITABLE-->
                        <div class="tab-pane active" id="tab_1"><br>
                          <!-- <button type="button" class="btn btn-default pull-right" id="preview-first-page"><i class="fa fa-fw fa-eye"></i> Preview</button> -->
                          <button type="button" class="btn btn-default pull-right" id="first-page"><i class="fa fa-save"></i> Save</button><br><br>
                          <div class="box-body" style="width: 612pt">
                            <br>
                            <div class="form-group">
                              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal; tab-stops: 105.0pt;"><span lang="EN-US" style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">Subject: <span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><strong style="mso-bidi-font-weight: normal;"><span style="mso-spacerun: yes;">&nbsp;</span>ENVIRONMENTAL COMPLIANCE CERTIFICATE</strong></span></p><br>
                            </div>

                            <div class="form-group"><br>
                              <textarea class="editor" id="Body" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">{{ isset($draft) ? $draft->Body : '' }}</textarea>
                            </div>
                            <div class="form-group">
                              <p style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"><b>${approver}</b></p>
                              <p style="font-family: 'Bookman Old Style', serif; font-size: 10pt;">${approverdesignation}</p>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane" id="tab_2"><br>
                          <!--SECOND TAB EDITABLE-->
                          <!-- <button type="button" class="btn btn-default pull-right" id="preview-second-page"><i class="fa fa-fw fa-eye"></i> Preview</button> -->
                          <button type="submit" class="btn btn-default pull-right" id="second-page"><i class="fa fa-save"></i> Save</button>
                          <br><br>
                          <div class="box-body" style="width: 612pt">
                            <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">ENVIRONMENTAL COMPLIANCE CERTIFICATE</span></strong></p>
                            <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><span style="font-family: 'Bookman Old Style', serif; font-size: 12pt;">(Issued under Presidential Decree 1586)</span></p>
                            <p class="MsoNormal" style="margin-bottom: 0cm; margin-top: 0cm; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0cm; mso-add-space: auto; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">${referenceno}</span></strong></p><br>
                            <div class="form-group">
                              <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:100%;width:98.3%;padding:10px" id="ThisIsToCertify" class="editor">{{ isset($draft) ? $draft->ThisIsToCertify : '' }}</textarea>
                            </div>
                            <center>
                              <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">PROJECT DESCRIPTION</span></strong></p><br>
                              <!-- <h4 style="padding-top: 1px; padding-bottom: 1px; font-size: 30px;"><b>PROJECT DESCRIPTION</b></h4><br><br> -->
                            </center>

                            <div class="form-group">
                              <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:50px;width:98.3%;padding:10px" id="ProjectDescription" class="editor">{{ isset($draft) ? $draft->ProjectDescription : '' }}</textarea>
                            </div>

                            <div class="form-group">
                              <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:98.3%;padding:10px" id="ThisCertificateIsIssued" class="editor">{{ isset($draft) ? $draft->ThisCertificateIsIssued : '' }}</textarea>
                            </div>

                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-7">
                                  <p class="MsoNormal"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Recommending Approval:</span></p><br>
                                  <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">${eiachief}<br></span></strong></p>
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Chief, Clearance &amp; Permitting Division</span></p>
                                </div>
                                <div class="col-md-5">
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Approved:</span></p><br>
                                  <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">${approver}<br></span></strong></p>
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">${approverdesignation}</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane" id="tab_3"><br>
                          <!--THIRD TAB EDITABLE-->
                          <!-- <button type="button" class="btn btn-default pull-right" id="preview-third-page"><i class="fa fa-fw fa-eye"></i> Preview</button> -->
                          <button type="submit" class="btn btn-default pull-right" id="third-page"><i class="fa fa-save"></i> Save</button>
                          <br><br>
                          <div class="box-body" style="width: 612pt">
                            <center>
                              <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">SWORN ACCOUNTABILITY STATEMENT</span></strong></p>
                              <br><br>
                            </center>
                            <div class="form-group">
                              <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:20px;width:98.3%;padding:10px" id="SwornAccountabilityStatement" class="editor">{{ isset($draft) ? $draft->SwornAccountabilityStatement : '' }}</textarea>
                            </div>

                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                  <p  class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;margin-bottom: 0cm;">_____________________</span></p>
                                  <p  class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;margin-bottom: 0cm;">${representative}</span></p>
                                  <p  class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;margin-bottom: 0cm;">Signature</span></p>
                                  <br>
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">TIN No. _____________</span></p>
                                  <br>
                                </div>
                                <div class="col-md-12" style="padding-bottom: 50px">
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Subscribed and sworn before me this ________, the above-named affiant taking oath presenting  ________________________________, issued on _______________________________ at _____________. </span></p>
                                </div>
                                <br><br>
                                <div class="col-md-8">
                                  <br>
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Doc. No. __________</span></p>
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Page No. __________</span></p>
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Book No. __________</span></p>
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Series of ___________</span></p>
                                </div>
                                <div class="col-md-4">
                                  <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Notary Public</span></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane" id="tab_4"><br>
                          <!--FOURTH TAB EDITABLE-->
                          <button type="submit" class="btn btn-default pull-right" id="fourth-page"><i class="fa fa-save"></i> Save</button>
                          <br><br>
                          <div class="form-group">
                            <p class="MsoNormal" style="margin-bottom: 0cm; text-align: right; line-height: normal;">
                              <strong style="mso-bidi-font-weight: normal;">
                                <span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">ANNEX A
                                </span>
                              </strong>
                            </p>

                            <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;">
                              <strong style="mso-bidi-font-weight: normal;">
                                <span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">I. ENVIRONMENTAL MANAGEMENT</span>
                              </strong>
                            </p><br>

                            <div class="row" style="overflow-x:auto;">
                              <center><br>
                                <table class="MsoTableGrid" style="border-collapse: collapse; border: none; height: 203px; width: 822px;" border="1" width="854" cellspacing="0" cellpadding="0">
                                  <tbody>
                                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes;">
                                      <td style="width: 232.469px; border: 1pt solid windowtext; background: rgb(217, 226, 243); padding: 0cm 5.4pt;">
                                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><span style="font-size: 12pt;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext;">POTENTIAL IMPACT PER PROJECT ACTIVITY PER PROJECT PHASE</span></strong></span></p>
                                      </td>

                                      <td style="width: 406.172px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: rgb(217, 226, 243); padding: 0cm 5.4pt;">
                                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center">
                                          <span style="font-size: 12pt;">
                                            <strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext;">MITIGATING MEASURES</span>
                                            </strong>
                                          </span>
                                        </p>
                                      </td>

                                      <td style="width: 182.047px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: rgb(217, 226, 243); padding: 0cm 5.4pt;">
                                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center">
                                          <span style="font-size: 12pt;">
                                            <strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext;">RATING/ PERFORMANCE OF MITIGATING MEASURES</span>
                                            </strong>
                                          </span>
                                        </p>
                                      </td>
                                    </tr>

                                    <tr style="mso-yfti-irow: 1;">
                                      <td style="width: 820.688px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; background: rgb(191, 191, 191); padding: 0cm 5.4pt;" colspan="3" valign="top">
                                        <p class="MsoListParagraph" style="margin-left: 18.0pt; text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><strong><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Bookman Old Style'; mso-bidi-font-family: 'Bookman Old Style';"><span style="mso-list: Ignore;">A.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp; </span></span></span></strong><!--[endif]--><strong><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; color: black; mso-color-alt: windowtext;">Construction Phase</span></strong></p>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center>
                            </div>
                            <center>
                              <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:830px;padding:10px" id="EM-A" class="editor">{{ isset($draft) ? $draft->ConstructionPhase : '' }}</textarea>
                            </center>

                            <div class="row" style="overflow-x:auto;">
                              <center><br>
                                <table style="border-collapse: collapse; width: 822px; border-width: initial; border-spacing: 0px; border-color: initial; border-style: none;" border="1" width="633" cellspacing="0" cellpadding="0">
                                  <tbody>
                                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes;">
                                      <td style="width: 474.65pt; border: solid; background: rgb(180, 198, 231); padding: 0cm 5.4pt;" valign="top" width="633">
                                        <p class="MsoListParagraph" style="margin-left: 18.0pt; text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Bookman Old Style'; mso-bidi-font-family: 'Bookman Old Style'; mso-bidi-font-weight: bold; mso-bidi-font-style: italic;"><span style="mso-list: Ignore;">B.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp; </span></span></span><!--[endif]--><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; color: black; mso-color-alt: windowtext; mso-bidi-font-weight: bold; mso-bidi-font-style: italic;">Operational Phase</span></p>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center>
                            </div>

                            <center>
                              <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:830px;padding:10px" id="EM-B" class="editor">{{ isset($draft) ? $draft->OperationPhase : '' }}</textarea>
                            </center>
                          </div>
                        </div>

                        <div class="tab-pane" id="tab_5">
                          <!--FIFTH TAB EDITABLE-->
                          <!-- <button type="button" class="btn btn-default pull-right" id="preview-fifth-page"><i class="fa fa-fw fa-eye"></i> Preview</button> -->
                          <button type="button" class="btn btn-default pull-right" id="fifth-page"><i class="fa fa-save"></i> Save</button>
                          <br><br>
                          <div class="box-body" style="width: 612pt">
                            <br>
                            <div class="form-group">
                              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">II.  GENERAL CONDITIONS</span></strong></p><br>
                            </div>

                            <div class="form-group"><br>
                              <textarea class="editor" id="GeneralConditions" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">{{ isset($draft) ? $draft->GeneralConditions : '' }}</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab_6">
                          <!--FIFTH TAB EDITABLE-->
                          <!-- <button type="button" class="btn btn-default pull-right" id="preview-sixth-page"><i class="fa fa-fw fa-eye"></i> Preview</button> -->
                          <button type="button" class="btn btn-default pull-right" id="sixth-page"><i class="fa fa-save"></i> Save</button>
                          <br><br>
                          <div class="box-body" style="width: 612pt">
                            <br>
                            <div class="form-group">
                              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">III.  RESTRICTIONS</span></strong></p><br>
                            </div>

                            <div class="form-group"><br>
                              <textarea class="editor" id="Restrictions" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">{{ isset($draft) ? $draft->Restrictions : '' }}</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab_7">
                          <!--FIFTH TAB EDITABLE-->
                          <!-- <button type="button" class="btn btn-default pull-right" id="preview-seventh-page"><i class="fa fa-fw fa-eye"></i> Preview</button> -->
                          <button type="button" class="btn btn-default pull-right" id="seventh-page"><i class="fa fa-save"></i> Save</button>
                          <br><br>
                          <div class="box-body" style="width: 612pt">
                            <br>
                            <div class="form-group">
                              <center>
                                <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">PROJECT ASSESSMENT PLANNING TOOL</span></strong></p>
                                <br><br>
                              </center>
                            </div>

                            <div class="form-group"><br>
                              <textarea class="editor" id="PAPT" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">{{ isset($draft) ? $draft->PAPT : '' }}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"  crossorigin="anonymous"></script>

    <script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/u1zby00l4hbcsuf7u8q6mm6iekqmrs3txm1ih2nk2x23fy21/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>

      tinymce.init({
        resize: 'both',
        selector: 'textarea.editor',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
    // menubar: 'file edit view insert format tools table help',
    menubar: 'edit view insert format tools table',
    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | nonbreaking',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    content_css: '//www.tiny.cloud/css/codepen.min.css',
    link_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,
    file_picker_callback: function (callback, value, meta) {
      /* Provide file and text for the link dialog */
      if (meta.filetype === 'file') {
        callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
      }

      /* Provide image and alt text for the image dialog */
      if (meta.filetype === 'image') {
        callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
      }

      /* Provide alternative source and posted for the media dialog */
      if (meta.filetype === 'media') {
        callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
      }
    },
    templates: [
    { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 520,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: 'sliding',
    contextmenu: "link image imagetools table",
    nonbreaking_force_tab: true
  });

      var Template = "{{ $Template}}";
      var ApplicationType = "{{ $ApplicationType}}";

      $(document).ready(function() {

        console.log(ApplicationType);

        $("#Template").val(Template);
        $("#ApplicationType").val(ApplicationType);

        $("#Search").on('click', function() {
          var Template = $("#Template").val();
          var ApplicationType = $("#ApplicationType").val();

          $.ajax({
            url: "{{route('ECCDraftDataAdmin')}}",
            type: 'POST',
            data: {
              Template : Template,
              ApplicationType : ApplicationType,
              _token: '{{csrf_token()}}',
            },
            success: function(response){
              $("#body-editable").html(response['Body']);
              $("#papt-editable").html(response['PAPT']);
              $("#restrictions-editable").html(response['Restrictions']);
              $("#general-conditions-editable").html(response['GeneralConditions']);
              $("#construction-phase-editable").html(response['ConstructionPhase']);
              $("#operation-phase-editable").html(response['OperationPhase']);
              $("#sworn-accountability-statement-editable").html(response['SwornAccountabilityStatement']);
              $("#this-certificate-is-issued-editable").html(response['ThisCertificateIsIssued']);
              $("#this-is-to-certify-editable").html(response['ThisIsToCertify']);
              $("#project-description-editable").html(response['ProjectDescription']);

            }
          });
        });


        $("#first-page").on('click', function() {
          var Body = tinymce.get("Body").getContent();

          $.ajax({
            url: "{{route('PageSaveAdmin')}}",
            type: 'POST',
            data: {
              Template : Template,
              ApplicationType : ApplicationType,
              content : Body,
              Page : 1,
              _token: '{{csrf_token()}}',
            },
            success: function(response){
              location.reload();
            }
          });
        });

        $("#second-page").on('click', function() {
          var ThisIsToCertify = tinymce.get("ThisIsToCertify").getContent();
          var ProjectDescription = tinymce.get("ProjectDescription").getContent();
          var ThisCertificateIsIssued = tinymce.get("ThisCertificateIsIssued").getContent();

          $.ajax({
            url: "{{route('PageSaveAdmin')}}",
            type: 'POST',
            data: {
              Template : Template,
              ApplicationType : ApplicationType,
              ThisIsToCertify : ThisIsToCertify,
              ProjectDescription : ProjectDescription,
              ThisCertificateIsIssued : ThisCertificateIsIssued,
              Page : 2,
              _token: '{{csrf_token()}}' ,
            },
            success: function(response){
              location.reload();
            }
          });
        });

        $("#third-page").on('click', function() {
          var SwornAccountabilityStatement = tinymce.get("SwornAccountabilityStatement").getContent();


          $.ajax({
            url: "{{route('PageSaveAdmin')}}",
            type: 'POST',
            data: {
              Template : Template,
              ApplicationType : ApplicationType,
              SwornAccountabilityStatement : SwornAccountabilityStatement,
              Page : 3,
              _token: '{{csrf_token()}}' ,
            },
            success: function(response){
              console.log(response);
              location.reload();

            }
          });

        });

        $("#fourth-page").on('click', function() {
          var ConstructionPhase = tinymce.get("EM-A").getContent();
          var OperationPhase = tinymce.get("EM-B").getContent();



          $.ajax({
            url: "{{route('PageSaveAdmin')}}",
            type: 'POST',
            data: {
              Template : Template,
              ApplicationType : ApplicationType,
              ConstructionPhase : ConstructionPhase,
              OperationPhase : OperationPhase,
              Page : 4,
              _token: '{{csrf_token()}}' ,
            },
            success: function(response){
              console.log(response);
              location.reload();

            }
          });

        });

        $("#fifth-page").on('click', function() {
          var GeneralConditions = tinymce.get("GeneralConditions").getContent();


          $.ajax({
            url: "{{route('PageSaveAdmin')}}",
            type: 'POST',
            data: {
              Template : Template,
              ApplicationType : ApplicationType,
              GeneralConditions : GeneralConditions,
              Page : 5,
              _token: '{{csrf_token()}}' ,
            },
            success: function(response){
              location.reload();

            }
          });

        });

        $("#sixth-page").on('click', function() {
          var Restrictions = tinymce.get("Restrictions").getContent();


          $.ajax({
            url: "{{route('PageSaveAdmin')}}",
            type: 'POST',
            data: {
              Template : Template,
              ApplicationType : ApplicationType,
              Restrictions : Restrictions,
              Page : 6,
              _token: '{{csrf_token()}}' ,
            },
            success: function(response){
              location.reload();

            }
          });

        });

        $("#seventh-page").on('click', function() {
          var PAPT = tinymce.get("PAPT").getContent();


          $.ajax({
            url: "{{route('PageSaveAdmin')}}",
            type: 'POST',
            data: {
              Template : Template,
              ApplicationType : ApplicationType,
              PAPT : PAPT,
              Page : 7,
              _token: '{{csrf_token()}}' ,
            },
            success: function(response){
              location.reload();

            }
          });

        });

      });

    </script>


  </body>
  </html>