<?php

namespace App\Http\Controllers;

use App\Models\AspnetUser;
use App\Models\Component;
use App\Models\Project;
use App\Models\Proponent;
use App\Models\ProjectActivity;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\AspnetUserController;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use App\Http\Controllers\View;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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

}
