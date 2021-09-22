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
        
        $project = Project::where('project.GUID', '=', $GUID)
        ->where('project.Stage', '=', 0 )
        ->leftJoin('projectactivity', 'project.GUID', '=', 'projectactivity.ProjectGUID')
        ->leftJoin('proponent', 'project.ProponentGUID', '=', 'proponent.GUID')
        ->select('project.Address AS Address',
        'project.Municipality  AS Municipality',
        'project.Province AS Province', 
        'project.ProjectSize AS ProjectSize', 
        'project.Address', 
        'projectactivity.Status', 
        'projectactivity.Details AS Remarks', 
        'project.ProjectName', 
        'project.Region AS Region', 
        'projectactivity.RoutedTo', 
        'projectactivity.RoutedFrom', 
        'projectactivity.CreatedDate', 
        'project.GUID AS ProjectGUID', 
        'project.PreviousECCNo', 
        'project.Purpose', 
        'project.PriorTo1982', 
        'project.InNIPAS', 
        'project.Description', 
        'project.ComponentGUID', 
        'project.ZoneClassification',
        'project.LandAreaInSqM',
        'project.FootPrintAreaInSqM',
        'project.NoOfEmployees',
        'project.ProjectCost',
        'proponent.*')
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
        ->leftJoin('projectgeocoordinates', 'projectarea.GUID', '=', 'projectgeocoordinates.AreaGUID')
        ->select(
            'projectarea.GUID AS AreaGUID',
            'projectarea.Area',
            'projectarea.AreaType AS Type',
            'projectgeocoordinates.LongDeg',
            'projectgeocoordinates.LongMin',
            'projectgeocoordinates.LongSec',
            'projectgeocoordinates.LatDeg',
            'projectgeocoordinates.LatMin',
            'projectgeocoordinates.LatSec',
            'projectgeocoordinates.Longitude',
            'projectgeocoordinates.Latitude',
            'projectgeocoordinates.Sorter',
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
