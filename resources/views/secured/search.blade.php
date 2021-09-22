@extends('layouts.adminlte.default.layout-ch')

@section('header')
    <section class="content-header">
        <h1 class="hidden-sm">
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cog"></i>Search Applications</a></li>
        </ol>
    </section>
@stop

@section('content')
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="box box-default">
          <div class="box-header with-border">
            <h1 class="box-title"><b>SEARCH APPLICATIONS
</b></h1>
          </div>
          <div class="box-body">
              Locate applications by providing the keywords in the box then click the search button.    
            <br><br>
            <b>Applications found -</b>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <!---<tbody>
                <tr>
                  <td>
                  <a href="">SAMPLE AMENDMENT PROJECT <i style="color:slategray;"> (With Proponent - Pending for Submission )</i></a> 
                  <br>SPECIFIC LOCATION QUEZON, BUKIDNON, R10<br/>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="">AUTOPROJECCTSAMPLE <i style="color:slategray;"> (With Proponent - Pending for Submission)</i></a> 
                    <br>LOCATION ABORLAN, PALAWAN, R4B<br/>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="">TESTING PROJECT NAME  <i style="color:slategray;"> (With Proponent - Pending for Submission)</i></a> 
                    <br>WARN YOU AGONCILLO, BATANGAS, R4A<br/>
                  </td>
                </tr>
              </tbody> ---->
            </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop