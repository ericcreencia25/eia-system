<!doctype html>
<html lang="en">
<head>
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

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<style>
  html {
    height: 100%;
  }
  body {
      min-height: 100%;
  }

  .html2canvas-container { width: 3000px !important; height: 3000px !important; }
</style>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="Convert_HTML_To_PDF();">
<i class="fa fa-download"></i> Generate PDF
</button>
<body id="test">
<!-- <div class="wrapper"> -->


  <!-- Full Width Column -->
  <!-- <div class="content-wrapper"> -->
    <!-- <section class="content"> -->

      <div class="row" style="margin-top: 1.00cm; margin-left: 1.27cm; margin-right: 2.54cm; margin-bottom: 2.54cm; width: 21.59cm; height: 27.94cm;  ">
        <div class="col-md-12">
          <!--FIRST PREVIEW-->
          <div class="box box" id="first-page-view" style="border-top: none; height: 792pt;">
            <img src="../../img/CO-headCO.jpg" style="width: 21.59cm;">
            
            <div class="mailbox-read-message">
              <div class="form-group">
                
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt">${dategenerated}</p>
                <p style="font-size: 12pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"><b>${referenceno}</b></p>
                <p style="font-size: 12pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; margin-bottom: 0px"><b>{{$project->Representative}}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt; margin-bottom: 0px">{{$project->Designation}}</p>
                <p style="font-size: 12pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; margin-bottom: 0px"><b>{{$project->ProponentName}}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt; margin-bottom: 0px">{{$project->MailingAddress}}</p>
              </div>
              <br>
              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal; tab-stops: 105.0pt;">
                <span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">Subject: <span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><strong style="mso-bidi-font-weight: normal;"><span style="mso-spacerun: yes;">&nbsp;</span>ENVIRONMENTAL COMPLIANCE CERTIFICATE</strong></span></p><br>
              <div id="body-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              <br><br><br><br>
              <div class="form-group">
                <p style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';margin-bottom: 0px"><b>{{ $project->Director}}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 12pt;">{{$project->DirectorDesignation}}</p>
              </div>
            </div>
          </div>

          <!--SECOND PREVIEW-->
          <div  class="box box-default" id="second-page-view" style="border-top: none; height: 792pt;">
            <img src="../../img/CO-headCO.jpg" style="width: 21.59cm;">
            <div class="mailbox-read-message">
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
                    <p class="MsoNormal"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Recommending Approval:</span></p><br><br><br>
                    <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->EIAChief}}<br></span></strong></p>
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Chief, Clearance &amp; Permitting Division</span></p>
                  </div>
                  <div class="col-md-5">
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Approved:</span></p><br><br><br>
                    <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{ $project->Director}}<br></span></strong></p>
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->DirectorDesignation}}</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--THIRD PREVIEW-->
          <div  class="box box-default" id="third-page-view" style="border-top: none; height: 792pt;">
            <div class="mailbox-read-message">
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
          <div  class="box box-default" id="fourth-page-view" style="border-top: none;">
            <div class="mailbox-read-message">
              <div class="form-group">
                <p class="MsoNormal" style="margin-bottom: 0cm; text-align: right; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">ANNEX A</span></strong></p>
                <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">I. ENVIRONMENTAL MANAGEMENT</span></strong></p>
              </div>
              <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">All commitments, mitigating measures and monitoring requirements, especially those contained in the Initial Environmental Examination Checklist Report, particularly in the Environmental Management and Monitoring Plan (EMMoP), shall be instituted to minimize any adverse impact to the environment throughout the project implementation including among others the following, to wit:</span></p>
              <br>
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

          <!--FIFTH PREVIEW-->
          <div class="box box-default" id="fifth-page-view" style="border-top: none;">
            <div class="mailbox-read-message">
              <br>
              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">II.  GENERAL CONDITIONS</span></strong></p><br>
              <div id="general-conditions-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              <br><br>
            </div>
          </div>

          <!--SIXTH PREVIEW-->
          <div class="box box-default" id="sixth-page-view" style="border-top: none;">
            <div class="mailbox-read-message">
              <br>
              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">III.  RESTRICTIONS</span></strong></p><br>
              <div id="restrictions-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              <br><br><br><br>
            </div>
          </div>

          <!--LAST PREVIEW-->
          <div  class="box box-default" id="seventh-page-view" style="border-top: none; border-bottom: none;">
            <div class="mailbox-read-message" style="border-bottom: none; height: 792pt;">
              <div class="form-group">
                <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">PROJECT ASSESSMENT PLANNING TOOL</span></strong></p>
              </div>
              <br>
              
              <div id="papt-editable" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>
              <br><br>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-7">
                    <p class="MsoNormal"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Recommending Approval:</span></p><br><br><br>
                    <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->EIAChief}}<br></span></strong></p>
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Chief, Clearance &amp; Permitting Division</span></p>
                  </div>
                  <div class="col-md-5">
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">Approved:</span></p><br><br><br>
                    <p class="MsoNormal" style="margin-bottom: 0cm; text-align: justify; line-height: normal;"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->Director}}<br></span></strong></p>
                    <p><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">{{$project->DirectorDesignation}}</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      
    <!-- </section> -->
  <!-- </div> -->
<!-- </div> -->


<script src="../../adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"  crossorigin="anonymous"></script>
<script src="../../adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

<script>
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



});

function Convert_HTML_To_PDF() {
  var elementHTML = document.getElementById('test');

  html2canvas(elementHTML, {
   scrollX: 0,
        scrollY: 0,
        margin: [10, 20, 10, 20],
    useCORS: true,
    onrendered: function(canvas) {
      var pdf = new jsPDF('p', 'pt', 'letter');

      var pageHeight = 1090;
      var pageWidth = 900;

      // var body = document.body, html = document.documentElement;

      // var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );

      // console.log(body);
      // console.log(html);
      // console.log(height);

      for (var i = 0; i <= 8965 / pageHeight; i++) {
        var srcImg = canvas;
        var sX = 0;
        var sY = pageHeight * i; // start 1 pageHeight down for every new page
        var sWidth = pageWidth;
        var sHeight = pageHeight;
        var dX = 0;
        var dY = 0;
        var dWidth = pageWidth;
        var dHeight = pageHeight;

        window.onePageCanvas = document.createElement("canvas");
        onePageCanvas.setAttribute('width', pageWidth);
        onePageCanvas.setAttribute('height', pageHeight);
        var ctx = onePageCanvas.getContext('2d');
        ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);

        var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
        var width = onePageCanvas.width;
        var height = onePageCanvas.clientHeight;
          console.log(i);

        pdf.setFont("Bookman Old Style");
        pdf.setFontSize(10);
        if (i > 0) // if we're on anything other than the first page, add another page
          pdf.addPage(612, 792); // 8.5" x 12" in pts (inches*72)

        pdf.setPage(i + 1); // now we declare that we're working on that page
        pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width * .62), (height * .62)); // add content to the page
        pdf.text(50,755,'Environmental Compliance Certificate');
        pdf.text(50,765,'{{$project->ProjectName}}');
        pdf.text(50,775,'{{$project->ProponentName}}');
        
      }
      // myImage = '<img src="https://iis.emb.gov.ph/iis-images/document-header/CO-headCO.gif">';
      // var myImage = 'data:image/jpeg;base64,'+ Base64.encode('https://iis.emb.gov.ph/iis-images/document-header/CO-headCO.gif');
      // pdf.addImage(myImage, 'GIF', 10, 30, 150, 76);

    // Save the PDF
      pdf.save('document.pdf');
    }
  });

}
</script>

</body>
</html>