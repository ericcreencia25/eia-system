<style>
body {
    font: 10pt/175% Arial, sans-serif; /* 175% seems to correspond to 150% in MS Word */
}
ul {
    list-style: none;
}
ul li:before {
    content: '- ';
    margin-left: -20px;
    margin-right: 10px;
}

p {
    letter-spacing: 1pt;
}
</style>
<h3 align="center">PROJECT FACT SHEET</h3>
        <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <td style="border: 1px solid; padding:12px; " width="40%"><b>Name of the Project</b></td>
            <td style="border: 1px solid; padding:12px; " width="50%" colspan="2"></td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:12px; " width="30%"><b>Proponent Name</b></td>
            <td style="border: 1px solid; padding:12px; " width="70%" colspan="2"></td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:12px; " width="30%"><b>Proponent Address</b></td>
            <td style="border: 1px solid; padding:12px; " width="70%" colspan="2">'.$step_5['proponent_address'].'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:12px; " width="20%"><b>Authorized Representative</b></td>
            <td style="border: 1px solid; padding:12px; " width="40%"><b>Name </b><br>'.$step_5['represented_by'].'</td>
            <td style="border: 1px solid; padding:12px; " width="40%"><b>Designation </b><br>'.$step_5['designation'].'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:12px; " width="20%"><b>Proponent Means of Contact</b></td>
            <td style="border: 1px solid; padding:12px; " width="40%"><b>Landline No. </b><br>'.$step_5['landline_no'].'</td>
            <td style="border: 1px solid; padding:12px; " width="40%"><b>Fax No. </b><br>'.$step_5['fax_no'].'</td>
        </tr>
        </table>