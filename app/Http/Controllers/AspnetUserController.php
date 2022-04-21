<?php

namespace App\Http\Controllers;

use App\Models\AspnetUser;
use App\Models\Component;
use App\Models\Project;
use App\Models\Proponent;
use App\Models\Region;
use App\Models\Office;
use App\Models\ProjectActivity;
use App\Models\ActionRequiredPerson;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\AspnetUserController;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use App\Http\Controllers\View;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class AspnetUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        return view('welcome', compact('GUID'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $req)
    {
        $user = AspnetUser::on('mysql')->where('aspnet_users.UserName', '=', $req->username)
        ->where('aspnet_membership.Password', '=', $req->password )
        // ->where('aspnet_users.InECCOAS', '=', 1)
        ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
        ->first();
        
        $now = new \DateTime(); 
        $GUID = Uuid::generate()->string;

        if($user){
            $req->session()->put('data', $user);

            DB::table('aspnet_users')
              ->where('UserId','=', $user->UserId)
              ->where('UserName', '=', $user->UserName)
              ->update([
                'LastActivityDate' => $now->format('Y-m-d H:i:s')
            ]);

            DB::table('aspnet_membership')
              ->where('UserId','=', $user->UserId)
              ->update([
                'LastLoginDate' => $now->format('Y-m-d H:i:s')
            ]);

            if($user->UserRole == 'Evaluator'){
                return redirect('default')->with('msg', 'Hi, '.$user->UserName.'! You signed in successfully');
            }else{
                return redirect('default')->with('msg', 'Hi, '.$user->UserName.'! You signed in successfully');
            }
        }else{

            $NewGUID = Uuid::generate()->string;
            $GUID = Str::upper($NewGUID);

            return redirect('login/'.$GUID)->with('msg', 'You have entered invalid credentials');
        }

    }

    public function firstTimeLoginUser(Request $req)
    {
        $UserName = Session::get('data')['UserName'];
        $Password = $req->password;

        $validator = $this->validate( $req, 
            [
                'password' => 'required|min:6',
            ]
        );

        $user = AspnetUser::on('mysql')->where('aspnet_users.UserName', '=', $UserName)
        ->where('aspnet_membership.Password', '=', $Password )
        ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
        ->first();
        
        $now = new \DateTime(); 
        $GUID = Uuid::generate()->string;

        if($user){
            Session::flush();

            $req->session()->put('data', $user);

            DB::table('aspnet_users')
              ->where('UserId','=', $user->UserId)
              ->where('UserName', '=', $user->UserName)
              ->update([
                'LastActivityDate' => $now->format('Y-m-d H:i:s')
            ]);

            DB::table('aspnet_membership')
              ->where('UserId','=', $user->UserId)
              ->update([
                'LastLoginDate' => $now->format('Y-m-d H:i:s')
            ]);

              return redirect('default')->with('msg', 'Hi, '.$user->UserName.'! You signed in successfully');

            
        }else{

            $NewGUID = Uuid::generate()->string;
            $GUID = Str::upper($NewGUID);

            return redirect('default')->with('msg', 'You have entered invalid credentials');
        }

    }

    public function logoutUser(Request $req)
    {
        if (Session::has('data')) {
            Session::flush();

            return redirect('welcome');
        }
    }

    public function getUsersList(Request $req)
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

            'projectactivity.Status', 
            'projectactivity.Details AS Remarks', 
            'projectactivity.GUID AS ActivityGUID', 
            'projectactivity.RoutedTo', 
            'projectactivity.RoutedFrom', 
            'projectactivity.CreatedDate',
            'projectactivity.UpdatedDate AS UpdatedDate', 
        )
        ->Join('projectactivity', function ($join) {
            $join->on('project.GUID', '=', 'projectactivity.ProjectGUID');

            $join->whereRaw('projectactivity.ID IN (select MAX(a2.ID) from projectactivity as a2 
                join project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })
        ->where('projectactivity.Status', '<>', "For Screening")
        ->where('projectactivity.RoutedTo', '=', $UserName)
        ->where('project.CreatedBy', '=', $UserName)
        ->where('projectactivity.UpdatedDate', '>=', '2019-01-01')
        ->where('projectactivity.UpdatedDate', '<=', $tomorrow)
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

            $details = '<i style="color:slategray;">'. $project->Status.'</i>';
            
            
            return $details;
        })
        ->addColumn('Remarks', function($project){

            $date = date("F j, Y g:i a", strtotime($project->UpdatedDate));
            $details = '<small>'. $project->Remarks.' - <i>'.$project->RoutedFrom .' on '. $date .'</i></small>';
            return $details;
        })
        ->rawColumns(['Details', 'Status', 'Remarks'])
        ->make(true);
    }

    public function createNewGUID()
    {   
        $NewGUID = Uuid::generate()->string;
        $GUID = Str::upper($NewGUID);

        return $GUID;
    }


    public function getProponentInformation(Request $req)
    {   
        $ProponentGUID = $req['ProponentGUID'];

        $proponent = Proponent::where('proponent.GUID', '=', $ProponentGUID)
        ->first();

        return $proponent;
    }

    public function getProponentInformationComparison(Request $req)
    {   
        $Name = $req['Name'];

        $proponent = Proponent::where('proponent.ProponentName', 'LIKE', '%' . $Name . '%')
        ->first();

        return $proponent;
    }

    public function verification($GUID)
    {
        $project = Project::where('project.GUID', '=', $GUID)
        ->where('project.Stage', '=' , 5)
        ->first();

        if($project){
            return view('secured.verification', compact('project'));
        } else {
            return redirect('/welcome');
        }
    }

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
            ->get();
        } else {
            $user = AspnetUser::on('mysql')->where('aspnet_users.UserOffice', '=', 'NULL')
            ->Join('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
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

    public function getRegionalInformation(Request $req)
    {   
        $GUID = $req['GUID'];
        $Region = Region::where('region.RegionGUID', '=', $GUID)->first();

        return $Region;
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

    public function registerUrAccount()
    {
        return view('auth.register');
    }

    public function saveRegister(Request $req)
    {
        $cPassword = Session::get('data')['Password'];
        $Password = $req->password;

        $validator = $this->validate( $req, 
            [
                'username' => 'unique:aspnet_users,UserName',
                'email' => 'unique:aspnet_membership,Email',
                // 'password' => 'required|min:6|required_with:password-confirmation|same:password-confirmation',
                'g-recaptcha-response' => 'required|captcha',
                // 'datepicker' => 'required',
                'password' => ['required', function ($attribute, $value, $fail) use ($cPassword) {
                        if ($value != $cPassword) {
                            return $fail(__('Invalid Credentials: Make sure that your password is same with CRS.'));
                        }
                    }],
            ],
            [   
                // 'password.same' => 'Password doesn\'t match',
                'password.min' => 'Password must at least 6 characters.',
                'g-recaptcha-response.required' => 'Captcha is required'
            ]
        );

            $row['ApplicationId'] = 'AE7B47D9-7F8F-4911-ADC7-AE6CF878E9D8';
            $row['UserId'] = Session::get('data')['UserCode'];
            $row['Title'] = $req->gender;
            $row['UserName'] = Session::get('data')['UserName'];
            $row['LoweredUserName'] = Str::lower(Session::get('data')['UserName']);
            $row['GovernmentID'] = '';
            $row['AuthorizationLetter'] ='';
            $row['SecDTIRegistration'] = '';
            $row['Designation'] = '';
            $row['AlternateEmail'] = '';
            $row['MobileAlias'] = Session::get('data')['MobileAlias'];
            $row['UserOffice'] = 'Proponent';
            $row['Department'] = '';
            $row['UserRole'] = 'Applicant';
            $row['DefaultRecipient'] = 0;
            $row['DefaultRecipientCMR'] = 0;
            $row['DefaultRecipientCNC'] = 0;
            $row['IsAnonymous'] = 0;
            $row['LastActivityDate'] = 0;
            $row['CreatedDate'] = date('Y-m-d H:i:s');
            $row['ProponentGUID'] = 1;
            $row['BirthDate'] = $req->datepicker;
            $row['InECCOAS'] = 0;
            $row['InCMROS'] = 0;
            $row['InCNCOAS'] = 0;
            $row['OnLeave'] = 0;
            $row['OnLeaveReceiver'] = '';
            $row['Screened'] = 0;

            if(DB::table('aspnet_users')->insert($row)){
                $row1['ApplicationId'] = 'AE7B47D9-7F8F-4911-ADC7-AE6CF878E9D8';
                $row1['UserId'] = Session::get('data')['UserCode'];
                $row1['Password'] = $req->password;
                $row1['PasswordFormat'] = 0;
                $row1['PasswordSalt'] = Hash::make($req->password);
                $row1['MobilePIN'] = '';
                $row1['Email'] = Session::get('data')['Email'];
                $row1['LoweredEmail'] = Str::lower(Session::get('data')['Email']);
                $row1['PasswordQuestion'] = '';
                $row1['PasswordAnswer'] = '';
                $row1['IsApproved'] = Session::get('data')['MobileAlias'];
                $row1['IsLockedOut'] = 0;
                $row1['CreateDate'] = date('Y-m-d H:i:s');
                $row1['LastLoginDate'] = date('Y-m-d H:i:s');
                $row1['LastPasswordChangedDate'] = 0;
                $row1['LastLockoutDate'] = 0;
                $row1['FailedPasswordAttemptCount'] = 0;
                $row1['FailedPasswordAttemptWindowStart'] = 0;
                $row1['FailedPasswordAnswerAttemptCount'] = 0;
                $row1['FailedPasswordAnswerAttemptWindowStart'] = 0;
                $row1['Comment'] = 0;
                $row1['PasswordOld'] = 0;

                DB::table('aspnet_membership')->insert($row1);

                return redirect('authentication/registerUrAccount')->with('success', 'Successfully binded');
            }

        return redirect('authentication/registerUrAccount');

    }

    public function manageAccount()
    {
        return view('secured.manage_account.index');
    }

    public function updateAccount(Request $req)
    {
        $cPassword = Session::get('data')['Password'];
        $UserId = Session::get('data')['UserId'];
        $confirmPassword = $req->confirmpassword;

        if ($req->has('updatepassword')) {
            $validator = $this->validate( $req, 
                [
                    'newpassword' => 'required|min:7|required_with:confirmpassword|same:confirmpassword',
                    'confirmpassword' => ['required', function ($attribute, $value, $fail) use ($cPassword) {
                        if ($value == $cPassword) {
                            return $fail(__('The new password is same with current password.'));
                        }
                    }],
                    'currentpassword' => ['required', function ($attribute, $value, $fail) use ($cPassword) {
                        if ($value != $cPassword) {
                            return $fail(__('The current password is incorrect.'));
                        }
                    }],
                    
                ],
                [   
                    'confirmpassword.same' => 'Same password with the current password.',
                    'newpassword.same' => 'Password didn\'t match',
                    'newpassword.min' => 'Password must at least 8 characters.',
                ]
            );

            DB::table('aspnet_membership')
                ->where('UserId','=', $UserId)
                ->where('Password', '=', $cPassword)
                ->update([
                    'Password' => $confirmPassword,
                    'PasswordSalt' => Hash::make($confirmPassword),
                    'PasswordOld' => $cPassword,
                    // 'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);

            $user = AspnetUser::on('mysql')->where('aspnet_users.UserId', '=', $UserId)
            ->where('aspnet_membership.Password', '=', $confirmPassword )
            ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->first();

            if($user){
                Session::flush();
                $req->session()->put('data', $user);  
            }

            

            return redirect('secured/manageAccount')->with('success1', 'Successfully changed your password.');
        }

        if ($req->has('updatebasicinfo')) {
            $validator = $this->validate( $req, 
                [
                    // 'primaryemail' => 'required|unique:aspnet_membership,Email',
                    // 'alternateemail' => 'required|unique:aspnet_users,AlternateEmail',
                    'mobileno' => 'required',
                    'datepicker' => 'required',
                ],
                [   
                    // 'alternateemail.unique' => 'The Alternate Email field is required.',
                    // 'primaryemail' => 'The Primary Email field is required.',
                    'mobileno.required' => 'The Mobile Number field is required.',
                    'datepicker.required' => 'The Birth Date field is required.',
                ]
            );



            DB::table('aspnet_users')
            ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->where('aspnet_users.UserId','=', $UserId)
            ->where('aspnet_membership.Password', '=', $cPassword)
            ->update([
                    // 'aspnet_membership.Email' => $req->primaryemail,
                    'aspnet_membership.LoweredEmail' => Str::lower($req->primaryemail),
                    'aspnet_users.AlternateEmail' => $req->alternateemail,
                    'aspnet_users.MobileAlias' => $req->mobileno,
                    'aspnet_users.BirthDate' => $req->datepicker
                    // 'UpdatedDate' => $now->format('Y-m-d H:i:s')
                ]);

            $user = AspnetUser::on('mysql')->where('aspnet_users.UserId', '=', $UserId)
            ->where('aspnet_membership.Password', '=', $cPassword )
            ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->first();

            if($user){
                Session::flush();
                $req->session()->put('data', $user);  
            }

            return redirect('secured/manageAccount')->with('success2', 'Basic Information updated successfully.  ');
        }
        
    }

    

}
