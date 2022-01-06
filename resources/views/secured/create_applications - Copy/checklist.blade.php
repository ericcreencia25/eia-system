<div class="box-body">
    <div>
        <button type="button" class="btn btn-primary pull-right" id="save_entry">Save Entry<i class="fa fa-fw fa-save"></i></button>
      </div>
    <h4><b>6. CHECKLIST & OTHER REQUIREMENTS</b><br></h4>
    <i>
        Please download and fill up the forms below for notarial purposes. Once notarized, return to the system and locate this application from the 'For Action' Menu to upload the Checklist together with the required attachments. You need to have pdf reader installed to open the files.
    </i>
    <br><br>
    <table cellpadding="12" width="100%">
        <tbody>
            <tr>
                <td style="border-bottom:Solid 1px Silver;"> 1. <a href="{{url('dynamic_pdf/ProjectInformation')}}" target="_blank" style="text-decoration:none;">Project Description</a></td>
            </tr>
            <tr>
                <td style="border-bottom:Solid 1px Silver;">2. <a href="../templates/EPRMPC.pdf" target="_blank" style="text-decoration:none;">Project Components &amp; Operation Information</a> - <i>Fillable Form</i> </td>
            </tr>
             <tr>
                <td style="border-bottom:Solid 1px Silver;"> 3. <a href="../templates/EPRMPCL.pdf" target="_blank" style="text-decoration:none;">Environmental Impact and Management Plan</a> - <i>Fillable Form</i></td>
            </tr>
             <tr>
                <td style="border-bottom:Solid 1px Silver;">4. <a href="../templates/EPRMPAB.pdf" target="_blank" style="text-decoration:none;">Abandonement/Decommissioning/Rehabilitation Policies and Generic Guidelines</a> - <i>Fillable Form</i></td>
            </tr>
              <tr>
                <td style="border-bottom:Solid 1px Silver;">5. <a href="../templates/PEMAPS.pdf" target="_blank" style="text-decoration:none;">Project Environmental Monitoring &amp; Audit Prioritization Scheme (PEMAPS)</a> - <i>Fillable Form</i></td>
            </tr>
             <tr>
                <td style="border-bottom:Solid 1px Silver;"> 6. <a href="{{url('dynamic_pdf/SwornStatement')}}" target="_blank" style="text-decoration:none;">Sworn Statement</a>  </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function(){
        var url=window.location.pathname;
        var arr=url.split('/');
        var NewGUID=arr[2];

        $("#save_entry").on('click', function(){
            $.ajax({
                url: "{{route('SaveNewApplication')}}",
                type: 'POST',
                data: {
                    ProjectGUID : NewGUID,
                    _token: '{{csrf_token()}}',
                },
                success: function(response)
                {
                    toastr.success('Saved Entry! ');
                }
            });

        });
    });
</script>