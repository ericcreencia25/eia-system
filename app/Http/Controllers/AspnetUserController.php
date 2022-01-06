<?php

namespace App\Http\Controllers;

use App\Models\AspnetUser;
use App\Models\Component;
use App\Models\Project;
use App\Models\ProjectActivity;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\AspnetUserController;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class AspnetUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    public function loginUser(Request $req)
    {
        $user = AspnetUser::on('mysql')->where('aspnet_Users.UserName', '=', $req->username)
        ->where('aspnet_Membership.Password', '=', $req->password )
        ->leftJoin('aspnet_Membership', 'aspnet_Users.UserId', '=', 'aspnet_Membership.UserId')
        ->first();
        
        if($user){
            $req->session()->put('data', $user);
            if($user->UserRole == 'Evaluator'){
                return redirect('default');
            }else{
                return redirect('new_document');
            }
            
        }else{

             return redirect('login')->with('msg', 'You have entered invalid credentials');
        }
    }

    public function logoutUser(Request $req)
    {
        if (Session::has('data')) {
            Session::pull('data');
            return redirect('login');
        }
    }

    public function getUsersList(Request $req)
    {
        $UserName = $req['UserName'];
        $UserRole = $req['UserRole'];
        $UserOffice = $req['UserOffice'];

        $projects = Project::select('ProjectActivity', 'Project.GUID', '=', 'ProjectActivity.ProjectGUID')
        ->select('Project.Address AS Address', 'Project.Municipality  AS Municipality', 'Project.Province AS Province', 'ProjectActivity.Status', 'ProjectActivity.Details AS Remarks', 'Project.ProjectName', 'Project.Region  AS Region', 'ProjectActivity.RoutedTo', 'ProjectActivity.RoutedFrom', 'Project.GUID AS ProjectGUID', 'Project.Stage', 'ProjectActivity.CreatedDate')
        ->where('Project.CreatedBy', '=', $UserName)
            ->leftJoin('ProjectActivity', 'Project.GUID', '=', 'ProjectActivity.ProjectGUID')
            ->get();

        $project = $projects;

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
        ->rawColumns(['Details', 'Status', 'Remarks'])
        ->make(true);
    }

}
