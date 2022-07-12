<!-- <link rel="stylesheet" href="../../adminlte/dist/css/overlay-success.css"> -->
<div class="box-body">
    <div class="callout callout-default" style="background: #ccc; margin-bottom: 0px">
    <div>
        <button type="button" class="btn btn-primary pull-right" id="save_entry">Save Entry<i class="fa fa-fw fa-save"></i></button>
      </div>
    <h4><b>6. CHECKLIST & OTHER REQUIREMENTS</b><br></h4>
    <i>
        Please download and fill up the forms below for notarial purposes. Once notarized, return to the system and locate this application from the 'For Action' Menu to upload the Checklist together with the required attachments. You need to have pdf reader installed to open the files.
    </i>
    <br><br>
</div>
    <table cellpadding="12" width="100%">
        
        <tbody>
            <tr style="padding: 10px;">
                <td style="border-bottom:Solid 1px Silver; padding: 13px;">1. <a href="{{url('dynamic_pdf/ProjectInformation')}}" target="_blank" style="text-decoration:none;">Project Description</a></td>
            </tr>
            <tr>
                <td style="border-bottom:Solid 1px Silver;padding: 13px;">2. <a href="../templates/EPRMPC.pdf" target="_blank" style="text-decoration:none;">Project Components &amp; Operation Information</a> - <i>Fillable Form</i> </td>
            </tr>
             <tr>
                <td style="border-bottom:Solid 1px Silver;padding: 13px;">3. <a href="../templates/CL TEmplates/{{Session::get('step_2')['MgtPlanPDF']}}" target="_blank" style="text-decoration:none;">Initial Environmental Examination (IEE) Checklist Report</a> - <i>Fillable Form</i></td>
            </tr>
             <tr>
                <td style="border-bottom:Solid 1px Silver;padding: 13px;">4. <a href="../templates/EMP TEmplates/{{Session::get('step_2')['Template']}}EMP.pdf" target="_blank" style="text-decoration:none;">Environmental Management Plan (EMP)</a> - <i>Fillable Form</i></td>
            </tr>
              <tr>
                <td style="border-bottom:Solid 1px Silver;padding: 13px;">5. <a href="../templates/PEMAPS.pdf" target="_blank" style="text-decoration:none;">Project Environmental Monitoring &amp; Audit Prioritization Scheme (PEMAPS)</a> - <i>Fillable Form</i></td>
            </tr>
             <tr>
                <td style="border-bottom:Solid 1px Silver;padding: 13px;">6. <a href="{{url('dynamic_pdf/SwornStatement')}}" target="_blank" style="text-decoration:none;">Sworn Statement of Accountability</a>  </td>
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
                beforeSend: function() {
                    $('#overlay').show();
                },
                success: function(response)
                {
                    $('#overlay').fadeOut(2000, () => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Your application has been saved!.',
                            showConfirmButton: false,
                            timer: 1500,
                            width: '850px'
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss) {

                                $('#myTab li a')[6].click();

                                location.reload();
                            }
                        });
                    });
                }
            });

        });

    });
</script>