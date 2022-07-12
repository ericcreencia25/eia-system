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
            selector: 'textarea#editor', });
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
    </nav>
  </header>

  <!-- Full Width Column -->
  <div class="content-wrapper">
    <section class="content">
      <h2 class="page-header">
        <div class="box-header with-border" style="background-color:#106A9A; color:White; padding:10px;">
          <h3 class="box-title" style="font-weight:bold;">ECC DRAFT CERTIFICATE</h3>
        </div>
      </h2>

      <div class="row">
        <div class="col-md-6">
          <!--FIRST PREVIEW-->
          <div class="box box-default" id="first-page-view">
            <div class="mailbox-read-message">
              <div class="form-group">
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt;">${dategenerated}</p>
                <p style="font-size: 12pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"><b>${referenceno}</b></p>
                <p style="font-size: 12pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; margin-bottom: 0px"><b>{{$project->Representative}}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt; margin-bottom: 0px">{{$project->Designation}}</p>
                <p style="font-size: 12pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; margin-bottom: 0px"><b>{{$project->ProponentName}}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt; margin-bottom: 0px">{{$project->MailingAddress}}</p>
              </div>
              <!-- <div class="form-group">
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt;">${dategenerated}</p>
                <p style="font-size: 12pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"><b>${referenceno}</b></p>
                <p style="font-size: 12pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; margin-bottom: 0px"><b>{{$project->Representative}}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt; margin-bottom: 0px">{{$project->Designation}}${representativedesignation}</p>
                <p style="font-size: 12pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; margin-bottom: 0px"><b>${proponentname}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt; margin-bottom: 0px">${proponentaddress}</p>
              </div> -->
              <br>
              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal; tab-stops: 105.0pt;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">Subject: <span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><strong style="mso-bidi-font-weight: normal;"><span style="mso-spacerun: yes;">&nbsp;</span>ENVIRONMENTAL COMPLIANCE CERTIFICATE</strong></span></p><br>
              <div id="body-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"><p>${projectname}</p></div>
              <br><br><br><br>
              <div class="form-group">
                <p style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';margin-bottom: 0px"><b>{{ $project->Director}}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt;">{{$project->DirectorDesignation}}</p>
              </div>
            </div>
          </div>

          <!--SECOND PREVIEW-->
          <div  class="box box-default" id="second-page-view" hidden="hidden">
            <div class="mailbox-read-message" style="margin: 50px">
              <div class="form-group">
                <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">ENVIRONMENTAL COMPLIANCE CERTIFICATE</span></strong></p>
                <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><span style="font-family: 'Bookman Old Style', serif; font-size: 12pt;">(Issued under Presidential Decree 1586)</span></p>
                <p class="MsoNormal" style="margin-bottom: 0cm; margin-top: 0cm; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0cm; mso-add-space: auto; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">${referenceno}</span></strong></p>
              </div>
              <br>
              
              <div id="this-is-to-certify-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              <br>

              <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">PROJECT DESCRIPTION</span></strong></p><br>

              <div id="project-description-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              <br>
              
              <div id="this-certificate-is-issued-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>

              <br><br>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-7">
                    <p class="MsoNormal"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Recommending Approval:</span></p><br>
                    <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->EIAChief}}<br></span></strong></p>
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Chief, Clearance &amp; Permitting Division</span></p>
                  </div>
                  <div class="col-md-5">
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Approved:</span></p><br>
                    <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{ $project->Director}}<br></span></strong></p>
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->DirectorDesignation}}</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--THIRD PREVIEW-->
          <div  class="box box-default" id="third-page-view" hidden="hidden">
            <div class="mailbox-read-message" style="margin: 50px">
              <div class="form-group">
                <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">SWORN ACCOUNTABILITY STATEMENT</span></strong></p>
              </div>
              <br>
              
              <div id="sworn-accountability-statement-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              <br>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-8"></div>
                  <div class="col-md-4">
                    <p  class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;margin-bottom: 0cm;">_____________________</span></p>
                    <p  class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;margin-bottom: 0cm;">{{$project->Representative}}</span></p>
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

          <!--FOURTH PREVIEW-->
          <div  class="box box-default" id="fourth-page-view" hidden="hidden">
            <div class="mailbox-read-message" style="margin: 50px">
              <div class="form-group">
                <p class="MsoNormal" style="margin-bottom: 0cm; text-align: right; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">ANNEX A</span></strong></p>
                <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">I. ENVIRONMENTAL MANAGEMENT</span></strong></p>
              </div>
              <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">All commitments, mitigating measures and monitoring requirements, especially those contained in the Initial Environmental Examination Checklist Report, particularly in the Environmental Management and Monitoring Plan (EMMoP), shall be instituted to minimize any adverse impact to the environment throughout the project implementation including among others the following, to wit:</span></p>
              <br>
              <div class="row" style="overflow-x:auto;">
              <center><br>
                <table class="MsoTableGrid" style="border-collapse: collapse; border: none; height: 203px; width: 822px;" border="1" width="854" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes;">
                      <td style="width: 232.469px; border: 1pt solid windowtext; background: rgb(217, 226, 243); padding: 0cm 5.4pt;">
                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><span style="font-size: 12pt;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext;">POTENTIAL IMPACT PER PROJECT ACTIVITY PER PROJECT PHASE</span></strong></span></p>
                      </td>
                      <td style="width: 406.172px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: rgb(217, 226, 243); padding: 0cm 5.4pt;">
                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><span style="font-size: 12pt;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext;">MITIGATING MEASURES</span></strong></span></p>
                      </td>
                      <td style="width: 182.047px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: rgb(217, 226, 243); padding: 0cm 5.4pt;">
                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><span style="font-size: 12pt;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext;">RATING/ PERFORMANCE OF MITIGATING MEASURES</span></strong></span></p>
                      </td>
                    </tr>

                    <tr style="mso-yfti-irow: 1;">
                      <td style="width: 820.688px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; background: rgb(191, 191, 191); padding: 0cm 5.4pt;" colspan="3" valign="top">
                        <p class="MsoListParagraph" style="margin-left: 18.0pt; text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><strong><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Bookman Old Style'; mso-bidi-font-family: 'Bookman Old Style';"><span style="mso-list: Ignore;">A.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp; </span></span></span></strong><!--[endif]--><strong><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; color: black; mso-color-alt: windowtext;">Construction Phase</span></strong></p>
                      </td>
                    </tr>
                    <tr style="mso-yfti-irow: 2; mso-yfti-lastrow: yes;">
                      <td style="width: 820.688px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; background: rgb(208, 206, 206); padding: 0cm 5.4pt;" colspan="3" valign="top">
                        <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style', serif; color: black; font-size: 10pt;">Site Development/Site Clearing</span></p>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- <div align="center">
                  <table class="MsoTableGrid" style="border-collapse: collapse; border: none; width: 817px;" border="1" width="633" cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes; mso-yfti-lastrow: yes;">
                        <td style="width: 231.875px; border: 1pt solid windowtext; padding: 0cm 5.4pt;" valign="top" width="180">
                          <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal; mso-layout-grid-align: none; text-autospace: none;"><span lang="EN-AU" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; mso-ansi-language: EN-AU;">Potential siltation of nearby bodies of water due to soil erosion</span></p>
                        </td>
                        <td style="width: 406.375px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;" valign="top" width="312">
                          <p class="MsoListParagraph" style="margin-left: 12.6pt; mso-add-space: auto; text-indent: -7.9pt; mso-list: l0 level1 lfo1;"><span lang="EN-AU" style="font-size: 11.0pt; font-family: Symbol; mso-fareast-font-family: Symbol; mso-bidi-font-family: Symbol; mso-ansi-language: EN-AU;"><span style="mso-list: Ignore;">&middot;<span style="font: 7.0pt 'Times New Roman';">&nbsp; </span></span></span><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif;">Provision of sediment control measures such as sediment traps, slope stabilization, etc.</span></p>
                        </td>
                        <td style="width: 177.438px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;" valign="top" width="138">
                          <p class="MsoNormal" style="line-height: normal; margin: 0cm 0cm 0cm -.35pt;"><span lang="EN-US" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman';">100% no siltation of nearby bodies of water</span></p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div> -->
                <div id="construction-phase-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>

                <table style="border-collapse: collapse; width: 822px; border-width: initial; border-spacing: 0px; border-color: initial; border-style: none;" border="1" width="633" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes;">
                      <td style="width: 474.65pt; border: solid; background: rgb(180, 198, 231); padding: 0cm 5.4pt;" valign="top" width="633">
                        <p class="MsoListParagraph" style="margin-left: 18.0pt; text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Bookman Old Style'; mso-bidi-font-family: 'Bookman Old Style'; mso-bidi-font-weight: bold; mso-bidi-font-style: italic;"><span style="mso-list: Ignore;">A.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp; </span></span></span><!--[endif]--><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; color: black; mso-color-alt: windowtext; mso-bidi-font-weight: bold; mso-bidi-font-style: italic;">Operation Phase</span></p>
                           </td>
                           </tr>
                           <tr style="mso-yfti-irow: 1; mso-yfti-lastrow: yes;">
                           <td style="width: 474.65pt; border-width: initial; border-style: none solid solid; border-color: initial; border-image: initial; background: rgb(208, 206, 206); padding: 0cm 5.4pt;" valign="top" width="633">
                           <p class="MsoNormal" style="margin-bottom: 0cm; margin-top: 0cm; mso-margin-bottom-alt: 12.75pt; mso-margin-top-alt: 0cm; mso-add-space: auto; line-height: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext;">Operation and Maintenance of the Main and Support Facilities</span></p>
                           </td>
                           </tr>
                           </tbody>
                           </table>
                <div id="operation-phase-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              </center>
              <br>
            </div>
            </div>
          </div>

          <!--FIFTH PREVIEW-->
          <div class="box box-default" id="fifth-page-view" hidden="hidden">
            <div class="mailbox-read-message">
              <br>
              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">II.  GENERAL CONDITIONS</span></strong></p><br>
              <div id="general-conditions-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              <br><br><br><br>
            </div>
          </div>

          <!--SIXTH PREVIEW-->
          <div class="box box-default" id="sixth-page-view" hidden="hidden">
            <div class="mailbox-read-message">
              <br>
              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">III.  RESTRICTIONS</span></strong></p><br>
              <div id="restrictions-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              <br><br><br><br>
            </div>
          </div>

          <!--LAST PREVIEW-->
          <div  class="box box-default" id="seventh-page-view" hidden="hidden">
            <div class="mailbox-read-message" style="margin: 50px">
              <div class="form-group">
                <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">PROJECT ASSESSMENT PLANNING TOOL</span></strong></p>
              </div>
              <br>
              <div class="row"  style="overflow-x:auto;">
                <div id="papt-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';" ></div>
              </div>
              <br><br>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-7">
                    <p class="MsoNormal"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Recommending Approval:</span></p><br>
                    <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->EIAChief}}<br></span></strong></p>
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Chief, Clearance &amp; Permitting Division</span></p>
                  </div>
                  <div class="col-md-5">
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Approved:</span></p><br>
                    <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->Director}}<br></span></strong></p>
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->DirectorDesignation}}</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>



        <div class="col-md-6">
          <div class="box box-default">
            <div class="row">
              <div class="col-md-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#tab_1" data-toggle="tab">First Page</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Second Page</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Sworn Accountability Statement</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Environmental Management</a></li>
                    <li><a href="#tab_5" data-toggle="tab">General Conditions</a></li>
                    <li><a href="#tab_6" data-toggle="tab">Restrictions</a></li>
                    <li><a href="#tab_7" data-toggle="tab">Project Assessment Planning Tool</a></li>
                    <li class="pull-right"><button type="button" class="btn btn-default pull-right" id="preview-all-page"><i class="fa fa-fw fa-eye"></i>ALL PREVIEW</button></li>
                  </ul>
                  <div class="tab-content">
                    <!--FIRST TAB EDITABLE-->
                    <div class="tab-pane active" id="tab_1"><br>
                      <button type="button" class="btn btn-default pull-right" id="preview-first-page"><i class="fa fa-fw fa-eye"></i> Preview</button>
                      <button type="button" class="btn btn-default pull-right" id="first-page"><i class="fa fa-save"></i> Save</button>                      <br><br>
                      <div class="box-body">
                        <br>
                        <div class="form-group">
                          <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal; tab-stops: 105.0pt;"><span lang="EN-US" style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">Subject: <span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><strong style="mso-bidi-font-weight: normal;"><span style="mso-spacerun: yes;">&nbsp;</span>ENVIRONMENTAL COMPLIANCE CERTIFICATE</strong></span></p><br>
                        </div>

                        <div class="form-group"><br>
                          <textarea class="editor" id="Body" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">{{ $draft->Body }}</textarea>
                        </div>
                        <div class="form-group">
                          <p style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"><b>${approver}</b></p>
                          <p style="font-family: 'Bookman Old Style', serif; font-size: 10pt;">${approverdesignation}</p>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="tab_2"><br>
                    <!--SECOND TAB EDITABLE-->
                      <button type="button" class="btn btn-default pull-right" id="preview-second-page"><i class="fa fa-fw fa-eye"></i> Preview</button>
                      <button type="submit" class="btn btn-default pull-right" id="second-page"><i class="fa fa-save"></i> Save</button>
                      <br><br>
                      <div class="box-body">
                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">ENVIRONMENTAL COMPLIANCE CERTIFICATE</span></strong></p>
                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><span style="font-family: 'Bookman Old Style', serif; font-size: 12pt;">(Issued under Presidential Decree 1586)</span></p>
                        <p class="MsoNormal" style="margin-bottom: 0cm; margin-top: 0cm; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0cm; mso-add-space: auto; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">${referenceno}</span></strong></p><br>
                        <div class="form-group">
                          <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:100%;width:98.3%;padding:10px" id="ThisIsToCertify" class="editor">{{ $draft->ThisIsToCertify }}</textarea>
                        </div>
                        <center>
                          <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">PROJECT DESCRIPTION</span></strong></p><br>
                          <!-- <h4 style="padding-top: 1px; padding-bottom: 1px; font-size: 30px;"><b>PROJECT DESCRIPTION</b></h4><br><br> -->
                        </center>

                        <div class="form-group">
                          <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:50px;width:98.3%;padding:10px" id="ProjectDescription" class="editor">{{ $draft->ProjectDescription }}</textarea>
                        </div>

                        <div class="form-group">
                          <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:98.3%;padding:10px" id="ThisCertificateIsIssued" class="editor">{{ $draft->ThisCertificateIsIssued }}</textarea>
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
                    <button type="button" class="btn btn-default pull-right" id="preview-third-page"><i class="fa fa-fw fa-eye"></i> Preview</button>
                    <button type="submit" class="btn btn-default pull-right" id="third-page"><i class="fa fa-save"></i> Save</button>
                    <br><br>
                    <div class="box-body">
                      <center>
                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">SWORN ACCOUNTABILITY STATEMENT</span></strong></p>
                          <br><br>
                        </center>
                        <div class="form-group">
                          <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:98.3%;padding:10px" id="SwornAccountabilityStatement" class="editor">{{ $draft->SwornAccountabilityStatement }}</textarea>
                        </div>
                        
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                              <p  class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;margin-bottom: 0cm;">_____________________</span></p>
                              <p  class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;margin-bottom: 0cm;">{{$project->Representative}}</span></p>
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
                    <button type="button" class="btn btn-default pull-right" id="preview-fourth-page"><i class="fa fa-fw fa-eye"></i> Preview</button>
                    <button type="submit" class="btn btn-default pull-right" id="fourth-page"><i class="fa fa-save"></i> Save</button>
                    <br><br>
                    <div class="form-group">
                      <p class="MsoNormal" style="margin-bottom: 0cm; text-align: right; line-height: normal;">
                        <strong style="mso-bidi-font-weight: normal;">
                          <span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">ANNEX A</span>
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
                                    </span></p>
                                </td>
                              </tr>

                              <tr style="mso-yfti-irow: 1;">
                                <td style="width: 820.688px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; background: rgb(191, 191, 191); padding: 0cm 5.4pt;" colspan="3" valign="top">
                                  <p class="MsoListParagraph" style="margin-left: 18.0pt; text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><strong><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Bookman Old Style'; mso-bidi-font-family: 'Bookman Old Style';"><span style="mso-list: Ignore;">A.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp; </span></span></span></strong><!--[endif]--><strong><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; color: black; mso-color-alt: windowtext;">Construction Phase</span></strong></p>
                                </td>
                              </tr>
                              <tr style="mso-yfti-irow: 2; mso-yfti-lastrow: yes;">
                                <td style="width: 820.688px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; background: rgb(208, 206, 206); padding: 0cm 5.4pt;" colspan="3" valign="top">
                                  <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style', serif; color: black; font-size: 10pt;">Site Development/Site Clearing</span></p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </center>
                      </div>

                      <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:98.3%;padding:10px" id="EM-A" class="editor">{{ $draft->ConstructionPhase }} </textarea>

                      <div class="row" style="overflow-x:auto;">
                        <center><br>
                          <table style="border-collapse: collapse; width: 822px; border-width: initial; border-spacing: 0px; border-color: initial; border-style: none;" border="1" width="633" cellspacing="0" cellpadding="0">
                           <tbody>
                           <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes;">
                           <td style="width: 474.65pt; border: solid; background: rgb(180, 198, 231); padding: 0cm 5.4pt;" valign="top" width="633">
                           <p class="MsoListParagraph" style="margin-left: 18.0pt; text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Bookman Old Style'; mso-bidi-font-family: 'Bookman Old Style'; mso-bidi-font-weight: bold; mso-bidi-font-style: italic;"><span style="mso-list: Ignore;">A.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp; </span></span></span><!--[endif]--><span lang="EN-US" style="font-size: 11.0pt; font-family: 'Bookman Old Style',serif; color: black; mso-color-alt: windowtext; mso-bidi-font-weight: bold; mso-bidi-font-style: italic;">Operation Phase</span></p>
                           </td>
                           </tr>
                           <tr style="mso-yfti-irow: 1; mso-yfti-lastrow: yes;">
                           <td style="width: 474.65pt; border-width: initial; border-style: none solid solid; border-color: initial; border-image: initial; background: rgb(208, 206, 206); padding: 0cm 5.4pt;" valign="top" width="633">
                           <p class="MsoNormal" style="margin-bottom: 0cm; margin-top: 0cm; mso-margin-bottom-alt: 12.75pt; mso-margin-top-alt: 0cm; mso-add-space: auto; line-height: normal;"><span lang="EN-US" style="font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; mso-bidi-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext;">Operation and Maintenance of the Main and Support Facilities</span></p>
                           </td>
                           </tr>
                           </tbody>
                           </table>
                        </center>
                      </div>

                      <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:98.3%;padding:10px" id="EM-B" class="editor">{{ $draft->OperationPhase }} </textarea>
                      </div>
                  </div>
                      <div class="tab-pane" id="tab_5">
                        <!--FIFTH TAB EDITABLE-->
                        <button type="button" class="btn btn-default pull-right" id="preview-fifth-page"><i class="fa fa-fw fa-eye"></i> Preview</button>
                        <button type="button" class="btn btn-default pull-right" id="fifth-page"><i class="fa fa-save"></i> Save</button>
                        <br><br>
                        <div class="box-body">
                          <br>
                          <div class="form-group">
                            <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">II.  GENERAL CONDITIONS</span></strong></p><br>
                          </div>

                          <div class="form-group"><br>
                            <textarea class="editor" id="GeneralConditions" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">{{ $draft->GeneralConditions }}</textarea>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="tab_6">
                        <!--FIFTH TAB EDITABLE-->
                        <button type="button" class="btn btn-default pull-right" id="preview-sixth-page"><i class="fa fa-fw fa-eye"></i> Preview</button>
                        <button type="button" class="btn btn-default pull-right" id="sixth-page"><i class="fa fa-save"></i> Save</button>
                        <br><br>
                        <div class="box-body">
                          <br>
                          <div class="form-group">
                            <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">III.  RESTRICTIONS</span></strong></p><br>
                          </div>

                          <div class="form-group"><br>
                            <textarea class="editor" id="Restrictions" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">{{ $draft->Restrictions }}</textarea>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="tab_7">
                        <!--FIFTH TAB EDITABLE-->
                        <button type="button" class="btn btn-default pull-right" id="preview-seventh-page"><i class="fa fa-fw fa-eye"></i> Preview</button>
                        <button type="button" class="btn btn-default pull-right" id="seventh-page"><i class="fa fa-save"></i> Save</button>
                        <br><br>
                        <div class="box-body">
                          <br>
                          <div class="form-group">
                            <center>
                              <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">PROJECT ASSESSMENT PLANNING TOOL</span></strong></p>
                                <br><br>
                              </center>
                          </div>

                          <div class="form-group"><br>
                            <textarea class="editor" id="PAPT" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">{{ $draft->PAPT }}</textarea>
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
  toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
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
 });

var ProjectGUID = "{{ $draft->ProjectGUID}}";

$(document).ready(function() {

  $.ajax({
      url: "{{route('ECCDraftData')}}",
      type: 'POST',
      data: {
        ProjectGUID : ProjectGUID,
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

        $('#body-editable p').each(function() {
            // get element text
            var text = $(this).html();
            // modify text
            text = text.replace('${projectname}', '{{$project->ProjectName}}');
            text = text.replace('${projectaddress}', '{{$project->Address}}');
            // update element text
            $(this).html(text); 
        });

        $('#this-is-to-certify-editable p').each(function() {
            // get element text
            var text = $(this).html();
            // modify text
            text = text.replace('${projectname}', '{{$project->ProjectName}}');
            text = text.replace('${projectaddress}', '{{$project->Address}}');
            text = text.replace('${proponentname}', '{{$project->ProponentName}}');
            text = text.replace('${representativedesignation}', '{{$project->Designation}}');
            text = text.replace('${representative}', '{{$project->Representative}}');
            // update element text
            $(this).html(text); 
        });

        $('#project-description-editable p').each(function() {
            // get element text
            var text = $(this).html();
            // modify text
            text = text.replace('${projectname}', '{{$project->ProjectName}}');
            text = text.replace('${region}', '{{$project->Region}}');
            text = text.replace('${projectaddress}', '{{$project->Address}}');
            text = text.replace('${projectdescription}', '{{$project->Description}}');

            // update element text
            $(this).html(text); 
        });

        $('#this-certificate-is-issued-editable p').each(function() {
            // get element text
            var text = $(this).html();
            // modify text
            text = text.replace('${projectname}', '{{$project->ProjectName}}');
            text = text.replace('${region}', '{{$project->Region}}');
            text = text.replace('${projectaddress}', '{{$project->Address}}');
            text = text.replace('${embaddress}', 'EMB Building, DENR Compound, Visayas Ave., Diliman, Quezon City');

            // update element text
            $(this).html(text); 
        });

        

        $('#sworn-accountability-statement-editable p').each(function() {
            // get element text
            var text = $(this).html();
            // modify text
            text = text.replace('${proponentname}', '{{$project->ProponentName}}');
            text = text.replace('${representativedesignation}', '{{$project->Designation}}');
            text = text.replace('${representative}', '{{$project->Representative}}');
            text = text.replace('${proponentaddress}', '{{$project->MailingAddress}}');
            // update element text
            $(this).html(text); 
        });
      }
    });

  


  $("#myTab").on('click', function() {

    // on load of the page: switch to the currently selected tab
      $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        // window.location.hash = id;
        // console.log(id);
        if(id === "tab_1"){
          $("#first-page-view").removeAttr("hidden");

          $("#second-page-view").attr("hidden","hidden");
          $("#third-page-view").attr("hidden","hidden");
          $("#fourth-page-view").attr("hidden","hidden");
          $("#fifth-page-view").attr("hidden","hidden");
          $("#sixth-page-view").attr("hidden","hidden");
          $("#seventh-page-view").attr("hidden","hidden");
        }else if(id === "tab_2"){
          $("#second-page-view").removeAttr("hidden");

          $("#first-page-view").attr("hidden","hidden");
          $("#third-page-view").attr("hidden","hidden");
          $("#fourth-page-view").attr("hidden","hidden");
          $("#fifth-page-view").attr("hidden","hidden");
          $("#sixth-page-view").attr("hidden","hidden");
          $("#seventh-page-view").attr("hidden","hidden");
        }else if(id === "tab_3"){
          $("#third-page-view").removeAttr("hidden");

          $("#first-page-view").attr("hidden","hidden");
          $("#second-page-view").attr("hidden","hidden");
          $("#fourth-page-view").attr("hidden","hidden");
          $("#fifth-page-view").attr("hidden","hidden");
          $("#sixth-page-view").attr("hidden","hidden");
          $("#seventh-page-view").attr("hidden","hidden");
        }else if(id === "tab_4"){
          $("#fourth-page-view").removeAttr("hidden");

          $("#first-page-view").attr("hidden","hidden");
          $("#second-page-view").attr("hidden","hidden");
          $("#third-page-view").attr("hidden","hidden");
          $("#fifth-page-view").attr("hidden","hidden");
          $("#sixth-page-view").attr("hidden","hidden");
          $("#seventh-page-view").attr("hidden","hidden");
        }else if(id === "tab_5"){
          $("#fifth-page-view").removeAttr("hidden");

          $("#first-page-view").attr("hidden","hidden");
          $("#second-page-view").attr("hidden","hidden");
          $("#third-page-view").attr("hidden","hidden");
          $("#fourth-page-view").attr("hidden","hidden");
          $("#sixth-page-view").attr("hidden","hidden");
          $("#seventh-page-view").attr("hidden","hidden");
        }else if(id === "tab_6"){
          $("#sixth-page-view").removeAttr("hidden");

          $("#first-page-view").attr("hidden","hidden");
          $("#second-page-view").attr("hidden","hidden");
          $("#third-page-view").attr("hidden","hidden");
          $("#fourth-page-view").attr("hidden","hidden");
          $("#fifth-page-view").attr("hidden","hidden");
          $("#seventh-page-view").attr("hidden","hidden");
        }else if(id === "tab_7"){
          $("#seventh-page-view").removeAttr("hidden");

          $("#first-page-view").attr("hidden","hidden");
          $("#second-page-view").attr("hidden","hidden");
          $("#third-page-view").attr("hidden","hidden");
          $("#fourth-page-view").attr("hidden","hidden");
          $("#fifth-page-view").attr("hidden","hidden");
          $("#sixth-page-view").attr("hidden","hidden");
        }
      });

      // on load of the page: switch to the currently selected tab
      var hash = window.location.hash;
      var activetab = $('#myTab a[href="' + hash + '"]').tab('show');

    });


  $("#first-page").on('click', function() {
    var Body = tinymce.get("Body").getContent();

    $.ajax({
      url: "{{route('PageSave')}}",
      type: 'POST',
      data: {
        ProjectGUID : ProjectGUID,
        content : Body,
        Page : 1,
        _token: '{{csrf_token()}}',
      },
      success: function(response){
        console.log(response);
        location.reload();
      }
    });
  });

  $("#second-page").on('click', function() {
    var ThisIsToCertify = tinymce.get("ThisIsToCertify").getContent();
    var ProjectDescription = tinymce.get("ProjectDescription").getContent();
    var ThisCertificateIsIssued = tinymce.get("ThisCertificateIsIssued").getContent();

    $.ajax({
      url: "{{route('PageSave')}}",
      type: 'POST',
      data: {
        ProjectGUID : ProjectGUID,
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
            url: "{{route('PageSave')}}",
            type: 'POST',
            data: {
              ProjectGUID : ProjectGUID,
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
            url: "{{route('PageSave')}}",
            type: 'POST',
            data: {
              ProjectGUID : ProjectGUID,
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
            url: "{{route('PageSave')}}",
            type: 'POST',
            data: {
              ProjectGUID : ProjectGUID,
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
            url: "{{route('PageSave')}}",
            type: 'POST',
            data: {
              ProjectGUID : ProjectGUID,
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
            url: "{{route('PageSave')}}",
            type: 'POST',
            data: {
              ProjectGUID : ProjectGUID,
              PAPT : PAPT,
              Page : 7,
              _token: '{{csrf_token()}}' ,
            },
            success: function(response){
                location.reload();

            }
        });

    });

    ///ONKEYUP
    window.onload = function () {
        tinymce.get('Body').on('keyup',function(e){
          var Body = tinymce.get("Body").getContent();
            $("#body-editable").html(Body);
        });

        tinymce.get('ThisIsToCertify').on('keyup',function(e){
          var ThisIsToCertify = tinymce.get("ThisIsToCertify").getContent();
            $("#this-is-to-certify-editable").html(ThisIsToCertify);
        });

        tinymce.get('ProjectDescription').on('keyup',function(e){
          var ProjectDescription = tinymce.get("ProjectDescription").getContent();
            $("#project-description-editable").html(ProjectDescription);
        });

        tinymce.get('ThisCertificateIsIssued').on('keyup',function(e){
          var ThisCertificateIsIssued = tinymce.get("ThisCertificateIsIssued").getContent();
            $("#this-certificate-is-issued-editable").html(ThisCertificateIsIssued);
        });
    }


    $("#preview-first-page").on('click', function() {
      var Body = tinymce.get("Body").getContent();

      $("#body-editable").html(Body);

      $('#body-editable p').each(function() {
            // get element text
            var text = $(this).html();
            // modify text
            text = text.replace('${projectname}', '{{$project->ProjectName}}');
            text = text.replace('${projectaddress}', '{{$project->Address}}');
            // update element text
            $(this).html(text); 
        });
    });

    $("#preview-second-page").on('click', function() {
      var ProjectDescription = tinymce.get("ProjectDescription").getContent();
      var ThisIsToCertify = tinymce.get("ThisIsToCertify").getContent();
      var ThisCertificateIsIssued = tinymce.get("ThisCertificateIsIssued").getContent();

      
      $("#this-certificate-is-issued-editable").html(ThisCertificateIsIssued);
      $("#this-is-to-certify-editable").html(ThisIsToCertify);
      $("#project-description-editable").html(ProjectDescription);

      $('#this-is-to-certify-editable p').each(function() {
            // get element text
            var text = $(this).html();
            // modify text
            text = text.replace('${projectname}', '{{$project->ProjectName}}');
            text = text.replace('${projectaddress}', '{{$project->Address}}');
            text = text.replace('${proponentname}', '{{$project->ProponentName}}');
            text = text.replace('${representativedesignation}', '{{$project->Designation}}');
            text = text.replace('${representative}', '{{$project->Representative}}');
            // update element text
            $(this).html(text); 
        });

        $('#project-description-editable p').each(function() {
            // get element text
            var text = $(this).html();
            // modify text
            text = text.replace('${projectname}', '{{$project->ProjectName}}');
            text = text.replace('${region}', '{{$project->Region}}');
            text = text.replace('${projectaddress}', '{{$project->Address}}');
            text = text.replace('${projectdescription}', '{{$project->Description}}');

            // update element text
            $(this).html(text); 
        });

        $('#this-certificate-is-issued-editable p').each(function() {
            // get element text
            var text = $(this).html();
            // modify text
            text = text.replace('${projectname}', '{{$project->ProjectName}}');
            text = text.replace('${region}', '{{$project->Region}}');
            text = text.replace('${projectaddress}', '{{$project->Address}}');
            text = text.replace('${embaddress}', 'EMB Building, DENR Compound, Visayas Ave., Diliman, Quezon City');

            // update element text
            $(this).html(text); 
        });

    });

    $("#preview-third-page").on('click', function() {
      var SwornAccountabilityStatement = tinymce.get("SwornAccountabilityStatement").getContent();

      
      $("#sworn-accountability-statement-editable").html(SwornAccountabilityStatement);

    });

    $("#preview-fourth-page").on('click', function() {
      var ConstructionPhase = tinymce.get("EM-A").getContent();
      var OperationPhase = tinymce.get("EM-B").getContent();

      
      $("#construction-phase-editable").html(ConstructionPhase);
      $("#operation-phase-editable").html(OperationPhase);
    });

    $("#preview-fifth-page").on('click', function() {
      var GeneralConditions = tinymce.get("GeneralConditions").getContent();

      
      $("#general-conditions-editable").html(GeneralConditions);
    });

    $("#preview-sixth-page").on('click', function() {
      var Restrictions = tinymce.get("Restrictions").getContent();

      
      $("#restrictions-editable").html(Restrictions);
    });

    $("#preview-seventh-page").on('click', function() {
      var PAPT = tinymce.get("PAPT").getContent();

      
      $("#papt-editable").html(PAPT);
    });

    $("#preview-all-page").on('click', function() {
      window.location.href = '/ecc-draft-print/' + ProjectGUID;

        // window.open('/ecc-draft-print/' + ProjectGUID, '_blank');
      // var Body = tinymce.get("Body").getContent();

      // $("#body-editable").html(Body);

      // var ProjectDescription = tinymce.get("ProjectDescription").getContent();
      // var ThisIsToCertify = tinymce.get("ThisIsToCertify").getContent();
      // var ThisCertificateIsIssued = tinymce.get("ThisCertificateIsIssued").getContent();

      
      // $("#this-certificate-is-issued-editable").html(ThisCertificateIsIssued);
      // $("#this-is-to-certify-editable").html(ThisIsToCertify);
      // $("#project-description-editable").html(ProjectDescription);

      // var SwornAccountabilityStatement = tinymce.get("SwornAccountabilityStatement").getContent();

      
      // $("#sworn-accountability-statement-editable").html(SwornAccountabilityStatement);

      // var EnvironmentalManagement = tinymce.get("EnvironmentalManagement").getContent();

      
      // $("#environmental-management-editable").html(EnvironmentalManagement);

      // var GeneralConditions = tinymce.get("GeneralConditions").getContent();

      
      // $("#general-conditions-editable").html(GeneralConditions);

      // var GeneralConditions = tinymce.get("GeneralConditions").getContent();

      
      // $("#general-conditions-editable").html(GeneralConditions);

      // var Restrictions = tinymce.get("Restrictions").getContent();

      
      // $("#restrictions-editable").html(Restrictions);

      // var PAPT = tinymce.get("PAPT").getContent();

      
      // $("#papt-editable").html(PAPT);

      // $("#first-page-view").removeAttr("hidden");
      // $("#second-page-view").removeAttr("hidden");
      // $("#third-page-view").removeAttr("hidden");
      // $("#fourth-page-view").removeAttr("hidden");
      // $("#fifth-page-view").removeAttr("hidden");
      // $("#sixth-page-view").removeAttr("hidden");
      // $("#seventh-page-view").removeAttr("hidden");
    });


    

    
    
});
  
</script>


</body>
</html>