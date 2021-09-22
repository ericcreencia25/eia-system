<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\AspnetUser;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Secured\EccApplicationsController;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

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

    public function getECCApplications(Request $req)
    {
        $UserName = $req['UserName'];
        $UserRole = $req['UserRole'];
        $UserOffice = $req['UserOffice'];

        $project =  Project::select('projectactivity', 'project.GUID', '=', 'projectactivity.ProjectGUID')
        // ->leftJoin('projectactivity', 'project.GUID', '=', 'projectactivity.ProjectGUID')
        ->select('project.Address AS Address', 
            'project.Municipality  AS Municipality', 
            'project.Province AS Province', 
            'projectactivity.Status', 
            'projectactivity.Details AS Remarks', 
            'project.ProjectName', 
            'project.Region  AS Region', 
            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom', 
            'projectactivity.CreatedDate', 
            'project.GUID  AS ProjectGUID', 
            'project.Stage', 
            'projectactivity.RoutedToOffice')
        ->where('project.Region', '=', $UserOffice)
        ->where('project.Stage', '>', 0)
        ->leftJoin('projectactivity', function($project){
            $project->on('projectactivity.ProjectGUID','=','project.GUID')
            ->whereRaw('projectactivity.id IN (select MAX(a2.id) from projectactivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        });

        if($UserRole == 'Evaluator'){
            $project->where('project.Region', '=', $UserOffice)
            // ->where('projectactivity.Status', '!=', 'Approved') 
            ->get();
        }else{
            $project->where('project.CreatedBy', '=', $UserName)->get();
        }
        

        return DataTables::of($project)
        ->addColumn('Details', function($project) use($UserRole){
            if($project->Stage > 0){
                $details = '<a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'">'. $project->ProjectName.'</a>';
            }else{
                if($UserRole != 'Evaluator'){
                    $details = '<a class="text-uppercase" href="NewApplications/'.$project->ProjectGUID.'">'. $project->ProjectName.'</a>';
                }else{
                    $details = '<a class="text-uppercase" href="NewApplications/'.$project->ProjectGUID.'">'. $project->ProjectName.'</a>';
                }
            }
            $details .= '<br><p class="text-uppercase">'.$project->Address.', '. $project->Municipality.', '. $project->Province.', '. $project->Region .'</b><br/>';
            return $details;
        })
        ->addColumn('Status', function($project){
            $details = '<i style="color:slategray;">With '. $project->RoutedToOffice . ' - ' . $project->Status.'</i>';
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

}
