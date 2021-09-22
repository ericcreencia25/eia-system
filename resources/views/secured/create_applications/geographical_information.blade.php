    <div class="box-body">
            <button type="button" class="pull-right btn btn-default" id="sendEmail">Next    <i class="fa fa-arrow-circle-right" onclick="window.location='{{ url("new_applications/1") }}'"></i></button>
            <button type="button" class="pull-right btn btn-default" id="sendEmail"><i class="fa fa-arrow-circle-left" onclick="window.location='{{ url("new_applications/1") }}'"></i>Previous</button>

            <h4><b>4. PROJECT GEOGRAPHICAL INFORMATION</b><br></h4>
            <i>
              Select from the shape icon below to add the project area (triangle - for polygon area, Line icon - for bridge, roads etc). Click only once if you only have (1) project area. The project area number will appear in the list. If you have MORE THAN (1) project area, make sure you have selected the appropriate project area number from the list before adding the geo-coordinate (latitude and longitude). Please add the coordinates in sequence. You may have to pad/add '0' if the coordinate has fewer digits. For consistency purposes, please use the World Geodetic System 1984 (WGS84) Datum Convention. Mobile Phones and most online maps are using this convention by default.
            </i>

            <br><br>
            <div style="border:Solid 1px Silver;">
            <div style="  background-color:#C3D1E6; ">
              <table cellspacing="0" cellpadding="3" style="background-color:#C3D1E6;  ">
                <tbody><tr style="font-size:7pt">
                  <td colspan="2">Clik icon to Add Area</td>
                  <td style="padding-left:30px;">Selected Area</td>
                  <td>Geo-format</td>
                  <td></td>
                  <td>Latitude (pad space with 0)</td>
                  <td>Longitude (pad space with 0)</td>
                </tr>
                <tr>
                  <td> <input type="image" name="ctl00$ContentPlaceHolder1$ImgPoly" id="ContentPlaceHolder1_ImgPoly" title="Click to add a polygon" src="../img/polygon.PNG" onclick="return confirm('Add a polygon?');" style="background-color:White;width:30px;"> 
                  </td>
                  <td> 
                    <input type="image" name="ctl00$ContentPlaceHolder1$ImgLine" id="ContentPlaceHolder1_ImgLine" title="Click to add a line" src="../img/line.PNG" onclick="return confirm('Add a line?');" style="background-color:White;width:30px;">
                  </td>
                  <td style="padding-left:30px;"><select name="ctl00$ContentPlaceHolder1$Area" id="ContentPlaceHolder1_Area" style="width:50px;">
                    <option selected="selected" value="82f6cd86-25db-45ef-a40d-6070aec3d9b1">1</option>
                  </select></td>
                  <td><select name="ctl00$ContentPlaceHolder1$geoFormat" onchange="javascript:setTimeout('__doPostBack(\'ctl00$ContentPlaceHolder1$geoFormat\',\'\')', 0)" id="ContentPlaceHolder1_geoFormat" style="width:130px;">
                    <option value="0">Decimal</option>
                    <option selected="selected" value="1">Deg-Min-Sec</option>
                  </select></td> 
                  <td style="padding-left:30px;">Geo-Coordinate</td>
                  <td>
                    <input name="ctl00$ContentPlaceHolder1$Latitude" type="text" value="__°___'___.____&quot;" id="ContentPlaceHolder1_Latitude" onkeydown="return (event.keyCode!=13);" class="">
                    <input type="hidden" name="ctl00$ContentPlaceHolder1$MaskedEditExtender1_ClientState" id="ContentPlaceHolder1_MaskedEditExtender1_ClientState">
                  </td> 
                  <td>
                    <input name="ctl00$ContentPlaceHolder1$Longitude" type="text" value="___°___'___.____&quot;" id="ContentPlaceHolder1_Longitude" onkeydown="return (event.keyCode!=13);">
                    <input type="hidden" name="ctl00$ContentPlaceHolder1$MaskedEditExtender2_ClientState" id="ContentPlaceHolder1_MaskedEditExtender2_ClientState">
                  </td>
                  <td>
                    <input type="submit" name="ctl00$ContentPlaceHolder1$btnAddGeo" class="btn btn-block btn-flat btn-success" value="Add Point " id="ContentPlaceHolder1_btnAddGeo" title="Click to add point"></td>
                    <td style="padding-left:50px;">
                      <input type="submit" name="ctl00$ContentPlaceHolder1$btnRemoveArea" value="Remove Area " onclick="return confirm('Removing the selected project area will also delete its geo-coordinates. Do you want to continue?');" id="ContentPlaceHolder1_btnRemoveArea" title="Click to remove the selected area" class="btn btn-block btn-flat btn-warning">
                    </td>
                    <td>
                      &nbsp;&nbsp;
                      <input type="image" name="ctl00$ContentPlaceHolder1$ImgViewInmap" id="ContentPlaceHolder1_ImgViewInmap" title="Click here to view in map" class="imgbutton" src="../img/globe.jpg" style="background-color:White;width:35px;">
                    </td>
                  </tr>
                </tbody></table>
              </div>
            </div>
          </div>