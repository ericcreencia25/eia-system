<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Component;
use App\Models\Municipality;
use App\Models\ProjectActivityAttachment;
use App\Models\ProjectApplicationRequirements;
use App\Models\ProjectArea;

use Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class NewApplicationsController extends Controller
{
    public function index()
    {
        return view('secured.new_applications.index');
    }

    public function getProjectType(Request $req)
    {
        $ComponentGUID = $req['ComponentGUID'];

        $ProjectSize = $req['ProjectSize'];
        
        if(empty($ComponentGUID) && empty($ProjectSize)){$component = Component::all();}
        else{$component = Component::where('GUID', '=', $ComponentGUID)->get();}
        
        return DataTables::of($component)
        ->addColumn('Category', function($component){
            $details = $component->ProjectType . '<br>'. $component->ProjectSubType;
            return $details;
        })
        ->addColumn('SpecificType', function($component){
            $details =  $component->ProjectSpecificType . '<br>'. $component->ProjectSpecificSubType;
            return $details;
        })
        ->addColumn('ProjectSize', function($component)  use ($ProjectSize){
            // $details =  '<button class="btn btn-block btn-flat"><i class="fa fa-file-o"></i></button>';
            // $details =  '<label style="background-color:Silver; width:30%;">'. $component->Parameter . ' in '. $component->UnitOfMeasure. '</label><input type="text" class="form-control input-lg" id="" placeholder="">';

            $details = '<div class="input-group input-group-lg">
                <span class="input-group-addon input-sm" style="background-color:Silver; ">'. $component->Parameter . ' in '. $component->UnitOfMeasure. '</span>
                <input type="text" class="form-control" value="'.$ProjectSize.'">
              </div>';
            return $details;
        })
        ->rawColumns(['Category', 'SpecificType', 'ProjectSize'])
        ->make(true);
    }

    public function description()
    {
        return view('secured.new_applications.description');
    }

    public function geographical_information()
    {
        return view('secured.new_applications.geographical_information');
    }

    public function basic_project_info()
    {
        return view('secured.new_applications.basic_project_info');
    }

    public function checklist()
    {
        return view('secured.new_applications.checklist');
    }

    public function ecc_application_requirements()
    {
        return view('secured.new_applications.ecc_application_requirements');
    }

    public function application_tab(Request $request, $GUID)
    {

        $sess = $request->session()->get('data');
        $UserRole = $sess->UserRole;
        
        $project = Project::where('Project.GUID', '=', $GUID)
        ->where('Project.Stage', '=', 0 )
        ->leftJoin('projectactivity', 'Project.GUID', '=', 'ProjectActivity.ProjectGUID')
        ->leftJoin('Proponent', 'Project.ProponentGUID', '=', 'Proponent.GUID')
        ->select('Project.Address AS Address',
        'Project.Municipality  AS Municipality',
        'Project.Province AS Province', 
        'Project.ProjectSize AS ProjectSize', 
        'Project.Address', 
        'ProjectActivity.Status', 
        'ProjectActivity.Details AS Remarks', 
        'Project.ProjectName', 
        'Project.Region AS Region', 
        'ProjectActivity.RoutedTo', 
        'ProjectActivity.RoutedFrom', 
        'ProjectActivity.CreatedDate', 
        'Project.GUID AS ProjectGUID', 
        'Project.PreviousECCNo', 
        'Project.Purpose', 
        'Project.PriorTo1982', 
        'Project.InNIPAS', 
        'Project.Description', 
        'Project.ComponentGUID', 
        'Project.ZoneClassification',
        'Project.LandAreaInSqM',
        'Project.FootPrintAreaInSqM',
        'Project.NoOfEmployees',
        'Project.ProjectCost',
        'Proponent.*')
        ->first();

        if($UserRole == 'Evaluator'){
            return view('error');
        }else{
            return view('secured.new_applications.application_tab', compact('project'));
        }
        
    }

    public function getMunicipalities(Request $req)
    {   
        $project['data'] = Municipality::all();
        return response()->json($project);
    }

    public function getApplicationRequirements()
    {
        $project = ProjectApplicationRequirements::all();

        return DataTables::of($project)
        ->addColumn('Counts', function($project){
            $details = '<div style="padding:3px; background-color:RGB(30, 126, 223); color:White;">
                                Files: <span id="" title="Files Attached">0</span>
                            </div>';
            return $details;
        })
        ->addColumn('Requirements', function($project){
            $details = '<div id="">
                                <a title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;">'.$project->Description.'</a>
                            </div>';
            return $details;
        })
        ->addColumn('Files', function($project){

            $details = '<div class="form-group"><input type="file" id="exampleInputFile" style="width: 100px"></div>';

            return $details;
        })
        ->addColumn('Action', function($project){

            $details = '<button type="button" class="btn btn-default btn-sm"><input type="image" name="" id="" title="Click here to upload file." src="../img/upload.png" style="width:15px;"></button>';

            $details .= '<button type="button" class="btn btn-default btn-sm"><input type="image" name=" id="" title="Click here to remove the uploaded file." src="../img/trashbin.jpg" onclick="return confirm('."'Remove the updated file?'".');" style="width:15px;"></button>';

            return $details;
        })
        ->rawColumns(['Counts', 'Requirements', 'Files', 'Action'])
        ->make(true);
    }

    public function getGeoCoordinates(Request $req)
    {
        $ProjectGUID = $req['data'];
        
        $ProjectArea = ProjectArea::where('ProjectGUID', '=', $ProjectGUID)
        ->leftJoin('ProjectGeocoordinates', 'ProjectArea.GUID', '=', 'ProjectGeocoordinates.AreaGUID')
        ->select(
            'ProjectArea.GUID AS AreaGUID',
            'ProjectArea.Area',
            'ProjectArea.AreaType AS Type',
            'ProjectGeocoordinates.LongDeg',
            'ProjectGeocoordinates.LongMin',
            'ProjectGeocoordinates.LongSec',
            'ProjectGeocoordinates.LatDeg',
            'ProjectGeocoordinates.LatMin',
            'ProjectGeocoordinates.LatSec',
            'ProjectGeocoordinates.Longitude',
            'ProjectGeocoordinates.Latitude',
            'ProjectGeocoordinates.Sorter',
        )
        ->orderByRaw('Sorter ASC')
        ->get();

        return DataTables::of($ProjectArea)
        ->addColumn('DMSLatitude', function($ProjectArea){
            $details = $ProjectArea->LatDeg . '° ' . $ProjectArea->LatMin."' ". $ProjectArea->LatSec;
            return $details;
        })
        ->addColumn('DMSLongitude', function($ProjectArea){
            $details = $ProjectArea->LongDeg . '° ' . $ProjectArea->LongMin."' ". $ProjectArea->LongSec;
            return $details;
        })
        ->addColumn('Action', function($ProjectArea){
            $details =  '<input type="image"  src="../img/trashbin.jpg" onclick="return confirm('."'Remove this geo-coordinate?'".');" style="width:20px;">';
            return $details;
        })
        ->rawColumns(['DMSLatitude', 'DMSLongitude', 'Action'])
        ->make(true);
    }
    
}
