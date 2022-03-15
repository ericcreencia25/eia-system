<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectActivityAttachment;
use App\Models\ProjectActivityAttachmentTemp;
use App\Models\ProjectActivity;
use App\Models\ProjectRequirements;
use App\Models\Attachment;
use App\Models\ActionRequired;
use App\Models\ActionRequiredPerson;
use App\Models\AspnetUser;
use App\Models\Holidays;
use App\Models\Holidays_;
use App\Models\HolidaysNational;
use App\Models\Region;

use Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Secured\EccApplicationsController;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
// use PhpOffice\PhpWord\TemplateProcessor;
use \PhpOffice\PhpWord\TemplateProcessor,
    \PhpOffice\PhpWord\Shared\Html,
    \PhpOffice\PhpWord\PhpWord;
use File;
use PDF;
use \ConvertApi\ConvertApi;


class ForActionsController extends Controller
{
    public function index()
    {
        return view('secured.for_actions.index');
    }

    public function project_app($GUID, $ActivityGUID)
    {   

        $project = Project::where('project.GUID', '=', $GUID)
        // ->where('project.Stage', '>', 0 )
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');
            // $join->on('projectactivity.CreateDate','>=', DB::raw("'2012-05-01'"));

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->leftJoin('proponent', 'project.ProponentGUID', '=', 'proponent.GUID')
        ->select(
            'project.Purpose',
            'project.Address AS Address', 
            'project.Municipality  AS Municipality', 
            'project.Province AS Province', 
            'project.Address', 
            'project.CreatedBy AS CreatedBy', 
            'project.GUID AS GUID', 
            'project.PreviousECCNo',
            'proponent.ProponentName',
            'project.ProjectName', 
            'project.Region  AS Region', 
            'project.AcceptedBy',
            'project.AcceptedDate',

            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom', 

            'projectactivity.RoutedToOffice', 
            'projectactivity.RoutedFromOffice', 

            'projectactivity.CreatedDate', 
            'projectactivity.Status', 
            'projectactivity.Details AS Remarks', 
            'projectactivity.GUID AS ActivityGUID',
            'projectactivity.FromDate AS FromDate',
            'projectactivity.UpdatedDate AS UpdatedDate',
            
        )
        ->first();

        $UserRole = Session::get('data')['UserRole'];
        $UserName = Session::get('data')['UserName'];

        $attachments = Attachment::where('UserRole', '=', $UserRole)
        ->orderByRaw('Sorter ASC')
        ->get();

        
        if(Str::lower($project->RoutedTo) === Str::lower($UserName) ){
            return view('secured.for_actions.project_app', compact('project', 'attachments'));
        } else {
            return redirect()->route('default');
        }
    }

    public function reviewer($GUID)
    {   
        $project = Project::where('project.GUID', '=', $GUID)
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->leftJoin('proponent', 'project.ProponentGUID', '=', 'proponent.GUID')
        ->select(
            'project.Purpose',
            'project.Address AS Address', 
            'project.Municipality  AS Municipality', 
            'project.Province AS Province', 
            'project.Address', 
            'project.CreatedBy AS CreatedBy', 
            'project.GUID AS GUID', 
            'project.PreviousECCNo',
            'proponent.ProponentName',
            'project.ProjectName', 
            'project.Region  AS Region', 
            'project.AcceptedBy',
            'project.AcceptedDate',

            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom', 

            'projectactivity.RoutedToOffice', 
            'projectactivity.RoutedFromOffice', 

            'projectactivity.CreatedDate', 
            'projectactivity.Status', 
            'projectactivity.Details AS Remarks', 
            'projectactivity.GUID AS ActivityGUID',
            'projectactivity.FromDate AS FromDate',
            'projectactivity.UpdatedDate AS UpdatedDate',
            
        )
        ->first();

        $projectrequirements = ProjectRequirements::where('ProjectGUID', '=', $GUID)
        ->select('Description', 'Compliant', 'Required', 'Remarks')
        ->get();


        return view('secured.for_actions.reviewer', compact('project', 'projectrequirements'));
    }

    public function project()
    {
        return view('secured.for_actions.project');
    }

    public function getRoutingHistory(Request $req)
    {   
        $GUID = $req['data']; 
        
        $project = DB::table('project')
        ->where('project.GUID', '=', $GUID)
        ->leftJoin('projectactivity', 'project.GUID', '=', 'projectactivity.ProjectGUID')
        ->select('project.Address AS Address', 
            'project.Municipality  AS Municipality', 
            'project.Province AS Province', 
            'project.Address', 
            'projectactivity.Status',
            'projectactivity.Details AS Remarks', 
            'project.ProjectName', 
            'project.Region  AS Region', 
            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom', 
            'projectactivity.CreatedDate', 
            'project.GUID AS GUID', 
            'projectactivity.RoutedToOffice',
            'projectactivity.UpdatedDate', 
            'projectactivity.GUID AS ActivityGUID', 
            'projectactivity.CreatedBy AS CreatedBy' 
        )
        ->orderByRaw('projectactivity.UpdatedDate DESC')
        ->get();

        return DataTables::of($project)
        ->addColumn('Routing', function($project){
            $details = 'Forwarded to '. $project->RoutedToOffice;
            return $details;
        })
        ->addColumn('Status', function($project){
            $details =  $project->Status;
            return $details;
        })
        ->addColumn('Action', function($project){
            $details =  '<button class="btn btn-block btn-flat" onclick="listOfAttachments('."'". $project->CreatedBy."', "."'". $project->ActivityGUID."'".')"><i class="fa fa-paperclip"></i></button>';
            return $details;
        })
        ->addColumn('Date', function($project){
            $date = date("F j, Y g:i a", strtotime($project->UpdatedDate));
            // $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $date;
        })
        ->rawColumns(['Details', 'Status', 'Action', 'Date'])
        ->make(true);
    }

    public function getRoutingHistoryCaseHandler(Request $req)
    {   
        $GUID = $req['data']; 
        
        $project = DB::table('project')
        ->where('project.GUID', '=', $GUID)
        ->leftJoin('projectactivity', 'project.GUID', '=', 'projectactivity.ProjectGUID')
        ->select(
            'projectactivity.Status', 
            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom',
            'projectactivity.RoutedToOffice', 
            'projectactivity.UpdatedDate',  
            'projectactivity.GUID AS ActivityGUID', 
            'projectactivity.CreatedBy AS CreatedBy', 
            'projectactivity.RoutedFromOffice', 
            'projectactivity.TotAccumulatedDays',
            'projectactivity.Details AS Remarks', 
        )
        ->orderByRaw('projectactivity.UpdatedDate DESC')
        ->get();

        return DataTables::of($project)
        ->addColumn('Routing', function($project){
            $details = 'Forwarded to '. $project->RoutedTo . ' (' . $project->RoutedToOffice . ')' ;
            return $details;
        })
        ->addColumn('AccumulatedDays', function($project){
            $details = $project->TotAccumulatedDays . " days";
            return $details;
        })
        ->addColumn('Status', function($project){
            $details =  '<i>' . $project->Status . '</i>';
            return $details;
        })
        ->addColumn('Action', function($project){
            $details =  '<button class="btn btn-block btn-flat" onclick="getlistOfAttachments('."'". $project->CreatedBy."', "."'". $project->ActivityGUID."'".')"><i class="fa fa-paperclip"></i></button>';
            return $details;
        })
        ->addColumn('PostedOn', function($project){
            $date = '<small>' . date("F j, Y g:i a", strtotime($project->UpdatedDate)) . '</small>';
            // $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></s/mall>';
            return $date;
        })
        ->addColumn('By', function($project){
            $details =  '<small>' . $project->RoutedFrom . ' (' . $project->RoutedFromOffice . ')' . '</small>';
            return $details;
        })
        ->rawColumns(['Details', 'AccumulatedDays', 'Status', 'Action', 'PostedOn', 'By'])
        ->make(true);
    }

    public function getActivityAttachments(Request $req)
    {   
        $UserName = Session::get('data')['UserName'];
        $project['data'] = ProjectRequirements::where('ProjectGUID', '=', $req['data'])
        ->where('Compliant', '=', 0)
        // ->where('CreatedBy', '=', $UserName)
        ->select('Description', 'ID', 'ProjectGUID')
        ->get();
        return response()->json($project);
    }

    public function getActivityAttachmentsList(Request $req)
    {   
        $ActivityGUID = $req['ActivityGUID'];
        $ProjectGUID = $req['ProjectGUID'];
        // $project = ProjectActivityAttachment::select('FilePath', 'Description', 'CreatedDate', 'CreatedBy')
        // ->where('ActivityGUID', '=', $ActivityGUID)

        // ->get();

        $project = ProjectActivity::where('projectactivity.ProjectGUID', '=', $ProjectGUID)
        ->Join('projectactivityattachment', function($join)
        {
            $join->on('projectactivityattachment.ActivityGUID', '=', 'projectactivity.GUID');
            // $join->on('projectactivityattachment.Description', '=', 'projectrequirement.Description');
        })
        ->select(
            'projectactivity.GUID', 
            'projectactivityattachment.ActivityGUID',
            'projectactivityattachment.FileName',
            'projectactivityattachment.FilePath',
            'projectactivityattachment.Directory',
            'projectactivityattachment.CreatedDate',
            'projectactivityattachment.CreatedBy',
            'projectactivityattachment.Description',
        )
        ->orderByRaw('projectactivityattachment.CreatedDate DESC')
        ->get();
        
        return DataTables::of($project)
        ->addColumn('Details', function($project){
            $details = '<div id="">
                <a title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;" 
                href="'.url($project->FilePath).'">'.$project->Description.'</a>
                </div>';

            return $details;
        })
        ->addColumn('CreatedDate', function($project){
            $date = date("F j, Y g:i a", strtotime($project->CreatedDate));
            // $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $date;
        })
        ->rawColumns(['Details', 'CreatedDate'])
        ->make(true);
    }


    public function getCaseHandlerForActionsTable(Request $req)
    {
        $UserName = $req['UserName'];
        $UserRole = $req['UserRole'];
        $UserOffice = $req['UserOffice'];
        $StartDate = $req['StartDate'];
        $EndDate = $req['EndDate'];

        $todate = date('Y-m-d H:i:s');
        $tomorrow = date('Y-m-d', strtotime( $todate . " +1 days"));

        if($UserRole === 'Approving'){
            $projects = Project::select(
                'project.Address AS Address',
                'project.Municipality  AS Municipality', 
                'project.Province AS Province', 
                'projectactivity.Status', 
                'projectactivity.Details AS Remarks', 
                'project.ProjectName', 
                'project.Region  AS Region', 
                'projectactivity.RoutedTo', 
                'projectactivity.RoutedFrom', 
                'project.GUID AS ProjectGUID', 
                'project.Stage', 
                'projectactivity.CreatedDate',
                'project.ProcTimeFrameInDays',
                'project.TotProcDays',
                'project.TotProcDays',
                'projectactivity.GUID AS ActivityGUID',
                'projectactivity.Status',
                'projectactivity.UpdatedDate'
            )
            ->Join('projectactivity', function ($join) {
                $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');
                // $join->on('projectactivity.CreateDate','>=', DB::raw("'2012-05-01'"));

                $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                    join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
            })
            ->where('project.Region', '=', $UserOffice)
            // ->where('project.UpdatedDate', '>=', $StartDate)
            // ->where('project.UpdatedDate', '<=', $EndDate)
            ->where('projectactivity.RoutedTo', '=', $UserName)
            ->where('projectactivity.RoutedToOffice', '=', $UserOffice)
            ->whereIn('Status', array('For Approval', 'For Denial'))
            ->groupBy('project.GUID')
            ->orderByRaw('project.UpdatedDate DESC')
            ->get();

        } else {
            $projects = Project::select(
                'project.Address AS Address',
                'project.Municipality  AS Municipality', 
                'project.Province AS Province', 
                'projectactivity.Status', 
                'projectactivity.Details AS Remarks', 
                'project.ProjectName', 
                'project.Region  AS Region', 
                'projectactivity.RoutedTo', 
                'projectactivity.RoutedFrom', 
                'project.GUID AS ProjectGUID', 
                'project.Stage', 
                'projectactivity.CreatedDate',
                'project.ProcTimeFrameInDays',
                'project.TotProcDays',
                'project.TotProcDays',
                'projectactivity.GUID AS ActivityGUID',
                'projectactivity.Status',
                'projectactivity.UpdatedDate'
            )
            ->Join('projectactivity', function ($join) {
                $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');
                // $join->on('projectactivity.CreateDate','>=', DB::raw("'2012-05-01'"));

                $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                    join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
            })
            ->where('project.Region', '=', $UserOffice)
            // ->where('project.UpdatedDate', '>=', $StartDate)
            // ->where('project.UpdatedDate', '<=', $EndDate)
            ->where('projectactivity.RoutedTo', '=', $UserName)
            ->where('projectactivity.RoutedToOffice', '=', $UserOffice)
            ->whereNotIn('Status', array('Approved', 'Denied'))
            ->groupBy('project.GUID')
            ->orderByRaw('project.UpdatedDate DESC')
            ->get();
        }

        // $project = collect([]);
        // $projects->each(function($proj) use ($project, $UserName){
        //     if( $proj->Status == 'Approved' || $proj->Status == 'Denied'){}
        //         else{
        //                 if($proj->RoutedTo == $UserName){
        //                     $project->push($proj);    
        //                 }
        //             }
        //     });

        return DataTables::of($projects)
        ->addColumn('Details', function($project) use ($UserRole){
            if($project->Stage > 0){
                $details = '<a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
            }else{
                if($UserRole != 'Evaluator'){
                    $details = '<a class="text-uppercase" href="NewApplications/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
                }else{
                    $details = '<a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
                }
            }
            
            $details .= '<br><p class="text-uppercase">'.$project->Address.', '. $project->Municipality.', '. $project->Province.', '. $project->Region .'</p><br/>';
            return $details;
        })
        ->addColumn('Status', function($project){
            $details = '<i style="color:slategray;">'. $project->Status.'</i>';
            return $details;
        })
        ->addColumn('Remarks', function($project){
            // $projectactivity = ProjectActivity::on('mysql')->where('projectactivity.ProjectGUID', '=', $project->ProjectGUID)
            // ->orderByRaw('ID Desc')
            // ->first();

            $date = date("F j, Y g:i a", strtotime($project->UpdatedDate));
            $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $details;
        })
        ->addColumn('IncurredDate', function($project){
            //  $projectactivity = ProjectActivity::on('mysql')->where('projectactivity.ProjectGUID', '=', $project->ProjectGUID)
            // ->orderByRaw('ID Desc')
            // ->first();

            // $start_date = date("d-m-Y", strtotime($projectactivity->UpdatedDate));
            // $end_date = date('d-m-Y');
            $start_date = $project->UpdatedDate;
            $end_date = date('Y-m-d');

            // $dateDiff = $this->dateDiffInDays($start_date, $end_date);
            $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

            if($dateDiff > 21){
                $details = '<small>'. ($dateDiff - 1).'/'.$project->ProcTimeFrameInDays.', days incurred from last submission - </small><span class="label label-danger">'.($dateDiff - 1).'</span>';
            } else {
                $details = '<small>'. ($dateDiff - 1).'/'.$project->ProcTimeFrameInDays.', days incurred from last submission - </small><span class="label label-success">'.($dateDiff - 1).'</span>';
            }
            
            return $details;
        })
        ->rawColumns(['Details', 'Status', 'Remarks', 'IncurredDate'])
        ->make(true);
    }

    public function Count_Days_Without_Weekends($start, $end)
    {
        $days_diff = floor(((abs(strtotime($end) - strtotime($start))) / (60*60*24)));
        $run_days=0;
        for($i=0; $i<=$days_diff; $i++){
            $newdays = $i-$days_diff;
            $futuredate = strtotime("$newdays days");
            $mydate = date("F d, Y", $futuredate);
            $today = date("D", strtotime($mydate));         
            if(($today != "Sat") && ($today != "Sun")){
                $run_days++;
            }
        }
    return $run_days;
    }


    // public function dateDiffInDays($date1, $date2) 
    // {
    // // Calculating the difference in timestamps
    //     $diff = strtotime($date2) - strtotime($date1);
      
    // // 1 day = 24 hours
    // // 24 * 60 * 60 = 86400 seconds
    //     return abs(round($diff / 86400));
    // }

    public function getListOfAttachments(Request $req)
    {   
        $ActivityGUID = $req['ActivityGUID'];
        $CreatedBy = $req['CreatedBy'];

        $project = ProjectActivityAttachment::where('ActivityGUID', '=', $ActivityGUID)
        ->where('CreatedBy', '=', $CreatedBy)
        ->get();

        return DataTables::of($project)
        ->addColumn('Details', function($project){

            $details = '<a href="'.url($project->FilePath).'">' . $project->Description . '</a>';

            return $details;
        })
        
        ->rawColumns(['Details'])
        ->make(true);
    }

    public function getProjectActivity(Request $req)
    {   
        $ProjectGUID = $req['ProjectGUID'];
        $UserOffice = Session::get('data')['UserOffice'];

        $project = ProjectActivity::where('ProjectGUID', '=', $ProjectGUID)
        ->orderByRaw("CreatedDate DESC")
        ->first();

        return $project;
    }

    public function UserListsOnRegion(Request $req)
    {   
        $UserOffice = Session::get('data')['UserOffice'];

        $project = AspnetUser::where('UserOffice', '=', $UserOffice)
        ->where('InECCOAS', 1)
        // ->whereIn('UserRole', array('Evaluator', 'Reviewer'))
        ->orderByRaw("UserName ASC")
        ->get();

        return $project;
    }

    public function getProcessingDays(Request $req)
    {   
        $ProjectGUID = $req['ProjectGUID'];

        $project = ProjectActivity::where('ProjectGUID', '=', $ProjectGUID)
        ->orderByRaw("CreatedDate DESC")
        ->get();

        return DataTables::of($project)
        ->addColumn('Routing', function($project){
            $fromdate = date("M d, Y", strtotime($project->FromDate));
            $todate = date("M d, Y", strtotime($project->UpdatedDate));
            $details = 'From ' . $project->RoutedFrom . ' on ' . $fromdate . ' to ' . $project->RoutedTo . ' on '. $todate ;
            
            return $details;
        })
        ->addColumn('Accumulated', function($project){
            $details = $project->TotAccumulatedDays . ' days';
            
            return $details;
        })
        ->addColumn('Elapsed', function($project){
            $details = $project->TotElapsedDays;
            
            return $details;
        })
        ->addColumn('Holidays', function($project){
            $details = $project->TotHolidays;
            
            return $details;
        })
        ->addColumn('Incurred', function($project){
            $details = $project->TotWorkDays;
            
            return $details;
        })

        ->rawColumns(['Routing', 'Accumulated', 'Elapsed', 'Holidays', 'Incurred'])
        ->make(true);
    }

    public function getRegisteredAccount(Request $req)
    {   
        $CreatedBy = $req['CreatedBy'];

        $Account = AspnetUser::where('UserName', '=', $CreatedBy)
        ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
        ->select('aspnet_users.*', 'aspnet_membership.*')
        ->first();

        return $Account;
    }

    public function getApplicationRequirementLists(Request $req)
    {   
        $ProjectGUID = $req['ProjectGUID'];
        $project = ProjectRequirements::orderByRaw('ID ASC')
        // ->where('required', '=', 1)
        ->where('ProjectGUID', '=', $ProjectGUID)
        ->get();

        return DataTables::of($project)
        ->addColumn('Complied', function($project){
            if($project->Compliant == 1){
                $details = '<center><div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" checked disabled>
                    </label>
                  </div>
                  </div>';
              } else {
                $details = '<center><div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" disabled>
                    </label>
                  </div>
                  </div>';
              }
            
            return $details;
        })
        ->addColumn('Description', function($project){

            if( $project->Required == 1){ 
                $Required = " (Required) " ;
            } else { $Required = ""; } 

            $details = '<a id="pointer" onclick="modalEvaluation('."'". $project->ProjectGUID."', ". 
            "'". $project->ID."', "."'". $project->Description ."'".')">' . $project->Description .' </a> <i>' . $Required .'</i>';
            
            return $details;
        })
        ->rawColumns(['Complied', 'Description'])
        ->make(true);
    }

    public function getApplicationRequirementsModal(Request $req)
    {   
        $ID = $req['ID']; 
        $ProjectGUID = $req['ProjectGUID']; 
        $Description = $req['Description']; 

        $project = ProjectRequirements::where('projectrequirement.ProjectGUID', '=', $ProjectGUID)
        ->where('projectrequirement.ID', '=', $ID)
        ->where('projectrequirement.Description', '=', $Description)
        ->Join('projectactivity', function($join)
        {
            $join->on('projectrequirement.ProjectGUID', '=', 'projectactivity.ProjectGUID');
        })
        ->Join('projectactivityattachment', function($join)
        {
            $join->on('projectactivityattachment.ActivityGUID', '=', 'projectactivity.GUID');
            $join->on('projectactivityattachment.Description', '=', 'projectrequirement.Description');
        })
        ->select(
            'projectrequirement.Description', 
            'projectrequirement.Remarks', 
            'projectrequirement.Required',
            'projectrequirement.Compliant',  
            'projectrequirement.ID as PRID',
            'projectactivity.GUID', 
            'projectactivityattachment.ActivityGUID',
            'projectactivityattachment.FileName',
            'projectactivityattachment.FilePath',
            'projectactivityattachment.Directory',

        )
        ->first();

        return response()->json($project);
    }

    public function SaveAppReq(Request $req)
    {   
        $Required = $req['Required'];

        if($Required === "true"){
            $Required = 1;
        } else {
            $Required = 0;
        }

        $Remarks = $req['Remarks'];

        $Compliant = $req['Compliant'];

        if($Compliant === "true"){
            $Compliant = 1;
        } else {
            $Compliant = 0;
        }

        $PRID = $req['PRID'];
        $ProjectGUID = $req['ProjectGUID'];

        $now = new \DateTime(); 

        DB::table('projectrequirement')
        ->where('ProjectGUID','=', $ProjectGUID)
        ->where('ID', '=', $PRID)
        ->update([
            'Required' => $Required,
            'Compliant' => $Compliant,
            'Remarks' => $Remarks,
            'UpdatedDate' => $now->format('Y-m-d H:i:s')
        ]);

        return "Success";
    }

    public function SaveAppReqApprover(Request $req)
    {   
        $Remarks = $req['Remarks'];

        $Compliant = $req['Compliant'];

        if($Compliant === "true"){
            $Compliant = 1;
        } else {
            $Compliant = 0;
        }

        $PRID = $req['PRID'];
        $ProjectGUID = $req['ProjectGUID'];

        $now = new \DateTime(); 

        DB::table('projectrequirement')
        ->where('ProjectGUID','=', $ProjectGUID)
        ->where('ID', '=', $PRID)
        ->update([
            'Compliant' => $Compliant,
            'Remarks' => $Remarks,
            'UpdatedDate' => $now->format('Y-m-d H:i:s')
        ]);

        return "Success";

    }

    public function EndorseApplication(Request $req)
    {
        $UpdatedDate = $req['UpdatedDate'];
        $ProjectGUID = $req['ProjectGUID'];
        $ActivityGUID = $req['ActivityGUID'];
        $Destination = $req['Destination'];
        $UserDestination = $req['UserDestination'];
        $ActionRequired = $req['ActionRequired'];
        $Remarks = $req['Remarks'];
        $NewActivityGUID = Session::get('NewActivityGUID');

        $IncludeAttachment = $req['IncludeAttachment'];

        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $start_date = $UpdatedDate;
        $end_date = date('Y-m-d');

        $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

        $NewGUID = Uuid::generate()->string;

        $projectActivity = array();
        $projectActivity['GUID'] = Str::upper($NewActivityGUID);
        $projectActivity['ProjectGUID'] = $ProjectGUID;
        $projectActivity['Status'] = $ActionRequired;
        $projectActivity['Details'] = $Remarks;
        $projectActivity['RoutedFrom'] = $UserName;
        $projectActivity['RoutedFromOffice'] = $UserOffice;
        $projectActivity['RoutedTo'] = $UserDestination;
        $projectActivity['RoutedToOffice'] = $Destination;
        $projectActivity['Routing'] = 1;
        $projectActivity['Remarks'] = '';
        $projectActivity['UpdatedBy'] = $UserName;
        $projectActivity['CreatedBy'] = $UserName;
        $projectActivity['FromDate'] = $UpdatedDate;
        $projectActivity['TotWorkDays'] = $dateDiff;
        $projectActivity['TotElapsedDays'] = $dateDiff;

        if(DB::table('projectactivity')->insert($projectActivity)){
            $now = new \DateTime(); 

            if($ActionRequired == 'For Evaluation'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 1,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }else if($ActionRequired == 'For Review'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 2,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }else if($ActionRequired == 'For Recommendation'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 3,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }else if($ActionRequired == 'For Approval' || $ActionRequired == 'For Denial'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 4,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }else if($ActionRequired == 'Approved' || $ActionRequired == 'Denied'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 5,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }

            $AdditionalRequirements = $req['AdditionalRequirements'];

            if($AdditionalRequirements != null){
                foreach ($AdditionalRequirements as $key => $value) {
                    $projectrequirement = array();
                    $projectrequirement['ProjectGUID'] = $ProjectGUID;
                    $projectrequirement['Description'] = $value['description']; 
                    $projectrequirement['Required'] = 0;
                    $projectrequirement['Compliant'] = 0; 
                    DB::table('projectrequirement')->insert($projectrequirement);
                }
            }

            if($IncludeAttachment === "true"){

                $data = DB::table('projectactivityattachmenttemp')
                    ->select('GUID','ActivityGUID','Description','FileName','Directory','FilePath','FileSizeInKB','CreatedBy','CreatedDate')
                    ->where('ActivityGUID', '=', $NewActivityGUID)
                    ->get();

                $array = $data->map(function($obj){
                    return (array) $obj;
                    })->toArray();


                if(DB::table('projectactivityattachment')->insert($array)){
                    ProjectActivityAttachmentTemp::where('ActivityGUID', $NewActivityGUID)->delete();
                }
            }

        }

    }

    public function ReturnApplication(Request $req)
    {
        $UpdatedDate = $req['UpdatedDate'];
        $ProjectGUID = $req['ProjectGUID'];
        $ActivityGUID = $req['ActivityGUID'];

        $RoutedToOffice = $req['RoutedToOffice'];
        $RoutedTo = $req['RoutedTo'];
        $RoutedFromOffice = $req['RoutedFromOffice'];
        $RoutedFrom = $req['RoutedFrom'];

        $Remarks = $req['Remarks'];
        $NewActivityGUID = $req['NewActivityGUID'];

        $attachedDocuments = $req['attachedDocuments'];

        $Status = $req['Status'];

        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $start_date = $UpdatedDate;
        $end_date = date('Y-m-d');

        $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

        $NewGUID = Uuid::generate()->string;

        $projectActivity = array();
        $projectActivity['GUID'] = Str::upper($NewActivityGUID);
        $projectActivity['ProjectGUID'] = $ProjectGUID;
        $projectActivity['Status'] = $Status;
        $projectActivity['Details'] = $Remarks;
        $projectActivity['RoutedFrom'] = $UserName;
        $projectActivity['RoutedFromOffice'] = $UserOffice;
        $projectActivity['RoutedTo'] = $RoutedTo;
        $projectActivity['RoutedToOffice'] = $RoutedToOffice;
        $projectActivity['Routing'] = 1;
        $projectActivity['Remarks'] = '';
        $projectActivity['UpdatedBy'] = $UserName;
        $projectActivity['CreatedBy'] = $UserName;
        $projectActivity['FromDate'] = $UpdatedDate;
        $projectActivity['TotWorkDays'] = $dateDiff;
        $projectActivity['TotElapsedDays'] = $dateDiff;


        if(DB::table('projectactivity')->insert($projectActivity)){
            if($attachedDocuments != '' ){
                DB::table('projectactivityattachment')->insert($attachedDocuments);
            }
        }

    }


    public function addNewActivityGUID(Request $req)
    {
        $NewGUID = Uuid::generate()->string;

        $req->session()->put('NewActivityGUID', $NewGUID);

        return $NewGUID;
    }

    public function uploadFileEndorseApp(Request $request)
    {
        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        $UserName = Session::get('data')['UserName'];
        $ActivityGUID = Session::get('NewActivityGUID');
        $NewActivityGUID = Str::upper($ActivityGUID);

        $ProjectGUID = $request['ProjectGUID'];


        if($request['Documents'] == 'Others, specify'){
            $description = $request['OthersAttachment'];
        }else{
            $description = $request['Documents'];
        }

        $data = array();
        $rtrn = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:docx,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);

        if ($validator->fails()) {
            $rtrn['success'] = 0;
            $rtrn['error'] = $validator->errors()->first('file');// Error response
        }else{
            if($request->file('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();

                // $filename = $NewGUID;

                // filesize
                $size = $file->getSize();
                $filesize = $size * 0.001;

                // File extension
                $extension = $file->getClientOriginalExtension();

                $path = public_path('files/'.$ProjectGUID);
                // $savedFiles = $pdf->saveAs($urlSavePDF);

                if(!File::exists($path)) {
                    File::makeDirectory($path, $mode = 0755, true, true);

                    // File upload location
                    $location = 'files/'.$ProjectGUID.'/';

                    // // Upload file
                    $file->move($location,$NewGUID.'.'.$extension);

                } else {
                    $location = 'files/'.$ProjectGUID.'/';
                    $file->move($location,$NewGUID.'.'.$extension);
                }

                // File path
                // $filepath = public_path('files/'.$NewGUID.'.'.$extension);
                $filepath = 'files/'.$ProjectGUID.'/'.$NewGUID.'.'.$extension;

                // Response
                $rtrn['success'] = 1;
                $rtrn['message'] = 'Uploaded Successfully!';

                // data to be insert into database
                $data['GUID'] = $GUID;
                $data['ActivityGUID'] = $NewActivityGUID;
                $data['Description'] = $description;
                $data['Directory'] = public_path();
                $data['FileName'] = $filename;
                $data['FilePath'] = $filepath;
                // $data['extension'] = $extension;
                $data['FileSizeInKB'] = round($filesize, 3);
                $data['CreatedBy'] = $UserName;


                DB::table('projectactivityattachmenttemp')->insert($data);
            }else{
                // Response
                $rtrn['success'] = 2;
                $rtrn['message'] = 'File not uploaded.';
            }
        }

        return response()->json($rtrn);
    }

    public function uploadFileEndorseApplicant(Request $request)
    {
        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        $UserName = Session::get('data')['UserName'];
        $ActivityGUID = Session::get('NewActivityGUID');
        $NewActivityGUID = Str::upper($ActivityGUID);

        $description = $request['Documents'];
        $ProjectGUID = $request['ProjectGUID'];

        $data = array();
        $rtrn = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);

        if ($validator->fails()) {
            $rtrn['success'] = 0;
            $rtrn['error'] = $validator->errors()->first('file');// Error response
        }else{
            if($request->file('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();

                // $filename = $NewGUID;
             
                // filesize
                $size = $file->getSize();
                $filesize = $size * 0.001;

                // File extension
                $extension = $file->getClientOriginalExtension();

                $path = public_path('files/'.$ProjectGUID);
                // $savedFiles = $pdf->saveAs($urlSavePDF);


                if(!File::exists($path)) {
                    File::makeDirectory($path, $mode = 0755, true, true);

                    // File upload location
                    $location = 'files/'.$ProjectGUID.'/';

                    // // Upload file
                    $file->move($location,$NewGUID.'.'.$extension);
                } else {
                    // File upload location
                    $location = 'files/'.$ProjectGUID.'/';

                    // // Upload file
                    $file->move($location,$NewGUID.'.'.$extension);
                }

                // File path
                $filepath = 'files/'.$ProjectGUID.'/'.$NewGUID.'.'.$extension;

                // Response
                $rtrn['success'] = 1;
                $rtrn['message'] = 'Uploaded Successfully!';

                $data['GUID'] = $GUID;
                $data['ActivityGUID'] = $NewActivityGUID;
                $data['Description'] = $description;
                $data['Directory'] = public_path();
                $data['FileName'] = $filename;
                $data['FilePath'] = $filepath;
                // $data['extension'] = $extension;
                $data['FileSizeInKB'] = round($filesize, 3);
                $data['CreatedBy'] = $UserName;

                DB::table('projectactivityattachmenttemp')->insert($data);
                return response()->json($data);
            }else{
                // Response
                $rtrn['success'] = 2;
                $rtrn['message'] = 'File not uploaded.'; 
            }
        }
    }


    public function getUploadedFile(Request $req)
    {
        $ActivityGUID = Session::get('NewActivityGUID');
        $ProjectGUID = $req['ProjectGUID'];

        $project = ProjectActivityAttachmentTemp::where('ActivityGUID', '=', Str::upper($ActivityGUID))
        ->select('FilePath', 'Description', 'FileSizeInKB', 'ID')
        ->first();
        
        return $project;
    }

    public function generateEvaluationReport($ProjectGUID, $ActivityGUID)
    {
        $NewActivityGUID = Session::get('NewActivityGUID');
        $UserName = Session::get('data')['UserName'];

        $project = ProjectRequirements::orderByRaw('ID ASC')
        // ->where('required', '=', 1)
        ->where('ProjectGUID', '=', $ProjectGUID)
        ->get();

        $todate = date('m/d/Y H:i:s A');

        $pdf = PDF::loadView('pdf.evaluation_report', compact('project', 'todate'));
        $pdf->output();

        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        $todate = date('m/d/Y H:i:s A');

        $Date = date('m/d/Y');

        $urlSavePDF = public_path('files/'.$ProjectGUID.'/'.$GUID.'.pdf');
        $path = public_path('files/'.$ProjectGUID);
            // $savedFiles = $pdf->saveAs($urlSavePDF);

        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0755, true, true);
            $pdf->save($urlSavePDF);
        } else {
            $pdf->save($urlSavePDF);
        }

        $file = pathinfo($urlSavePDF);

        $filesize = filesize($urlSavePDF) * 0.001;

        //  $file = $request->file('file');

        $filename = $file['filename'];
        $extension = $file['extension'];
        $basename = $file['basename'];
        $dirname = $file['dirname'];

        // File path
        // $filepath = public_path('attachments/SignedECC/'.$filename.'.'.$extension);
        $filepath = 'files/'.$ProjectGUID.'/'.$filename.'.'.$extension;

        // Response

        $data['GUID'] = $GUID;
        $data['ActivityGUID'] = Str::upper($NewActivityGUID);
        $data['Description'] = 'Evaluation Report';
        $data['Directory'] = public_path();
        $data['FileName'] = $filename;
        $data['FilePath'] = $filepath;
        // $data['extension'] = $extension;
        $data['FileSizeInKB'] = round($filesize, 3);
        $data['CreatedBy'] = $UserName;

        if(DB::table('projectactivityattachmenttemp')->insert($data)){
            $rtrn['success'] = 1;
            $rtrn['message'] = 'Uploaded Successfully!';
        } else {
            $rtrn['success'] = 0;
            $rtrn['error'] = 'Error while saving data into the database';// Error response
        }

        return redirect()->route('project_app', ['GUID' => $ProjectGUID, 'ActivityGUID' => $ActivityGUID]);

        // return $pdf->download('Evaluation Report.pdf');
    }

    public function generateOrderOfPayment($ProjectGUID, $ActivityGUID)
    {
        $NewActivityGUID = Session::get('NewActivityGUID');
        $UserName = Session::get('data')['UserName'];

        $MaxOOP = Project::max('OrderOfPayment');

        $BankRefNo = str_replace("-","E",$ProjectGUID);

        $now = new \DateTime(); 

        $selectOrderOfPayment = Project::where('project.GUID', '=', $ProjectGUID)
        ->select('OrderOfPayment')
        ->first();

        if($selectOrderOfPayment->OrderOfPayment === null){
            $updateOOP = DB::table('project')
            ->where('GUID','=', $ProjectGUID)
            ->update([
                'OrderOfPayment' => $MaxOOP + 1,
                'BankRefNo' => $BankRefNo
            ]);
        }

        $project = Project::where('project.GUID', '=', $ProjectGUID)
            // ->where('project.Stage', '>', 0 )
            ->Join('projectactivity', function ($join) {
                $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

                $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
            })
            ->leftJoin('proponent', 'project.ProponentGUID', '=', 'proponent.GUID')
            ->select(
                'project.Purpose',
                'project.Address AS Address', 
                'project.Municipality  AS Municipality', 
                'project.Province AS Province', 
                'project.Address', 
                'project.CreatedBy AS CreatedBy', 
                'project.GUID AS GUID', 
                'project.PreviousECCNo',
                'proponent.ProponentName',
                'project.ProjectName', 
                'project.Region  AS Region', 
                'project.OrderOfPayment',

                'projectactivity.RoutedTo', 
                'projectactivity.RoutedFrom', 

                'projectactivity.RoutedToOffice', 
                'projectactivity.RoutedFromOffice', 

                'projectactivity.CreatedDate', 
                'projectactivity.Status', 
                'projectactivity.Details AS Remarks', 
                'projectactivity.GUID AS ActivityGUID',
                'projectactivity.FromDate AS FromDate',
                'projectactivity.UpdatedDate AS UpdatedDate',
                
            )
            ->first();

            $NewGUID = Uuid::generate()->string;
            $GUID = Str::upper($NewGUID);

            $todate = date('m/d/Y H:i:s A');
            $Date = date('m/d/Y');

            $pdf = PDF::loadView('pdf.order_of_payment', compact('project', 'todate', 'Date'));
            $urlSavePDF = public_path('files/'.$ProjectGUID.'/'.$GUID. '.pdf');
            $path = public_path('files/'.$ProjectGUID.'/');
            // $savedFiles = $pdf->saveAs($urlSavePDF);


            if(!File::exists($path)) {
                File::makeDirectory($path, $mode = 0755, true, true);
                
                $pdf->save($urlSavePDF);
            } else {
                $pdf->save($urlSavePDF);
            }

            $file = pathinfo($urlSavePDF);

            $filesize = filesize($urlSavePDF) * 0.001;

            //  $file = $request->file('file');
            $filename = $file['filename'];
            $extension = $file['extension'];
            $basename = $file['basename'];
            $dirname = $file['dirname'];

            // File path
            // $filepath = public_path('attachments/SignedECC/'.$filename.'.'.$extension);
            $filepath = 'files/'.$ProjectGUID.'/'.$filename.'.'.$extension;

            // Response

            $data['GUID'] = $GUID;
            $data['ActivityGUID'] = Str::upper($NewActivityGUID);
            $data['Description'] = 'Order of Payment - Application';
            $data['Directory'] = public_path();
            $data['FileName'] = $filename;
            $data['FilePath'] = $filepath;
            // $data['extension'] = $extension;
            $data['FileSizeInKB'] = round($filesize, 3);
            $data['CreatedBy'] = $UserName;

            if(DB::table('projectactivityattachmenttemp')->insert($data)){
                $rtrn['success'] = 1;
                $rtrn['message'] = 'Uploaded Successfully!';
            } else {
                $rtrn['success'] = 0;
                $rtrn['error'] = 'Error while saving data into the database';// Error response
            }

            return redirect()->route('project_app', ['GUID' => $ProjectGUID, 'ActivityGUID' => $ActivityGUID]);
            // return $pdf->download('Order of Payment - Application.pdf');
        
    }

    public function generateDraftCerticate($GUID, $ActivityGUID)
    {
        $NewActivityGUID = Session::get('NewActivityGUID');
        $UserName = Session::get('data')['UserName'];

        $project = Project::where('project.GUID', '=', $GUID)
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->leftJoin('proponent', 'project.ProponentGUID', '=', 'proponent.GUID')
        ->leftJoin('aspnet_users', 'proponent.GUID', '=', 'aspnet_users.ProponentGUID')
        ->Join('region', 'region.Region', '=', 'project.Region')
        ->select(
            'project.Purpose',
            'project.Address AS Address', 
            'project.Municipality  AS Municipality', 
            'project.Province AS Province',  
            'project.CreatedBy AS CreatedBy', 
            'project.GUID AS GUID', 
            'project.PreviousECCNo',
            'proponent.ProponentName',
            'project.ProjectName', 
            'project.Region  AS Region', 
            'project.LandAreaInSqM',
            'project.Representative as Representative',

            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom', 

            'projectactivity.RoutedToOffice', 
            'projectactivity.RoutedFromOffice', 

            'projectactivity.CreatedDate', 
            'projectactivity.Status', 
            'projectactivity.Details AS Remarks', 
            'projectactivity.GUID AS ActivityGUID',
            'projectactivity.FromDate AS FromDate',
            'projectactivity.UpdatedDate AS UpdatedDate',
            'aspnet_users.*',
            'proponent.*',

            'region.Address as EMBAddress',
            'region.TelephoneNo as EMBTelephoneNo',
            'region.EmailAddress as EMBEmailAddress',
            'region.WebSite as EMBWebSite',
            'region.Director as Director',
            'region.EIAChief as EIAChief',
            'region.EIAChiefSignature',
            'region.DirectorSignature',
            'region.Designation as DirectorDesignation'
        )
        ->first();

        $templateProcessor = new TemplateProcessor('word-template/ECC.docx');

        $templateProcessor->setValue('projectname', $project->ProjectName);
        $templateProcessor->setValue('proponentname', $project->ProponentName);
        $templateProcessor->setValue('representativedesignation', $project->Designation);
        $templateProcessor->setValue('proponentaddress', $project->MailingAddress);
        $templateProcessor->setValue('projectaddress', $project->Address);
        $templateProcessor->setValue('projectdescription', $project->Description);

        $templateProcessor->setValue('UserName', $project->CreatedBy);
        $templateProcessor->setValue('region', $project->Region);
        $templateProcessor->setValue('projectarea', $project->LandAreaInSqM . " square meters ");
        $templateProcessor->setValue('province', $project->Province);
        $templateProcessor->setValue('municipality ', $project->Municipality);
        $templateProcessor->setValue('representative', $project->Representative);

        $templateProcessor->setValue('embaddress', $project->EMBAddress);
        $templateProcessor->setValue('embtelephoneno', $project->EMBTelephoneNo);
        $templateProcessor->setValue('emailaddress', $project->EMBEmailAddress);
        $templateProcessor->setValue('website', $project->EMBWebSite);

        if(Str::lower($project->EIAChief != $project->Director)){
            $templateProcessor->setValue('eiachief', $project->EIAChief);
        } else {
            $templateProcessor->setValue('eiachief', '');
        }
        

        $templateProcessor->setValue('approver', $project->Director);
        $templateProcessor->setValue('approverdesignation', $project->DirectorDesignation);


        $str = $project->DirectorSignature;
        $Signature = explode("/",$str);
        $image = 'signatures/' . $Signature[3];

        $templateProcessor->setImageValue('sign', array('path' => $image, 'width' => 160, 'height' => 70, 'ratio' => false));

        // $templateProcessor->setValue('dategenerated', date("F j, Y"));

        $str1 = $project->EIAChiefSignature;
        $Signature1 = explode("/",$str1);
        $image1 = 'signatures/' . $Signature1[3];

        $templateProcessor->setImageValue('eiachiefsign', array('path' => $image1, 'width' => 160, 'height' => 70, 'ratio' => false));

        // $templateProcessor->setImageV    alue('qrcode', array('path' => 'img/qrc.png', 'width' => 64,  'ratio' => true));

        $filename = 'Draft ECC';
        $urlSave = 'attachments/ECC/' . $GUID . '.docx';
        // dd($urlSave);
        $templateProcessor->saveAs($urlSave);

        $file = pathinfo($urlSave);

        $filesize = filesize($urlSave) * 0.001;

        //  $file = $request->file('file');
        $filename = $file['filename'];
        $extension = $file['extension'];
        $basename = $file['basename'];
        $dirname = $file['dirname'];

        // File path
        // $filepath = public_path('attachments/SignedECC/'.$filename.'.'.$extension);
        $filepath = 'attachments/ECC/'.$filename.'.'.$extension;

        // Response

        $data['GUID'] = $GUID;
        $data['ActivityGUID'] = Str::upper($NewActivityGUID);
        $data['Description'] = 'Draft ECC';
        $data['Directory'] = public_path();
        $data['FileName'] = $filename;
        $data['FilePath'] = $filepath;
        // $data['extension'] = $extension;
        $data['FileSizeInKB'] = round($filesize, 3);
        $data['CreatedBy'] = $UserName;

        if(DB::table('projectactivityattachmenttemp')->insert($data)){
            $rtrn['success'] = 1;
            $rtrn['message'] = 'Uploaded Successfully!';
        } else {
            $rtrn['success'] = 0;
            $rtrn['error'] = 'Error while saving data into the database';// Error response
        }

        return redirect()->route('project_app', ['GUID' => $GUID, 'ActivityGUID' => $ActivityGUID]);
        // return response()->download('attachments/ECC/' . $GUID . '.docx')->deleteFileAftersend(false);
        
    }

    public function default()
    {
        return view('secured.for_actions.default');
    }

    public function generateDenialLetter($GUID, $ActivityGUID)
    {
        $NewActivityGUID = Session::get('NewActivityGUID');
        $UserName = Session::get('data')['UserName'];

        $project = Project::where('project.GUID', '=', $GUID)
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->leftJoin('proponent', 'project.ProponentGUID', '=', 'proponent.GUID')
        ->leftJoin('aspnet_users', 'proponent.GUID', '=', 'aspnet_users.ProponentGUID')
        ->Join('region', 'region.Region', '=', 'project.Region')
        ->select(
            'project.Purpose',
            'project.Address AS Address', 
            'project.Municipality  AS Municipality', 
            'project.Province AS Province',  
            'project.CreatedBy AS CreatedBy', 
            'project.GUID AS GUID', 
            'project.PreviousECCNo',
            'proponent.ProponentName',
            'project.ProjectName', 
            'project.Region  AS Region', 
            'project.LandAreaInSqM',
            'project.Representative as Representative',

            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom', 

            'projectactivity.RoutedToOffice', 
            'projectactivity.RoutedFromOffice', 

            'projectactivity.CreatedDate', 
            'projectactivity.Status', 
            'projectactivity.Details AS Remarks', 
            'projectactivity.GUID AS ActivityGUID',
            'projectactivity.FromDate AS FromDate',
            'projectactivity.UpdatedDate AS UpdatedDate',
            'aspnet_users.*',
            'proponent.*',

            'region.Address as EMBAddress',
            'region.TelephoneNo as EMBTelephoneNo',
            'region.EmailAddress as EMBEmailAddress',
            'region.WebSite as EMBWebSite',
            'region.Director as Director',
            'region.EIAChief as EIAChief',
            'region.EIAChiefSignature',
            'region.DirectorSignature',
            'region.Designation as DirectorDesignation'
        )
        ->first();

        $templateProcessor = new TemplateProcessor('word-template/Denial.docx');

        $templateProcessor->setValue('projectname', $project->ProjectName);
        $templateProcessor->setValue('proponentname', $project->ProponentName);
        $templateProcessor->setValue('representativedesignation', $project->Designation);
        $templateProcessor->setValue('proponentaddress', $project->MailingAddress);
        $templateProcessor->setValue('projectaddress', $project->Address);
        $templateProcessor->setValue('projectdescription', $project->Description);

        $templateProcessor->setValue('UserName', $project->CreatedBy);
        $templateProcessor->setValue('region', $project->Region);
        $templateProcessor->setValue('projectarea', $project->LandAreaInSqM . " square meters ");
        $templateProcessor->setValue('province', $project->Province);
        $templateProcessor->setValue('municipality ', $project->Municipality);
        $templateProcessor->setValue('representative', $project->Representative);

        $templateProcessor->setValue('embaddress', $project->EMBAddress);
        $templateProcessor->setValue('embtelephoneno', $project->EMBTelephoneNo);
        $templateProcessor->setValue('emailaddress', $project->EMBEmailAddress);
        $templateProcessor->setValue('website', $project->EMBWebSite);

        if(Str::lower($project->EIAChief != $project->Director)){
            $templateProcessor->setValue('eiachief', $project->EIAChief);
        } else {
            $templateProcessor->setValue('eiachief', '');
        }
        

        $templateProcessor->setValue('approver', $project->Director);
        $templateProcessor->setValue('approverdesignation', $project->DirectorDesignation);


        $str = $project->DirectorSignature;

        $Signature = explode("/",$str);
        $image = 'signatures/' . $Signature[3];

        $templateProcessor->setImageValue('sign', array('path' => $image, 'width' => 160, 'height' => 70, 'ratio' => false));

        // $templateProcessor->setValue('dategenerated', date("F j, Y"));

        // $filename = 'Draft Denial Letter';
        // $urlSave = public_path('attachments/');
        // $templateProcessor->saveAs($urlSave.$filename . '.docx');
        // return response()->download($filename . '.docx')->deleteFileAftersend(false);

        $filename = 'Draft Denial Letter';
        $urlSave = 'attachments/ECC/' . $GUID . '.docx';
        // dd($urlSave);
        $templateProcessor->saveAs($urlSave);

        $file = pathinfo($urlSave);

        $filesize = filesize($urlSave) * 0.001;

        //  $file = $request->file('file');
        $filename = $file['filename'];
        $extension = $file['extension'];
        $basename = $file['basename'];
        $dirname = $file['dirname'];

        // File path
        // $filepath = public_path('attachments/SignedECC/'.$filename.'.'.$extension);
        $filepath = 'attachments/ECC/'.$filename.'.'.$extension;

        // Response

        $data['GUID'] = $GUID;
        $data['ActivityGUID'] = Str::upper($NewActivityGUID);
        $data['Description'] = 'Draft Denial Letter';
        $data['Directory'] = public_path();
        $data['FileName'] = $filename;
        $data['FilePath'] = $filepath;
        // $data['extension'] = $extension;
        $data['FileSizeInKB'] = round($filesize, 3);
        $data['CreatedBy'] = $UserName;

        if(DB::table('projectactivityattachmenttemp')->insert($data)){
            $rtrn['success'] = 1;
            $rtrn['message'] = 'Uploaded Successfully!';
        } else {
            $rtrn['success'] = 0;
            $rtrn['error'] = 'Error while saving data into the database';// Error response
        }

        return redirect()->route('project_app', ['GUID' => $GUID, 'ActivityGUID' => $ActivityGUID]);
        
        // return response()->download('attachments/ECC/' . $GUID . '.docx')->deleteFileAftersend(false);

        // return redirect()->route('project_app', ['GUID' => $GUID, 'ActivityGUID' => $ActivityGUID]);
    }


    public function acceptApplication(Request $req)
    {
        $ProjectGUID = $req['ProjectGUID'];
        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];
        $Screened = Session::get('data')['Screened'];
        $Email = Session::get('data')['AlternateEmail'];
        $todate = date('Y-m-d H:i:s');

        DB::table('project')
        ->where('GUID','=', $ProjectGUID)
        ->update([
            'AcceptedBy' => $UserName,
            'AcceptedDate' => $todate
        ]);

        DB::table('aspnet_users')
        ->where('UserOffice', '=', $UserOffice)
        ->where('UserName', '=', $UserName)
        ->where('AlternateEmail', '=', $Email)
        ->update([
            'Screened' => $Screened + 1,
        ]);

        return "Success";
    }

    public function getActionRequired(Request $req)
    {
        $UserName = $req['selected_user'];
        $ActionRequired = $req['ActionRequired'];

        $actionrequiredperson = ActionRequiredPerson::where('UserName', '=', $UserName)
        ->where('Active', 1)
        ->get();   

        $array = [];
        foreach ($actionrequiredperson as $key => $arp) {
            $data = [];
            if($arp['Action'] == $ActionRequired){
                $data = '<option value="'.$arp['Action'].'" selected> '.$arp['Action'].'</option>';
            } else {
                $data = '<option value="'.$arp['Action'].'"> '.$arp['Action'].'</option>';
            }
            

            $array[] = $data;
        }

        return $array;

    }

    public function deleteTempAttachment(Request $req)
    {
        $ID = $req['ID'];
        $ActivityGUID = Str::upper(Session::get('NewActivityGUID'));

        ProjectActivityAttachmentTemp::where('ActivityGUID', $ActivityGUID)
        ->where('ID', $ID)
        ->delete();

        return "Success";
    }

    public function decideApplication(Request $req)
    {   
        $now = new \DateTime(); 
        $Status = $req['Status'];
        $UpdatedDate = $req['UpdatedDate'];
        $ProjectGUID = $req['ProjectGUID'];
        $Region = $req['Region'];
        $Remarks = 'Signed ECC';
        $NewActivityGUID = Session::get('NewActivityGUID');

        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $start_date = $UpdatedDate;
        $end_date = date('Y-m-d');

        $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

        $NewGUID = Uuid::generate()->string;

        $ReferenceNoSeries = Project::max('ReferenceNoSeries');
        $ReferenceNoSeries = $ReferenceNoSeries + 1;


        $projectData = Project::where('GUID', '=', $ProjectGUID)
        ->select('*')
        ->first();

        $project = array();
        $project['DecisionDate'] = date('Y-m-d H:i:s');
        $project['ReferenceNoYear'] = date('Y');
        $project['ReferenceNoSeries'] = $ReferenceNoSeries;

        if($Status === 'Approved'){
            $project['DecisionDocument'] = 'ECC';
            $Details = "ECC application Approved. Notarized copy of ECC required.";
        } else {
            $project['DecisionDocument'] = 'DEN';
            $Details = "ECC application Denied.";
        }
        

        $project['ReferenceNo'] = $project['DecisionDocument'] . '-OL-' . $projectData->Region . '-' . date('Y') . '-' . str_pad($ReferenceNoSeries, 4, "0", STR_PAD_BOTH );

        $project['Stage'] = 5;
        $project['UpdatedDate'] = $now->format('Y-m-d H:i:s');

        $ProjectUpdate = DB::table('project')
        ->where('GUID','=', $ProjectGUID)
        ->update([
            'DecisionDate' => $project['DecisionDate'],
            'ReferenceNoYear' => $project['ReferenceNoYear'],
            'ReferenceNoSeries' => $project['ReferenceNoSeries'],
            'DecisionDocument' => $project['DecisionDocument'],
            'ReferenceNo' => $project['ReferenceNo'],
            'Stage' => $project['Stage'],
            'UpdatedDate' => $project['UpdatedDate']
        ]);
        
        $projectActivity = array();
        $projectActivity['GUID'] = Str::upper($NewActivityGUID);
        $projectActivity['ProjectGUID'] = $ProjectGUID;
        $projectActivity['Status'] = $Status;
        $projectActivity['Details'] = $Remarks;
        $projectActivity['RoutedFrom'] = $UserName;
        $projectActivity['RoutedFromOffice'] = $UserOffice;
        $projectActivity['RoutedTo'] = $projectData->CreatedBy;
        $projectActivity['RoutedToOffice'] = "Proponent";
        $projectActivity['Routing'] = 1;
        $projectActivity['Remarks'] = '';
        $projectActivity['UpdatedBy'] = $UserName;
        $projectActivity['CreatedBy'] = $UserName;
        $projectActivity['FromDate'] = $UpdatedDate;
        $projectActivity['TotWorkDays'] = $dateDiff;
        $projectActivity['TotElapsedDays'] = $dateDiff;

        if($ProjectUpdate){
            DB::table('projectactivity')->insert($projectActivity);
        }

        return redirect()->route('convertDocxToPDF', ['GUID' => $ProjectGUID]);
        // if(){
        //    

        //     $AdditionalRequirements = $req['AdditionalRequirements'];

        //     if($AdditionalRequirements != null){
        //         foreach ($AdditionalRequirements as $key => $value) {
        //             $projectrequirement = array();
        //             $projectrequirement['ProjectGUID'] = $ProjectGUID;
        //             $projectrequirement['Description'] = $value['description']; 
        //             $projectrequirement['Required'] = 0;
        //             $projectrequirement['Compliant'] = 0; 
        //             DB::table('projectrequirement')->insert($projectrequirement);
        //         }
        //     }

        //     if($IncludeAttachment === "true"){

        //         $data = DB::table('projectactivityattachmenttemp')
        //             ->select('GUID','ActivityGUID','Description','FileName','Directory','FilePath','FileSizeInKB','CreatedBy','CreatedDate')
        //             ->where('ActivityGUID', '=', $NewActivityGUID)
        //             ->get();

        //         $array = $data->map(function($obj){
        //             return (array) $obj;
        //             })->toArray();


        //         if(DB::table('projectactivityattachment')->insert($array)){
        //             ProjectActivityAttachmentTemp::where('ActivityGUID', $NewActivityGUID)->delete();
        //         }
        //     }

        // }
    }


    public function reviewerPDF(Request $req)
    {
        $ProjectGUID = $req['ProjectGUID'];
        $Description = $req['Description'];

        $Requirements = ProjectActivity::where('projectactivity.ProjectGUID', '=', $ProjectGUID)
        ->Join('projectactivityattachment', function ($join) {
            $join->on('projectactivity.GUID', '=', 'projectactivityattachment.ActivityGUID');

            // $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
            //     join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->leftJoin('projectrequirement', function ($join) {
            $join->on('projectactivity.ProjectGUID', '=', 'projectrequirement.ProjectGUID');
            $join->on('projectactivityattachment.Description', '=', 'projectrequirement.Description');
            // $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
            //     join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->where('projectactivityattachment.Description', '=', $Description)
        ->select(
            'projectactivityattachment.Description',
            'projectactivityattachment.FileName',
            'projectactivityattachment.Directory',
            'projectactivityattachment.FilePath',
            'projectactivityattachment.FileSizeInKB',
            'projectactivityattachment.CreatedBy',
            'projectactivityattachment.CreatedDate',
            'projectactivityattachment.ActivityGUID',
            'projectactivityattachment.GUID',
            'projectrequirement.Compliant',
            'projectrequirement.ID AS PRID',
            'projectrequirement.Remarks AS Remarks'
        )
        ->first();

        $PDF = url($Requirements->FilePath);

        $returnArray['FilePath'] = $PDF;
        $returnArray['Compliant'] = $Requirements->Compliant;
        $returnArray['Description'] = $Requirements->Description;
        $returnArray['PRID'] = $Requirements->PRID;
        $returnArray['Remarks'] = $Requirements->Remarks;
        
        

        return $returnArray;

    }

    public function generateQrCode()
    {   
        $QRCode = \QrCode::size(250)->generate('http://ecconline.emb.gov.ph:8080/welcome');
        return view('secured.for_actions.qrcode', compact('QRCode'));
    }

    public function convertDocxToPDF($GUID)
    {
        $ProjectGUID = $GUID;
        $NewActivityGUID = Session::get('NewActivityGUID');
        $UserName = Session::get('data')['UserName'];

        $project = Project::where('project.GUID', '=', $GUID)
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->leftJoin('proponent', 'project.ProponentGUID', '=', 'proponent.GUID')
        ->leftJoin('aspnet_users', 'proponent.GUID', '=', 'aspnet_users.ProponentGUID')
        ->Join('region', 'region.Region', '=', 'project.Region')
        ->select(
            'project.Purpose',
            'project.Address AS Address', 
            'project.Municipality  AS Municipality', 
            'project.Province AS Province',  
            'project.CreatedBy AS CreatedBy', 
            'project.GUID AS GUID', 
            'project.PreviousECCNo',
            'proponent.ProponentName',
            'project.ProjectName', 
            'project.Region  AS Region', 
            'project.LandAreaInSqM',
            'project.Representative as Representative',

            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom', 

            'projectactivity.RoutedToOffice', 
            'projectactivity.RoutedFromOffice', 

            'projectactivity.CreatedDate', 
            'projectactivity.Status', 
            'projectactivity.Details AS Remarks', 
            'projectactivity.GUID AS ActivityGUID',
            'projectactivity.FromDate AS FromDate',
            'projectactivity.UpdatedDate AS UpdatedDate',
            'aspnet_users.*',
            'proponent.*',

            'region.Address as EMBAddress',
            'region.TelephoneNo as EMBTelephoneNo',
            'region.EmailAddress as EMBEmailAddress',
            'region.WebSite as EMBWebSite',
            'region.Director as Director',
            'region.EIAChief as EIAChief',
            'region.EIAChiefSignature',
            'region.DirectorSignature',
            'region.Designation as DirectorDesignation'
        )
        ->first();

        // $templateProcessor = new TemplateProcessor('word-template/ECC.docx');

        $templateProcessor = new TemplateProcessor('attachments/ECC/'.$GUID.'.docx');

        $ReferenceNoSeries = Project::max('ReferenceNoSeries');
        $ReferenceNoSeries = $ReferenceNoSeries + 1;

        $projectData = Project::where('GUID', '=', $ProjectGUID)
        ->select('*')
        ->first();


        $ReferenceNo = 'ECC' . '-OL-' . 'R07' . '-' . date('Y') . '-' . str_pad($ReferenceNoSeries, 4, "0", STR_PAD_BOTH );

        $templateProcessor->setValue('referenceno', $ReferenceNo);

        $templateProcessor->setValue('projectname', $project->ProjectName);
        $templateProcessor->setValue('proponentname', $project->ProponentName);
        $templateProcessor->setValue('representativedesignation', $project->Designation);
        $templateProcessor->setValue('proponentaddress', $project->MailingAddress);
        $templateProcessor->setValue('projectaddress', $project->Address);
        $templateProcessor->setValue('projectdescription', $project->Description);

        $templateProcessor->setValue('UserName', $project->CreatedBy);
        $templateProcessor->setValue('region', $project->Region);
        $templateProcessor->setValue('projectarea', $project->LandAreaInSqM . " square meters ");
        $templateProcessor->setValue('province', $project->Province);
        $templateProcessor->setValue('municipality ', $project->Municipality);
        $templateProcessor->setValue('representative', $project->Representative);

        $templateProcessor->setValue('embaddress', $project->EMBAddress);
        $templateProcessor->setValue('embtelephoneno', $project->EMBTelephoneNo);
        $templateProcessor->setValue('emailaddress', $project->EMBEmailAddress);
        $templateProcessor->setValue('website', $project->EMBWebSite);

        if(Str::lower($project->EIAChief != $project->Director)){
            $templateProcessor->setValue('eiachief', $project->EIAChief);
        } else {
            $templateProcessor->setValue('eiachief', '');
        }
        

        $templateProcessor->setValue('approver', $project->Director);
        $templateProcessor->setValue('approverdesignation', $project->DirectorDesignation);

        // $QRCodeLink = 'http://ecconline.emb.gov.ph:8080/verification/' . $GUID;

        $QRCodeLink = url('/verification/' . $GUID);

        $QRCode = \QrCode::size(250)->format('png')
        ->generate($QRCodeLink, public_path('qr-code/' . $GUID .'.png'));

        $QrCodePath = 'qr-code/'.$GUID.'.png';

        $templateProcessor->setImageValue('qrcode', array('path' => $QrCodePath, 'width' => 64, 'height' => 125, 'ratio' => true));

        $str = $project->DirectorSignature;

        $Signature = explode("/",$str);
        $image = 'signatures/' . $Signature[3];

        $templateProcessor->setImageValue('sign', array('path' => $image, 'width' => 160, 'height' => 125, 'ratio' => true));

        $templateProcessor->setValue('dategenerated', date("F j, Y"));

        $str1 = $project->EIAChiefSignature;
        $Signature1 = explode("/",$str1);
        $image1 = 'signatures/' . $Signature1[3];

        $templateProcessor->setImageValue('eiachiefsign', array('path' => $image1, 'width' => 160, 'height' => 125, 'ratio' => true));

        $filename = 'Draft ECC';
        $urlSave = public_path('attachments/SignedECC/'.$GUID.'.docx');
        // do some variable magic
        // $templateProcessor->setValue('key', $value);

        $html = view('html');

        // create temporary section
        $section = (new PhpWord())->addSection();

        // add html
        Html::addHtml($section, $html, false, false);

        // get elements in section
        $containers = $section->getElements();


        // clone the html block in the template
        $templateProcessor->cloneBlock('htmlblock', count($containers), true, true);

        // replace the variables with the elements
        for($i = 0; $i < count($containers); $i++) {
            // be aware of using setComplexBlock
            // and the $i+1 as the cloned elements start with #1
            $templateProcessor->setComplexBlock('html#' . ($i+1), $containers[$i]);
        }

        if ( file_exists($urlSave) ) {
            unlink($urlSave);
        }

        // save final document
        $templateProcessor->saveAs($urlSave);


         // $file = file_get_contents($urlSave);

         // ConvertApi::setApiSecret('oIwYrAjcSsermjaL');

        // # Example of saving Word docx to PDF and to PNG
        // # https://www.convertapi.com/docx-to-pdf
        // # https://www.convertapi.com/docx-to-png

        // $dir = sys_get_temp_dir();

        // # Use upload IO wrapper to upload file only once to the API
        // $upload = new \ConvertApi\FileUpload(public_path('attachments/SignedECC/'.$GUID.'.docx'));

        // $urlSavePDF = public_path('attachments/SignedECC/'.$GUID.'.pdf');
        // $result = ConvertApi::convert('pdf', ['File' => $upload]);
        // $savedFiles = $result->saveFiles($urlSavePDF);

        // echo "The PDF saved to:\n";
        // print_r($savedFiles);

        // # Reuse the same uploaded file
        // $result = ConvertApi::convert('png', ['File' => $upload]);
        // $savedFiles = $result->saveFiles($dir);

        // echo "The PNG saved to:\n";
        // print_r($savedFiles);

        // $now = new \DateTime(); 

        // $templateProcessor = new TemplateProcessor('attachments/ECC/Draft ECC.docx');
        
        // return response()->download(public_path('attachments/SignedECC/' . $NewActivityGUID . '.docx'), $NewActivityGUID . '.docx');

        ///urlSave 
        ///urlSavePDF
        $file = pathinfo($urlSave);

        $filesize = filesize($urlSave) * 0.001;

        //  $file = $request->file('file');
        $filename = $file['filename'];
        $extension = $file['extension'];
        $basename = $file['basename'];
        $dirname = $file['dirname'];

        // File path
        // $filepath = public_path('attachments/SignedECC/'.$filename.'.'.$extension);
        $filepath = 'attachments/SignedECC/'.$filename.'.'.$extension;

        // Response
        $rtrn['success'] = 1;
        $rtrn['message'] = 'Uploaded Successfully!';

        $data['GUID'] = $GUID;
        $data['ActivityGUID'] = Str::upper($NewActivityGUID);
        $data['Description'] = 'Signed ECC';
        $data['Directory'] = public_path();
        $data['FileName'] = $filename;
        $data['FilePath'] = $filepath;
        // $data['extension'] = $extension;
        $data['FileSizeInKB'] = round($filesize, 3);
        $data['CreatedBy'] = $UserName;

        DB::table('projectactivityattachment')->insert($data);

        return redirect()->route('default');
    }

    public function revertApplication(Request $req)
    {
        $now = new \DateTime(); 
        $ProjectGUID = $req['ProjectGUID'];
        $UpdatedDate = $req['UpdatedDate'];
        $NewActivityGUID = Session::get('NewActivityGUID');

        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $start_date = $UpdatedDate;
        $end_date = date('Y-m-d');

        // Str::upper($NewActivityGUID);

        $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

        $NewGUID = Uuid::generate()->string;

        $ProjectID = ProjectActivity::where('ProjectGUID', '=', $ProjectGUID)->max('ID');

        // get previous user id
        $Previous = ProjectActivity::where('ID', '<', $ProjectID)
        ->where('ProjectGUID', '=', $ProjectGUID)
        ->orderBy('ID','desc')->first();

        $projectActivity = array();
        $projectActivity['GUID'] = Str::upper($NewActivityGUID);
        $projectActivity['ProjectGUID'] = $ProjectGUID;
        $projectActivity['Status'] = $Previous->Status;
        $projectActivity['Details'] = $Previous->Details;
        $projectActivity['RoutedFrom'] = $UserName;
        $projectActivity['RoutedFromOffice'] = $UserOffice;
        $projectActivity['RoutedTo'] = $Previous->RoutedTo;
        $projectActivity['RoutedToOffice'] = $Previous->RoutedToOffice;
        $projectActivity['Routing'] = $Previous->Routing;
        $projectActivity['Remarks'] = 'Reverted';
        $projectActivity['UpdatedBy'] = $UserName;
        $projectActivity['CreatedBy'] = $UserName;
        $projectActivity['FromDate'] = $UpdatedDate;
        $projectActivity['TotWorkDays'] = $dateDiff;
        $projectActivity['TotElapsedDays'] = $dateDiff;

        if( DB::table('projectactivity')->insert($projectActivity))
        {
            return 'Success';
        }else{
            return 'Error while saving data into the database';
        }
    }

    public function holidays()
    {
        $Holidays = HolidaysNational::all();

        $Regions = Region::all();

        return view('secured.holidays', compact('Holidays', 'Regions'));
    }

    public function getHolidaysTable(Request $req)
    {
        $UserName = $req['UserName'];
        $UserRole = $req['UserRole'];
        $UserOffice = $req['UserOffice'];

        $StartDate = date('Y') . '-01-01';
        $EndDate = date('Y') . '-12-31';


        $Holidays = Holidays::where('Coverage', 'LIKE', '%'. $UserOffice . '%')
        ->where('OnDate','>=', $StartDate)
        ->where('OnDate','<=', $EndDate)
        ->orderByRaw('OnDate ASC')
        ->get();

        return DataTables::of($Holidays)
        ->addColumn('Description', function($Holidays){
            $details = '<b>' . $Holidays->Description . '</b>';
            return $details;

        })
        ->addColumn('Date', function($Holidays){
            $date = date("F j, Y", strtotime($Holidays->OnDate));
            return $date;

        })
        ->addColumn('Action', function($Holidays){
            $details = '<button type="button" class="btn btn-default btn-sm" name="submit" title="Edit Holiday" onclick="editHoliday('.$Holidays->ID.')"><img src="../img/edit.png" style="width:15px;" /></button>&nbsp;&nbsp;';

            $details .= '<button type="button" class="btn btn-default btn-sm" onclick="deleteFile('.$Holidays->ID.')" title="Delete Holiday"><img src="../img/trashbin.jpg" style="width:15px;" /></button></form>';
            return $details;
        })

        
        ->rawColumns(['Date', 'Description', 'Action'])
        ->make(true);
    }

    public function addHolidays(Request $req)
    {
        $UserName = Session::get('data')['UserName'];
        $ID = $req['DescriptionID'];
        $Notes = $req['Notes'];


        foreach($ID as $IDDesc){
            $row = [];
            $Holidays = HolidaysNational::where('ID', '=', $IDDesc)
            ->first();

            $row['Description'] = $Holidays->Description;
            $row['OnDate'] = date("Y-m-d", strtotime($Holidays->OnDate . date('Y')) );
            $row['Coverage'] = $Holidays->Coverage;
            $row['Scope'] = 'National';
            $row['Notes'] = $Notes;
            $row['UpdatedBy'] = $UserName;
            $row['UpdatedDate'] = date('Y-m-d H:i:s');
            $row['CreatedBy'] = $UserName;
            $row['CreatedDate'] = date('Y-m-d H:i:s');

            DB::table('holidays')->insert($row);
        }
    }

    public function getSpecificHolidays(Request $req)
    {
        $UserName = Session::get('data')['UserName'];
        $ID = $req['ID'];

        $Holidays = Holidays::where('ID', '=', $ID)
            ->first();


        // foreach ($Holidays as $key => $value) {
            $rowData = [];

            $rowData['Description'] = $Holidays['Description'];
            $rowData['OnDate'] = date("m/d/Y", strtotime($Holidays['OnDate']) );
            $rowData['Coverage'] =explode(", ",$Holidays['Coverage']);
            $rowData['Scope'] = $Holidays['Scope'];
            $rowData['Notes'] = $Holidays['Notes'];
            $rowData['UpdatedBy'] = $Holidays['UpdatedBy'];
            $rowData['UpdatedDate'] = $Holidays['UpdatedDate'];
            $rowData['CreatedBy'] = $Holidays['CreatedBy'];
            $rowData['CreatedDate'] = $Holidays['CreatedDate'];

            return $rowData;
        // }
    }

    
}



