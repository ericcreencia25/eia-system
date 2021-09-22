@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>New ECC Application</a></li>
            <li class="active"><i class="fa fa-user"></i>Description of proposed project</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="box box-default">
          <div class="box-header with-border">
            <h1 class="box-title"><b>New ECC Application </b></h1>
            <button type="button" class="pull-right btn btn-block btn-danger btn-sm" style="width: 70px; height:30px">Reset</button>
            <br>
            <small style=" color:red; font-style:bold;">Note: You need to reach Step 6 to save entries and return to this application.</small>
          </div>
          <div class="box-body">
            <button type="button" class="pull-right btn btn-default" id="sendEmail">Next    <i class="fa fa-arrow-circle-right" onclick="window.location='{{ url("new_applications/1") }}'"></i></button>
            <button type="button" class="pull-right btn btn-default" id="sendEmail"><i class="fa fa-arrow-circle-left" onclick="window.location='{{ url("new_applications/1") }}'"></i>Previous</button>

            <h4><b>7. ECC Application Requirements</b><br></h4>
            <i>
              Click the browse button to select the scanned copy of the requirement then click the 'Upload' arrow to attach the file or the bin icon to remove the uploaded file. You can click the description to view the uploaded file. Only PDF file is allowed not larger than 10MB.
            </i>

            <br><br>
            <div style="padding-top:5px;">
                <div>
                    <table cellspacing="0" cellpadding="5" rules="rows" border="1" id="ContentPlaceHolder1_gvRequirements" style="border-style:None;width:100%;border-collapse:collapse;">
                        <tbody><tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Project Description</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name=" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Environmental Impact and Management Plan</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;"> 
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Abandonment / Decommissioning / Rehabilitation Information</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Geotagged photographs of project site (taken for last 30 days)</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;"> 
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Topographic Map of impact/affected areas (at least 1km from the project boundaries)</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Certification from LGU on the compatibility of proposed project with existing land use plan</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Site Development and/or Vicinity map signed by registered professionals</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Project/Plant layout signed by registered professionals</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Schematic diagram of wastewater treatment facility</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Schematic diagram of Air Pollution Control Facility</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="''" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Organizational Chart in charge on environmental concerns</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Proof of authority over the project site (land title, lease contract, deed of absolute sale, etc.)</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Duly notarized accountability statement of proponent </a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="" id="" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="">
                                    <a id="" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Duly accomplished project environmental monitoring and audit prioritization scheme (PEMAPS) questionnaire</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl15$fUpload" id="ContentPlaceHolder1_gvRequirements_fUpload_13" style="border-width:0px;border-style:None;font-size:Medium;width:300px;"> 
                            </td>
                            <td>
                                <input type="image" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl15$ImgUpload" id="ContentPlaceHolder1_gvRequirements_ImgUpload_13" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl15$ImgRemove" id="ContentPlaceHolder1_gvRequirements_ImgRemove_13" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="ContentPlaceHolder1_gvRequirements_lblFiles_14" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="ContentPlaceHolder1_gvRequirements_UpdatePanel2_14">
                                    <a id="ContentPlaceHolder1_gvRequirements_hlDescription_14" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">IEE Checlist Sworn Statement</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl16$fUpload" id="ContentPlaceHolder1_gvRequirements_fUpload_14" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl16$ImgUpload" id="ContentPlaceHolder1_gvRequirements_ImgUpload_14" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl16$ImgRemove" id="ContentPlaceHolder1_gvRequirements_ImgRemove_14" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="ContentPlaceHolder1_gvRequirements_lblFiles_15" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="ContentPlaceHolder1_gvRequirements_UpdatePanel2_15">
                                    <a id="ContentPlaceHolder1_gvRequirements_hlDescription_15" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Affidavit of No Complaint</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl17$fUpload" id="ContentPlaceHolder1_gvRequirements_fUpload_15" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl17$ImgUpload" id="ContentPlaceHolder1_gvRequirements_ImgUpload_15" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl17$ImgRemove" id="ContentPlaceHolder1_gvRequirements_ImgRemove_15" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                    Files: <span id="ContentPlaceHolder1_gvRequirements_lblFiles_16" title="Files Attached">0</span>
                                </div>
                            </td>
                            <td>
                                <div id="ContentPlaceHolder1_gvRequirements_UpdatePanel2_16">
                                    <a id="ContentPlaceHolder1_gvRequirements_hlDescription_16" title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">Project Components &amp; Operation Information</a>
                                </div>
                            </td>
                            <td>
                                <input type="file" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl18$fUpload" id="ContentPlaceHolder1_gvRequirements_fUpload_16" style="border-width:0px;border-style:None;font-size:Medium;width:300px;">
                            </td>
                            <td>
                                <input type="image" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl18$ImgUpload" id="ContentPlaceHolder1_gvRequirements_ImgUpload_16" title="Click here to upload file." src="../img/upload.png" style="width:15px;">
                            </td>
                            <td>
                                <input type="image" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl18$ImgRemove" id="ContentPlaceHolder1_gvRequirements_ImgRemove_16" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('Remove the updated file?');" style="width:15px;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>
</div>
@stop