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
use App\Models\ECCDraft;
use App\Models\ECCDraftPerProject;


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

use Session;
use File;
// use PDF;
use \ConvertApi\ConvertApi;

use Knp\Snappy\Pdf as PDF;




class ForActionsController extends Controller
{
    public function index()
    {
        return view('secured.for_actions.index');
    }

    public function project_app($GUID, $ActivityGUID)
    {  

        $project = DB::table('project')->where('project.GUID', $GUID)
        // ->where('project.Stage', '>', 0 )
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', 'projectactivity.ProjectGUID');

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->leftJoin('proponent', 'project.ProponentGUID', 'proponent.GUID')
        ->select(
            'project.Purpose',
            'project.Address AS Address', 
            'project.Municipality  AS Municipality', 
            'project.Province AS Province', 
            'project.Address', 
            'project.CreatedBy AS CreatedBy', 
            'project.GUID AS GUID', 
            'project.PreviousECCNo',
            'project.ProjectName', 
            'project.Region  AS Region', 
            'project.AcceptedBy',
            'project.AcceptedDate',
            'project.Representative',
            'project.Designation',
            'project.LandAreaInSqM',
            'project.FootPrintAreaInSqM',

            'project.NoOfEmployees',
            'project.ProjectCost',

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


            'proponent.ProponentName',
            
        )
        ->first();

        $UserRole = Session::get('data')['UserRole'];
        $UserName = Session::get('data')['UserName'];

        $attachments = Attachment::where('UserRole', '=', $UserRole)
        ->orderByRaw('Sorter ASC')
        ->get();

        $start_date = $project->UpdatedDate;
        $end_date = date('Y-m-d');

        $UpdatedDate = date("F j, Y g:i a", strtotime($project->UpdatedDate));

        $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

        
        if(Str::lower($project->RoutedTo) === Str::lower($UserName) ){
            return view('secured.for_actions.project_app', compact('project', 'attachments', 'dateDiff'));
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
        $project['data'] = ProjectRequirements::where('ProjectGUID', $req['data'])
        ->where('Compliant', 0)
        ->where('Required', 1)
        // ->where('CreatedBy', '=', $UserName)
        ->select('Description', 'ID', 'ProjectGUID')
        ->get();
        return response()->json($project);
    }

    public function getActivityAttachmentsList(Request $req)
    {   
        $ActivityGUID = $req['ActivityGUID'];
        $ProjectGUID = $req['ProjectGUID'];

        $project = ProjectActivity::where('projectactivity.ProjectGUID', '=', $ProjectGUID)
        ->Join('projectactivityattachment', function($join)
        {
            $join->on('projectactivityattachment.ActivityGUID', '=', 'projectactivity.GUID');
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

            return $date;
        })
        ->rawColumns(['Details', 'CreatedDate'])
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
        ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
        ->select('aspnet_users.*', 'aspnet_membership.*')
        ->where('aspnet_users.InECCOAS', 1)
        ->where('aspnet_membership.IsApproved', 1)
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
        // $project = DB::table('projectrequirement')->orderByRaw('ID ASC')
        // // ->where('required', '=', 1)
        // ->where('ProjectGUID', '=', $ProjectGUID)
        // ->get();

        $project = DB::table('projectrequirement')->orderByRaw('projectrequirement.ID ASC')
        ->where('projectrequirement.ProjectGUID', '=', $ProjectGUID)
        ->Join('projectactivity', 'projectrequirement.ProjectGUID', '=', 'projectactivity.ProjectGUID')
        ->select(
            'projectactivity.Status', 
            'projectactivity.ProjectGUID AS ProjectGUID',
            'projectactivity.GUID AS ActivityGUID',
            'projectrequirement.Compliant',
            'projectrequirement.Required',
            'projectrequirement.Description',
            'projectrequirement.ID',
        )
        ->orderByRaw('projectrequirement.ID DESC')
        ->get();

        $ApplicationRequirements = [];

        foreach ($project as $key => $value) {
            $rowData = [];

            $found_key = array_search($value->Description, array_column($ApplicationRequirements, 'Description'));
            // echo($found_key);
            if(!$found_key){

                $project = DB::table('projectactivityattachment')->orderByRaw('projectactivityattachment.ID ASC')
                ->where('projectactivityattachment.ActivityGUID', '=', $value->ActivityGUID)
                ->where('projectactivityattachment.Description', '=', $value->Description)
                ->first();

                if($project){
                    
                    $rowData['Compliant'] = $value->Compliant;
                    $rowData['Required'] = $value->Required;
                    $rowData['Description'] = $value->Description;
                    $rowData['Compliant'] = $value->Compliant;
                    $rowData['ID'] = $value->ID;
                    $rowData['ActivityGUID'] = $value->ActivityGUID;
                    $rowData['ProjectGUID'] = $value->ProjectGUID;
                    $rowData['Status'] = $value->Status;

                    $rowData['FileName'] = $project->FileName;
                    $rowData['Directory'] = $project->Directory;
                    $rowData['FilePath'] = $project->FilePath;
                    $rowData['FileSizeInKB'] = $project->FileSizeInKB;
      
                    array_push($ApplicationRequirements, $rowData);
                } 
                else{

                    if($value->Description == 'Affidavit of No Complaint' || $value->Description == 'Bank Receipt (Application Fee)' ){

                        $rowData['Compliant'] = $value->Compliant;
                        $rowData['Required'] = $value->Required;
                        $rowData['Description'] = $value->Description;
                        $rowData['Compliant'] = $value->Compliant;
                        $rowData['ID'] = $value->ID;
                        $rowData['ActivityGUID'] = $value->ActivityGUID;
                        $rowData['ProjectGUID'] = $value->ProjectGUID;
                        $rowData['Status'] = $value->Status;

                        $rowData['FileName'] = '';
                        $rowData['Directory'] = '';
                        $rowData['FilePath'] = '';
                        $rowData['FileSizeInKB'] = '';

                        array_push($ApplicationRequirements, $rowData);

                    }
                    
                }

                

            }

        }
        // dd($ApplicationRequirements);

        //array search by value
        

        //sort array
        // $keys = array_column($ApplicationRequirements, 'ID');
        // array_multisort($keys, SORT_DESC, $ApplicationRequirements);
        
        return DataTables::of($ApplicationRequirements)
        ->addColumn('Complied', function($project){
            if($project['Compliant'] == 1){
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

            if( $project['Required'] == 1){ 
                $Required = " (Required) " ;
            } else { $Required = " (Not Required) "; } 

            if($project['Description'] == 'Bank Receipt (Application Fee)'){
                $description = $project['Description'] .' </a> <i>' . $Required .'</i> <span style="background-color:yellow;">&nbsp;-Please dont forget to require (tick) this item prior to reverting to the proponent.</span>';
            } else {
                $description = $project['Description'].' </a> <i>' . $Required .'</i> ';
            }

            // $details = '<a id="pointer" onclick="modalEvaluation('."'". $project['ProjectGUID']."', ". 
            // "'". $project['ID']."', "."'". $project['Description'] ."'".')">' . $description ;

            $details = '<a id="pointer" onclick="modalEvaluation(\''. $project['ProjectGUID'].'\', \''. $project['ID'].'\', \''. $project['Description'].'\', \''. $project['ActivityGUID'].'\')">' . $description ;

            
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
        $ActivityGUID = $req['ActivityGUID'];

        // $project = DB::table('projectactivity')->whereHas('projectactivityattachment', function($q) use($projectactivityattachment) {
        //     $q->whereIn('projectactivityattachment.ActivityGUID', $ActivityGUID);
        // })->get();

        $project = DB::table('projectrequirement')->where('projectrequirement.ProjectGUID', '=', $ProjectGUID)
        ->where('projectrequirement.ID', '=', $ID)
        ->where('projectrequirement.Description', '=', $Description)
        ->where('projectactivity.GUID', '=', $ActivityGUID)
        ->Join('projectactivity', function($join) use ($ActivityGUID)
        {
            $join->on('projectrequirement.ProjectGUID', '=', 'projectactivity.ProjectGUID');
            // $join->on('projectactivity.GUID', '=', $ActivityGUID);
        })
        ->leftJoin('projectactivityattachment', function($join)
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
        // DD($project);
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

        // return "Success";
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
        
        $NewActivityGUID = Session::get('NewActivityGUID');

        $IncludeAttachment = $req['IncludeAttachment'];

        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $start_date = $UpdatedDate;
        $end_date = date('Y-m-d');

        $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

        $NewGUID = Uuid::generate()->string;

        $Status = $req['Status'];

        if($Status == 'For Screening'){
            $StatusAction = 'For Screening';
            $Remarks = $ActionRequired . ' - '. $req['Remarks'];
        }else{
            $StatusAction = $ActionRequired;
            $Remarks = $req['Remarks'];
        }

        $projectActivity = array();
        $projectActivity['GUID'] = Str::upper($NewActivityGUID);
        $projectActivity['ProjectGUID'] = $ProjectGUID;
        $projectActivity['Status'] = $StatusAction;
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
        $projectActivity['TotWorkDays'] = $dateDiff - 1;
        $projectActivity['TotElapsedDays'] = $dateDiff - 1;

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

        $BankBranch = $req['BankBranch'];
        $Datepicker = $req['Datepicker'];
        $BankSequenceNo = $req['BankSequenceNo'];

        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $start_date = $UpdatedDate;
        $end_date = date('Y-m-d');

        $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

        if($Status == 'For Screening'){
            $StatusAction = 'For Evaluation';
        }else{
            $StatusAction = $Status;
        }
        
        $RouteTo = DB::table('aspnet_users')
        ->select('*')
        ->where('UserOffice', '=', $RoutedToOffice)
        ->where('UserRole', '=', 'Evaluator')
        ->where('InECCOAS', '=', 1)
        // ->where('Designation', '=', 'casehandler')
        ->where('DefaultRecipient', '=', 1)
        ->orderByRaw('Screened Desc')
        ->first();

        $NewGUID = Uuid::generate()->string;

        $projectActivity = array();
        $projectActivity['GUID'] = Str::upper($NewActivityGUID);
        $projectActivity['ProjectGUID'] = $ProjectGUID;
        $projectActivity['Status'] = $StatusAction;
        $projectActivity['Details'] = $Remarks;
        $projectActivity['RoutedFrom'] = $UserName;
        $projectActivity['RoutedFromOffice'] = $UserOffice;
        $projectActivity['RoutedTo'] = $RouteTo->UserName;
        $projectActivity['RoutedToOffice'] = $RoutedToOffice;
        $projectActivity['Routing'] = 1;
        $projectActivity['Remarks'] = '';
        $projectActivity['UpdatedBy'] = $UserName;
        $projectActivity['CreatedBy'] = $UserName;
        $projectActivity['FromDate'] = $UpdatedDate;
        $projectActivity['TotWorkDays'] = $dateDiff - 1;
        $projectActivity['TotElapsedDays'] = $dateDiff - 1;

        $updateBankDetails = DB::table('project')
            ->where('GUID','=', $ProjectGUID)
            ->update([
                'BankBranch' => $BankBranch,
                'ORNumber' => $BankSequenceNo,
                'BankTransaction' => $Datepicker,
                'ProcessingFee' => 5070,
                'AmountPaid' => 5050
            ]);


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
            'file' => 'required|mimes:pdf,docx|max:2048'
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
        ->get();
        
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

        $todate = date('m/d/Y h:i:s A');

        $pdf = PDF::loadView('pdf.evaluation_report', compact('project', 'todate'));
        $pdf->output();

        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        $todate = date('m/d/Y h:i:s A');

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

        $DatabaseTemp = DB::table('projectactivityattachmenttemp')->insert($data);
        $DatabaseTemp = DB::table('projectactivityattachment')->insert($data);

        if($DatabaseTemp){
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

            $DatabaseTemp = DB::table('projectactivityattachmenttemp')->insert($data);
            $DatabaseTemp = DB::table('projectactivityattachment')->insert($data);

            if($DatabaseTemp){
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

        $templateProcessor->setValue('projectname', htmlspecialchars($project->ProjectName));
        $templateProcessor->setValue('proponentname', htmlspecialchars($project->ProponentName));
        $templateProcessor->setValue('representativedesignation', $project->Designation);
        $templateProcessor->setValue('proponentaddress', $project->MailingAddress);
        $templateProcessor->setValue('projectaddress', $project->Address);
        $templateProcessor->setValue('projectdescription', $project->Description);

        $templateProcessor->setValue('UserName', $project->CreatedBy);
        $templateProcessor->setValue('region', $project->Region);
        $templateProcessor->setValue('projectarea', $project->LandAreaInSqM . " square meters ");
        $templateProcessor->setValue('province', $project->Province);
        $templateProcessor->setValue('municipality', $project->Municipality);
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

        $templateProcessor->setValue('projectname', htmlspecialchars($project->ProjectName));
        $templateProcessor->setValue('proponentname', htmlspecialchars($project->ProponentName));
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

        $counter = 0;
        $array = [];
        foreach ($actionrequiredperson as $key => $arp) {
            $data = [];
            $counter++;
            if($arp['Action'] == $ActionRequired){
                $data = '<option value="'.$arp['Action'].'" selected> '.$arp['Action'].'</option>';
            } elseif($counter == 1){
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
        $projectActivity['TotWorkDays'] = $dateDiff - 1;
        $projectActivity['TotElapsedDays'] = $dateDiff - 1;

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

        $templateProcessor->setValue('projectname', htmlspecialchars($project->ProjectName));
        $templateProcessor->setValue('proponentname', htmlspecialchars($project->ProponentName));
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


         $file = file_get_contents($urlSave);

         ConvertApi::setApiSecret('oIwYrAjcSsermjaL');

        // # Example of saving Word docx to PDF and to PNG
        // # https://www.convertapi.com/docx-to-pdf
        // # https://www.convertapi.com/docx-to-png

        $dir = sys_get_temp_dir();

        // # Use upload IO wrapper to upload file only once to the API
        $upload = new \ConvertApi\FileUpload(public_path('attachments/SignedECC/'.$GUID.'.docx'));

        $urlSavePDF = public_path('attachments/SignedECC/'.$GUID.'.pdf');
        $result = ConvertApi::convert('pdf', ['File' => $upload]);
        $savedFiles = $result->saveFiles($urlSavePDF);

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
        $file = pathinfo($urlSavePDF);

        $filesize = filesize($urlSavePDF) * 0.001;

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
        $projectActivity['TotWorkDays'] = $dateDiff - 1;
        $projectActivity['TotElapsedDays'] = $dateDiff - 1;

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

    public function getCompliantsCount(Request $req)
    {
        $ProjectGUID = $req['ProjectGUID'];
        $ProjectCounts = DB::table('projectrequirement')->orderByRaw('ID ASC')
        ->where('Compliant', '=', 0)
        ->where('ProjectGUID', '=', $ProjectGUID)
        ->count();

        return $ProjectCounts;
    }

    public function updateBasicProjectInformation(Request $req)
    {
        $ProjectGUID = $req['ProjectGUID'];
        $ProjectName = $req['ProjectName'];
        $RepresentBy = $req['RepresentBy'];
        $Designation = $req['Designation'];
        $LandAreaInSqM = $req['LandAreaInSqM'];
        $FootPrintAreaInSqM = $req['FootPrintAreaInSqM'];
        $NoOfEmployees = $req['NoOfEmployees'];
        $ProjectCost = $req['ProjectCost'];

        $now = new \DateTime(); 
        
        try {
            // Validate the value...
            DB::table('project')
            ->where('GUID', $ProjectGUID)
            ->update([
                'ProjectName' => $ProjectName,
                'Representative' => $RepresentBy,
                'Designation' => $Designation,
                'LandAreaInSqM' => $LandAreaInSqM,
                'FootPrintAreaInSqM' => $FootPrintAreaInSqM,
                'NoOfEmployees' => $NoOfEmployees,
                'ProjectCost' => $ProjectCost,
                'UpdatedDate' => $now->format('Y-m-d H:i:s')
            ]);
        } catch (Throwable $e) {
            report($e);
     
            return false;
        }

        return true;
    }

    public function getApplicationsList(Request $req)
    {
        $UserName = $req['UserName'];
        $UserRole = $req['UserRole'];
        $UserOffice = $req['UserOffice'];

        $todate = date('Y-m-d H:i:s');
        $tomorrow = date('Y-m-d', strtotime( $todate . " +1 days"));

        $projects = Project::select(
            'project.Address AS Address', 
            'project.Municipality  AS Municipality', 
            'project.Province AS Province', 
            'project.Stage', 
            'project.ProjectName', 
            'project.Region AS Region', 
            'project.GUID AS ProjectGUID', 
            // 'project.UpdatedDate AS UpdatedDate',
            'project.ProcTimeFrameInDays',

            'projectactivity.Status', 
            'projectactivity.Details AS Remarks', 
            'projectactivity.GUID AS ActivityGUID', 
            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom', 
            'projectactivity.CreatedDate',
            'projectactivity.UpdatedDate AS UpdatedDate',

        )
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', 'projectactivity.ProjectGUID');

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->where('projectactivity.RoutedTo', $UserName)
        ->where('project.CreatedBy', $UserName)
        ->orderBy('projectactivity.UpdatedDate', 'DESC')
        ->groupBy('project.GUID')
        ->get();

        $project = $projects;

        return DataTables::of($project)
        ->addColumn('Details', function($project) use ($UserRole){
            if($project->Stage > 0){
                $details = '<a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
            }else{
                if($UserRole != 'Evaluator'){
                    $details = '<a class="text-uppercase pointer" onclick="NewDocument('. "'" .$project->ProjectGUID. "'".')">'. $project->ProjectName.'</a>';
                }else{
                    $details = '<a class="text-uppercase pointer" onclick="NewDocument('. "'" .$project->ProjectGUID. "'".')">'. $project->ProjectName.'</a>';
                }
            }
            
            $details .= '<br><p class="text-uppercase">'.$project->Address.', '. $project->Municipality.', '. $project->Province.', '. $project->Region .'</p>';
            return $details;
        })
        ->addColumn('Status', function($project){

            $details = '<small><i style="color:slategray;">'. $project->Status.'</i></small>';
            
            return $details;
        })
        ->addColumn('Remarks', function($project){

            $date = date("F j, Y g:i a", strtotime($project->UpdatedDate));
            $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $details;
        })
        ->addColumn('IncurredDate', function($project){

            $start_date = $project->UpdatedDate;
            $end_date = date('Y-m-d');

            $UpdatedDate = date("F j, Y g:i a", strtotime($project->UpdatedDate));

            $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

            if($dateDiff > 7){
                $details = '<small>'. ($dateDiff - 1).'/'.$project->ProcTimeFrameInDays.' days incurred from last submission';

                if($project->Status != 'Pending for Submission' && $project->Status != 'Approved' && $project->Status != 'Denied' && $project->Status != 'Dropped' ){
                    $this->autoForwardingProponent($project->ProjectGUID, $UpdatedDate, $dateDiff );
                } 
                
            } else if($project->Status == 'Dropped') {
                $details = '';                
            } else {
                $details = '<small>'. ($dateDiff - 1).'/'.$project->ProcTimeFrameInDays.' days incurred from last submission';
            }
            
            return $details;
        })
        ->rawColumns(['Details', 'Status', 'Remarks', 'IncurredDate'])
        ->make(true);
    }


    public function autoForwardingProponent($ProjectGUID, $UpdatedDate, $dateDiff )
    {

        $now = new \DateTime(); 

        $NewGUID = Uuid::generate()->string;
        $NewActivityGUID = Str::upper($NewGUID);

        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $start_date = $UpdatedDate;
        $end_date = date('Y-m-d');

        $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

        $projectActivity = array();
        $projectActivity['GUID'] = Str::upper($NewActivityGUID);
        $projectActivity['ProjectGUID'] = $ProjectGUID;
        $projectActivity['Status'] = 'Dropped';
        $projectActivity['Details'] = 'Per MC 2022-002 applications pending with the applicant beyond 20 calendar days will be dropped from the system with option to re-file the application.';
        $projectActivity['RoutedFrom'] = $UserName;
        $projectActivity['RoutedFromOffice'] = $UserOffice;
        $projectActivity['RoutedTo'] = $UserName;
        $projectActivity['RoutedToOffice'] = $UserOffice;
        $projectActivity['Routing'] = 1;
        $projectActivity['Remarks'] = 'Per MC 2022-002 applications pending with the applicant beyond 20 calendar days will be dropped from the system with option to re-file the application.';
        $projectActivity['UpdatedBy'] = $UserName;
        $projectActivity['CreatedBy'] = $UserName;
        $projectActivity['FromDate'] = $UpdatedDate;
        $projectActivity['TotWorkDays'] = $dateDiff - 1;
        $projectActivity['TotElapsedDays'] = $dateDiff - 1;

        DB::table('projectactivity')->insert($projectActivity);
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
            $projects = DB::table('project')->select(
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
                'project.CreatedBy',
                'projectactivity.GUID AS ActivityGUID',
                'projectactivity.Status',
                'projectactivity.UpdatedDate',
            )
            ->Join('projectactivity', function ($join) {
                $join->on('project.GUID', 'projectactivity.ProjectGUID');

                $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                    join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
            })
            ->where('project.Region', $UserOffice)
            ->where('projectactivity.RoutedTo', $UserName)
            ->where('projectactivity.RoutedToOffice', $UserOffice)
            ->whereIn('Status', array('For Approval', 'For Denial'))
            ->groupBy('project.GUID')
            ->orderByRaw('projectactivity.CreatedDate DESC')
            ->get();

        } else {

            $projects = DB::table('project')->select(
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
                'project.CreatedBy',
                'projectactivity.GUID AS ActivityGUID',
                'projectactivity.Status',
                'projectactivity.UpdatedDate'
            )
            ->Join('projectactivity', function ($join) {
                $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

                $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                    join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
            })
            ->where('project.Region', $UserOffice)
            ->where('projectactivity.RoutedTo', $UserName)
            ->where('projectactivity.RoutedToOffice', $UserOffice)
            // ->whereNotIn('Status', array('Approved', 'Denied'))
            ->groupBy('project.GUID')
            ->orderByRaw('projectactivity.CreatedDate DESC')
            ->get();
        }



        return DataTables::of($projects)
        ->addColumn('Details', function($project) use ($UserRole){
            if($project->Stage > 0){
                $details = '<small><a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
            }else{
                if($UserRole != 'Evaluator'){
                    $details = '<small><a class="text-uppercase" href="NewApplications/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
                }else{
                    $details = '<small><a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
                }
            }
            
            $details .= '<br><p class="text-uppercase">'.$project->Address.', '. $project->Municipality.', '. $project->Province.', '. $project->Region .'</p><br/></small>';
            return $details;
        })
        ->addColumn('Status', function($project){
            $details = '<small><i style="color:slategray;">'. $project->Status.'</i></small>';
            return $details;
        })
        ->addColumn('Remarks', function($project){

            $date = date("F j, Y g:i a", strtotime($project->UpdatedDate));
            $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $details;
        })
        ->addColumn('IncurredDate', function($project) use ($UserRole){

            $start_date = date("Y-m-d", strtotime($project->UpdatedDate));
            $end_date = date('Y-m-d');

            // if($start_date == $end_date){
            //     $dateDiff = 0;
            // } else {
                $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);
            // }


            // if($project->Status == 'For Screening' && ($dateDiff - 1) > 3){
            //     $this->autoForwarding($project, $dateDiff);
            // } 
            // else if($UserRole  == 'Evaluator' && ($dateDiff - 1) > 5 && $project->Status == 'For Evaluation'){
            //     $this->autoForwarding($project, $dateDiff);
            // } else if($UserRole  == 'Viewer' && ($dateDiff - 1) > 5){
            //     $this->autoForwarding($project, $dateDiff);
            // } else if($UserRole  == 'Reviewer' && ($dateDiff - 1) > 5 && $project->Status == 'For Review'){
            //     $this->autoForwarding($project, $dateDiff);
            // } else if($UserRole  == 'Recommending' && ($dateDiff - 1) > 5 && $project->Status == 'For Recommendation'){
            //     $this->autoForwarding($project, $dateDiff);
            // } else if($UserRole  == 'Approving' && ($dateDiff - 1) > 5){
            //     // $this->autoForwarding($project, $dateDiff);
            // } 
            
            if($dateDiff > 20){
                $details = '<small>'. ($dateDiff - 1).'/'.$project->ProcTimeFrameInDays.', days incurred from last submission - </small><span class="label label-danger">'.($dateDiff - 1).'</span>';
            } else {
                $details = '<small>'. ($dateDiff - 1).'/'.$project->ProcTimeFrameInDays.', days incurred from last submission - </small><span class="label label-success">'.($dateDiff - 1).'</span>';
            }
            
            return $details;
        })
        ->rawColumns(['Details', 'Status', 'Remarks', 'IncurredDate'])
        ->make(true);
    }

    public function autoForwarding($project, $dateDiff)
    {
        
        $now = new \DateTime(); 
        $UserName = Session::get('data')['UserName'];
        $ProjectGUID = $project->ProjectGUID;

        if($project->Status == 'For Screening'){

            $RoutedFrom = Session::get('data')['UserName'];
            $RoutedFromOffice = Session::get('data')['UserOffice'];
            $RoutedTo = $project->CreatedBy;
            $RoutedToOffice = 'Proponent';
            $Details = "For Submission of Basic Requirements - Good day, Ma'am/Sir. Please see attached evaluation report for guidance on the compliance of lacking requirements. Please do not return this application if requirements are not complete, otherwise, this will result to denial of application. Payment of application fee does not guarantee approval of ECC. Thank you. - This is auto-forwarded by system";
            $Status = 'For Screening';

        } else if($project->Status == 'For Evaluation'){

            $evaluator = AspnetUser::where('UserOffice', '=', Session::get('data')['UserOffice'])
            ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->select('aspnet_users.*', 'aspnet_membership.*')
            ->where('aspnet_users.InECCOAS', 1)
            ->where('aspnet_membership.IsApproved', 1)
            ->where('aspnet_users.UserRole', 'Reviewer')
            ->orderByRaw("UserName ASC")
            ->first();

            $RoutedFrom = Session::get('data')['UserName'];
            $RoutedFromOffice = Session::get('data')['UserOffice'];
            $RoutedTo =$evaluator->UserName;
            $RoutedToOffice = Session::get('data')['UserOffice'];
            $Details = 'Autoforward by system.';
            $Status = 'For Review';

        } else if($project->Status == 'For Review'){

            $reviewer = AspnetUser::where('UserOffice', '=', Session::get('data')['UserOffice'])
            ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->select('aspnet_users.*', 'aspnet_membership.*')
            ->where('aspnet_users.InECCOAS', 1)
            ->where('aspnet_membership.IsApproved', 1)
            ->where('aspnet_users.UserRole', 'Recommending')
            ->orderByRaw("UserName ASC")
            ->first();

            $RoutedFrom = Session::get('data')['UserName'];
            $RoutedFromOffice = Session::get('data')['UserOffice'];
            $RoutedTo =$reviewer->UserName;
            $RoutedToOffice = Session::get('data')['UserOffice'];
            $Details = 'Autoforward by system.';
            $Status = 'For Recommendation';

        } else if($project->Status == 'For Recommendation'){

            $recommendation = AspnetUser::where('UserOffice', '=', Session::get('data')['UserOffice'])
            ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->select('aspnet_users.*', 'aspnet_membership.*')
            ->where('aspnet_users.InECCOAS', 1)
            ->where('aspnet_membership.IsApproved', 1)
            ->where('aspnet_users.UserRole', 'Approving')
            ->orderByRaw("UserName ASC")
            ->first();

            $RoutedFrom = Session::get('data')['UserName'];
            $RoutedFromOffice = Session::get('data')['UserOffice'];
            $RoutedTo =$recommendation->UserName;
            $RoutedToOffice = Session::get('data')['UserOffice'];
            $Details = 'Autoforward by system.';
            $Status = 'For Approval';

        }

        $NewGUID = Uuid::generate()->string;
        $NewActivityGUID = Str::upper($NewGUID);


        $start_date = $project->UpdatedDate;
        $end_date = date('Y-m-d');

        $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

        $projectActivity = array();
        $projectActivity['GUID'] = Str::upper($NewActivityGUID);
        $projectActivity['ProjectGUID'] = $project->ProjectGUID;
        $projectActivity['Status'] = $Status;
        $projectActivity['Details'] = $Details;
        $projectActivity['RoutedFrom'] = $RoutedFrom;
        $projectActivity['RoutedFromOffice'] = $RoutedFromOffice;
        $projectActivity['RoutedTo'] = $RoutedTo;
        $projectActivity['RoutedToOffice'] = $RoutedToOffice;
        $projectActivity['Routing'] = 1;
        $projectActivity['Remarks'] = '';
        $projectActivity['UpdatedBy'] = Session::get('data')['UserName'];
        $projectActivity['CreatedBy'] = Session::get('data')['UserName'];
        $projectActivity['FromDate'] = $project->UpdatedDate;
        $projectActivity['TotWorkDays'] = $dateDiff - 1;
        $projectActivity['TotElapsedDays'] = $dateDiff - 1;

        
        if(DB::table('projectactivity')->insert($projectActivity)){
            
            $EvalReport = $this->autoGenerateEvaluationReport($projectActivity['ProjectGUID'], Str::upper($NewActivityGUID));

            if($project->Status == 'For Screening'){
                $OOP = $this->autoGenerateOrderOfPayment($projectActivity['ProjectGUID'], Str::upper($NewActivityGUID));
            }

            if($Status == 'For Evaluation'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 1,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }else if($Status == 'For Review'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 2,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }else if($Status == 'For Recommendation'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 3,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }else if($Status == 'For Approval' || $Status == 'For Denial'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 4,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }else if($Status == 'Approved' || $Status == 'Denied'){
                DB::table('project')
                ->where('GUID','=', $ProjectGUID)
                ->update([
                    'Stage' => 5,
                    'UpdatedBy' => $UserName,
                    'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);
            }
        }
    }

    public function autoGenerateEvaluationReport($ProjectGUID, $NewActivityGUID)
    {
        $UserName = Session::get('data')['UserName'];

        $project = ProjectRequirements::orderByRaw('ID ASC')
        // ->where('required', '=', 1)
        ->where('ProjectGUID', '=', $ProjectGUID)
        ->get();

        $todate = date('m/d/Y h:i:s A');

        $pdf = PDF::loadView('pdf.evaluation_report', compact('project', 'todate'));
        $pdf->output();

        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        $todate = date('m/d/Y h:i:s A');

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

        $Database = DB::table('projectactivityattachment')->insert($data);

        if($Database){
            $rtrn['success'] = 1;
            $rtrn['message'] = 'Uploaded Successfully!';
        } else {
            $rtrn['success'] = 0;
            $rtrn['error'] = 'Error while saving data into the database';// Error response
        }

        return $rtrn;

        // return $pdf->download('Evaluation Report.pdf');
    }

    public function autoGenerateOrderOfPayment($ProjectGUID, $NewActivityGUID)
    {
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

            $Database = DB::table('projectactivityattachment')->insert($data);

            if($Database){
                $rtrn['success'] = 1;
                $rtrn['message'] = 'Uploaded Successfully!';
            } else {
                $rtrn['success'] = 0;
                $rtrn['error'] = 'Error while saving data into the database';// Error response
            }

        return $rtrn;
        
    }

    public function ECCDraftCertificate(Request $req)
    {
        $GUID = $req['GUID'];

        $draft = ECCDraftPerProject::where('ecc_draft_per_project.ProjectGUID', $GUID)
        ->leftJoin('environmental_management_per_project', 'environmental_management_per_project.ProjectGUID', '=', 'ecc_draft_per_project.ProjectGUID')
        ->first();

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
            'project.Designation as Designation',
            'project.Description as Description',

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
            'region.Designation as DirectorDesignation',
        )
        ->first();


        return view('secured.for_actions.ecc_preview', compact('draft', 'project'));
    }

    public function ECCDraftPrint($GUID)
    {
        // $GUID = $req['GUID'];

        $draft = ECCDraftPerProject::where('ecc_draft_per_project.ProjectGUID', $GUID)
        ->leftJoin('environmental_management_per_project', 'environmental_management_per_project.ProjectGUID', '=', 'ecc_draft_per_project.ProjectGUID')
        ->first();

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
            'project.Designation as Designation',
            'project.Description as Description',

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
            // 'region.WebSite as EMBWebSite',
            'region.Director as Director',
            'region.EIAChief as EIAChief',
            'region.EIAChiefSignature',
            'region.DirectorSignature',
            'region.Designation as DirectorDesignation'
        )
        ->first();

        $projectname = $project->ProjectName;

        return view('secured.for_actions.ecc_print_draft', compact('draft', 'project', 'projectname'));

        // $pdf = \PDF::loadView('secured.for_actions.ecc_print_draft', array('draft' => $draft, 'project' => $project));
        
        // $pdf->setOption('margin-top', 20)

        // ->setOption('margin-bottom', 20)
        // ->setOption('margin-right', 20);

        // $pdf->setOption('enable-javascript', true);
        // $pdf->output();

        // $pdf->setOption('footer-html', \View::make('templates.footer'));
        // return $pdf->stream();


        
        // $NewGUID = Uuid::generate()->string;
        // $GUID = Str::upper($NewGUID);

        // $todate = date('m/d/Y h:i:s A');

        // $Date = date('m/d/Y');

        // $urlSavePDF = public_path('files/Test/'.$GUID.'.pdf');
        // $path = public_path('files/Test');ecc_print_draftecc_print_draftecc_print_draft
        //     // $savedFiles = $pdf->saveAs($urlSavePDF);

        // if(!File::exists($path)) {
        //     File::makeDirectory($path, $mode = 0755, true, true);
        //     $pdf->save($urlSavePDF);
        // } else {
        //     $pdf->save($urlSavePDF);
        // }

        // $file = pathinfo($urlSavePDF);

        // $filesize = filesize($urlSavePDF) * 0.001;
    }

    public function ECCDraftData(Request $req)
    {
        $ProjectGUID = $req['ProjectGUID'];

        $draft = ECCDraftPerProject::where('ecc_draft_per_project.ProjectGUID', $ProjectGUID)
        ->leftJoin('environmental_management_per_project', 'environmental_management_per_project.ProjectGUID', '=', 'ecc_draft_per_project.ProjectGUID')
        ->first();


        return $draft;
    }

    public function PageSave(Request $req)
    {
        
        $ProjectGUID = $req['ProjectGUID'];
        $Page = $req['Page'];

        if($Page == 1){

            $Content = $req['content'];

            DB::table('ecc_draft_per_project')
            ->where('ProjectGUID','=', $ProjectGUID)
            ->update([
                'Body' => $Content,
            ]);

        } else if($Page == 2){

            $ThisIsToCertify = $req['ThisIsToCertify'];
            $ProjectDescription = $req['ProjectDescription'];
            $ThisCertificateIsIssued = $req['ThisCertificateIsIssued'];

            DB::table('ecc_draft_per_project')
            ->where('ProjectGUID','=', $ProjectGUID)
            ->update([
                'ThisIsToCertify' => $ThisIsToCertify,
                'ProjectDescription' => $ProjectDescription,
                'ThisCertificateIsIssued' => $ThisCertificateIsIssued,
            ]);

        } else if($Page == 3) {
            $SwornAccountabilityStatement = $req['SwornAccountabilityStatement'];

            DB::table('ecc_draft_per_project')
            ->where('ProjectGUID','=', $ProjectGUID)
            ->update([
                'SwornAccountabilityStatement' => $SwornAccountabilityStatement,
            ]);
        } else if($Page == 4) {
            $ConstructionPhase = $req['ConstructionPhase'];
            $OperationPhase = $req['OperationPhase'];


            // DB::table('environmental_management_per_project')->insert([
            //     'ProjectGUID' => $ProjectGUID,
            //     'ConstructionPhase' => $ConstructionPhase,
            //     'OperationPhase' => $OperationPhase,
            // ]);

            DB::table('environmental_management_per_project')
            ->where('ProjectGUID','=', $ProjectGUID)
            ->update([
                'ConstructionPhase' => $ConstructionPhase,
                'OperationPhase' => $OperationPhase,
            ]);
        } else if($Page == 5) {
            $GeneralConditions = $req['GeneralConditions'];

            DB::table('ecc_draft_per_project')
            ->where('ProjectGUID','=', $ProjectGUID)
            ->update([
                'GeneralConditions' => $GeneralConditions,
            ]);
        } else if($Page == 6) {
            $Restrictions = $req['Restrictions'];

            DB::table('ecc_draft_per_project')
            ->where('ProjectGUID','=', $ProjectGUID)
            ->update([
                'Restrictions' => $Restrictions,
            ]);
        } else if($Page == 7) {
            $PAPT = $req['PAPT'];

            DB::table('ecc_draft_per_project')
            ->where('ProjectGUID','=', $ProjectGUID)
            ->update([
                'PAPT' => $PAPT,
            ]);
        }

        

    }

    


    
}



