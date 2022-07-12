<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
        name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="../../adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <title>ECC DRAFT </title>

        <link rel = "icon" type = "image/png" href="../../img/denr1.png">

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

    <body>
    
    <div class="container mt-4 mb-4">
        <!--Bootstrap classes arrange web page components into columns and rows in a grid -->
        <!-- <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-8">
                <h1 class="h2 mb-4">Submit issue</h1>
                <label>Describe the issue in detail</label>
                <div class="form-group">
                    <textarea id="editor"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div> -->
        <div class="box box-primary">
            <div class="box-header with-border" style="background-color:#106A9A; color:White; padding:10px;">
                <h3 class="box-title" style="font-weight:bold;">ECC DRAFT CERTIFICATE</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Custom Tabs -->
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

                                            <p>Subject:     <center><p class="MsoNormal" ><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 15.0pt; line-height: 107%; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: Calibri; mso-bidi-font-family: 'Times New Roman'; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;">ENVIRONMENTAL COMPLIANCE CERTIFICATE</span></strong></p></p>
                                        </div>
                                        <div class="form-group"><br>
                                            <textarea class="editor" id="Body">{{ $draft->Body }}</textarea>
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
                                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif; mso-fareast-font-family: 'Times New Roman';">ENVIRONMENTAL COMPLIANCE CERTIFICATE</span></strong></p>
                                        <p class="MsoNormal" style="margin-bottom: 0cm; text-align: center; line-height: normal;" align="center"><span style="font-family: 'Bookman Old Style', serif; font-size: 12pt;">(Issued under Presidential Decree 1586)</span></p>
                                        <p class="MsoNormal" style="margin-bottom: 0cm; margin-top: 0cm; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0cm; mso-add-space: auto; text-align: center; line-height: normal;" align="center"><strong style="mso-bidi-font-weight: normal;"><span lang="EN-US" style="font-size: 12.0pt; font-family: 'Bookman Old Style',serif;">${referenceno}</span></strong></p>

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

                                <!-- /.tab-pane -->
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
                                <div class="tab-pane" id="tab_4"><br><br>
                                ENVIRONMENTAL MANAGEMENT</div>
                                <div class="tab-pane" id="tab_5"><br><br>
                                GENERAL CONDITIONS</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

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

    

    $("#first-page").on('click', function() {

       var Body = tinymce.get("Body").getContent();

        $.ajax({
            url: "{{route('PageSave')}}",
            type: 'POST',
            data: {
              ProjectGUID : ProjectGUID,
              content : Body,
              Page : 1,
              _token: '{{csrf_token()}}' ,
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



});
</script>

</html>