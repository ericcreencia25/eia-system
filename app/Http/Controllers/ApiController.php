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
        // $response = Http::post('https://api.georisk.gov.ph/generate/token', [
        //     'client_id' => '955fa9bd-59c4-4e47-b936-bffe0855ecfd',
        //     'client_secret' => 'JXLOKsXakXXfqJUGep6bGjhgAYg3CQuobydrZygq',
        // ]);


    //     $response = $client->request('POST', '/api/user', [
    //     'headers' => [
    //         'Authorization' => 'Bearer '.$token,
    //         'Accept' => 'application/json',
    //     ],
    // ]);

    }

    public function georisk()
    {

        return view('georisk');
    }

    public function hazardAssessmentGeneration(Request $req)
    {
        $longitude = $req['longitude'];
        $latitude = $req['latitude'];


        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTVmYTliZC01OWM0LTRlNDctYjkzNi1iZmZlMDg1NWVjZmQiLCJqdGkiOiI1ODk1YTE1ZTMxYTcwNGI1ZTRlYzYyMzFiNzdiM2JmNjk1ODQ5ZjI5YTBjNWM5NTE1MjgwZGRiZjAwM2JlMjE5NzJkOWZlMWIyYzAyMTlhMyIsImlhdCI6MTY0NTA1ODMyMywibmJmIjoxNjQ1MDU4MzIzLCJleHAiOjE2NDYyNjc5MjMsInN1YiI6IiIsInNjb3BlcyI6WyJhc3Nlc3NtZW50cyJdfQ.dCoTUwlGINX5a95uHr7FUtw8ClXlcDGkOmRFmc0ZeRRgyW1m0CCBoi9FNzK6EBAX532rHw45uLvCPyq-D7E8wQfJTo3Ah3F6q28nzsUZckFS5v8TZKKH1WiVL-ZWFmJ9KeHSeD12xL8-sgh3sjCSm_zHnTnFS9jFxOKlWZujz30P-u4YJPfgAU2xsKaS-xSPj58cYbCVu9KW2344eSN8vVB-Rp8FhqRefH_PjWXEhY4p3wTaxNqMih7p2dc5eMmYHi1Cl2DIzBFQcPHUV68DZ1kYtiJItI8d7oZvMfsRJzt5PxCqHhDUMh1ZjJv80Lx6PnbKRRUd-SNbt5rVXV5RUvWlwK2KYaLpR8f0js3XOJm9cU_Z3XruUYmgCepwqhYNxzrOXusnCj2MQ_RneZmv5VRdoHlZsIaiHYjKxaxrcODi_k03LpgoL_JBjExRwY9hRYRbXED_s-KccgC3MWhxUumgP9HmS5ncgvQSfbLdIu5ADggoTlNSM1Sv9Jct_sja66bXWlESPsC4AELHVRDYYvcEpd8FxezN8dRtmGmaNyoQ823yYFzediQdH_s-nU4Vh2ref8kr7xbQfamPX0gRxSdvqRcGXQJBVXC0Pj-Yqyd_eXmQzj1bDaa5z4Xrv8urq_zTY9ahn3Vf6xtmihlrEQXHM41lt-1q1H1rkC7J50E';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post('https://api.georisk.gov.ph/api/assessments', [
            'longitude' => $longitude,
            'latitude' => $latitude,
        ]);

        // 'longitude' => '120.982155',
        //     'latitude' => '14.535067',

        return json_decode($response, TRUE);\
    }

    

}
