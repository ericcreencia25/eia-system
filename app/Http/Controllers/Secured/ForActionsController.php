<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectActivityAttachment;
use Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Secured\EccApplicationsController;

class ForActionsController extends Controller
{
    public function index()
    {
        return view('secured.for_actions.index');
        
    }

    public function project_app($GUID)
    {   
        $project = Project::where('project.GUID', '=', $GUID)
        ->where('project.Stage', '>', 0 )
        ->leftJoin('projectactivity', 'project.GUID', '=', 'projectactivity.ProjectGUID')
        ->select('project.Address AS Address', 'project.Municipality  AS Municipality', 'project.Province AS Province', 'project.Address', 'projectactivity.Status', 'projectactivity.Details AS Remarks', 'project.ProjectName', 'project.Region  AS Region', 'projectactivity.RoutedTo', 'projectactivity.RoutedFrom', 'projectactivity.CreatedDate', 'project.GUID AS GUID', 'project.PreviousECCNo',)
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
        ->where('project.GUID', '=', $GUID)
        ->leftJoin('projectactivity', 'project.GUID', '=', 'projectactivity.ProjectGUID')
        ->select('project.Address AS Address', 'project.Municipality  AS Municipality', 'project.Province AS Province', 'project.Address', 'projectactivity.Status', 'projectactivity.Details AS Remarks', 'project.ProjectName', 'project.Region  AS Region', 'projectactivity.RoutedTo', 'projectactivity.RoutedFrom', 'projectactivity.CreatedDate', 'project.GUID AS GUID', 'projectactivity.RoutedToOffice', 'projectactivity.UpdatedDate')
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
            $details =  '<button class="btn btn-block btn-flat"><i class="fa fa-file-o"></i></button>';
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

    public function getActivityAttachments(Request $req)
    {   
        $project['data'] = ProjectActivityAttachment::where('ActivityGUID', '=', $req['data'])->select('Description', 'GUID', 'ActivityGUID')
        ->get();
        return response()->json($project);
    }


    public function getCaseHandlerForActionsTable(Request $req)
    {
        $UserName = $req['UserName'];
        $UserRole = $req['UserRole'];
        $UserOffice = $req['UserOffice'];

        $projects = Project::select('projectactivity', 'project.GUID', '=', 'projectactivity.ProjectGUID')
        ->select(
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
            'project.TotProcDays')
        ->where('project.Region', '=', $UserOffice)
        ->where('project.Stage', '>', 0)
        ->leftJoin('projectactivity', function($projects){
            $projects->on('projectactivity.ProjectGUID','=','project.GUID')
            ->whereRaw('projectactivity.id IN (select MAX(a2.id) from projectactivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->get();

        $project = collect([]);
        $projects->each(function($proj) use ($project, $UserName){
            if( $proj->Status == 'Approved' || $proj->Status == 'Denied'){}
                else{
                        if($proj->RouteTo == $UserName){
                            $project->push($proj);    
                        }
                    }
            });

        return DataTables::of($project)
        ->addColumn('Details', function($project) use ($UserRole){
            if($project->Stage > 0){
                $details = '<a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'">'. $project->ProjectName.'</a>';
            }else{
                if($UserRole != 'Evaluator'){
                    $details = '<a class="text-uppercase" href="NewApplications/'.$project->ProjectGUID.'">'. $project->ProjectName.'</a>';
                }else{
                    $details = '<a class="text-uppercase" href="NewApplications/'.$project->ProjectGUID.'">'. $project->ProjectName.'</a>';
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
            $date = date("F j, Y g:i a", strtotime($project->CreatedDate));
            $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $details;
        })
        ->addColumn('IncurredDate', function($project){
            $details = '<small>'. $project->TotProcDays.'/'.$project->ProcTimeFrameInDays.'</small>';
            return $details;
        })
        ->rawColumns(['Details', 'Status', 'Remarks', 'IncurredDate'])
        ->make(true);
    }
}
