<?php

namespace App\Http\Controllers\Secured;


use App\Models\Component;
use App\Models\Project;
use App\Models\Proponent;
use App\Models\Region;
use App\Models\Office;
use App\Models\ProjectActivity;
use App\Models\ActionRequiredPerson;
use App\Models\ProjectActivityAttachment;
use App\Models\ProjectActivityAttachmentTemp;
use App\Models\ECCDraft;
use App\Models\ECCDraftPerProject;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\AspnetUserController;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use App\Http\Controllers\View;

use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AspnetUser;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

// use PhpOffice\PhpWord\TemplateProcessor;
use \PhpOffice\PhpWord\TemplateProcessor,
\PhpOffice\PhpWord\Shared\Html,
\PhpOffice\PhpWord\PhpWord;

use File;
use PDF;
use \ConvertApi\ConvertApi;

class AdministrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageCredentials()
    {
        if(Session::get('data')['UserRole'] === 'Sysad'){
            return view('secured.admin.admin');
        } else {
            return redirect('default');
        }
    }

    public function manageSignatories()
    {
        if(Session::get('data')['UserRole'] === 'Sysad'){
            return view('secured.admin.signatories');
        } else {
            return redirect('default');
        }
    }

    public function getRegisteredUsersCopy(Request $req)
    {   
        $OfficeSelect = $req['OfficeSelect'];

        if($OfficeSelect != ''){
            $user = AspnetUser::on('mysql')->where('aspnet_users.UserOffice', '=', $OfficeSelect)
            ->Join('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->orderByRaw('UserName ASC')
            ->get();
        } else {
            $user = AspnetUser::on('mysql')->where('aspnet_users.UserOffice', '=', 'NULL')
            ->Join('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->orderByRaw('UserName ASC')
            ->get();
        }
        

        return DataTables::of($user)
        ->addColumn('Status', function($user){
            
            $details = '<center><img src="../img/ActiveUser.jpg" style="width:35px; padding-top: 6px" class="pointer" onclick=\'StatusModal("'.Str::lower($user->UserName).'")\' />';
            return $details;
        })
        ->addColumn('UserName', function($user){

            $details = '<a>' . $user->UserName . '</a>';
            
            return $details;
        })
        ->addColumn('Role', function($user){

            $details = $user->UserRole;
            
            return $details;
        })
        ->addColumn('Email', function($user){

            $details = $user->Email . '<br>' .$user->AlternateEmail;
            
            return $details;
        })

        ->addColumn('BirthDate', function($user){

            $date = date("F j, Y", strtotime($user->BirthDate));

            $details = $date . '<br>' . $user->MobileAlias;
            return $details;
        })
        ->addColumn('LastActivityDate', function($user){

            $date = date("F j, Y g:i a", strtotime($user->LastActivityDate));
            return $date;
        })
        ->addColumn('InECCOAS', function($user){
            if($user->InECCOAS == 1){
                
                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )" checked></label></center>';


            } else {

                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )"></label></center>';
            }

            return $details;
        })
        ->addColumn('DefaultRecipient', function($user){

            if($user->DefaultRecipient == 1){
                
                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )" checked></label></center>';


            } else {

                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )"></label></center>';
            }
            
            return $details;
        })
        ->addColumn('InCNCOAS', function($user){
            if($user->InCNCOAS == 1){
                
                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )" checked></label></center>';


            } else {

                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )"></label></center>';
            }
            
            return $details;
        })
        ->addColumn('DefaultRecipientCNC', function($user){
            if($user->DefaultRecipientCNC == 1){
                
                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )" checked></label></center>';


            } else {

                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )"></label></center>';
            }
            
            return $details;
        })

        ->addColumn('InCMROS', function($user){
            if($user->InCMROS == 1){
                
                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )" checked></label></center>';


            } else {

                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )"></label></center>';
            }
            
            return $details;
        })
        ->addColumn('DefaultRecipientCMR', function($user){
            if($user->DefaultRecipientCMR == 1){
                
                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )" checked></label></center>';


            } else {

                $details = '<center><label><input name="InECCOAS_'.$user->UserId.'" style="width: 30px; height: 30px" type="checkbox" class="flat-red" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )"></label></center>';
            }
            
            return $details;
        })
        
        ->rawColumns(['Status', 'UserName', 'Role', 'Email', 'BirthDate', 'LastActivityDate', 'InECCOAS', 'DefaultRecipient', 'InCNCOAS', 'DefaultRecipientCNC', 'InCMROS','DefaultRecipientCMR'])
        ->make(true);
    }

    public function getRegisteredUsers(Request $req)
    {   
        $OfficeSelect = $req['OfficeSelect'];

        if($OfficeSelect != ''){
            $user = AspnetUser::on('mysql')->where('aspnet_users.UserOffice', '=', $OfficeSelect)
            ->Join('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->get();
        } else {
            $user = AspnetUser::on('mysql')->where('aspnet_users.UserOffice', '=', 'NULL')
            ->Join('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->get();
        }
        
        return DataTables::of($user)
        ->addColumn('Status', function($user){
            
            $details = '<center><img src="../img/ActiveUser.jpg" style="width:35px; padding-top: 6px; cursor: pointer" class="pointer" onclick=\'StatusModal("'.Str::lower($user->UserName).'")\' />';
            return $details;
        })
        ->addColumn('UserName', function($user){

            $details = '<a href="getUserApplications?Username='.$user->UserName.'" target="_blank">' . $user->UserName . '</a>';
            
            return $details;
        })
        ->addColumn('Role', function($user){

            $details = $user->UserRole;
            
            return $details;
        })
        ->addColumn('Email', function($user){

            $details = $user->Email . '<br>' .$user->AlternateEmail;
            
            return $details;
        })
        ->addColumn('BirthDate', function($user){

            $date = date("F j, Y", strtotime($user->BirthDate));

            $details = $date . '<br>' . $user->MobileAlias;
            return $details;
        })
        ->addColumn('LastActivityDate', function($user){

            $date = date("F j, Y g:i a", strtotime($user->LastActivityDate));
            return $date;
        })
        ->addColumn('InECCOAS', function($user){
            if($user->InECCOAS == 1){
                $details = '<input type="checkbox" class="switch" id="InECCOAS" checked data-bootstrap-switch >';
            } else {
                $details = '<input type="checkbox" class="switch" id="InECCOAS" data-bootstrap-switch>';
            }
            return $details;
        })
        ->addColumn('DefaultRecipient', function($user){

            if($user->DefaultRecipient == 1){
                $details = '<input type="checkbox" name="my-checkbox" checked data-bootstrap-switch />';
            } else {
                $details = '<input type="checkbox" name="my-checkbox" data-bootstrap-switch />';
            }
            return $details;
        })
        ->addColumn('InCNCOAS', function($user){
            if($user->InCNCOAS == 1){
                $details = '<input type="checkbox" name="my-checkbox" checked data-bootstrap-switch />';
            } else {
                $details = '<input type="checkbox" name="my-checkbox" data-bootstrap-switch />';
            }
            return $details;
        })
        ->addColumn('DefaultRecipientCNC', function($user){
            if($user->DefaultRecipientCNC == 1){
                $details = '<input type="checkbox" name="my-checkbox" checked data-bootstrap-switch />';
            } else {
                $details = '<input type="checkbox" name="my-checkbox" data-bootstrap-switch />';
            }
            return $details;
        })

        ->addColumn('InCMROS', function($user){
            if($user->InCMROS == 1){
                $details = '<input type="checkbox" name="my-checkbox" checked data-bootstrap-switch />';
            } else {
                $details = '<input type="checkbox" name="my-checkbox" data-bootstrap-switch />';
            }
            return $details;
        })
        ->addColumn('DefaultRecipientCMR', function($user){
            if($user->DefaultRecipientCMR == 1){
                $details = '<input type="checkbox" name="my-checkbox" checked data-bootstrap-switch />';
            } else {
                $details = '<input type="checkbox" name="my-checkbox" data-bootstrap-switch />';
            }
            return $details;
        })
        
        ->rawColumns(['Status', 'UserName', 'Role', 'Email', 'BirthDate', 'LastActivityDate', 'InECCOAS', 'DefaultRecipient', 'InCNCOAS', 'DefaultRecipientCNC', 'InCMROS','DefaultRecipientCMR'])
        ->make(true);
    }

    public function getSignatories()
    {   
        $Region = Region::all();

        return DataTables::of($Region)
        ->addColumn('Address', function($Region){

            $details = $Region->Address;
            
            return $details;
        })
        ->addColumn('EIAChief', function($Region){

            $EIAChiefSignature = $Region->EIAChiefSignature;
            $Signature = explode("/",$EIAChiefSignature);
            $sign = '../../signatures/' . $Signature[3];

            $details = '<a href="'.$sign.'" target="_blank">' . $Region->EIAChief . '</a>';
            
            return $details;
        })
        ->addColumn('Director', function($Region){

            $DirectorSignature = $Region->DirectorSignature;
            $Signature = explode("/",$DirectorSignature);
            $sign = '../../signatures/' . $Signature[3];

            $details = '<a href="'.$sign.'" target="_blank">' . $Region->Director . '</a>';
            
            return $details;
        })
        ->addColumn('Action', function($Region){

            $details = '<button type="button" class="btn btn-block btn-outline-secondary btn-lg"  onclick="regionalInfo('."'".$Region->RegionGUID."'".')"><img id="" src="../img/select1.png" style="width:20px;"></button>';
            
            return $details;
        })
        
        ->rawColumns(['Address', 'EIAChief', 'Director', 'Action'])
        ->make(true);
    }

    public function getOffice()
    {   
        $Office = Office::all();

        return $Office;
    }

    public function getUserAction(Request $req)
    {   
        $UserName = $req['UserName'];
        $ActionRequiredPerson = ActionRequiredPerson::where('actionrequiredperson.UserName', 'LIKE', '%'.$UserName.'%')
        ->get();

        return DataTables::of($ActionRequiredPerson)
        ->addColumn('Action', function($ActionRequiredPerson){
            
            $details = $ActionRequiredPerson->Action;
            return $details;
        })
        ->addColumn('Active', function($ActionRequiredPerson){

            if($ActionRequiredPerson->Active == 1){
                $details = '<label class="switch">
                <input class="switch-input" type="checkbox" name="InECCOAS_'.$ActionRequiredPerson->ID.'" onclick="checkbox(0,\'InECCOAS_'.$ActionRequiredPerson->ID.'\' )" checked/>
                <span class="switch-label" data-on="On" data-off="Off"></span> 
                <span class="switch-handle"></span> 
                </label>';
            } else {
                $details = '<label class="switch">
                <input class="switch-input" type="checkbox" name="InECCOAS_'.$ActionRequiredPerson->ID.'" onclick="checkbox(0,\'InECCOAS_'.$ActionRequiredPerson->ID.'\' )" />
                <span class="switch-label" data-on="On" data-off="Off"></span> 
                <span class="switch-handle"></span> 
                </label>';
            }
            
            return $details;
        })
        ->addColumn('ECC', function($ActionRequiredPerson){
            if($ActionRequiredPerson->InECCOAS == 1){
                $details = '<label class="switch">
                <input class="switch-input" type="checkbox" name="InECCOAS_'.$ActionRequiredPerson->ID.'" onclick="checkbox(0,\'InECCOAS_'.$user->UserId.'\' )" checked/>
                <span class="switch-label" data-on="On" data-off="Off"></span> 
                <span class="switch-handle"></span> 
                </label>';
            } else {
                $details = '<label class="switch">
                <input class="switch-input" type="checkbox" name="InECCOAS_'.$ActionRequiredPerson->ID.'" onclick="checkbox(0,\'InECCOAS_'.$ActionRequiredPerson->ID.'\' )" />
                <span class="switch-label" data-on="On" data-off="Off"></span> 
                <span class="switch-handle"></span> 
                </label>';
            }

            return $details;
        })
        ->addColumn('CNC', function($ActionRequiredPerson){
            if($ActionRequiredPerson->InCNCOAS == 1){
                $details = '<label class="switch">
                <input class="switch-input" type="checkbox" id="InECCOAS" checked/>
                <span class="switch-label" data-on="On" data-off="Off"></span> 
                <span class="switch-handle"></span> 
                </label>';
            } else {
                $details = '<label class="switch">
                <input class="switch-input" type="checkbox" />
                <span class="switch-label" data-on="On" data-off="Off"></span> 
                <span class="switch-handle"></span> 
                </label>';
            }
            
            return $details;
        })

        ->addColumn('CMR', function($ActionRequiredPerson){
            if($ActionRequiredPerson->InCMROS == 1){
                $details = '<label class="switch">
                <input class="switch-input" type="checkbox" id="InECCOAS" checked/>
                <span class="switch-label" data-on="On" data-off="Off"></span> 
                <span class="switch-handle"></span> 
                </label>';
            } else {
                $details = '<label class="switch">
                <input class="switch-input" type="checkbox" />
                <span class="switch-label" data-on="On" data-off="Off"></span> 
                <span class="switch-handle"></span> 
                </label>';
            }
            
            return $details;
        })
        
        ->rawColumns(['Action', 'Active', 'ECC', 'CMR', 'CNC', 'LastActivityDate', 'InECCOAS', 'DefaultRecipient', 'InCNCOAS', 'DefaultRecipientCNC', 'InCMROS','DefaultRecipientCMR'])
        ->make(true);

        return $ActionRequiredPerson;

    }

    public function getRegionalInformation(Request $req)
    {   
        $GUID = $req['GUID'];
        $Region = Region::where('region.RegionGUID', '=', $GUID)->first();

        return $Region;
    }

    public function getUserApplications(Request $req)
    {
        return view('secured.admin.user_application', compact('req'));
    }

    public function getUserApplicationsTable(Request $req)
    {
        $UserName = $req['UserName'];

        $Project = ProjectActivity::where('projectactivity.RoutedTo', '=', $UserName)
        ->leftJoin('project', 'project.GUID', '=', 'projectactivity.ProjectGUID')
        ->groupBy('project.GUID')
        ->select(
            'project.GUID AS ProjectGUID',
            'project.ProjectName',
            'project.ReferenceNo',
            'project.Address',
            'project.Municipality',
            'project.Province',
            'project.Region',
            'project.CreatedBy',
            
        )
        ->orderBy('project.CreatedDate','desc')
        ->get();


        return DataTables::of($Project)
        ->addColumn('Details', function($Project){
            
            $details = '<i><a href="ECC?GUID='.$Project->ProjectGUID.'" target="_blank">'.$Project->ProjectName . ' - ' . $Project->Address . ' ' . $Project->Municipality . ', ' . $Project->Province . ', ' . $Project->Region.'</a></i>';
            return $details;
        })
        ->addColumn('Representative', function($Project){

            $details = '<small>'.Str::upper($Project->CreatedBy).'</small>';
            return $details;
        })
        ->addColumn('ECCNumber', function($Project){

            $details = '<small>'.$Project->ReferenceNo.'</small>';
            return $details;
        })
        
        ->rawColumns(['Details', 'ECCNumber', 'Representative'])
        ->make(true);

        return $Project;
    }

    public function getECCData(Request $req)
    {
        $Project = Project::where('project.GUID', $req->GUID)
        ->leftJoin('proponent', 'project.ProponentGUID', '=', 'proponent.GUID')
        ->select([
            'project.GUID as ProjectGUID',
            'project.ProjectName',
            'project.Address',
            'project.Municipality',
            'project.Province',
            'project.Region',
            'project.Representative',
            'project.Designation',
            'project.Purpose',
            'project.BankBranch',
            'project.BankTransaction',
            'project.ProcessingFee',
            'project.AmountPaid',
            'project.ProcessingFee',
            'project.AcceptedDate',
            'project.AcceptedBy',
            'project.TotProcDays',
            'project.ProcTimeFrameInDays',
            'project.ComponentGUID',
            'project.CreatedBy',

            'proponent.ProponentName',
            'proponent.MailingAddress',
            'proponent.ContactPerson',
            // 'proponent.Designation',
            'proponent.ContactPersonNo',
            'proponent.MobileNo',
            'proponent.ContactPersonEmailAddress',
            'proponent.LineOfBusiness',
            'proponent.SECRegistrationNo',
            'proponent.DTIRegistrationNo'
        ])
        ->first();

        return view('secured.admin.ecc', compact('Project'));
    }

    public function getProjectTypeAdmin(Request $req)
    {
        $ComponentGUID = $req['ComponentGUID'];

        $component = Component::leftJoin('componentthreshold', 'component.GUID', '=', 'componentthreshold.ComponentGUID')
        ->where('component.GUID', $ComponentGUID)
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
            'componentthreshold.ReferenceID',
        )
        ->orderByRaw('componentthreshold.ID')
        ->get();

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
        
        ->rawColumns(['Category', 'SpecificType'])
        ->make(true);

    }

    public function getUserAccountsAdmin(Request $req)
    {
        $Representative = $req['Representative'];

        $User = AspnetUser::where('UserName',$Representative)->get();

        return DataTables::of($User)
        ->addColumn('UserName', function($User){
            $details = $User->UserName;
            return $details;
        })
        ->addColumn('Designation', function($User){
            $details = $User->Designation;
            
            return $details;
        })
        ->addColumn('Email', function($User){
            $details = $User->AlternateEmail;
            
            return $details;
        })
        ->addColumn('BirthDate', function($User){
            $details = date("F j, Y", strtotime($User->BirthDate));
            
            return $details;
        })
        ->addColumn('MobileNo', function($User){
            $details = $User->MobileAlias;
            return $details;
        })
        ->addColumn('GovernmentID', function($User){
            $details = 'Download';
            
            return $details;
        })
        ->addColumn('SecDTIRegistration', function($User){
            $details = 'Download';
            
            return $details;
        })
        ->addColumn('AuthorizationLetter', function($User){
            $details = 'Download';
            
            return $details;
        })
        
        ->rawColumns(['UserName', 'Designation', 'Email', 'BirthDate', 'MobileNo', 'GovernmentID', 'SecDTIRegistration', 'AuthorizationLetter'])
        ->make(true);
    }

    public function getAttachmentsAdmin(Request $req)
    {
        $ProjectGUID = $req['ProjectGUID'];

        $attachments = ProjectActivity::where('projectactivity.ProjectGUID', '=', $ProjectGUID)
        ->Join('projectactivityattachment', function($join)
        {
            $join->on('projectactivityattachment.ActivityGUID', '=', 'projectactivity.GUID');
        })
        ->select(
            'projectactivity.GUID',
            'projectactivityattachment.ID',
            'projectactivityattachment.ActivityGUID',
            'projectactivityattachment.FileName',
            'projectactivityattachment.FilePath',
            'projectactivityattachment.Directory',
            'projectactivityattachment.CreatedDate',
            'projectactivityattachment.CreatedBy',
            'projectactivityattachment.Description',
        )
        ->orderByRaw('projectactivityattachment.CreatedDate ASC')
        ->get();
        
        return DataTables::of($attachments)
        ->addColumn('Description', function($attachments){
            $details = '<div id="">
            <a title="Click here to view the uploaded file" target="_blank" style="text-decoration:none;" 
            href="'.url($attachments->FilePath).'">'.$attachments->Description.'</a>
            </div>';

            return $details;
        })
        ->addColumn('Timestamp', function($attachments){
            $date = date("m/d/Y", strtotime($attachments->CreatedDate));

            return $date;
        })
        ->addColumn('Upload', function($attachments){
            $details = '<form id="multi-file-upload-ajax" enctype="multipart/form-data">';
            $details .= '<div class="form-group row">
            <div class="col-sm-6"><input id="files_'.$attachments->ID.'" type="file" name="files" /></div>
            <div class="col-sm-6">
            <button type="button" class="btn btn-primary btn-sm" name="submit" onclick="uploadFile(\''. $attachments->Description.'\', \''. $attachments->ID.'\', \''. $attachments->ActivityGUID.'\')" ><i class="fa fa-upload"></i> Upload</button>
            </div>
            </div>
            </form>';

            return $details;
        })
        ->rawColumns(['Description', 'Timestamp', 'Upload'])
        ->make(true);

    }

    public function getRoutingHistoryAdmin(Request $req)
    {
        $GUID = $req['ProjectGUID']; 
        
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
            'projectactivity.RoutedFromOffice',
            'projectactivity.UpdatedDate', 
            'projectactivity.GUID AS ActivityGUID', 
            'projectactivity.CreatedBy AS CreatedBy' 
        )
        ->orderByRaw('projectactivity.UpdatedDate DESC')
        ->get();

        return DataTables::of($project)
        ->addColumn('Timestamp', function($project){
            $date = date("m/d/Y h:i A", strtotime($project->UpdatedDate));

            return $date;
        })
        ->addColumn('RoutedFrom', function($project){
            $detail = $project->RoutedFrom;

            return $detail;
        })
        ->addColumn('FromOffice', function($project){
            $detail = $project->RoutedFromOffice;

            return $detail;
        })
        ->addColumn('RoutedTo', function($project){
            $detail = $project->RoutedTo;

            return $detail;
        })
        ->addColumn('ToOffice', function($project){
            $detail = $project->RoutedToOffice;

            return $detail;
        })
        ->rawColumns(['Timestamp', 'RoutedFrom',  'FromOffice',  'RoutedTo',  'ToOffice'])
        ->make(true);
    }

    public function getRequirementsAdmin(Request $req)
    {   
        $ProjectGUID = $req['ProjectGUID'];
        $project = DB::table('projectrequirement')->orderByRaw('ID ASC')
        ->where('ProjectGUID', '=', $ProjectGUID)
        ->get();

        return DataTables::of($project)
        ->addColumn('Compliant', function($project){
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

            // if($project->Compliant == 1){
            //     $details = 'Complied';
            // }else{
            //     $details = 'Not Complied';  
            // }
            
            return $details;
        })
        ->addColumn('Description', function($project){

            if( $project->Required == 1){ 
                $Required = " (Required) " ;
            } else { $Required = " (Not Required) "; } 

            if($project->Description == 'Bank Receipt (Application Fee)'){
                $description = $project->Description .' </a><span style="background-color:yellow;">&nbsp;-Please dont forget to require (tick) this item prior to reverting to the proponent.</span>';
            } else {
                $description = $project->Description.' </a>';
            }

            $details = '<a id="pointer" onclick="modalEvaluation('."'". $project->ProjectGUID."', ". 
            "'". $project->ID."', "."'". $project->Description ."'".')">' . $description ;
            
            return $details;
        })
        ->addColumn('Required', function($project){

            if($project->Required == 1){
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

            // if( $project->Required == 1){ 
            //     $Required = "Required" ;
            // } else { 
            //     $Required = "Not Required"; 
            // } 

            // $details = $Required ;
            
            return $details;
        })
        ->rawColumns(['Compliant', 'Description', 'Required'])
        ->make(true);
    }

    public function getProcessingTimeAdmin(Request $req)
    {   
        $ProjectGUID = $req['ProjectGUID'];

        $project = ProjectActivity::where('ProjectGUID', '=', $ProjectGUID)
        ->orderByRaw("CreatedDate DESC")
        ->get();

        return DataTables::of($project)
        ->addColumn('RoutedFrom', function($project){
            $details = $project->RoutedFrom;
            
            return $details;
        })
        ->addColumn('RoutedTo', function($project){
            $details = $project->RoutedTo;
            
            return $details;
        })
        ->addColumn('AccumulatedDays', function($project){
            $details = $project->TotAccumulatedDays . ' days';
            
            return $details;
        })
        ->addColumn('Status', function($project){
            $details = $project->Status;
            
            return $details;
        })
        ->addColumn('Timestamp', function($project){
            $details = date("M d, Y", strtotime($project->CreatedDate));
            
            return $details;
        })

        ->rawColumns(['RoutedFrom', 'AccumulatedDays', 'RoutedTo', 'Status', 'Timestamp'])
        ->make(true);
    }

    public function adminUploadFile(Request $request)
    {
        $now = new \DateTime(); 
        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        $UserName = Session::get('data')['UserName'];
        $ActivityGUID = $request['ActivityGUID'];

        $description = $request['description'];
        $id = $request['id']; 
        $ProjectGUID = $request['ProjectGUID'];

        $dataRow = array();
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

        $dataRow['GUID'] = $GUID;
        $dataRow['ActivityGUID'] = $ActivityGUID;
        $dataRow['Description'] = $description;
        $dataRow['Directory'] = public_path();
        $dataRow['FileName'] = $filename;
        $dataRow['FilePath'] = $filepath;
             // $data['extension'] = $extension;
        $dataRow['FileSizeInKB'] = $filesize;
        $dataRow['CreatedBy'] = $UserName;
        $dataRow['CreatedDate'] = $now->format('Y-m-d H:i:s');


        DB::table('projectactivityattachment')
        ->where('ID','=', $id)
        ->where('ActivityGUID','=', $ActivityGUID)
        ->where('Description','=', $description)
        ->update($dataRow);
    }else{
             // Response
       $rtrn['success'] = 2;
       $rtrn['message'] = 'File not uploaded.'; 
   }
}
return response()->json($rtrn);
}


Public function ECCDraftDataAdmin(Request $req)
{
    $Template = $req['Template'];
    $ApplicationType  = $req['ApplicationType'];

    $draft = ECCDraft::where('ecc_draft.Template', $Template)
    ->where('ecc_draft.Type', $ApplicationType)
    ->leftJoin('environmental_management', function ($join) {
        $join->on('ecc_draft.Template', 'environmental_management.Template');

        $join->on('ecc_draft.Type', 'environmental_management.Type');
    })
    ->first();


    return $draft;
}

public function ECCDraftCertficateAdmin(Request $req)
{
    $Template = $req['Template'];
    $ApplicationType = $req['ApplicationType'];

    $draft = ECCDraft::where('ecc_draft.Template', $Template)
    ->where('ecc_draft.Type', $ApplicationType)
    ->leftJoin('environmental_management', function ($join) {
        $join->on('ecc_draft.Template', 'environmental_management.Template');

        $join->on('ecc_draft.Type', 'environmental_management.Type');
    })
    ->first();
    
    return view('secured.admin.ecc_preview', compact('draft', 'Template', 'ApplicationType'));
}

public function PageSaveAdmin(Request $req)
{
    
    $Template = $req['Template'];
    $ApplicationType = $req['ApplicationType'];
    $Page = $req['Page'];

    if($Page == 1){

        $Content = $req['content'];

        $ECC = DB::table('ecc_draft')->where('Template','=', $Template)
        ->where('Type','=', $ApplicationType)->first();

        if(!$ECC){
            DB::table('ecc_draft')->insert([
                'Template' => $Template,
                'Type' => $ApplicationType,
                'Body' => $Content,
            ]);
        } else {
            DB::table('ecc_draft')
            ->where('Template','=', $Template)
            ->where('Type','=', $ApplicationType)
            ->update([
                'Body' => $Content,
            ]);
        }

        
    } else if($Page == 2){

        $ThisIsToCertify = $req['ThisIsToCertify'];
        $ProjectDescription = $req['ProjectDescription'];
        $ThisCertificateIsIssued = $req['ThisCertificateIsIssued'];

        DB::table('ecc_draft')
        ->where('Template','=', $Template)
        ->where('Type','=', $ApplicationType)
        ->update([
            'ThisIsToCertify' => $ThisIsToCertify,
            'ProjectDescription' => $ProjectDescription,
            'ThisCertificateIsIssued' => $ThisCertificateIsIssued,
        ]);

    } else if($Page == 3) {
        $SwornAccountabilityStatement = $req['SwornAccountabilityStatement'];

        DB::table('ecc_draft')
        ->where('Template','=', $Template)
        ->where('Type','=', $ApplicationType)
        ->update([
            'SwornAccountabilityStatement' => $SwornAccountabilityStatement,
        ]);
    } else if($Page == 4) {
        $ConstructionPhase = $req['ConstructionPhase'];
        $OperationPhase = $req['OperationPhase'];

        $EM = DB::table('environmental_management')->where('Template','=', $Template)
        ->where('Type','=', $ApplicationType)->first();

        if(!$EM){
            DB::table('environmental_management')->insert([
                'Template' => $Template,
                'Type' => $ApplicationType,
                'ConstructionPhase' => $ConstructionPhase,
                'OperationPhase' => $OperationPhase,
            ]);
        } else {
            DB::table('environmental_management')
            ->where('Template','=', $Template)
            ->where('Type','=', $ApplicationType)
            ->update([
                'ConstructionPhase' => $ConstructionPhase,
                'OperationPhase' => $OperationPhase,
            ]);

        }
        
    } else if($Page == 5) {
        $GeneralConditions = $req['GeneralConditions'];

        DB::table('ecc_draft')
        ->where('Template','=', $Template)
        ->where('Type','=', $ApplicationType)
        ->update([
            'GeneralConditions' => $GeneralConditions,
        ]);
    } else if($Page == 6) {
        $Restrictions = $req['Restrictions'];

        DB::table('ecc_draft')
        ->where('Template','=', $Template)
        ->where('Type','=', $ApplicationType)
        ->update([
            'Restrictions' => $Restrictions,
        ]);
    } else if($Page == 7) {
        $PAPT = $req['PAPT'];

        DB::table('ecc_draft')
        ->where('Template','=', $Template)
        ->where('Type','=', $ApplicationType)
        ->update([
            'PAPT' => $PAPT,
        ]);
    }

    

}
}
