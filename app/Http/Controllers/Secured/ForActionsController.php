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
use App\Models\AspnetUser;
use Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Secured\EccApplicationsController;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 

class ForActionsController extends Controller
{
    public function index()
    {
        return view('secured.for_actions.index');
    }

    public function project_app($GUID, $ActivityGUID)
    {   
        $project = Project::where('Project.GUID', '=', $GUID)
        // ->where('Project.Stage', '>', 0 )
        ->Join('ProjectActivity', function ($join) {
            $join->on('Project.GUID', '=', 'ProjectActivity.ProjectGUID');
            // $join->on('ProjectActivity.CreateDate','>=', DB::raw("'2012-05-01'"));

            $join->whereRaw('ProjectActivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->leftJoin('Proponent', 'Project.ProponentGUID', '=', 'Proponent.GUID')
        ->select(
            'Project.Purpose',
            'Project.Address AS Address', 
            'Project.Municipality  AS Municipality', 
            'Project.Province AS Province', 
            'Project.Address', 
            'Project.CreatedBy AS CreatedBy', 
            'Project.GUID AS GUID', 
            'Project.PreviousECCNo',
            'Proponent.ProponentName',
            'Project.ProjectName', 
            'Project.Region  AS Region', 

            'ProjectActivity.RoutedTo', 
            'ProjectActivity.RoutedFrom', 

            'ProjectActivity.RoutedToOffice', 
            'ProjectActivity.RoutedFromOffice', 

            'ProjectActivity.CreatedDate', 
            'ProjectActivity.Status', 
            'ProjectActivity.Details AS Remarks', 
            'ProjectActivity.GUID AS ActivityGUID',
            'ProjectActivity.FromDate AS FromDate',
            'ProjectActivity.UpdatedDate AS UpdatedDate',
            
        )
        ->first();

        return view('secured.for_actions.project_app', compact('project'));
    }

    public function project()
    {
        return view('secured.for_actions.project');
    }

    public function getRoutingHistory(Request $req)
    {   
        $GUID = $req['data']; 
        
        $project = DB::table('project')
        ->where('Project.GUID', '=', $GUID)
        ->leftJoin('ProjectActivity', 'Project.GUID', '=', 'ProjectActivity.ProjectGUID')
        ->select('Project.Address AS Address', 
            'Project.Municipality  AS Municipality', 
            'Project.Province AS Province', 
            'Project.Address', 
            'ProjectActivity.Status',
            'ProjectActivity.Details AS Remarks', 
            'Project.ProjectName', 
            'Project.Region  AS Region', 
            'ProjectActivity.RoutedTo', 
            'ProjectActivity.RoutedFrom', 
            'ProjectActivity.CreatedDate', 
            'Project.GUID AS GUID', 
            'ProjectActivity.RoutedToOffice',
            'ProjectActivity.UpdatedDate', 
            'ProjectActivity.GUID AS ActivityGUID', 
            'ProjectActivity.CreatedBy AS CreatedBy' 
        )
        ->orderByRaw('ProjectActivity.UpdatedDate DESC')
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
            $details =  '<button class="btn btn-block btn-flat" onclick="listOfAttachments('."'". $project->CreatedBy."', "."'". $project->ActivityGUID."'".')"><i class="fa fa-file-o"></i></button>';
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
        ->where('Project.GUID', '=', $GUID)
        ->leftJoin('ProjectActivity', 'Project.GUID', '=', 'ProjectActivity.ProjectGUID')
        ->select(
            'ProjectActivity.Status', 
            'ProjectActivity.RoutedTo', 
            'ProjectActivity.RoutedFrom',
            'ProjectActivity.RoutedToOffice', 
            'ProjectActivity.UpdatedDate',  
            'ProjectActivity.GUID AS ActivityGUID', 
            'ProjectActivity.CreatedBy AS CreatedBy', 
            'ProjectActivity.RoutedFromOffice', 
            'ProjectActivity.TotAccumulatedDays',
            'ProjectActivity.Details AS Remarks', 
        )
        ->orderByRaw('ProjectActivity.UpdatedDate DESC')
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
            $details =  '<button class="btn btn-block btn-flat" onclick="getlistOfAttachments('."'". $project->CreatedBy."', "."'". $project->ActivityGUID."'".')"><i class="fa fa-file-o"></i></button>';
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
        $project = ProjectActivityAttachment::select('FilePath', 'Description', 'CreatedDate', 'CreatedBy')
        ->where('ActivityGUID', '=', $ActivityGUID)

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

        $projects = Project::select(
            'Project.Address AS Address',
            'Project.Municipality  AS Municipality', 
            'Project.Province AS Province', 
            'ProjectActivity.Status', 
            'ProjectActivity.Details AS Remarks', 
            'Project.ProjectName', 
            'Project.Region  AS Region', 
            'ProjectActivity.RoutedTo', 
            'ProjectActivity.RoutedFrom', 
            'Project.GUID AS ProjectGUID', 
            'Project.Stage', 
            'ProjectActivity.CreatedDate',
            'Project.ProcTimeFrameInDays',
            'Project.TotProcDays',
            'Project.TotProcDays',
            'ProjectActivity.GUID AS ActivityGUID',
            'ProjectActivity.Status',
            'ProjectActivity.UpdatedDate'
        )
        ->Join('ProjectActivity', function ($join) {
            $join->on('Project.GUID', '=', 'ProjectActivity.ProjectGUID');
            // $join->on('ProjectActivity.CreateDate','>=', DB::raw("'2012-05-01'"));

            $join->whereRaw('ProjectActivity.ID IN (select MAX(a2.ID) from ProjectActivity as a2 
                join Project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->where('Project.Region', '=', $UserOffice)
        // ->where('Project.UpdatedDate', '>=', $StartDate)
        // ->where('Project.UpdatedDate', '<=', $EndDate)
        ->where('ProjectActivity.RoutedTo', '<=', $UserName)
        ->where('ProjectActivity.RoutedToOffice', '<=', $UserOffice)
        // ->orderByRaw('CreatedDate DESC')
        ->whereNotIn('Status', array('Approved', 'Denied'))
        ->groupBy('Project.GUID')
        ->orderByRaw('Project.CreatedDate DESC')
        ->get();

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
            // $projectactivity = ProjectActivity::on('mysql')->where('ProjectActivity.ProjectGUID', '=', $project->ProjectGUID)
            // ->orderByRaw('ID Desc')
            // ->first();

            $date = date("F j, Y g:i a", strtotime($project->UpdatedDate));
            $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $details;
        })
        ->addColumn('IncurredDate', function($project){
            //  $projectactivity = ProjectActivity::on('mysql')->where('ProjectActivity.ProjectGUID', '=', $project->ProjectGUID)
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

            $details = '<a href="">' . $project->Description . '</a>';

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
        ->whereIn('UserRole', array('Evaluator', 'Reviewer'))
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
        ->leftJoin('aspnet_Membership', 'aspnet_Users.UserId', '=', 'aspnet_Membership.UserId')
        ->select('aspnet_Users.*', 'aspnet_Membership.*')
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

        $project = ProjectRequirements::where('ProjectRequirement.ProjectGUID', '=', $ProjectGUID)
        ->where('ProjectRequirement.ID', '=', $ID)
        ->where('ProjectRequirement.Description', '=', $Description)
        ->Join('ProjectActivity', function($join)
        {
            $join->on('ProjectRequirement.ProjectGUID', '=', 'ProjectActivity.ProjectGUID');
        })
        ->Join('ProjectActivityAttachment', function($join)
        {
            $join->on('ProjectActivityAttachment.ActivityGUID', '=', 'ProjectActivity.GUID');
            $join->on('ProjectActivityAttachment.Description', '=', 'ProjectRequirement.Description');
        })
        ->select(
            'ProjectRequirement.Description', 
            'ProjectRequirement.Remarks', 
            'ProjectRequirement.Required',
            'ProjectRequirement.Compliant',  
            'ProjectRequirement.ID as PRID',
            'ProjectActivity.GUID', 
            'ProjectActivityAttachment.ActivityGUID',
            'ProjectActivityAttachment.FileName',
            'ProjectActivityAttachment.FilePath',
            'ProjectActivityAttachment.Directory',

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

        DB::table('ProjectRequirement')
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

    public function EndorseApplication(Request $req)
    {
        $UpdatedDate = $req['UpdatedDate'];
        $ProjectGUID = $req['ProjectGUID'];
        $ActivityGUID = $req['ActivityGUID'];
        $Destination = $req['Destination'];
        $UserDestination = $req['UserDestination'];
        $ActionRequired = $req['ActionRequired'];
        $Remarks = $req['Remarks'];
        $NewActivityGUID = $req['NewActivityGUID'];

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
            $AdditionalRequirements = $req['AdditionalRequirements'];

            if($AdditionalRequirements != null){
                foreach ($AdditionalRequirements as $key => $value) {
                    $ProjectRequirement = array();
                    $ProjectRequirement['ProjectGUID'] = $ProjectGUID;
                    $ProjectRequirement['Description'] = $value['description']; 
                    $ProjectRequirement['Required'] = 0;
                    $ProjectRequirement['Compliant'] = 0; 
                    DB::table('ProjectRequirement')->insert($ProjectRequirement);
                }
            }

            if($IncludeAttachment === "true"){

                $data = DB::table('ProjectActivityAttachmenttemp')
                    ->select('GUID','ActivityGUID','Description','FileName','Directory','FilePath','FileSizeInKB','CreatedBy','CreatedDate')
                    ->where('ActivityGUID', '=', $NewActivityGUID)
                    ->get();

                $array = $data->map(function($obj){
                    return (array) $obj;
                    })->toArray();


                if(DB::table('ProjectActivityAttachment')->insert($array)){
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


        if(DB::table('ProjectActivity')->insert($projectActivity)){
            DB::table('ProjectActivityAttachment')->insert($attachedDocuments);
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

        $description = $request['Documents'];

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

             // File upload location
             $location = 'files';

             // // Upload file
             $file->move($location,$NewGUID.'.'.$extension);
             
             // File path
             // $filepath = public_path('files/'.$NewGUID.'.'.$extension);
             $filepath = 'files/'.$NewGUID.'.'.$extension;

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

             DB::table('ProjectActivityAttachmenttemp')->insert($data);
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

             // File upload location
             $location = 'files';

             // // Upload file
             $file->move($location,$NewGUID.'.'.$extension);
             
             // File path
             // $filepath = public_path('files/'.$NewGUID.'.'.$extension);
             $filepath = 'files/'.$NewGUID.'.'.$extension;

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

             // DB::table('ProjectActivityAttachmenttemp')->insert($data);
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


        $project = ProjectActivityAttachmentTemp::where('ActivityGUID', '=', $ActivityGUID)
        ->select('FilePath', 'Description')
        ->first();
        
        return $project;
    }
    
}
