<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\AspnetUser;
use App\Models\Project;
use App\Models\ProjectActivity;
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
        $StatusFilter = $req['StatusFilter'];

        $todate = date('Y-m-d H:i:s');
        $tomorrow = date('Y-m-d', strtotime( $todate . " +1 days"));

        $project = Project::select(
            'Project.Address AS Address',
            'Project.Municipality  AS Municipality', 
            'Project.Province AS Province',
            'Project.CreatedBy',
            'Project.ProjectName',
            'Project.Region  AS Region',
            'Project.GUID AS ProjectGUID',
            'Project.Stage', 
            'Project.ProcTimeFrameInDays',
            'Project.TotProcDays',

            'ProjectActivity.Details AS Remarks',
            'ProjectActivity.RoutedTo',
            'ProjectActivity.GUID AS ActivityGUID', 
            'ProjectActivity.RoutedFrom',
            'ProjectActivity.CreatedDate',
            'ProjectActivity.RoutedToOffice',
            'ProjectActivity.Status',
            )
        ->Join('ProjectActivity', function ($join) {
            $join->on('Project.GUID', '=', 'ProjectActivity.ProjectGUID');

            $join->whereRaw('ProjectActivity.ID IN (select MAX(a2.ID) from ProjectActivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
            })
            // ->where('RoutedFrom', '=', $UserOffice)
            // ->where('Project.CreatedDate', '>=', '2021-01-01')
            // ->where('Project.CreatedDate', '<=', $tomorrow)
        ->where('Project.CreatedBy', '=', $UserName)
        ->groupBy('Project.GUID')
        ->get();

        return DataTables::of($project)
        ->addColumn('Details', function($project) use($UserRole){
            if($project->Stage > 0){
                $details = '<a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
            }else{
                if($UserRole != 'Evaluator'){
                    $details = '<a class="text-uppercase pointer" onclick="NewDocument('. "'" .$project->ProjectGUID. "'".')">'. $project->ProjectName.'</a>';
                }else{
                    $details = '<a class="text-uppercase pointer" onclick="NewDocument('. "'" .$project->ProjectGUID. "'".')">'. $project->ProjectName.'</a>';
                }
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
        ->rawColumns(['Details', 'Status', 'Remarks'])
        ->make(true);
    }

    public function getECCApplicationsCaseHandler(Request $req)
    {
        $UserName = $req['UserName'];
        $UserRole = $req['UserRole'];
        $UserOffice = $req['UserOffice'];
        $StatusFilter = $req['StatusFilter'];

        $todate = date('Y-m-d H:i:s');
        $tomorrow = date('Y-m-d', strtotime( $todate . " +1 days"));

        $project = Project::select(
            'Project.Address AS Address',
            'Project.Municipality  AS Municipality', 
            'Project.Province AS Province',
            'Project.CreatedBy',
            'Project.ProjectName',
            'Project.Region  AS Region',
            'Project.GUID AS ProjectGUID',
            'Project.Stage', 
            'Project.ProcTimeFrameInDays',
            'Project.TotProcDays',

            'ProjectActivity.Details AS Remarks',
            'ProjectActivity.RoutedTo',
            'ProjectActivity.GUID AS ActivityGUID', 
            'ProjectActivity.RoutedFrom',
            'ProjectActivity.CreatedDate',
            'ProjectActivity.RoutedToOffice',
            'ProjectActivity.Status',
            )
        ->Join('ProjectActivity', function ($join) {
            $join->on('Project.GUID', '=', 'ProjectActivity.ProjectGUID');

            $join->whereRaw('ProjectActivity.ID IN (select MAX(a2.ID) from ProjectActivity as a2 join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
            });
        if($StatusFilter === 'Pending with EMB'){
            $project->where('RoutedToOffice', '=', $UserOffice)
            ->whereNotIn('Status', array('Approved', 'Denied'));
        } else if($StatusFilter === 'Pending with Proponents'){
            $project->where('RoutedToOffice', '=', 'Proponent')
            ->whereNotIn('Status', array('Approved', 'Denied', 'Pending for Submission'));
        } else if($StatusFilter === 'Decided'){
            $project->whereIn('RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereIn('Status', array('Approved', 'Denied'));
        } else if($StatusFilter === 'Approved'){
            $project->whereIn('RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereIn('Status', array('Approved'));
        } else if($StatusFilter === 'Approved (Auto)'){
            $project->whereIn('RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereIn('Status', array('Approved'));
        } else if($StatusFilter === 'Denied'){
            $project->whereIn('RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereIn('Status', array('Denied'));
        } else if($StatusFilter === 'Pending All'){
            $project->whereIn('RoutedToOffice', array($UserOffice, 'Proponent'), )
            ->whereNotIn('Status', array('Denied', 'Approved'));
        }

        
            // ->where('Project.CreatedDate', '>=', '2021-01-01')
            // ->where('Project.CreatedDate', '<=', $tomorrow)
        // ->where('Project.CreatedBy', '=', $UserName)

        $project->groupBy('Project.GUID')
        ->orderByRaw('ProjectActivity.UpdatedDate DESC')
        ->get();

        return DataTables::of($project)
        ->addColumn('Details', function($project) use($UserRole){
            if($project->Stage > 0){
                $details = '<a class="text-uppercase" href="ProjectApp/'.$project->ProjectGUID.'/'.$project->ActivityGUID.'">'. $project->ProjectName.'</a>';
            }else{
                if($UserRole != 'Evaluator'){
                    $details = '<a class="text-uppercase pointer" style="cursor:pointer" onclick="NewDocument('. "'" .$project->ProjectGUID. "'".')">'. $project->ProjectName.'</a>';
                }else{
                    $details = '<a class="text-uppercase pointer" style="cursor:pointer" onclick="NewDocument('. "'" .$project->ProjectGUID. "'".')">'. $project->ProjectName.'</a>';
                }
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
        ->rawColumns(['Details', 'Status', 'Remarks'])
        ->make(true);
    }

}
