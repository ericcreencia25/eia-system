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
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use Mapper;

class ApiController extends Controller
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

    public function tokenGeneration(Request $req)
    {
        $response = Http::post('https://api.georisk.gov.ph/generate/token', [
            'client_id' => '955fa9bd-59c4-4e47-b936-bffe0855ecfd',
            'client_secret' => 'JXLOKsXakXXfqJUGep6bGjhgAYg3CQuobydrZygq',
        ]);


    //     $response = $client->request('POST', '/api/user', [
    //     'headers' => [
    //         'Authorization' => 'Bearer '.$token,
    //         'Accept' => 'application/json',
    //     ],
    // ]);

        return $response;

    }

    public function georisk()
    {

        return view('georisk');
    }

    public function hazardAssessmentGeneration(Request $req)
    {
        $longitude = $req['longitude'];
        $latitude = $req['latitude'];


        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTVmYTliZC01OWM0LTRlNDctYjkzNi1iZmZlMDg1NWVjZmQiLCJqdGkiOiIyZjE3ZDYzMDNmNDYwYWE0ZDM4MGJjNzE1MzcxZmE3OTI5MjUzODIwMmNlNDcyZDMxYzAyYjFlNDNmNzUyYzg5NTAzY2Q0ODIyOWUzYjFhOCIsImlhdCI6MTY0NjcyMTAzNSwibmJmIjoxNjQ2NzIxMDM1LCJleHAiOjE2NDc5MzA2MzQsInN1YiI6IiIsInNjb3BlcyI6WyJhc3Nlc3NtZW50cyJdfQ.WtJFZLP5N7zVKSIUKJVHh736tqd68Qt3GRNx27O30evtDNcB9EzKtUHFNp9tzBSRHTe9wT2pnqEU0U7nvR08XB7qxkrL77QXHaO9YmEUJ1TqsKEIAM9j023Cv2UJ3upys4-B8U8uDwnnkOdComUW-3cenMykirZ67CWhgXSspViVBzGjl_Jfu0XHMLbyA1C2M-_hvHekM6TgHY9Qj2Hzi3goqH6Sb0yYPQsDlBBF6UMJY_EIgjGmo09bLWojY7RlI-Nn-lGIgYx2sQ5RmCqbE7pZreP-44cWPa33cE0K9ajMjYQNHeIfopb78-Po51tFHN92WFEVThiukdl7KSNC-v0wZdOHiCooKIQ0S7spTiV0vkveLBqBOwdGv1EXNWzWSCrgIlqMbkV7m86_CNXsw-lMWPhSR2C4lDYamovqvuHgiBfaML4xpGc3OWO8BkqvmquiF0QalCNDRvR2dSV1bs9EJSRGKwoF8R87IWuWFQIp0XNiybK2SxnTQ3Z6Vn0tWalul4_EVXvstNDO9DPCThUCD_Ug-EqDkr8D_hXyxJptxJ10KsJdbRTJzRF7EXh_pQs9AjvUsm0XCedeLYdKzPQ08JAxzimPA5biFZWswKXP1MD_ia02V3CrQAinJtIpIyK8KvE8gqhEvtDYlNotzBFp4z_c4BPHuVmj2muitRo';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post('https://api.georisk.gov.ph/api/assessments', [
            'longitude' => $longitude,
            'latitude' => $latitude,
        ]);

        // 'longitude' => '120.982155',
        //     'latitude' => '14.535067',

        return json_decode($response, TRUE);
    }

    public function loginCRS(Request $req)
    {
        // $UserName = 'sampleclient2021';
        // $Password = '1234567';

        $UserName = $req['username'];
        $Password = $req['password'];

        $url = 'https://iis.emb.gov.ph/embis/api/Crs_Api/crs_account_login_api?username='.$UserName.'&password='.$Password;

        // $response = Http::get('https://iis.emb.gov.ph/embis/api/Crs_Api/crs_account_login_api?username=sampleclient2021&password=1234567');

        // $response = Http::get('https://iis.emb.gov.ph/embis/api/Crs_Api/crs_account_login_api', [
        //     'username' => 'sampleclient2021',
        //     'password' => '1234567',
        // ]);

        $client = new Client(['verify' => false]);
        $res = $client->get($url);



        $result = json_decode($res->getBody());

        if($result->response == 'invalid username or password'){
            return 'invalid username or password';
        }else{

            $user = AspnetUser::on('mysql')->where('aspnet_users.UserName', '=', $UserName)
            ->where('aspnet_membership.Password', '=', $Password)
            // ->where('aspnet_users.InECCOAS', '=', 1)
            ->leftJoin('aspnet_membership', 'aspnet_users.UserId', '=', 'aspnet_membership.UserId')
            ->first();

            if($user){

                $now = new \DateTime(); 

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

                return "Success";

                // if($user->UserRole == 'Evaluator'){
                //     return redirect('default')->with('msg', 'Hi, '.$user->UserName.'! You signed in successfully');
                // }else{
                //     return redirect('default')->with('msg', 'Hi, '.$user->UserName.'! You signed in successfully');
                // }

            } else {

                $rowData = [];

                $rowData['UserName'] = $result->response->username;
                $rowData['Email'] = $result->response->email;
                $rowData['FirstName'] = $result->response->first_name;
                $rowData['LastName'] = $result->response->last_name;
                $rowData['MobileAlias'] = $result->response->contact_no;
                $rowData['Position'] = $result->response->position;
                $rowData['CreatedDate'] = $result->response->date_registered;
                $rowData['UserCode'] = $result->response->user_code;
                $rowData['Password'] = $Password;
                $rowData['PasswordSalt'] = $result->response->password;
                $rowData['UserOffice'] = 'Proponent';
                $rowData['UserRole'] = 'Applicant';
                $rowData['UserId'] = '';
                $rowData['UserCode'] = $result->response->user_code;
                
                $req->session()->put('data', $rowData);

                // if($rowData['UserRole'] == 'Evaluator'){
                //     return redirect('default')->with('msg', 'Hi, '.$UserName.'! You signed in successfully');
                // }else{
                //     return redirect('default')->with('msg', 'Hi, '.$UserName.'! You signed in successfully');
                // }

                return 'No Binded Account.';

            }
        }
        

        // return $rowData;
        // return json_decode($rowData);
    }

    public function loginCRSUSers()
    {
        return view('auth.login-crs');
    }

    public function companyData()
    {
        $UserName = Session::get('data')['UserName'];
        $Password = Session::get('data')['Password'];

        // $client = new \GuzzleHttp\Client();
        // $response = $client->post(
        //     'https://iis.emb.gov.ph/embis/api/Crs_Api/ecc_api',
        //     array(
        //         'form_params' => array(
        //         'username' => $UserName,
        //         'password' => $Password,
        //         'key' => '3mb$swmk3y',
        //         )
        //     )
        // );

        // $response_body = json_decode($response->getBody());
        
        // $emb_id = $response_body->company_details[0]->emb_id;

        $url = 'https://iis.emb.gov.ph/embis/api/Getdata/json_company_for_ecc?api_key=x&emb_id=EMBR4A-161540-57784';
        $client = new Client(['verify' => false]);
        $res = $client->get($url);

        $result = json_decode($res->getBody());

        $rowData = [];

        $rowData['emb_id'] = $result->emb_id;
        $rowData['company_name'] = $result->company_name;
        $rowData['establishment_name'] = $result->establishment_name;
        $rowData['date_established'] = $result->date_established;
        $rowData['house_no'] = $result->house_no;
        $rowData['barangay_name'] = $result->barangay_name;
        $rowData['city_name'] = $result->city_name;
        $rowData['province_name'] = $result->province_name;
        $rowData['region_name'] = $result->region_name;
        $rowData['latitude'] = $result->latitude;
        $rowData['longitude'] = $result->longitude;
        $rowData['email'] = $result->email;
        $rowData['contact_no'] = $result->contact_no;
        $rowData['project_name'] = $result->project_name;
        $rowData['int_comp_address'] = $result->int_comp_address;
        $rowData['input_date'] = $result->input_date;
        $rowData['affiliated'] = $result->affiliated;
        $rowData['street'] = $result->street;
        $rowData['ceo_fname'] = $result->ceo_fname;
        $rowData['ceo_sname'] = $result->ceo_sname;
        $rowData['ceo_mname'] = $result->ceo_mname;
        $rowData['sec_registration'] = '';
        $rowData['dti_registration'] = '';
        $rowData['ceo_contact_num'] = $result->ceo_contact_num;
        $rowData['ceo_fax_no'] = $result->ceo_fax_no;
        
        return $rowData;
    }

    // EMBR4B-1365400-79 
    // with establishment

    

}
