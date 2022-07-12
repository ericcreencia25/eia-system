<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectActivity;
use App\Models\Component;
use App\Models\ComponentThreshold;
use App\Models\ComponentTemplate;
use App\Models\Municipality;
use App\Models\ProjectActivityAttachment;
use App\Models\ProjectActivityAttachmentTemp;
use App\Models\ProjectApplicationRequirements;
use App\Models\ProjectArea;
use App\Models\ProjectRequirements;
use App\Models\BindedData;

use App\Models\Proponent;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use Webpatser\Uuid\Uuid;

use Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use File;
use PDF;

class NewApplicationsController extends Controller
{
    public function index()
    {
        return view('secured.new_applications.index');
    }

    

    public function getProjectType(Request $req)
    {
        $ComponentGUID = $req['ComponentGUID'];
        $search = $req['search'];

        $ProjectSize = $req['ProjectSize'];

        $component = Component::Join('componentthresholdnew', 'component.GUID', '=', 'componentthresholdnew.ComponentGUID')
            ->select(
                'component.GUID as GUID',
                'component.ProjectType as ProjectType',
                'component.ProjectSubType as ProjectSubType',
                'component.ProjectSpecificSubType as ProjectSpecificSubType',
                'component.ProjectSpecificType as ProjectSpecificType',
                'component.Parameter as Parameter',
                'component.UnitOfMeasure as UnitOfMeasure',

                'componentthresholdnew.Category as Category',
                'componentthresholdnew.Minimum',
                'componentthresholdnew.Maximum',
                'componentthresholdnew.ReportType as ReportType',
                'componentthresholdnew.GUID as componentthresholdGUID',
                'componentthresholdnew.ReferenceID',
            )
            ->orderByRaw('componentthresholdnew.ReferenceID')
            ->groupBy('component.GUID')
            ->get();
        // }
        
        return DataTables::of($component)
        ->addColumn('Category', function($component){
            $details = '<b>' . Str::upper($component->ProjectType) . '</b><br>'. $component->ProjectSubType;
            return $details;
        })
        ->addColumn('SpecificType', function($component){
            
            if($component->ProjectSpecificSubType == 'NULL'){
                $subtype = '';
            } else {
                $subtype = $component->ProjectSpecificSubType;
            }

            if($component->ProjectSpecificType == 'NULL'){
                $specifictype = '';
            } else {
                $specifictype = $component->ProjectSpecificType;
            }

            $details =  $specifictype . '<br>'. $subtype;
            return $details;
        })
        ->addColumn('ProjectSize', function($component)  use ($ProjectSize){

            $details = '<span class="input-group-addon input-md limit">'. $component->Parameter . ' in '. $component->UnitOfMeasure. '</span>';


            return $details;
        })
        ->addColumn('ProjectSizeInput', function($component)  use ($ProjectSize){

            // $details = '<div class="input-group input-group-lg col-md-12" ">
                
            //     <input type="number" id="input_project_size_'.$component->componentthresholdGUID.'"  class="form-control" value="'.$ProjectSize.'"  min="'.$component->Minimum.'" max="'.$component->Maximum.'" style="height: 70px">
            //   </div>';

              $details = '<div class="input-group input-group-lg col-md-12" ">
                
                <input type="number" id="input_project_size_'.$component->GUID.'"  class="form-control" style="height: 70px">
              </div>';


            return $details;
        })
        ->addColumn('Action', function($component){

            // if($component->ReportType === 'EIS'){
            //     $details = '<button type="button" class="btn btn-block btn-success btn-sm" style="margin-top: 20px" onclick="ProjectSize(\''.$component->componentthresholdGUID.'\', \''.$component->GUID.'\', \''.$component->ReportType.'\')" disabled>Apply Permit</button>';

            // }else if($component->ReportType === 'IEE'){
            //     $details = '<button type="button" class="btn btn-block btn-primary btn-sm" style="margin-top: 20px" onclick="ProjectSize(\''.$component->componentthresholdGUID.'\', \''.$component->GUID.'\', \''.$component->ReportType.'\')">Apply Permit</button>';
            // }else if($component->ReportType === 'CNC Application'){
            //     $details = '<button type="button" class="btn btn-block btn-warning btn-sm" style="margin-top: 20px" onclick="ProjectSize(\''.$component->componentthresholdGUID.'\', \''.$component->GUID.'\', \''.$component->ReportType.'\')" disabled>Apply Permit</button>';
            // }

            $details = '<button type="button" class="btn btn-block btn-default btn-sm" style="margin-top: 20px" onclick="ProjectSize(\''.$component->componentthresholdGUID.'\', \''.$component->GUID.'\', \''.$component->ReportType.'\')">Apply Permit</button>';
            

            return $details;

        })
        
        ->rawColumns(['Category', 'SpecificType', 'ProjectSize', 'Action', 'ProjectSizeInput'])
        ->make(true);

        // This type of project and its size falls under the Environmentally Critical Projects (ECPs). The ECC Online Application System covers only the Non-Environmentally Critical Projects (NECPs). For ECP Project, please coordinate with EMB Central Office - Environmnetal Impact Assessment and Management Division.
    }

    public function getComponents(Request $req)
    {
        $ComponentGUID = $req['ComponentGUID'];
        $ReportType = $req['ReportType'];

        $ProjectSize = number_format((float)$req['input_size'], 6, '.', '');

        $component = Component::where('component.GUID', '=', $ComponentGUID)
        ->Join('componentthreshold', 'component.GUID', '=', 'componentthreshold.ComponentGUID')

        ->select(
            'component.GUID as GUID',
            'component.ProjectType as ProjectType',
            'component.ProjectSubType as ProjectSubType',
                'component.ProjectSpecificSubType as ProjectSpecificSubType',
                'component.ProjectSpecificType as ProjectSpecificType',
                'component.Parameter as Parameter',
                'component.UnitOfMeasure as UnitOfMeasure',

                'componentthreshold.Category as Category',
                'componentthreshold.Minimum',
                'componentthreshold.Maximum',
                'componentthreshold.ReportType as ReportType',
                'componentthreshold.GUID as componentthresholdGUID',
            )
        ->whereRaw($ProjectSize .'BETWEEN componentthreshold.Minimum AND componentthreshold.Maximum')
        ->first();

        return $component;
    }

    public function getProjectTypeStep2(Request $req)
    {
        $ComponentGUID = $req['ComponentGUID'];
        $search = $req['search'];

        $ProjectSize = $req['ProjectSize'];

        
        if(empty($ComponentGUID)){
            $component = Component::where('component.ProjectType', 'LIKE', '%'. $search.'%')
            ->leftJoin('componentthreshold', 'component.GUID', '=', 'componentthreshold.ComponentGUID')
            ->select(
                'component.GUID as GUID',
                'component.ProjectType as ProjectType',
                'component.ProjectSubType as ProjectSubType',
                'component.ProjectSpecificSubType as ProjectSpecificSubType',
                'component.ProjectSpecificType as ProjectSpecificType',
                'component.Parameter as Parameter',
                'component.UnitOfMeasure as UnitOfMeasure',

                'componentthreshold.Category as Category',
                'componentthreshold.Minimum',
                'componentthreshold.Maximum'
            )

            // ->where('componentthreshold.Category', '=', 'NECP')
            ->where('componentthreshold.ReportType', '=', 'IEE')
            ->get();
        } else{
            $component = Component::where('component.GUID', '=', $ComponentGUID)
            ->leftJoin('componentthreshold', 'component.GUID', '=', 'componentthreshold.ComponentGUID')
            ->select(
                'component.GUID as GUID',
                'component.ProjectType as ProjectType',
                'component.ProjectSubType as ProjectSubType',
                'component.ProjectSpecificSubType as ProjectSpecificSubType',
                'component.ProjectSpecificType as ProjectSpecificType',
                'component.Parameter as Parameter',
                'component.UnitOfMeasure as UnitOfMeasure',

                'componentthreshold.Category as Category',
                'componentthreshold.Minimum',
                'componentthreshold.Maximum',
                'componentthreshold.ReportType',
                'componentthreshold.ReferenceID',
            )
            // ->where('componentthreshold.Category', '=', 'NECP')
            ->where('componentthreshold.ReportType', '=', 'IEE')
            ->get();
        }
        
        return DataTables::of($component)
        ->addColumn('Category', function($component){
            $details = '<b>' . Str::upper($component->ProjectType) . '</b><br>'. $component->ProjectSubType;
            return $details;
        })
        ->addColumn('SpecificType', function($component){
            
            if($component->ProjectSpecificSubType == 'NULL'){
                $subtype = '';
            } else {
                $subtype = $component->ProjectSpecificSubType;
            }

            if($component->ProjectSpecificType == 'NULL'){
                $specifictype = '';
            } else {
                $specifictype = $component->ProjectSpecificType;
            }

            $details =  Str::upper($specifictype) . '<br>'. $subtype;
            return $details;
        })
        ->addColumn('ProjectSize', function($component)  use ($ProjectSize){

            // $details = '<span class="input-group-addon input-md limit">'. $component->Parameter . ' in '. $component->UnitOfMeasure. '</span>';

            // $details .= '<input type="number" id="input_project_size_'.$component->GUID.'"  class="form-control" value="'.$ProjectSize.'"  min="'.$component->Minimum.'" max="'.$component->Maximum.'" style="height: 70px" disabled>';

            $details = '<div class="input-group margin">
                <div class="input-group-btn">
                  <span class="input-group-addon input-md limit" style="word-wrap:break-word; width: 150px; white-space: normal; background-color: #f5f6f8">'. $component->Parameter . ' in '. $component->UnitOfMeasure. '</span>
                </div>
                <!-- /btn-group -->
                <input type="text" class="form-control" style="height: 55px" value="'.$ProjectSize.'" disabled>
              </div>';


            return $details;
        })
        ->addColumn('ProjectSizeInput', function($component)  use ($ProjectSize){

            $details = '<div class="input-group input-group-lg col-md-12" ">
                
                <input type="number" id="input_project_size_'.$component->GUID.'"  class="form-control" value="'.$ProjectSize.'"  min="'.$component->Minimum.'" max="'.$component->Maximum.'" style="height: 70px" disabled>
              </div>';


            return $details;
        })
        
        ->rawColumns(['Category', 'SpecificType', 'ProjectSize', 'ProjectSizeInput'])
        ->make(true);

        // This type of project and its size falls under the Environmentally Critical Projects (ECPs). The ECC Online Application System covers only the Non-Environmentally Critical Projects (NECPs). For ECP Project, please coordinate with EMB Central Office - Environmnetal Impact Assessment and Management Division.
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

    public function selectedArea(Request $req)
    {   
        $ProjectGUID = $req['ProjectGUID'];

        $project['data'] = ProjectArea::where('ProjectGUID', '=', $ProjectGUID)->get();
        
        return response()->json($project);
    }

    public function getMunicipalities(Request $req)
    {   
        $municipality = $req['data'];

        // if(empty($municipality)){
            $project['data'] = Municipality::all();    
        // } else {
        //     $project['data'] = Municipality::where('municipality.municipality', '=', $municipality)->get();
        // }
        
        return response()->json($project);
    }


    public function onChangeMunicipalities(Request $req)
    {   
        $ID = $req['data'];

        $project['data'] = Municipality::where('municipality.ID', '=', $ID)->first();
        
        return response()->json($project);
    }

    public function getApplicationRequirements(Request $req)
    {
        $ActivityGUID = Session::get('ActivityGUID');
        $ProjectGUID = $req['ProjectGUID'];

        $IsGovProject = $req['IsGovProject'];
        $InTenInstrument = $req['InTenInstrument'];
        $IsAncestralDomain = $req['IsAncestralDomain'];

        $project = DB::table('project_applicationrequirements')->orderByRaw('Sorter ASC')
        ->where('Required', 1);

        if($InTenInstrument == 0){
            $project->where('Description', '!=', 'Application duly received by the DENR concerned for the tenurial instrument')->where('Description', '!=', 'Proof of authority over the project site (land title, lease contract, deed of absolute sale, etc.)');
        }

        if($IsAncestralDomain == 0){
            $project->where('Description', '!=', 'Received Letter filed to NCIP for the intent to use the ancestral domain')->where('Description', '!=', 'Proof of authority over the project site (land title, lease contract, deed of absolute sale, etc.)');
        }

        if($InTenInstrument == 1 && $IsAncestralDomain == 1){
            $project->where('Description', '!=', 'Proof of authority over the project site (land title, lease contract, deed of absolute sale, etc.)');
        }
        
        $project->get();

        return DataTables::of($project)
        ->addColumn('Counts', function($project) use ($ActivityGUID, $ProjectGUID){
            $count = ProjectActivityAttachmentTemp::where('ActivityGUID', $ActivityGUID)
            ->where('Description', $project->Description)
            ->count(); 


            if($count == 1){
                $details = '<center><img id="count_files_'.$project->ID.'" src="../img/checkroundedblue.jpg" style="width:30px; padding-top: 5px" data-id="1">';
            }else{
                $details = '<center><img id="count_files_'.$project->ID.'" style="width:30px; padding-top: 5px" data-id="0">';
            }

            return $details;
        })
        ->addColumn('Requirements', function($project) use ($ActivityGUID){
            $data = ProjectActivityAttachmentTemp::where('ActivityGUID', '=', $ActivityGUID)
            ->where('Description', $project->Description)
            ->first();

            if(!empty($data)){
                $details = '<a title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;" 
                href="'.url($data->FilePath).'">'.$project->Description.'</a>';
            }else{
                $details = $project->Description;
            }

            
            return $details;
        })
        
        ->addColumn('Files', function($project) use ($ActivityGUID){
            $data = ProjectActivityAttachmentTemp::where('ActivityGUID', $ActivityGUID)
            ->where('Description', $project->Description)
            ->first();

            $details = '<form id="multi-file-upload-ajax" enctype="multipart/form-data">';
            $details .= '<div class="input-group"><input id="files_'.$project->ID.'" type="file" name="files" /></div>';

            if(!empty($data)){
                $details .= '<div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" name="submit" style="width:70px;" disabled><i class="fa fa-upload"></i> Upload</button>

                                <button type="button" class="btn btn-danger btn-sm" style="width:70px;" onclick="deleteFile('. "'" .$data->GUID. "'".')"><i class="fa fa-trash"></i> Delete</button>
                            </div>';
            }else{
                $details .= '<div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" name="submit" onclick="uploadFile('. "'" .$project->Description. "',". "'". $project->ID. "'" . ')"  style="width:70px;" ><i class="fa fa-upload"></i> Upload</button>

                                <button type="button" class="btn btn-danger btn-sm" style="width:70px;"  disabled><i class="fa fa-trash"></i> Delete</button>
                            </div>';

                        }

                return $details;
        })

        ->addColumn('Progress', function($project) use ($ActivityGUID){
            $data = ProjectActivityAttachmentTemp::where('ActivityGUID', $ActivityGUID)
            ->where('Description', $project->Description)
            ->first();

            if(!empty($data)){
                $details = '';
            }else{
                $details ='<div class="progress"  style="width:150px;" >
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width: 00%" id="progressBar_'.$project->ID.'">
                        <span class="sr-only">0% Complete (success)</span>
                    </div>
                    <p class="text-green" id="progressMessage_'.$project->ID.'"></p>
                </div>';
            }

            
            return $details;
        })
        ->rawColumns(['Counts', 'Requirements', 'Files', 'Action', 'Progress'])
        ->make(true);
    }

    public function getDocumentsUploaded(Request $request)
    {
        $ProjectGUID = $request['ProjectGUID'];
        $ActivityGUID = Session::get('ActivityGUID');

        $project = DB::table('project_applicationrequirements')->orderByRaw('Sorter ASC')
        ->where('Required', 1)
        ->get();

        return DataTables::of($project)
        ->addColumn('Check', function($project){
            $details = '<span style="color: #00c0ef" class="glyphicon glyphicon-ok-sign"></span>';
            return $details;
        })
        ->rawColumns(['Check'])
        ->make(true);
    }

    public function getGeoCoordinates(Request $req)
    {
        $ProjectGUID = $req['data'];
        
        $ProjectArea = ProjectArea::where('ProjectGUID', $ProjectGUID)
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

    public function new_document($GUID)
    {
        $UserRole = Session::get('data')['UserRole'];
        $UserName = Session::get('data')['UserName'];

        $project = Project::where('GUID', $GUID)->first();

        if(!Session::has('step_1')){
            if($project){
                
                $this->ResetInputs();

                $this->putExistingDataInSession($GUID);
            }
        }
        
        if($UserRole != 'Applicant'){
            return redirect()->route('default');
        } else if($project === null) {
            return view('secured.create_applications.application_tab');
        }else {
            if(Str::lower($project->CreatedBy) == Str::lower($UserName) ){
                return view('secured.create_applications.application_tab');  
            } else {
                return redirect()->route('default');
            }
        }
    }

    public function putExistingDataInSession($GUID)
    {
        $ProjectGUID = $GUID;
        $project = Project::where('GUID', '=', $ProjectGUID)->first();

        $step_1 = ['ecc_amendment'=> $project->PreviousECCNo, 'purpose'=>$project->Purpose, 'prior_to_1982'=>$project->PriorTo1982, 'In_NIPAS'=> $project->InNIPAS, 'IsGovProject'=> $project->GovtProject, 'IsAncestralDomain'=> $project->AncestralDomain, 'InTenInstrument'=> $project->DENRTenurial, 'first' => 1];


        Session::put('step_1', $step_1);

        ///2nd Step

        $components =ComponentTemplate::where('GUID', $project->ComponentGUID)
        ->first();

        $step_2 = ['input_size'=> $project->ProjectSize, 'ComponentGUID'=>$project->ComponentGUID, 'second'=> 1, 'Template'=>$components->TemplateAcronym, 'ComponentPDF'=>$components->ComponentPDF, 'MgtPlanPDF'=>$components->MgtPlanPDF, 'AbandonementPDF'=>$components->AbandonementPDF];

        // $step_2 = ['input_size'=>$project->ProjectSize, 'ComponentGUID'=>$project->ComponentGUID, 'second'=>1];

        Session::put('step_2', $step_2);

        ///3rd Step
        $step_3 = ['description'=> $project->Description, 'third'=>1];

        Session::put('step_3', $step_3);

        ///4th 
        $projectGeo = ProjectArea::where('projectarea.ProjectGUID', '=', $ProjectGUID)
        ->Join('projectgeocoordinates', 'projectarea.GUID', '=', 'projectgeocoordinates.AreaGUID')
        ->select(
            'projectarea.*',
            'projectgeocoordinates.*'
        )->get();

        $arrayGeo = array();
        foreach($projectGeo as $Geo)
        {
            $raw = array();
            $raw[0] = $Geo->Area;
            $raw[1] = $Geo->AreaType;
            $raw[2] = $Geo->LatDeg .'°'. $Geo->LatMin . "'". $Geo->LatSec;
            $raw[3] = $Geo->LongDeg .'°'. $Geo->LongMin . "'". $Geo->LongSec;
            $raw[4] = $Geo->Latitude;
            $raw[5] = $Geo->Longitude;
            $raw[6] = '<button type="button" class="btn btn-default" id="remove" title="delete coordinates"><img src="../img/trashbin.jpg" style="width:15px;" /></button>';
            $raw[7] = '<button type="button" class="btn btn-default" id="map-view"       onclick="clickMe('.$Geo->Latitude.', '."'".$Geo->Longitude."'".')" title="view by point"><img src="../img/map.png" style="width:17px;" /></button';
            $raw[8] = $Geo->AreaGUID;
            array_push($arrayGeo, $raw);
        }

        if(count($projectGeo) > 0){
            Session::put('step_4_status', 1);
        } else {
            Session::put('step_4_status', 0);
        }
        Session::put('step_4', $arrayGeo);
        

        ///5th Step
        $ProponentGUID = session::get('data')['ProponentGUID'];
        $proponent = Proponent::where('proponent.GUID', '=', $ProponentGUID)
        ->first();

        $fifth = array();

        $fifth['represented_by'] = $project->Representative;
        $fifth['proponent_name'] = $proponent->ProponentName;
        $fifth['proponent_address'] = $proponent->MailingAddress;
        $fifth['landline_no'] = $project->LandlineNo;
        $fifth['fax_no'] = $project->FaxNo;
        $fifth['mobile_number'] = $project->MobileNo;
        $fifth['email_address'] = $project->EmailAddress;
        $fifth['designation'] = $project->Designation;

        $fifth['project_name'] = $project->ProjectName;
        $fifth['project_location'] = $project->Address;
        $fifth['project_landarea'] = $project->LandAreaInSqM;
        $fifth['project_footprintarea'] = $project->FootPrintAreaInSqM;
        $fifth['mailing_address'] = $project->MailingAddress;
        $fifth['province'] = $project->Province;
        $fifth['zone_classification'] = $project->ZoneClassification;
        $fifth['no_of_employees'] = $project->NoOfEmployees;
        $fifth['total_project_cost'] = $project->ProjectCost;
        $fifth['municipality'] = $project->Municipality;
        $fifth['ProjectGUID'] = $project->ProjectGUID;

        Session::put('step_5', $fifth);
        Session::put('step_5_status', 1);


        $projectActivity = ProjectActivity::where('ProjectGUID', '=', $ProjectGUID)->first();

        Session::put('ActivityGUID', $projectActivity->GUID);
    }

    public function FirstStep(Request $req)
    {
        $purpose = $req['purpose'];
        $prior_to_1982 = $req['prior_to_1982'];
        $In_NIPAS = $req['In_NIPAS'];
        $ecc_amendment = $req['ecc_amendment'];
        $IsGovProject = $req['IsGovProject'];
        $InTenInstrument = $req['InTenInstrument'];
        $IsAncestralDomain = $req['IsAncestralDomain'];
        $first = $req['first'];

        $proj = Project::where('project.ReferenceNo', '=', $ecc_amendment)
        ->first();

        $all = [
            'purpose'=>$purpose, 
            'prior_to_1982'=>$prior_to_1982, 
            'In_NIPAS'=>$In_NIPAS, 
            'ecc_amendment'=> $ecc_amendment, 
            'IsGovProject'=>$IsGovProject, 
            'InTenInstrument'=>$InTenInstrument, 
            'IsAncestralDomain'=> $IsAncestralDomain, 
            'first' => $first
        ];

        Session::put('step_1', $all);

        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        $ActivityGUID = Session::get('ActivityGUID') ? Session::get('ActivityGUID') : $GUID;

        Session::put('ActivityGUID', $ActivityGUID);

        if(empty($proj)){
            return 'Not Exists';
        }else{
            return 'Success';
        }
    }

    public function SecondStep(Request $req)
    {
        $ComponentGUID = $req['ComponentGUID'];
        $input_size = $req['input_size'];
        $second = $req['second'];

        $all = ['input_size'=>$input_size, 'ComponentGUID'=>$ComponentGUID, 'second'=>$second];

        $req->session()->put('step_2', $all);
    }


    public function ThirdStep(Request $req)
    {
        $description = $req['description'];
        $third = $req['third'];
        $all = ['description'=>$description, 'third'=>$third];

        $req->session()->put('step_3', $all);
    }

    public function FourthStep(Request $req)
    {
        $data = $req['data'];
        $fourth = $req['fourth'];

        if(!empty($data)){
            $req->session()->put('step_4', $data);
            $req->session()->put('step_4_status', $fourth);
        } else {
            $req->session()->put('step_4_status', $fourth);
        }
    }

    public function FifthStep(Request $req)
    {
        $data = $req['data'];
        $fifth = $req['fifth'];

        $ProjectGUID = $data['ProjectGUID'];

        $ProponentGUID = session::get('data')['ProponentGUID'];
        $proponent = Proponent::where('proponent.GUID', '=', $ProponentGUID)
        ->select('MailingAddress AS proponent_address')
        ->first();

        array_push($data, $data['proponent_address']=$proponent->proponent_address);

        if(!empty($fifth)){
            $req->session()->put('step_5', $data);
            $req->session()->put('step_5_status', $fifth);
        }else{
            $req->session()->put('step_5_status', $fifth); 
        }
        
    }

    public function insertProjectRequirement(Request $req)
    {
        $ProjectGUID = $req['ProjectGUID'];
        $IsGovProject = $req['IsGovProject'];
        $IsAncestralDomain = $req['IsAncestralDomain'];
        $InTenInstrument = $req['InTenInstrument'];

        if($InTenInstrument == 0){
            $data = ProjectApplicationRequirements::orderByRaw('Sorter ASC')
            ->where('Description', '!=', 'Application duly received by the DENR concerned for the tenurial instrument')->where('Description', '!=', 'Proof of authority over the project site (land title, lease contract, deed of absolute sale, etc.)')
            ->select('Description', 'Required')->get();
        }

        if($IsAncestralDomain == 0){
            $data = ProjectApplicationRequirements::orderByRaw('Sorter ASC')
            ->where('Description', '!=', 'Received Letter filed to NCIP for the intent to use the ancestral domain')->where('Description', '!=', 'Proof of authority over the project site (land title, lease contract, deed of absolute sale, etc.)')
            ->select('Description', 'Required')->get();
        }

        if($InTenInstrument == 1 && $IsAncestralDomain == 1){
            $data = ProjectApplicationRequirements::orderByRaw('Sorter ASC')
            ->where('Description', '!=', 'Proof of authority over the project site (land title, lease contract, deed of absolute sale, etc.)')
            ->select('Description', 'Required')->get();
        }
        

        $check = DB::table('projectrequirement')->where('ProjectGUID', $ProjectGUID)->get();

        if(count($check) == 0){
            $row = array();

            foreach ($data as $key => $value) {
                $row['ProjectGUID'] = $ProjectGUID;
                $row['Description'] = $value->Description;
                $row['Required'] = $value->Required;
                $row['Compliant'] = 0;
                DB::table('projectrequirement')->insert($row);
            }
        } else {

            if(DB::table('projectrequirement')->where('ProjectGUID', '=', $ProjectGUID)->delete()){

                $row = array();

                foreach ($data as $key => $value) {
                    $row['ProjectGUID'] = $ProjectGUID;
                    $row['Description'] = $value->Description;
                    $row['Required'] = $value->Required;
                    $row['Compliant'] = 0;
                    DB::table('projectrequirement')->insert($row);
                }

            }

        }
    }

    public function uploadFile(Request $request)
    {
        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        $UserName = Session::get('data')['UserName'];
        $ActivityGUID = Session::get('ActivityGUID');

        $description = $request['description'];
        $ProjectGUID = $request['ProjectGUID'];

        $data = array();
        $rtrn = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:2048'
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

             $data['GUID'] = $GUID;
             $data['ActivityGUID'] = $ActivityGUID;
             $data['Description'] = $description;
             $data['Directory'] = public_path();
             $data['FileName'] = $filename;
             $data['FilePath'] = $filepath;
             // $data['extension'] = $extension;
             $data['FileSizeInKB'] = $filesize;
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


    public function deleteFile(Request $request)
    {
        $GUID = $request['TempGUID'];

        $rtrn = array();

        $data = ProjectActivityAttachmentTemp::where('GUID', '=', $GUID)
        ->first();

        if(File::exists(public_path($data->FilePath))){

            File::delete(public_path($data->FilePath));

            if(ProjectActivityAttachmentTemp::where('GUID', $GUID)->delete()){
                $rtrn['success'] = 2;
                $rtrn['message'] = "Removed uploaded file."; 
            }
        }else{
            $rtrn['success'] = 2;
            $rtrn['message'] = "File doesn't uploaded.";  
        }

        return response()->json($rtrn);
    }


   public function getGeoTable()
    {
        $data = Session::get('step_4');

        return $data;
    }


    public function SaveNewApplication(Request $req)
    {
        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];
        $ProjectGUID = $req['ProjectGUID'];

        $step_1 = Session::get('step_1');
        $step_2 = Session::get('step_2');
        $step_3 = Session::get('step_3');
        $step_4 = Session::get('step_4');
        $step_5 = Session::get('step_5');
        $ProjectActivityGUID = Session::get('ActivityGUID');
        $ProponentGUID = Session::get('data')['ProponentGUID'];

        ///getting region from province
        $province = DB::table('province')
        ->where('Province', '=', $step_5['province'])
        ->first();

        $project = array();
        $project['GUID'] = $ProjectGUID;
        $project['Purpose'] = $step_1['purpose'];
        $project['PriorTo1982'] = $step_1['prior_to_1982'];
        $project['InNIPAS'] = $step_1['In_NIPAS'];
        $project['PreviousECCNo'] = $step_1['ecc_amendment'];

        $project['ProjectName'] = $step_5['project_name'];
        $project['MailingAddress'] = $step_5['mailing_address'];
        $project['Representative'] = $step_5['represented_by'];
        $project['Designation'] = $step_5['designation'];;
        $project['LandlineNo'] = $step_5['landline_no'];
        $project['MobileNo'] = $step_5['mobile_number'];
        $project['FaxNo'] = $step_5['fax_no'];
        $project['EmailAddress'] = $step_5['email_address'];
        $project['ZoneClassification'] = $step_5['zone_classification'];
        $project['ProponentGUID'] = $ProponentGUID;
        $project['Address'] = $step_5['project_location'];
        $project['Municipality'] = $step_5['municipality'];
        $project['Province'] = $step_5['province'];
        $project['Region'] = $province->Region;
        $project['LandAreaInSqM'] = $step_5['project_landarea'];
        $project['FootPrintAreaInSqM'] = $step_5['project_footprintarea'];

        $project['Description'] = $step_3['description'];

        $project['ComponentGUID'] = $step_2['ComponentGUID'];
        $project['ReportType'] = "IEE";
        $project['ProjectSize'] = $step_2['input_size'];

        $now = new \DateTime(); 

        $project['NoOfEmployees'] = $step_5['no_of_employees'];
        $project['ProjectCost'] = $step_5['total_project_cost'];
        $project['UpdatedBy'] = $UserName;
        $project['UpdatedDate'] = $now->format('Y-m-d H:i:s');
        $project['CreatedBy'] = $UserName;
        $project['AssociatedUser'] = $UserName;
        $project['Basis'] = "Auto";




        $project['DENRTenurial'] = $step_1['InTenInstrument'];
        $project['AncestralDomain'] = $step_1['IsAncestralDomain'];
        $project['GovtProject'] = $step_1['IsGovProject'];

        $project['Stage'] = 0;

        $componentData = Component::where('component.GUID', '=', $step_2['ComponentGUID'])
        ->leftJoin('componentthreshold', 'component.GUID', '=', 'componentthreshold.ComponentGUID')
        ->leftJoin('_componenttemplate', 'component.GUID', '=', '_componenttemplate.GUID')
        ->select(
            'component.IEEChecklist',

            'componentthreshold.Category as Category',
            'componentthreshold.ReportType',
            'componentthreshold.DecisionDocumentDefault',
            'componentthreshold.TagRef',
            '_componenttemplate.TemplateAcronym as Template',
            '_componenttemplate.AbandonementPDF',
            '_componenttemplate.ComponentPDF',
            '_componenttemplate.MgtPlanPDF',
        )
        ->where('componentthreshold.Category', '=', 'NECP')
        ->where('componentthreshold.ReportType', '=', 'IEE')
        ->first();

        $project['Category'] = 'NECP';
        $project['ECALocation'] = 'ECA';
        $project['Template'] = $componentData->Template;
        $project['AbandonPDF'] = $componentData->AbandonementPDF;
        $project['ComponentPDF'] = $componentData->ComponentPDF;
        $project['MgtPlanPDF'] = $componentData->MgtPlanPDF;

 
        $projectActivity = array();
        $projectActivity['GUID'] = $ProjectActivityGUID;
        $projectActivity['ProjectGUID'] = $ProjectGUID;
        $projectActivity['Status'] = "Pending for Submission";
        $projectActivity['Details'] = "IEE Project Checklist Downloaded/Prepared";
        $projectActivity['RoutedFrom'] = $UserName;
        $projectActivity['RoutedFromOffice'] = $UserOffice;
        $projectActivity['RoutedTo'] = $UserName;
        $projectActivity['RoutedToOffice'] = $UserOffice;
        $projectActivity['Routing'] = 1;
        $projectActivity['Remarks'] = '';
        $projectActivity['UpdatedBy'] = $UserName;
        $projectActivity['CreatedBy'] = $UserName;
        
        $checkIfExistingProject = DB::table('project')->where('GUID', '=', $ProjectGUID)->first();

        if(empty($checkIfExistingProject)){
            if(DB::table('project')->insert($project)){
                if(DB::table('projectactivity')->insert($projectActivity)){
                    $this->saveGeoCoordinates($ProjectGUID);
                    
                }
                return "Submitted";
            }
        } else {
            DB::table('project')->where('GUID', $ProjectGUID)->update($project);

            DB::table('projectactivity')
            ->where('GUID','=', $ProjectActivityGUID)
            ->where('ProjectGUID', '=', $ProjectGUID)
            ->update([
                'UpdatedDate' => $now->format('Y-m-d H:i:s')
            ]);
            $deleteArea = DB::table('projectarea')->where('ProjectGUID', '=', $ProjectGUID)->get();

            foreach($deleteArea as $Area){
                DB::table('projectgeocoordinates')->where('AreaGUID', '=', $Area->GUID)->delete();
                DB::table('projectarea')->where('ProjectGUID', '=', $ProjectGUID)
                ->where('GUID', '=', $Area->GUID)->delete();
            }

            $this->saveGeoCoordinates($ProjectGUID);

            return "Submitted";
        }
    }

    public function saveGeoCoordinates($ProjectGUID)
    {   
        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $step_1 = Session::get('step_1');
        $step_2 = Session::get('step_2');
        $step_3 = Session::get('step_3');
        $step_4 = Session::get('step_4');
        $step_5 = Session::get('step_5');
        $ProjectActivityGUID = Session::get('ActivityGUID');
        $ProponentGUID = Session::get('data')['ProponentGUID'];

        $areaArray = array();
        $saveArea = array();
        $saveGeo = array();

        foreach($step_4 as $geo_steps){
            $data = [];
            $raw = [];
            $all_raw = [];

            $data['Area'] = $geo_steps[0];
            $data['AreaType'] = $geo_steps[1];
            $data['ProjectGUID'] = $ProjectGUID;

            $raw['Area'] = $geo_steps[0];
            $raw['AreaType'] = $geo_steps[1];
            $raw['ProjectGUID'] = $ProjectGUID;
            $raw['GUID'] = $geo_steps[8];


            $DMS_lat = $geo_steps[2];
            $DMS_deg_lat = explode("°",$DMS_lat);
            $DMS_min_lat = explode("'", $DMS_deg_lat[1]);
            $DMS_sec_lat = explode('"', $DMS_min_lat[1]);

            $DMS_long = $geo_steps[3];
            $DMS_deg_long = explode("°",$DMS_long);
            $DMS_min_long = explode("'", $DMS_deg_long[1]);
            $DMS_sec_long = explode('"', $DMS_min_long[1]);


            $all_raw['AreaGUID'] = $geo_steps[8];

            $all_raw['LatDeg'] = $DMS_deg_lat[0];
            $all_raw['LatMin'] = $DMS_min_lat[0];
            $all_raw['LatSec'] = $DMS_sec_lat[0];

            $all_raw['LongDeg'] = $DMS_deg_long[0];
            $all_raw['LongMin'] = $DMS_min_long[0];
            $all_raw['LongSec'] = $DMS_sec_long[0];

            $all_raw['Longitude'] = $geo_steps[5];
            $all_raw['Latitude'] = $geo_steps[4];

            $last = DB::table('projectgeocoordinates')
            ->select('id')
            ->orderByRaw('ID DESC')
            ->first();

            if($last == null){
                $sorter = 0 + 1;
            } else {
                $sorter = $last->id + 1;
            }


            $all_raw['Sorter'] = $sorter;


            if(in_array($data, $areaArray) == false){
                ///put into array for checking
                array_push($areaArray, $data);

                // insert into database project area
                DB::table('projectarea')->insert($raw);


                // array_push($saveArea, $raw);
            }

            // insert into database geocoordinates
            DB::table('projectgeocoordinates')->insert($all_raw);

            // array_push($saveGeo, $all_raw);
        }

        
    }

    public function saveProjectActivityAttachment($ProjectGUID)
    {
        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $ProjectActivityGUID = Session::get('ActivityGUID');

        $data = DB::table('projectactivityattachmenttemp')
            ->select('GUID','ActivityGUID','Description','FileName','Directory','FilePath','FileSizeInKB','CreatedBy','CreatedDate')
            ->where('ActivityGUID', '=', $ProjectActivityGUID)
            ->get();

        $array = $data->map(function($obj){
            return (array) $obj;
            })->toArray();

        if(DB::table('projectactivityattachment')->insert($array)){
            ProjectActivityAttachmentTemp::where('ActivityGUID', $ProjectActivityGUID)->delete();
            $this->ResetInputs();
        }
    }

    public function SubmitApplication(Request $req)
    {
        $UserName = Session::get('data')['UserName'];
        $step_5 = Session::get('step_5');
        $ProjectActivityGUID = Session::get('ActivityGUID');
        $ProjectGUID = $req['ProjectGUID'];
        $Remarks = $req['remarks'];

        $province = DB::table('province')
        ->where('Province', '=', $step_5['province'])
        ->first();

        $this->saveProjectActivityAttachment($ProjectGUID);

        $RouteTo = DB::table('aspnet_users')
        ->select('*')
        ->where('UserOffice', '=', $province->ProcessingOffice)
        ->where('UserRole', '=', 'Evaluator')
        ->where('InECCOAS', '=', 1)
        ->where('DefaultRecipient', '=', 1)
        ->orderByRaw('Screened Desc')
        ->first();
        
        $now = new \DateTime(); 

        DB::table('projectactivity')
        ->where('GUID','=', $ProjectActivityGUID)
        ->where('ProjectGUID', '=', $ProjectGUID)
        ->update([
            'Status' => 'For Screening',
            'Details' => "ECC Application Requirements Submitted for Screening",
            'Remarks' => $Remarks,
            'RoutedTo' => $RouteTo->UserName,
            'RoutedToOffice' => $province->ProcessingOffice,
            'UpdatedDate' => $now->format('Y-m-d H:i:s')
        ]);

        DB::table('project')
        ->where('GUID','=', $ProjectGUID)
        ->update([
            'Stage' => 1,
            'UpdatedBy' => $UserName,
            'UpdatedDate' => $now->format('Y-m-d H:i:s')
        ]);

        return $RouteTo->UserName;
    }


    public function ResetInputs()
    {
        Session::pull('step_1');
        Session::pull('step_2');
        Session::pull('step_3');
        Session::pull('step_4');
        Session::pull('step_4_status');
        Session::pull('step_5');
        Session::pull('step_5_status');
        Session::pull('ActivityGUID');
        Session::pull('NewActivityGUID');
    }

    public function ProjectInformation()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_pdf());
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream();
    }

    public function ProjectDescription($GUID)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_pdf_updated($GUID));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream();
    }

    public function convert_pdf_updated($GUID)
    {
        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];


        $data = DB::table('project')->where('project.GUID', $GUID)
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

            'project.LandlineNo',
            'project.FaxNo',
            'project.ProjectSize',
            'project.Description',
            'project.ComponentGUID',
            'project.ZoneClassification',


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
            'proponent.MailingAddress as ProponentAddress'
            
        )
        ->first();

        $output = '<style>
        body {
            font: 10pt/175% Arial, sans-serif; 
        }
        ul {
            list-style: none;
        }
        ul li:before {
            content: "- ";
            margin-left: -20px;
            margin-right: 10px;
        }

        p {
            letter-spacing: 1pt;
        }
        </style>';
        $output .= '<h3 align="center">PROJECT FACT SHEET</h3>
        <table width="100%" style="border-collapse: collapse;">
        <tr>
            <td style=" padding:8px; " width="40%"><b>Name of the Project</b></td>
            <td style=" padding:8px; " width="50%" colspan="2">'.$data->ProjectName.'</td>
        </tr>
        <tr>
            <td style=" padding:8px; " width="30%"><b>Proponent Name</b></td>
            <td style=" padding:8px; " width="70%" colspan="2">'.$data->ProponentName.'</td>
        </tr>
        <tr>
            <td style=" padding:8px; " width="30%"><b>Proponent Address</b></td>
            <td style=" padding:8px; " width="70%" colspan="2">'.$data->ProponentAddress.'</td>
        </tr>
        <tr>
            <td style=" padding:8px; " width="20%"><b>Authorized Representative</b></td>
            <td style=" padding:8px; " width="40%"><b>Name </b><br>'.$data->Representative.'</td>
            <td style=" padding:8px; " width="40%"><b>Designation </b><br>'.$data->Designation.'</td>
        </tr>
        <tr>
            <td style=" padding:8px; " width="20%"><b>Proponent Means of Contact</b></td>
            <td style=" padding:8px; " width="40%"><b>Landline No. </b><br>'.$data->LandlineNo.'</td>
            <td style=" padding:8px; " width="40%"><b>Fax No. </b><br>'.$data->FaxNo.'</td>
        </tr>
        </table>';

        $ComponentGUID = $data->ComponentGUID;
        $component = Component::where('GUID', $ComponentGUID)
        ->first();

        $output .= '<h3>Project Description</h3>
        <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <td style=" padding:8px; " width="30%"><b>Project Type</b></td>
            <td style=" padding:8px; " width="30%"><b>Project Size Parameter</b></td>
            <td style=" padding:8px; " width="30%"><b>Project Size</b></td>
        </tr>
        <tr>
            <td style=" padding:8px; ">'.$component->ProjectType.'; '.$component->ProjectSubType.'</td>
            <td style=" padding:8px; ">'.$component->Parameter.'</td>
            <td style=" padding:8px; ">'.$data->ProjectSize. ' '.$component->UnitOfMeasure .'</td>
        </tr>
        <tr>
            <td style=" padding:8px; " width="70%" colspan="3"><b>Other Description:</b><br>'.$data->Description.'</td>
        </tr>
        </table>';

        ///getting region from province

        $output .= '<h3>1.1. PROJECT LOCATION AND AREA:</h3>
        <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <td style=" padding:8px; ">Street/Sitio/Barangay:<br>'.$data->Address.'</td>
            <td style=" padding:8px; " colspan="2">Zone/Classification (i.e. industrial, residential):<br>'.$data->ZoneClassification.'</td>
        </tr>
        <tr>
            <td style=" padding:8px; ">Region:<br>'.$data->Region.'</td>
            <td style=" padding:8px; ">City/Municipality:<br>'.$data->Municipality.'</td>
            <td style=" padding:8px; ">Province:<br>'.$data->Province.'</td>
        </tr>
        <tr>
            <td style=" padding:8px; ">Total Project Land Area:<br>'.$data->LandAreaInSqM.' sq. m. </td>
            <td style=" padding:8px; " width="70%" colspan="2">Total Project/Building Footprint Area:<br>'.$data->FootPrintAreaInSqM.' sq. m. </td>
        </tr>
        </table>';

        
        $output .= '<h3>Geographic Coordinates of the Project Area (WGS84):</h3>
        <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <td style=" padding:8px; ">Area</td>
            <td style=" padding:8px; ">Longitude</td>
            <td style=" padding:8px; ">Latitude</td>
        </tr>';

        $geocoordinates = ProjectArea::where('ProjectGUID', $GUID)
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

        foreach ($geocoordinates as $value) {
            $output .= '<tr>
            <td style=" padding:8px; ">'.$value->Area.'</td>
            <td style=" padding:8px; ">'.$value->Longitude.'</td>
            <td style=" padding:8px; ">'.$value->Latitude.'</td>
            </tr>';
        }
                
        $output .= '</table>';


        return $output;
    }

    public function convert_pdf()
    {
        $UserName = Session::get('data')['UserName'];
        $UserOffice = Session::get('data')['UserOffice'];

        $step_1 = Session::get('step_1');
        $step_2 = Session::get('step_2');
        $step_3 = Session::get('step_3');
        $step_4 = Session::get('step_4');
        $step_5 = Session::get('step_5');
        $ProjectActivityGUID = Session::get('ActivityGUID');
        $ProponentGUID = Session::get('data')['ProponentGUID'];

        $output = '<style>
        body {
            font: 10pt/175% Arial, sans-serif; 
        }
        ul {
            list-style: none;
        }
        ul li:before {
            content: "- ";
            margin-left: -20px;
            margin-right: 10px;
        }

        p {
            letter-spacing: 1pt;
        }
        </style>';
        $output .= '<h3 align="center">PROJECT FACT SHEET</h3>
        <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <td style="border: 1px solid; padding:8px; " width="40%"><b>Name of the Project</b></td>
            <td style="border: 1px solid; padding:8px; " width="50%" colspan="2">'.$step_5['project_name'].'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:8px; " width="30%"><b>Proponent Name</b></td>
            <td style="border: 1px solid; padding:8px; " width="70%" colspan="2">'.$step_5['proponent_name'].'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:8px; " width="30%"><b>Proponent Address</b></td>
            <td style="border: 1px solid; padding:8px; " width="70%" colspan="2">'.$step_5['proponent_address'].'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:8px; " width="20%"><b>Authorized Representative</b></td>
            <td style="border: 1px solid; padding:8px; " width="40%"><b>Name </b><br>'.$step_5['represented_by'].'</td>
            <td style="border: 1px solid; padding:8px; " width="40%"><b>Designation </b><br>'.$step_5['designation'].'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:8px; " width="20%"><b>Proponent Means of Contact</b></td>
            <td style="border: 1px solid; padding:8px; " width="40%"><b>Landline No. </b><br>'.$step_5['landline_no'].'</td>
            <td style="border: 1px solid; padding:8px; " width="40%"><b>Fax No. </b><br>'.$step_5['fax_no'].'</td>
        </tr>
        </table>';
        $ComponentGUID = $step_2['ComponentGUID'];
        $component = Component::where('GUID', $ComponentGUID)
        ->first();

        $output .= '<h3>Project Description</h3>
        <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <td style="border: 1px solid; padding:8px; " width="30%"><b>Project Type</b></td>
            <td style="border: 1px solid; padding:8px; " width="30%"><b>Project Size Parameter</b></td>
            <td style="border: 1px solid; padding:8px; " width="30%"><b>Project Size</b></td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:8px; ">'.$component->ProjectType.'; '.$component->ProjectSubType.'</td>
            <td style="border: 1px solid; padding:8px; ">'.$component->Parameter.'</td>
            <td style="border: 1px solid; padding:8px; ">'.$step_2['input_size']. ' '.$component->UnitOfMeasure .'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:8px; " width="70%" colspan="3"><b>Other Description:</b><br>'.$step_3['description'].'</td>
        </tr>
        </table>';

        ///getting region from province
        $province = DB::table('province')
        ->where('Province', '=', $step_5['province'])
        ->first();

        $output .= '<h3>1.1. PROJECT LOCATION AND AREA:</h3>
        <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <td style="border: 1px solid; padding:8px; ">Street/Sitio/Barangay:<br>'.$step_5['project_location'].'</td>
            <td style="border: 1px solid; padding:8px; " colspan="2">Zone/Classification (i.e. industrial, residential):<br>'.$step_5['zone_classification'].'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:8px; ">Region:<br>'.$province->Region.'</td>
            <td style="border: 1px solid; padding:8px; ">City/Municipality:<br>'.$step_5['municipality'].'</td>
            <td style="border: 1px solid; padding:8px; ">Province:<br>'.$step_5['province'].'</td>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:8px; ">Total Project Land Area:<br>'.$step_5['project_landarea'].' sq. m. </td>
            <td style="border: 1px solid; padding:8px; " width="70%" colspan="2">Total Project/Building Footprint Area:<br>'.$step_5['project_footprintarea'].' sq. m. </td>
        </tr>
        </table>';

        

        $output .= '<h3>Geographic Coordinates of the Project Area (WGS84):</h3>
        <table width="100%" style="border-collapse: collapse; border: 1px;">
        <tr>
            <td style="border: 1px solid; padding:8px; ">Area</td>
            <td style="border: 1px solid; padding:8px; ">Longitude</td>
            <td style="border: 1px solid; padding:8px; ">Latitude</td>
        </tr>';

        foreach ($step_4 as $value) {
            $output .= '<tr>
            <td style="border: 1px solid; padding:8px; ">'.$value[0].'</td>
            <td style="border: 1px solid; padding:8px; ">'.$value[5].'</td>
            <td style="border: 1px solid; padding:8px; ">'.$value[4].'</td>
            </tr>';
        }
                
        $output .= '</table>';


        return $output;
    }

    public function SwornStatement()
    {
        $ProponentGUID = session::get('data')['ProponentGUID'];
        $proponent = Proponent::where('proponent.GUID', '=', $ProponentGUID)
        ->first();

        $pdf = PDF::loadView('pdf.sworn_statement', compact('proponent'));
        return $pdf->stream('try.pdf');
    }

    public function ProjectTypeTable(Request $req)
    {
        $search = $req['search'];
        
        $component = Component::where('component.ProjectType', 'LIKE', '%'. $search.'%')
            ->leftJoin('componentthreshold', 'component.GUID', '=', 'componentthreshold.ComponentGUID')
            ->select('component.*', 'componentthreshold.*')
            ->orderByRaw('componentthreshold.Ranking ASC')
            ->get();

        return DataTables::of($component)
        
        ->addColumn('Action', function($component){
            if($component->ReportType == 'IEE'){
                $title = 'Initial Environment Examination';
            }else if($component->ReportType == 'EIS'){
                $title = 'Environmental Impact Statement';
            }else{
                $title = 'Certificates of Non-Coverage';
            }

            if($component->ReportType == 'IEE'){
                $details = '<button title="'.$title.'" class="btn btn-default btn-block btn-sm" onclick="LinkProject('."'". $component->ComponentGUID."', "."'". $component->Category."', "."'". $component->ReportType."'".')">'.$component->ReportType.'</button>';
            }else{

                $details = '<button title="'.$title.'" class="btn btn-default btn-block btn-sm" onclick="LinkProject('."'". $component->ComponentGUID."', "."'". $component->Category."', "."'". $component->ReportType."'".')" disabled>'.$component->ReportType.'</button>';
            }
            
            return $details;

        })
        ->addColumn('SpecificType', function($component){

            if($component->ProjectSpecificSubType == 'NULL'){
                $subtype = '';
            } else {
                $subtype = $component->ProjectSpecificSubType;
            }

            if($component->ProjectSpecificType == 'NULL'){
                $specifictype = '';
            } else {
                $specifictype = $component->ProjectSpecificType;
            }

            $details =  $specifictype . '<br>'. $subtype;
            
            return $details;

        })
        
        ->rawColumns(['Action', 'SpecificType'])
        ->make(true);

        // This type of project and its size falls under the Environmentally Critical Projects (ECPs). The ECC Online Application System covers only the Non-Environmentally Critical Projects (NECPs). For ECP Project, please coordinate with EMB Central Office - Environmnetal Impact Assessment and Management Division.
    }

    public function LinkProjectType(Request $req)
    {
        $ComponentGUID = $req['ComponentGUID'];
        $input_size = $req['input_size'];
        $second = $req['second'];

        $components = DB::table('_componenttemplate')
        ->where('GUID', $ComponentGUID)
        ->first();

        $all = ['input_size'=> $input_size, 'ComponentGUID'=>$ComponentGUID, 'second'=> 1, 'Template'=>$components->Template, 'ComponentPDF'=>$components->ComponentPDF, 'MgtPlanPDF'=>$components->MgtPlanPDF, 'AbandonementPDF'=>$components->AbandonementPDF];

        $req->session()->put('step_2', $all);

        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        return $GUID;

        // Session::pull('input');
    }

    public function searchProjectType()
    {
        return view('secured.create_applications.project_type_search');
    }

    public function addBindData(Request $req)
    {
        $EmbID = $req['EmbID'];
        $ProponentGUID = $req['ProponentGUID'];
        $CompanyName = $req['CompanyName'];
        $ProponentName = $req['ProponentName'];
        $UserId = Session::get('data')['UserId'];

        $UserData = DB::table('binded_data')
        ->where('UserId', $UserId)
        ->where('EmbID',$EmbID)
        ->first();

        if(!$UserData){
            $row = ['ProponentGUID' => $ProponentGUID, 'EmbID' => $EmbID, 'CompanyName' => $CompanyName, 'UserId' => $UserId, 'ProponentName' => $ProponentName];

            if(DB::table('binded_data')->insert($row)){

                 DB::table('aspnet_users')
                    ->where('UserId', $UserId)
                    ->update([
                        'ProponentGUID' => $ProponentGUID
                    ]);


                return 'Bind company successfully!';
            } else {
                return 'Error while saving into your database';
            }
        } elseif($UserData->ProponentGUID == ''){
            DB::table('binded_data')
            ->where('UserId', '=', $UserId)
            ->update([
                'ProponentGUID' => $ProponentGUID,
                'ProponentName' => $ProponentName
            ]);

            DB::table('aspnet_users')
            ->where('UserId', $UserId)
            ->update([
                'ProponentGUID' => $ProponentGUID
            ]);

            return 'Bind company successfully!';

        }else {
            return "There's binded data: unbind data first";
        }
    }

    public function unBindData(Request $req)
    {
        $EmbID = $req['EmbID'];
        $ProponentGUID = $req['ProponentGUID'];
        $CompanyName = $req['CompanyName'];
        $UserId = Session::get('data')['UserId'];


        DB::table('binded_data')
        ->where('UserId', '=', $UserId)
        ->where('EmbID', '=', $EmbID)
        ->update([
            'ProponentGUID' => '',
            'ProponentName' => '',
        ]);

        DB::table('aspnet_users')
        ->where('UserId', '=', $UserId)
        ->update([
            'ProponentGUID' => 1
        ]);

        return 'Unbind company successfully!';
    }

    public function searchCompany(Request $req)
    {
        $search = $req['search'];
        
        $Proponent = Proponent::where('ProponentName', 'LIKE', '%' . $search .'%');

        return DataTables::of($Proponent)
        ->addColumn('ProponentName', function($Proponent){
            $details = '<small>'. $Proponent->ProponentName . '</small>';
            
            return $details;

        })
        
        ->addColumn('Action', function($Proponent){
            $details = '<button class="btn btn-default" onclick="ComparisonData(' . "'" . $Proponent->ProponentName . "'". ')"><span class="glyphicon glyphicon-eye-open"></span></button>';
            
            return $details;

        })
        ->rawColumns(['Action', 'ProponentName'])
        ->make(true);
    }

    public function getBindedData(Request $req)
    {
        $ID = $req['emb_id'];
        $Name = $req['company_name'];
        $UserId = Session::get('data')['UserId'];

        $BindedData = BindedData::where('EmbID', '=', $ID)
        ->where('CompanyName', '=', $Name)
        ->where('UserId', '=', $UserId)
        ->first();

        return $BindedData;
    }

    public function addCompanyDetailsECC(Request $req)
    {
        $EmbID = $req['emb_id'];
        $CompanyName = $req['company_name'];
        $ProponentName = $req['company_name'];
        $EstablishmentName = $req['establishment_name'];

        $ContactNo = $req['contact_no'];
        $MobileNo = $req['mobile_no'];

        $Email = $req['email'];
        $ContactPerson = $req['contact_person'];
        $Address = $req['address'];

        $UserId = Session::get('data')['UserId'];

        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        $SECRegistrationNo = $req['sec_registration_no'];
        $DTIRegistrationNo = $req['dti_registration_no'];


        $ProponentGUID = $GUID;

        DB::table('proponent')->insert([
            'GUID' => $ProponentGUID, 
            'ProponentName' => $CompanyName, 
            'MailingAddress' => $Address, 
            'ContactPerson' => $ContactPerson, 
            'Designation' => 'CEO/President/Owner',
            'ContactPersonNo' => $ContactNo, 
            'MobileNo' => $MobileNo, 
            'ContactPersonEmailAddress' => $Email, 
            'LineOfBusiness' => '', 
            'SECRegistrationNo' => $SECRegistrationNo, 
            'DTIRegistrationNo' => $DTIRegistrationNo, 
            'UpdatedBy' => Session::get('data')['UserName'], 
            'UpdatedDate' => date('Y-m-d H:i:s'),
            'CreatedBy' => Session::get('data')['UserName'], 
            'CreatedDate' => date('Y-m-d H:i:s'), 
        ] );

        $UserData = DB::table('binded_data')->where('UserId', '=', $UserId)->first();

        if(!$UserData){
            $row = ['ProponentGUID' => $ProponentGUID, 'EmbID' => $EmbID, 'CompanyName' => $CompanyName, 'UserId' => $UserId, 'ProponentName' => $ProponentName];

            if(DB::table('binded_data')->insert($row)){

                 DB::table('aspnet_users')
                    ->where('UserId', '=', $UserId)
                    ->update([
                        'ProponentGUID' => $ProponentGUID
                    ]);


                return 'Successfully binded!';
            } else {
                return 'Error while saving into your database';
            }
        } elseif($UserData->ProponentGUID == ''){
            DB::table('binded_data')
            ->where('UserId', '=', $UserId)
            ->update([
                'ProponentGUID' => $ProponentGUID,
                'ProponentName' => $ProponentName
            ]);

            DB::table('aspnet_users')
            ->where('UserId', '=', $UserId)
            ->update([
                'ProponentGUID' => $ProponentGUID
            ]);

            return 'Successfully binded!';

        }else {
            return "There's binded data: unbind data first";
        }

        
    }

}
