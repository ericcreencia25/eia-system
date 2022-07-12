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
        <div class="col-md-7">
          <div class="box box-default">
            <div class="mailbox-read-message" style="margin: 50px">
              <div class="form-group">
                <p style="font-family: 'Bookman Old Style', serif; font-size: 10pt;">${dategenerated}</p>
                <p style="font-size: 10pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"><b>${referenceno}</b></p>
                <p style="font-size: 10pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; margin-bottom: 0px"><b>${representative}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 10pt; margin-bottom: 0px">${representativedesignation}</p>
                <p style="font-size: 10pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman'; margin-bottom: 0px"><b>${proponentname}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 10pt; margin-bottom: 0px">${proponentaddress}</p>
              </div>
              <br>
              <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal; tab-stops: 105.0pt;"><span lang="EN-US" style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">Subject: <span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><strong style="mso-bidi-font-weight: normal;"><span style="mso-spacerun: yes;">&nbsp;</span>ENVIRONMENTAL COMPLIANCE CERTIFICATE</strong></span></p><br>
              
              <div id="body-editable" style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"></div>

              <br><br><br><br>
              <div class="form-group">
                <p style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';"><b>${approver}</b></p>
                <p style="font-family: 'Bookman Old Style', serif; font-size: 10pt;">${approverdesignation}</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-5">
          <div class="box box-default">
            <div class="row">
              <div class="col-md-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">First Page</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Second Page</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Sworn Accountability Statement</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Environmental Management</a></li>
                    <li><a href="#tab_5" data-toggle="tab">General Conditions</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1"><br><br>
                      <button type="button" class="btn btn-primary pull-right" id="first-page">Save</button>

                      <div class="box-body">
                        <br>
                        <div class="form-group">
                          <p class="MsoNormal" style="margin-bottom: 0cm; line-height: normal; tab-stops: 105.0pt;"><span lang="EN-US" style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">Subject: <span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><strong style="mso-bidi-font-weight: normal;"><span style="mso-spacerun: yes;">&nbsp;</span>ENVIRONMENTAL COMPLIANCE CERTIFICATE</strong></span></p><br>
                        </div>

                        <div class="form-group"><br>
                          <textarea class="editor" id="Body" style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">{{ $draft->Body }}</textarea>
                        </div>
                        <div class="form-group">
                          <p><b>${approver}</b></p>
                          <p>${approverdesignation}</p>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="tab_2"><br><br>
                      <button type="submit" class="btn btn-primary pull-right" id="second-page">Save</button>
                      <div class="box-body">
                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">ENVIRONMENTAL COMPLIANCE CERTIFICATE</span></strong></p>
                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><span style="font-family: 'Bookman Old Style', serif; font-size: 10pt;">(Issued under Presidential Decree 1586)</span></p>
                        <p class="MsoNormal" style="margin-bottom: 0cm; margin-top: 0cm; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0cm; mso-add-space: auto; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 10.0pt; font-family: 'Bookman Old Style',serif;">${referenceno}</span></strong></p>
                        <div class="form-group">
                          <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:98.3%;padding:10px" id="ThisIsToCertify" class="editor">{{ $draft->ThisIsToCertify }}</textarea>
                        </div>
                        <center>
                          <h4 style="padding-top: 1px; padding-bottom: 1px; font-size: 30px;"><b>PROJECT DESCRIPTION</b></h4><br><br>
                        </center>

                        <div class="form-group">
                          <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:98.3%;padding:10px" id="ProjectDescription" class="editor">{{ $draft->ProjectDescription }}</textarea>
                        </div>

                        <div class="form-group">
                          <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:98.3%;padding:10px" id="ThisCertificateIsIssued" class="editor">{{ $draft->ThisCertificateIsIssued }}</textarea>
                        </div>

                        <div class="form-group">
                          <div class="col-md-6">
                            <p>Recommending Approval:</p><br>
                            <p><b>${eiachief}</b></p>
                            <p>Chief, Clearance & Permitting Division</p>
                          </div>
                          <div class="col-md-6">
                            <p>Approved:</p><br>
                            <p><b>${approver}</b></p>
                            <p>${approverdesignation}</p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="tab_3"><br><br>
                      <button type="submit" class="btn btn-primary pull-right" id="third-page">Save</button>
                      <div class="box-body">
                        <center>
                          <h4 style="padding-top: 1px; padding-bottom: 1px; font-size: 30px;"><b>SWORN ACCOUNTABILITY STATEMENT</b></h4><br><br>
                        </center>
                        <div class="form-group">
                          <textarea rows="2" cols="20" style="font-family:Tahoma;font-size:18px;height:200px;width:98.3%;padding:10px" id="SwornAccountabilityStatement" class="editor">{{ $draft->SwornAccountabilityStatement }}</textarea>
                        </div>

                        <div class="col-md-12">
                          <div class="col-md-9"></div>
                          <div class="col-md-3">
                            <p>____________________</p>
                            <p>${representative}</p>
                            <p>Signature</p>
                            <br>
                            <p>TIN No. _____________</p>
                            <br>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <p>Subscribed and sworn before me this ________, the above-named affiant taking oath presenting  ________________________________, issued on _______________________________ at _____________. </p>
                        </div>


                        <div class="form-group">
                          <div class="col-md-6">
                            <br>
                            <p>Doc. No. __________</p>
                            <p>Page No. __________ </p>
                            <p>Book No. __________</p>
                            <p>Series of ___________</p>
                          </div>

                          <div class="col-md-6">
                            <p>Notary Public</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="tab_4">
                      <br><br> ENVIRONMENTAL MANAGEMENT</div>
                      <div class="tab-pane" id="tab_5">
                        <br><br>GENERAL CONDITIONS
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
  selector: 'textarea.editor',
  plugins: 'lists, link, image, media, nonbreaking',
  toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help | nonbreaking',
  menubar: false,
  // plugins: "nonbreaking",
  // mewnubar: "insert",
  // toolbar: "nonbreaking",
  nonbreaking_force_tab: true,
  setup: (editor) => {
      // Apply the focus effect
      editor.on("init", () => {
      editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
        });
      editor.on("focus", () => { (editor.getContainer().style.boxShadow = "0 0 0 .2rem rgba(0, 123, 255, .25)"),
      (editor.getContainer().style.borderColor = "#80bdff");
        });
      editor.on("blur", () => {
      (editor.getContainer().style.boxShadow = ""),
      (editor.getContainer().style.borderColor = "");
        });
      },
    });

var ProjectGUID = "{{ $draft->ProjectGUID}}";

$(document).ready(function() {

  alert("dsds");

  // $("#body-editable").html("{{ $draft->Body }}");

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
                console.log(response);
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

     window.onload = function () {
        tinymce.get('Body').on('keyup',function(e){
          var Body = tinymce.get("Body").getContent();
            $("#body-editable").html(Body);
        });
    }
});
  
</script>


</body>
</html>