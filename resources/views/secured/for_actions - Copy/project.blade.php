@extends('layouts.adminlte.default.layout')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>Project Application</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="box box-default">
            <div style="padding:10px;">
                <h2><b>Proponent Name - Somewhere, Maasim, Saranggani<br>Purpose: Amendment of ECC No. ECC-2929292</b></h2>
                <div id="ContentPlaceHolder1_pnAttachments" style="width: 70%; background-color: white; display: none; position: fixed;">
                    <div style="background-color:RGB(16,106,154); padding:5px; color:White;">
                        <table width="100%">
                            <tbody><tr>
                                <td>Click the the link below to view the attachment.</td>
                                <td style="width:40px;">
                                    <input type="submit" name="" value="X" id="" style="color:White;background-color:#1E8CBE;border-style:None;">
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div style="padding:10px;">
                        <div id="ContentPlaceHolder1_Panel1" style="height:320px;overflow-y:scroll;">
                        </div>
                    </div>
                </div>
                <div class="dvinfo">
                    <div style="  padding-bottom:5px; font-size:9pt; ">Instruction: Scroll down to review the project information/requirements below. Use Endorse Application to forward the application to the concerned for appropriate action. You can view the routing history and previous attachments at the bottom of the page.</div>
                    <div id="ContentPlaceHolder1_dvrequirements">
                        <div style="padding-top:5px; padding-left:5px;">
                            <div style="font-weight:bold;   background-color:#106A9A; color:White; cursor:pointer;">
                                <table style="width:100%;">
                                    <tbody><tr>
                                        <td>APPLICATION REQUIREMENTS&nbsp;&nbsp;&nbsp;
                                            <a id="" title="Click to load requirements in browsing mode" href="" style="background-color:Yellow;text-decoration:none;padding:3px; font-size:8pt;">Browsing Mode</a>
                                        </td>
                                        <td style="width:5%; text-align:right">
                                            <input type="image" name="" id="" title="Click here to view in map" class="imgbutton" src="../img/globe.jpg" style="background-color:White;width:20px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <table class="gridview" cellspacing="0" cellpadding="5" rules="rows" border="1" id="" style="border-style:None;font-size:11pt;width:100%;border-collapse:collapse;">
                                <tbody>
                                    <tr>
                                        <th scope="col" style="width:3%;">Complied</th><th align="left" scope="col">Description</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="" type="checkbox" name="" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl02$Description','')" style="text-decoration:none;">Project Description</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl03$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl03$Description','')" style="text-decoration:none;">Environmental Impact and Management Plan</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl04$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl04$Description','')" style="text-decoration:none;">Abandonment / Decommissioning / Rehabilitation Information</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl05$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl05$Description','')" style="text-decoration:none;">Geotagged photographs of project site (taken for last 30 days)</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl06$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl06$Description','')" style="text-decoration:none;">Topographic Map of impact/affected areas (at least 1km from the project boundaries)</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl07$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl07$Description','')" style="text-decoration:none;">Certification from LGU on the compatibility of proposed project with existing land use plan</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl08$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl08$Description','')" style="text-decoration:none;">Site Development and/or Vicinity map signed by registered professionals</a>
                                            <span style="font-style:italic;">(Required)</span>
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl09$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_7" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl09$Description','')" style="text-decoration:none;">Project/Plant layout signed by registered professionals</a>
                                            <span style="font-style:italic;">(Required)</span>
                                            <span style="background-color:yellow;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_8" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl10$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_8" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl10$Description','')" style="text-decoration:none;">Schematic diagram of wastewater treatment facility</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_9" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl11$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_9" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl11$Description','')" style="text-decoration:none;">Schematic diagram of Air Pollution Control Facility</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_10" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl12$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_10" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl12$Description','')" style="text-decoration:none;">Organizational Chart in charge on environmental concerns</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_11" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl13$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_11" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl13$Description','')" style="text-decoration:none;">Proof of authority over the project site (land title, lease contract, deed of absolute sale, etc.)</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_12" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl14$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_12" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl14$Description','')" style="text-decoration:none;">Duly notarized accountability statement of proponent </a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_13" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl15$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_13" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl15$Description','')" style="text-decoration:none;">Others (Optional)</a>
                                            <span style="font-style:italic;">(Not Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_14" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl16$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_14" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl16$Description','')" style="text-decoration:none;">Duly accomplished project environmental monitoring and audit prioritization scheme (PEMAPS) questionnaire</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_15" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl17$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_15" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl17$Description','')" style="text-decoration:none;">IEE Checlist Sworn Statement</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_16" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl18$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_16" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl18$Description','')" style="text-decoration:none;">Bank Receipt (Application Fee)</a>
                                            <span style="font-style:italic;">(Not Required)</span> 
                                            <span style="background-color:yellow;">&nbsp;-Please dont forget to require (tick) this item once the rest of the requirements are satisfied.</span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_17" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl19$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_17" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl19$Description','')" style="text-decoration:none;">Affidavit of No Complaint</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox2_18" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl20$CheckBox2" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <a id="ContentPlaceHolder1_gvRequirements_Description_18" title="Click here to evaluate documents" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$gvRequirements$ctl20$Description','')" style="text-decoration:none;">Project Components &amp; Operation Information</a>
                                            <span style="font-style:italic;">(Required)</span> 
                                            <span style="background-color:yellow;"></span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="aspNetDisabled"><input id="ContentPlaceHolder1_gvRequirements_CheckBox3" type="checkbox" name="ctl00$ContentPlaceHolder1$gvRequirements$ctl21$CheckBox3" disabled="disabled"></span>
                                        </td>
                                        <td>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="" id="" style="border-style:None;width:99%;">
                                                            <option value=""></option>
                                                            <option value="Area status clearance for quarry project">Area status clearance for quarry project</option>
                                                            <option value="CENRO certification on the status of project area">CENRO certification on the status of project area</option>
                                                            <option value="Certificate of compliance on the easement from Boracay Redevelopment Task Force">Certificate of compliance on the easement from Boracay Redevelopment Task Force</option>
                                                            <option value="Certificate of connection from BWSS (for Boracay Projects)">Certificate of connection from BWSS (for Boracay Projects)</option>
                                                            <option value="Certification from Biodiversity Management Bureau (BMB) that it has undergone their review consistent with the objectives of DENR MC No. 2016-745">Certification from Biodiversity Management Bureau (BMB) that it has undergone their review consistent with the objectives of DENR MC No. 2016-745</option>
                                                            <option value="Certification of non-overlapped on ancestral domain">Certification of non-overlapped on ancestral domain</option>
                                                            <option value="Clearance from DENR Secretary">Clearance from DENR Secretary</option>
                                                            <option value="Clearance from the DENR Regional Director that the project is consistent with the classification established by Law">Clearance from the DENR Regional Director that the project is consistent with the classification established by Law</option>
                                                            <option value="Clearance from the Regional Executive Director (for Tagaytay Projects)">Clearance from the Regional Executive Director (for Tagaytay Projects)</option>
                                                            <option value="Department of Tourism endorsement (for Boracay Projects)">Department of Tourism endorsement (for Boracay Projects)</option>
                                                            <option value="Geohazard Identification Report">Geohazard Identification Report</option>
                                                            <option value="MARO/PARO Certification that the area is not suitable for agricultural purposes">MARO/PARO Certification that the area is not suitable for agricultural purposes</option>
                                                            <option value="PAMB resolution for projects in protected area">PAMB resolution for projects in protected area</option>
                                                            <option value="Proof of Payment for Operating without ECC">Proof of Payment for Operating without ECC</option>
                                                            <option value="Resource use plan for forestry project">Resource use plan for forestry project</option>
                                                            <option value="SEP Clearance (for Palawan Projects)">SEP Clearance (for Palawan Projects)</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="submit" name="" class="btn btn-default" value="add" onclick="return confirm('Add this requirement?');" id="">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="button" name="" value="" onclick="" id="" style="display: none">
                    <div id="" style="width: 90%; background-color: white; display: none; position: fixed;">
                        <div style=" background-color:#106A9A; padding:5px; color:White;">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td>Click the the link below to view the attachment and provide remarks if it did not pass the screening/evaluation/review</td>
                                        <td>
                                            <input type="submit" name="ctl00$ContentPlaceHolder1$btnClose" value="X" id="ContentPlaceHolder1_btnClose">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="padding:10px;">
                            <table style="width:100%">
                                <tbody><tr>
                                     <td>Attachment: <a id="ContentPlaceHolder1_hlDescription" target="_blank" style="text-decoration:none;"></a>
                                        <span id="ContentPlaceHolder1_lblDescriptionDate" style="color:Silver;font-size:7pt;"></span>
                                    </td>
                                    <td style="text-align:right; padding-right:20px;">
                                        <span class="radiobut" title="Tick if Required"><input id="ContentPlaceHolder1_chkRequired" type="checkbox" name="ctl00$ContentPlaceHolder1$chkRequired"><label for="ContentPlaceHolder1_chkRequired">Required</label></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                         <table class="tablecs" width="100%">
                            <tbody>
                                <tr>
                                    <td> 
                                        <textarea name="ctl00$ContentPlaceHolder1$Remarks" rows="2" cols="20" id="ContentPlaceHolder1_Remarks" style="height:200px;"></textarea>
                                        <input type="hidden" name="ctl00$ContentPlaceHolder1$TextBoxWatermarkExtender3_ClientState" id="ContentPlaceHolder1_TextBoxWatermarkExtender3_ClientState">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="padding-top:10px;padding-bottom:10px;">
                            <span class="radiobut" title="Tick if compliant"><input id="ContentPlaceHolder1_chkCompliant" type="checkbox" name="ctl00$ContentPlaceHolder1$chkCompliant"><label for="ContentPlaceHolder1_chkCompliant">The submitted documents passed the screening/evaluation/review.</label></span>
                        </div>
                        <div style=" padding:2px;">
                            <input type="submit" name="ctl00$ContentPlaceHolder1$btnSave" value="Save" id="ContentPlaceHolder1_btnSave" style="color:White;background-color:#3079ED;border-color:#3079ED;border-style:Solid;width:100px;padding:5px;">
                            <input type="submit" name="ctl00$ContentPlaceHolder1$btnCancel" value="Cancel" id="ContentPlaceHolder1_btnCancel" style="border-style:None;width:100px;padding:5px;">
                        &nbsp;<span id="ContentPlaceHolder1_Label1" style="font-size:8pt;"></span>
                    </div>
                </div><br>
            </div><br>
            <div style="padding-bottom:5px; font-size:small;">
                <span id="ContentPlaceHolder1_lblAccept"></span>
           </div> 
           <table width="100%">
            <tbody>
                <tr>
                    <td style="width:18%;">
                        <input  class="btn btn-default"  type="submit" name="" value="Generate Evaluation Report" onclick="return confirm('Do you want to generate a report based on the evaluation of the above requirements? The generated report will be added immediately as attachment below.');" id="" style="text-decoration:none;width:100%;">
                    </td>
                        <td style="width:18%;">
                            <input  class="btn btn-default"  type="submit" name="ctl00$ContentPlaceHolder1$btnGenOrder" value="Generate Order of Payment" onclick="return confirm('Do you want to generate an order of payment for this application? The generated document will be added immediately as attachment below. Please make sure you update (if necessary) the amount in the Order of Payment to correspond to the fee/s appropriate for this application. See EMB Manual of Fees for reference.');" id="ContentPlaceHolder1_btnGenOrder" style="text-decoration:none;width:100%;">
                        </td>
                        <td style="width:18%;">
                            <input class="btn btn-default"  type="submit" name="ctl00$ContentPlaceHolder1$lnkAcceptance" value="Accept Application" onclick="return confirm('By clicking OK, you confirm that the submitted application and required documents (INCLUDING ECC APPLICATION FEE) were screened and found complete and accepted for processing.');" id="ContentPlaceHolder1_lnkAcceptance" style="text-decoration:none;width:100%;">
                        </td>
                        <td style="width:15%;">
                            <input class="btn btn-default"  type="submit" name="ctl00$ContentPlaceHolder1$btnDraftECC" value="Draft Certificate" onclick="return confirm('Do you want to generate a draft ECC for this application? The generated draft document  will be in docx format for editing purposes and will be added immediately as attachment below. Please make sure you have word editor installed in your machine.');" id="ContentPlaceHolder1_btnDraftECC" style="text-decoration:none;width:100%;"></td>
                            <td style="width:15%;">
                                <input class="btn btn-default"  type="submit" name="ctl00$ContentPlaceHolder1$btnDraftDenial" value="Draft Denial Letter" onclick="return confirm('Do you want to generate a draft denial letter for this application? The generated draft document will be in docx format for editing purposes and will be added immediately as attachment below. Please make sure you have word editor installed in your machine.');" id="ContentPlaceHolder1_btnDraftDenial" style="text-decoration:none;width:100%;">
                            </td>
                            <td></td>
                        </tr>
 
             </tbody>
         </table>
         <div id="ContentPlaceHolder1_mpext_backgroundElement" class="modalBackgroundgray" style="display: none; position: fixed; left: 0px; top: 0px;">
         </div>
     </div>
     <br>
     <div style="padding-bottom:10px;">
        <b>Recent Activity/Comments:</b> <a id="" href="" style="text-decoration:none;">For Screening - ECC Application Requirements Submitted for Screening</a> - 
        <span id="" style="font-size:Smaller;">DEMETRIO2021 on 6/12/2021 12:12:50 PM</span>
    </div>
    <div id="">
        <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:5px;  cursor:pointer;">ENDORSE APPLICATION
        </div><br>
        <div>
            <b>1. Attachments </b><div style="padding-bottom:10px; padding-top:10px;"><span style="font-size:smaller;">Select from the list or specify the description of the document and browse to locate the electronic copy. Click the upload icon to attach the file. Size of the file should be no larger than  <span id="ContentPlaceHolder1_lblMaxFileSize">10</span>&nbsp;MEGABYTES.
           </span></div>
       </div>
           <table cellspacing="0" cellpadding="2" width="100%">
            <tbody>
                <tr>
                    <td style="width:50%;">
                        <select class="form-control" name="" onchange="" id="">
                            <option selected="selected" value="Evaluation Report">Evaluation Report</option>
                            <option value="Inspection Report">Inspection Report</option>
                            <option value="Draft ECC">Draft ECC</option>
                            <option value="Draft Denial Letter">Draft Denial Letter</option>
                            <option value="Others, specify">Others, specify</option>
                        </select>
                        <input type="hidden" name="" id="">
                    </td>
                    <td style="vertical-align:top;">
                        <input type="file" name="ctl00$ContentPlaceHolder1$fUpload" id="ContentPlaceHolder1_fUpload" style="border-width:0px;border-style:None;font-size:Medium;width:98%;"> 
                    </td>
                    <td style="width:2%; text-align:right; vertical-align:top;">
                        <input type="image" name="ctl00$ContentPlaceHolder1$imgUpload" id="ContentPlaceHolder1_imgUpload" title="Click here to upload the attachment" src="../img/upload.png" style="width:15px;">
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <b>2. Routing</b><div style="padding-bottom:10px; padding-top:10px;"><span style="font-size:smaller;">Select the destination, action required and provide the remarks.
        </span>
    </div>
    <table style="width:100%; vertical-align:top;">
        <tbody>
            <tr>
                <td>Destination</td>
                <td style="width:35%">
                    <select class="form-control" name="" onchange="" id="">
                        <option selected="selected" value="Proponent">Proponent</option>
                        <option value="R07">R07</option>
                    </select>
                </td>
                <td colspan="2">
                    <select class="form-control" name="" onchange="" id="">
                        <option selected="selected" value="DEMETRIO2021">DEMETRIO2021</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;">
                    <span id="ContentPlaceHolder1_lblActionRequired">Action Required</span>
                </td>
                <td colspan="3">
                    <select class="form-control" name="" onchange="" id="">
                        <option value="For Submission of Basic Requirements">For Submission of Basic Requirements</option>
                        <option value="For Submission of Additional Information">For Submission of Additional Information</option>
                        <option value="For Clarification of Information">For Clarification of Information</option>
                        <option value="For Payment of ECC Application">For Payment of ECC Application</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td> </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td style="width:15%;  vertical-align:top;">Remarks</td>
                <td colspan="3">
                    <textarea name="" rows="2" cols="100" id="" style="font-family:Tahoma;font-size:Medium;height:200px;"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <table>
                        <tbody>
                            <tr>
                                <td><input id="" type="checkbox" name="" checked="checked"></td>
                                <td>Include attachments</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="text-align:right; font-size:9pt; color:red;    ">Make sure local <a id="" href="Holidays.aspx" target="_blank">holidays</a> were already entered before routing
                </td>
                <td style="text-align:right; padding-top:10px; width:20%; "> 
                    <input  class="btn btn-default"  type="submit" name="ctl00$ContentPlaceHolder1$btnPostRouting" value="Endorse" onclick="return confirm('Forward the application to the selected destination?');" id="ContentPlaceHolder1_btnPostRouting" class="postbutton" style="width:100px;">
                    <input  class="btn btn-default"  type="submit" name="ctl00$ContentPlaceHolder1$btnCancelRouting" value="Cancel" id="ContentPlaceHolder1_btnCancelRouting" style="width:100px;">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- <div style="background-color:Whitesmoke; "> -->
    <div style="padding:10px;">
        <div style="padding-top:10px;">
            <div style="font-weight:bold;   background-color:#106A9A; color:White; cursor:pointer;">ROUTING HISTORY</div>
            <table id="" class="table table-striped" >
                <tbody>
                    <tr>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Posted on</th>
                    <th style="width: 100px">by</th>
                  </tr>
                    <tr>
                        <td>
                            <div style="padding-top:5px; padding-bottom:5px;">
                                <a id="" title="Click here to view the attachments." href="" style="text-decoration:none;"> Forwarded to Fred Virgil Barriga (R07)<span style="font-size:small;">&nbsp;(0 Accumulated Days)</span></a>
                            </div>
                        </td>
                        <td>
                            <i>For Screening</i>
                        </td>
                        <td>
                            <span style="font-size:8pt;">Aug 23, 2021 09:51 AM</span>
                        </td>
                        <td>
                            <span style="font-size:8pt;">DEMETRIO2021  (Proponent)</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div style="font-weight:bold;background-color:#106A9A; color:White; padding:5px;  cursor:pointer;">ATTACHMENTS</div>
        <table  class="table table-striped" cellspacing="0" autogeneratecolumns="false" style="font-size:11pt;width:100%;border-collapse:collapse;">
            <tbody>
                <tr>
                    <th>Details</th>
                    <th>Posted on</th>
                    <th style="width: 100px">by</th>
                  </tr>
                <tr>
                    <td>
                        <div style="padding-bottom:5px; padding-top:5px;">
                            <a id="" href="" target="_blank" style="text-decoration:none;">Project/Plant layout signed by registered professionals</a>
                        </div>
                    </td>
                    <td>
                        <span style="font-size:8pt;">Aug 23, 2021 09:51 AM</span>
                    </td>
                    <td>
                        <span style="font-size:8pt;">demetrio2021</span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div style="padding-bottom:5px; padding-top:5px;">
                            <a id="" href="" target="_blank" style="text-decoration:none;">Site Development and/or Vicinity map signed by registered professionals</a>
                        </div>
                    </td>
                    <td>
                        <span style="font-size:8pt;">Aug 23, 2021 09:50 AM</span>
                    </td>
                    <td>
                        <span style="font-size:8pt;">demetrio2021</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding-bottom:5px; padding-top:5px;">
                            <a id="" href="" target="_blank" style="text-decoration:none;">Project Components &amp; Operation Information</a>
                            <span style="font-size:8pt;">Posted on Aug 23, 2021 09:50 AM by demetrio2021</span>
                        </div>
                    </td>
                    <td>
                        <span style="font-size:8pt;">Aug 23, 2021 09:50 AM</span>
                    </td>
                    <td>
                        <span style="font-size:8pt;">demetrio2021</span>
                    </td>
                </tr>
                
        </tbody>
    </table>
    <br>
    <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:5px;  cursor:pointer;">PROCESSING DAYS</div>
    <div style="padding-top:10px; font-size:8pt;"></div>
    <table id="" class="table table-striped" cellspacing="0" autogeneratecolumns="false" style="font-size:11pt;width:100%;border-collapse:collapse;">
        <tbody>
            <tr>
                <td>
                    <table style="width:100%; font-weight:bold; " cellspacing="0" cellpadding="5">
                        <tbody>
                            <tr>
                                <td style="border-bottom:Solid 1px Silver; width:60%">Routing</td>
                                <td style="border-bottom:Solid 1px Silver; width:10%; text-align:center;">Elapsed</td>
                                <td style="border-bottom:Solid 1px Silver; width:10%; text-align:center;">Holidays</td>
                                <td style="border-bottom:Solid 1px Silver; width:10%; text-align:center; ">Incurred</td>
                                <td style="border-bottom:Solid 1px Silver; width:10%">Accumulated</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="padding-bottom:2px; padding-top:2px;">
                        <table style="width:100%; " cellspacing="0" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td style=" width:60%; vertical-align :top;">
                                        From  DEMETRIO2021 on Jun 12, 2021   to  Fred Virgil Barriga on Aug 23, 2021
                                    </td>
                                    <td style="width:10%; text-align:center;">
                                        0 
                                    </td>
                                    <td style="width:10%;  text-align:center;">
                                        0 
                                    </td>
                                    <td style="width:10%;  text-align:center;"> 
                                        0 
                                    </td>
                                    <td style="width:10%;  text-align:center;">
                                        0 days 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<div style="padding-top:10px;">
    <div style="font-weight:bold;   background-color:#106A9A; color:White; padding:5px;  cursor:pointer;">REGISTERED ACCOUNT</div>
    <div>
        <table cellspacing="0" cellpadding="5" rules="rows" border="1" class="table table-striped" style="border-style:None;width:100%;border-collapse:collapse;">
            <tbody>
                <tr>
                    <td>DEMETRIO2021&nbsp;(Owner) - valdiviad771@gmail.com/danalfornon@yahoo.com
                        <br>
                        <div style="font-size:small;">
                            <a id="ContentPlaceHolder1_gvAuthorizedPerson_HyperLink1_0" href="../Account/Attachments/27e6b432-4a48-4110-b76e-2fa97547adc2.pdf" target="_blank" style="text-decoration:none;">Government Issued ID</a>,
                            <a id="ContentPlaceHolder1_gvAuthorizedPerson_HyperLink3_0" target="_blank" style="text-decoration:none;">Authorization Letter</a>,
                            <a id="ContentPlaceHolder1_gvAuthorizedPerson_HyperLink4_0" target="_blank" style="text-decoration:none;">Authorization Letter</a>,
                            <a id="ContentPlaceHolder1_gvAuthorizedPerson_HyperLink5_0" target="_blank" style="text-decoration:none;">SEC/DTI Registration</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<input type="button" name="ctl00$ContentPlaceHolder1$btnShowPopup1" value="" onclick="javascript:__doPostBack('ctl00$ContentPlaceHolder1$btnShowPopup1','')" id="ContentPlaceHolder1_btnShowPopup1" style="display: none">
<div id="ContentPlaceHolder1_pnActivityAttachments" style="width: 70%; background-color: white; display: none; position: fixed;">
    <div style="background-color:RGB(16,106,154); padding:5px; color:White;">
        <table width="100%">
            <tbody>
                <tr>
                    <td>Click the the link below to view the attachment.</td>
                    <td style="width:40px;">
                        <input type="submit" name="ctl00$ContentPlaceHolder1$btnClose1" value="X" id="ContentPlaceHolder1_btnClose1" style="color:White;background-color:#1E8CBE;border-style:None;">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="padding:10px;">
        <div id="ContentPlaceHolder1_Panel1" style="height:320px;overflow-y:scroll;">
        </div>
    </div>
</div>
<div id="ContentPlaceHolder1_mpext1_backgroundElement" class="modalBackgroundgray" style="display: none; position: fixed; left: 0px; top: 0px;">
</div>
<!-- </div> -->
</div>
<div id="ContentPlaceHolder1_mpext_backgroundElement" class="modalBackgroundgray" style="display: none; position: fixed; left: 0px; top: 0px;">
</div>
</div>
</section>
</div>
@stop