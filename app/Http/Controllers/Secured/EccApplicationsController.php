<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\AspnetUser;
use App\Models\Project;
use App\Models\ProjectActivity;
use App\Models\Attachment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Secured\EccApplicationsController;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;

class EccApplicationsController extends Controller
{
    public function index()
    {
        return view('secured.ecc_applications.index');
    }

    public function search()
    {
        return view('secured.search');
    }

    public function ECCDashboard()
    {   
        $todate = date('m/d/Y H:i:s A');
        $After15minutes = date('d-m-Y H:i',  strtotime("+15 minutes"));

        $NextRefresh = date('m/d/Y H:i:s A', strtotime($After15minutes));
        
        return view('secured.ecc_applications.dashboard', compact('todate', 'NextRefresh'));
    }

    public function getECCApplications(Request $req)
    {
        $UserName = $req['UserName'];
        $UserRole = $req['UserRole'];
        $UserOffice = $req['UserOffice'];
        $StatusFilter = $req['StatusFilter'];

        $todate = date('Y-m-d H:i:s');
        $tomorrow = date('Y-m-d', strtotime( $todate . " +1 days"));

        $project = DB::table('project')->select(
            'project.Address AS Address',
            'project.Municipality  AS Municipality', 
            'project.Province AS Province',
            'project.CreatedBy',
            'project.ProjectName',
            'project.Region  AS Region',
            'project.GUID AS ProjectGUID',
            'project.Stage', 
            'project.ProcTimeFrameInDays',
            'project.TotProcDays',
            'project.version',

            'projectactivity.Details AS Remarks',
            'projectactivity.RoutedTo',
            'projectactivity.GUID AS ActivityGUID', 
            'projectactivity.RoutedFrom',
            'projectactivity.CreatedDate',
            'projectactivity.RoutedToOffice',
            'projectactivity.Status',
            )
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
            })

        ->where('project.CreatedBy', '=', $UserName)
        ->groupBy('project.GUID')
        ->get();

        return DataTables::of($project)
        ->addColumn('Details', function($project) use($UserName){
            // if($project->Stage == 0){
            //     $details = '<a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
            // }else{
            //     if($UserRole != 'Evaluator'){
            //         $details = '<a class="text-uppercase pointer" onclick="NewDocument('. "'" .$project->ProjectGUID. "'".')">'. $project->ProjectName.'</a>';
            //     }else{
            //         $details = '<a class="text-uppercase pointer" onclick="NewDocument('. "'" .$project->ProjectGUID. "'".')">'. $project->ProjectName.'</a>';
            //     }
            // }

            if($project->Stage == 0){
                $details = '<a class="text-uppercase pointer" onclick="NewDocument('. "'" .$project->ProjectGUID. "'".')">'. $project->ProjectName.'</a>';
            }else if($project->Status == 'Archived' || $project->Status == 'Approved'){
                $details = '<a class="text-uppercase" href="ProjectComp?GUID='.$project->ProjectGUID.'&AGUID='.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
            }else if($project->RoutedTo == $UserName){
                $details = '<a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
            } else {
                $details = '<a class="text-uppercase" href="ProjectView?GUID='.$project->ProjectGUID.'&AGUID='.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
            }

            $details .= '<br><p class="text-uppercase">'.$project->Address.', '. $project->Municipality.', '. $project->Province.', '. $project->Region .'</b><br/>';
            return $details;
        })
        ->addColumn('Status', function($project){
            $details = '<i style="color:slategray;">With '.$project->RoutedToOffice.' - '.$project->Status.' </i>';

            return $details;
        })
        ->addColumn('Remarks', function($project){
            $date = date("F j, Y g:i a", strtotime($project->CreatedDate));
            $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $details;
        })
        ->addColumn('Action', function($project){
            if($project->version == 0){
                $details = 'Migrated Data';
            } else {
                $details = 'New Data';
            }
            return $details;
        })
        ->rawColumns(['Details', 'Status', 'Remarks'])
        ->make(true);
    }

    public function getECCApplicationsCaseHandler(Request $req)
    {
        $UserName = $req['UserName'];
        $UserRole = $req['UserRole'];
        $UserOffice = $req['UserOffice'];
        
        $Search = $req['Search'];

        if($Search != null){
            $StatusFilter = 'All';
        } else {
            $StatusFilter = $req['StatusFilter'];
        }

        $todate = date('Y-m-d H:i:s');
        $tomorrow = date('Y-m-d', strtotime( $todate . " +1 days"));

        $project = DB::table('project')->select(
            'project.Address AS Address',
            'project.Municipality  AS Municipality', 
            'project.Province AS Province',
            'project.CreatedBy',
            'project.ProjectName',
            'project.Region  AS Region',
            'project.GUID AS ProjectGUID',
            'project.Stage', 
            'project.ProcTimeFrameInDays',
            'project.TotProcDays',

            'projectactivity.Details AS Remarks',
            'projectactivity.RoutedTo',
            'projectactivity.GUID AS ActivityGUID', 
            'projectactivity.RoutedFrom',
            'projectactivity.CreatedDate',
            'projectactivity.RoutedToOffice',
            'projectactivity.Status',
            )
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
            });

        if($StatusFilter == 'Pending with EMB'){
            $project->where('projectactivity.RoutedToOffice', $UserOffice)
            ->whereNotIn('projectactivity.Status', array('Approved', 'Denied'));
        } else if($StatusFilter == 'Pending with Proponents'){
            $project->where('projectactivity.RoutedToOffice', 'Proponent')
            ->whereNotIn('projectactivity.Status', array('Approved', 'Denied', 'Pending for Submission'));
        } else if($StatusFilter == 'Decided'){
            $project->whereIn('projectactivity.RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereIn('projectactivity.Status', array('Approved', 'Denied'));
        } else if($StatusFilter == 'Approved'){
            $project->whereIn('projectactivity.RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereIn('projectactivity.Status', array('Approved'));
        } else if($StatusFilter == 'Approved (Auto)'){
            $project->whereIn('projectactivity.RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereIn('projectactivity.Status', array('Approved'));
        } else if($StatusFilter == 'Denied'){
            $project->whereIn('projectactivity.RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereIn('projectactivity.Status', array('Denied'));
        } else if($StatusFilter == 'Pending All'){
            $project->whereIn('projectactivity.RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereNotIn('projectactivity.Status', array('Denied', 'Approved'));
        } else if($StatusFilter == 'All'){
            $project->whereIn('projectactivity.RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->where('project.ProjectName', 'LIKE', '%' . $Search . '%' );
        }

        $project->where('project.Stage', '>', 0)
        ->groupBy('project.GUID')
        ->orderByRaw('projectactivity.UpdatedDate DESC')
        ->get();

        return DataTables::of($project)
        ->addColumn('Details', function($project) use($UserRole){
            if($project->Status == 'Archived' || $project->Status == 'Approved'){
                $details = '<small><a class="text-uppercase" href="ProjectComp?GUID='.$project->ProjectGUID.'&AGUID='.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';

                // $details = '<a class="text-uppercase pointer" style="cursor:pointer" href="ProjectComp?GUID='.$project->ProjectGUID.'>'. $project->ProjectName.'</a>';
            }else{
                if($UserRole != 'Evaluator'){
                    $details = '<small><a class="text-uppercase" href="ProjectView?GUID='.$project->ProjectGUID.'&AGUID='.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
                }else{
                    $details = '<small><a class="text-uppercase" href="ProjectView?GUID='.$project->ProjectGUID.'&AGUID='.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
                }
            }

            $details .= '<br><p class="text-uppercase">'.$project->Address.', '. $project->Municipality.', '. $project->Province.', '. $project->Region .'</b><br/></small>';
            return $details;
        })
        ->addColumn('Status', function($project){
            $details = '<small><i style="color:slategray;">With '.$project->RoutedToOffice.' - '.$project->Status.' </i></small>';

            return $details;
        })
        ->addColumn('Remarks', function($project){
            $date = date("F j, Y g:i a", strtotime($project->CreatedDate));
            $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $details;
        })
        ->rawColumns(['Details', 'Status', 'Remarks'])
        ->make(true);
    }

    public function getUnderProcessPerStatus(Request $req)
    {
        $UserOffice = $req['UserOffice'];

        $YearToday = date('Y');
        $Year = $YearToday - 2; 
        $Past2Years = $Year .'-01-01';

        $array = ['Screening', 'Under Review', 'For Approval', 'For Denial'];



        $data = [];
        foreach($array as $status)
        {
            $rawData = [];
            $rawData['Status'] = $status;
            if($status === 'Screening'){
                $pending = Project::where('project.Region', '=', $UserOffice)
                ->Join('projectactivity', function ($join) {
                    $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

                    $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                        join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
                })
                ->select('project.ID')
                ->where('project.CreatedDate', '>=', $Past2Years)
                ->where('projectactivity.RoutedToOffice', '=', $UserOffice)
                ->where('project.AcceptedBy', '=', '')
                ->whereNotIn('projectactivity.Status', array('For Approval', 'For Denial'))
                ->groupBy('project.GUID')
                ->get();

            } else if($status === 'Under Review'){
                $pending = Project::where('project.Region', '=', $UserOffice)
                ->Join('projectactivity', function ($join) {
                    $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

                    $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                        join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
                })
                ->groupBy('project.ID')
                ->where('project.CreatedDate', '>=', $Past2Years)
                ->where('projectactivity.RoutedToOffice', '=', $UserOffice)
                ->where('project.AcceptedBy', '<>', '')
                ->whereNotIn('projectactivity.Status', array('For Approval', 'For Denial'))
                ->get();
            } else if($status === 'For Approval'){
                $pending = Project::where('project.Region', '=', $UserOffice)
                ->Join('projectactivity', function ($join) {
                    $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

                    $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                        join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
                })
                ->groupBy('project.ID')
                ->where('project.CreatedDate', '>=', $Past2Years)
                ->where('projectactivity.RoutedToOffice', '=', $UserOffice)
                ->where('projectactivity.Status','=','For Approval')
                ->get();
            } else if($status === 'For Denial'){
                $pending = Project::where('project.Region', '=', $UserOffice)
                ->Join('projectactivity', function ($join) {
                    $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

                    $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                        join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
                })
                ->groupBy('project.ID')
                ->where('project.CreatedDate', '>=', $Past2Years)
                ->where('projectactivity.RoutedToOffice', '=', $UserOffice)
                ->where('projectactivity.Status','=','For Denial')
                ->get();
            }

            $rawData['Pending'] = count($pending);


            $data[] = $rawData;
        }

        return $data;
    }

    public function getUnderProcessECCApplication(Request $req)
    {
        $UserOffice = $req['UserOffice'];

        $YearToday = date('Y');
        $Year = $YearToday - 2; 
        $Past2Years = $Year .'-01-01';

        $projects = Project::select(
            'project.Address AS Address',
            'project.Municipality  AS Municipality', 
            'project.Province AS Province',
            'project.AcceptedBy',
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

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->where('project.Region', '=', $UserOffice)
        ->where('project.CreatedDate', '>=', $Past2Years)
        ->where('projectactivity.RoutedToOffice', '=', $UserOffice)
        ->whereNotIn('projectactivity.Status', array('Approved', 'Denied'))
        ->groupBy('project.GUID')
        ->orderByRaw('project.CreatedDate DESC')
        ->get();


        return DataTables::of($projects)
        ->addColumn('Details', function($project){

            $setStatus = '';

            if($project->AcceptedBy == '' && $project->Status != 'For Approval' && $project->Status != 'For Denial'){
                $setStatus = 'SCREENING';
            }else if($project->AcceptedBy != '' && $project->Status != 'For Approval' && $project->Status != 'For Denial'){
                $setStatus = 'UNDER REVIEW';
            }else if($project->Status == 'For Approval'){
                $setStatus = 'FOR APPROVAL';
            }else if($project->Status == 'For Denial'){
                $setStatus = 'FOR DENIAL';
            }

            $details = '<small style="font-size:8pt;border-bottom:Solid 1px WhiteSmoke;padding:3px;">['. $setStatus.'] ';

            $details .= Str::upper($project->ProjectName);
            
            $details .= ' - '.$project->Address.', '. $project->Municipality.', '. $project->Province.', '. $project->Region .' - ';

            $details .= 'Currently with ' . Str::upper($project->RoutedTo)  . ' since ' . date("m/d/Y", strtotime($project->CreatedDate));

            $start_date = $project->UpdatedDate;
            $end_date = date('Y-m-d');

            // $dateDiff = $this->dateDiffInDays($start_date, $end_date);
            $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

            $details .= ' ( Total Days inccured - ' . ($dateDiff - 1).'/'.$project->ProcTimeFrameInDays . ', Days from last submission - ';
            return $details;
        })
        ->addColumn('Color', function($project){
            $start_date = $project->UpdatedDate;
            $end_date = date('Y-m-d');

            // $dateDiff = $this->dateDiffInDays($start_date, $end_date);
            $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

            if($dateDiff > 21){
                $details = '<blink><input type="image" class="blink_img" src="../img/red.png"  style="width:20px;"></blink>';
            } else {
                $details = '<input type="image"  src="../img/green.png"  style="width:20px;">';
            }
            
            return $details;
        })
        ->rawColumns(['Details', 'Color'])
        ->make(true);
    }

    public function getApplicationsDecided(Request $req)
    {
        $UserOffice = $req['UserOffice'];

        $todate = date('Y-m-d');
        $Past30Days = date('Y-m-d', strtotime( $todate . " -30 days"));

        $projects = Project::select(
            'project.Address AS Address',
            'project.Municipality  AS Municipality', 
            'project.Province AS Province',
            'project.AcceptedBy',
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

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->where('project.Region', '=', $UserOffice)
        ->where('projectactivity.UpdatedDate', '>=', $Past30Days)
        ->where('projectactivity.RoutedToOffice', '=', $UserOffice)
        ->whereIn('projectactivity.Status', array('Approved', 'Denied'))
        ->groupBy('project.GUID')
        ->orderByRaw('project.CreatedDate DESC')
        ->get();


        return DataTables::of($projects)
        ->addColumn('Details', function($project){

            $setStatus = Str::upper($project->Status);

            $details = '<small style="font-size:8pt;border-bottom:Solid 1px WhiteSmoke;padding:3px;">['. $setStatus.'] ';

            $details .= Str::upper($project->ProjectName);


            $start_date = $project->UpdatedDate;
            $end_date = date('Y-m-d');

            // $dateDiff = $this->dateDiffInDays($start_date, $end_date);
            $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);


            if($dateDiff > 21){
                $incurred = '<span class="label label-danger">'.($dateDiff - 1).'/'.$project->ProcTimeFrameInDays.'</span>';
            } else {
                $incurred = '<span class="label label-success">'.($dateDiff - 1).'/'.$project->ProcTimeFrameInDays.'</span>';
            }
            
            $details .= ' - '.$project->Address.', '. $project->Municipality.', '. $project->Province.', '. $project->Region .', '. $incurred;
            return $details;
        })
        ->addColumn('Color', function($project){
            $start_date = $project->UpdatedDate;
            $end_date = date('Y-m-d');

            // $dateDiff = $this->dateDiffInDays($start_date, $end_date);
            $dateDiff = $this->Count_Days_Without_Weekends($start_date, $end_date);

            if($dateDiff > 21){
                $details = '<blink><input type="image" class="blink_img" src="../img/red.png"  style="width:20px;"></blink>';
            } else {
                $details = '<input type="image"  src="../img/green.png"  style="width:20px;">';
            }
            
            return $details;
        })
        ->rawColumns(['Details', 'Color'])
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

    public function documents(Request $req)
    {
        return view('secured.ecc_applications.document', compact('req'));
    }

    public function searchDocuments(Request $req)
    {
        return view('secured.ecc_applications.search-page', compact('req'));
    }

    public function project_comp(Request $req)
    {

        $project = Project::where('project.GUID', '=', $req->GUID)
        // ->where('project.Stage', '>', 0 )
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', 'projectactivity.ProjectGUID');
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

        return view('secured.ecc_applications.casehandler_project_app', compact('project', 'attachments'));
    }

    public function project_view(Request $req)
    {

        $project = Project::where('project.GUID', '=', $req->GUID)
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

        if($UserRole == 'Applicant'){
            return view('secured.ecc_applications.project_view', compact('project', 'attachments'));
        } else {
           return view('secured.ecc_applications.project_view', compact('project', 'attachments')); 
        }

        
    }

}
