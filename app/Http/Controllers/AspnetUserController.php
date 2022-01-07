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
        $user = AspnetUser::on('mysql')->where('aspnet_Users.UserName', '=', $req->username)
        ->where('aspnet_Membership.Password', '=', $req->password )
        ->leftJoin('aspnet_Membership', 'aspnet_Users.UserId', '=', 'aspnet_Membership.UserId')
        ->first();
            
        $now = new \DateTime(); 
        $GUID = Uuid::generate()->string;

        if($user){
            $req->session()->put('data', $user);

            DB::table('aspnet_Users')
              ->where('UserId','=', $user->UserId)
              ->where('UserName', '=', $user->UserName)
              ->update([
                'LastActivityDate' => $now->format('Y-m-d H:i:s')
            ]);

            DB::table('aspnet_Membership')
              ->where('UserId','=', $user->UserId)
              ->update([
                'LastLoginDate' => $now->format('Y-m-d H:i:s')
            ]);



            if($user->UserRole == 'Evaluator'){
                return redirect('default');
            }else{
                return redirect('default');
            }
            
        }else{

             return redirect('login')->with('msg', 'You have entered invalid credentials');
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
            'Project.Address AS Address', 
            'Project.Municipality  AS Municipality', 
            'Project.Province AS Province', 
            'Project.Stage', 
            'Project.ProjectName', 
            'Project.Region AS Region', 
            'Project.GUID AS ProjectGUID', 

            'ProjectActivity.Status', 
            'ProjectActivity.Details AS Remarks', 
            'ProjectActivity.GUID AS ActivityGUID', 
            'ProjectActivity.RoutedTo', 
            'ProjectActivity.RoutedFrom', 
            'ProjectActivity.CreatedDate'
        )
        ->Join('ProjectActivity', function ($join) {
            $join->on('Project.GUID', '=', 'ProjectActivity.ProjectGUID');

            $join->whereRaw('ProjectActivity.ID IN (select MAX(a2.ID) from ProjectActivity as a2 
                join Project as u2 on u2.GUID = a2.ProjectGUID group by u2.GUID)');
        })

        ->where('ProjectActivity.Status', '<>', "For Screening")
        ->where('ProjectActivity.RoutedTo', '=', $UserName)
        ->where('Project.CreatedBy', '=', $UserName)
        ->where('Project.UpdatedDate', '>=', '2019-01-01')
        ->where('Project.UpdatedDate', '<=', $tomorrow)
        ->groupBy('Project.GUID')
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

        $proponent = Proponent::where('Proponent.GUID', '=', $ProponentGUID)
        ->first();

        return $proponent;
    }
}
