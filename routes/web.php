<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspnetUserController;
use App\Http\Controllers\Secured\EccApplicationsController;
use App\Http\Controllers\Secured\ForActionsController;
use App\Http\Controllers\Secured\NewApplicationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>'web'], function(){

////ECC APPLICATIONS CONTROLLER
    Route::get('/index', [App\Http\Controllers\Secured\EccApplicationsController::class, 'index'])->name('index');

    Route::get('/index', [App\Http\Controllers\Secured\EccApplicationsController::class, 'index'])->name('index'); 

    Route::get('/Search', [App\Http\Controllers\Secured\EccApplicationsController::class, 'search'])
    ->name('search'); 

    Route::post('/getECCApplications', [EccApplicationsController::class, 'getECCApplications'])->name('get.ecc.applications');


//// FOR ACTIONS CONTROLLER
    Route::get('index', [App\Http\Controllers\Secured\ForActionsController::class, 'index'])->name('index');

    Route::get('/ProjectApp/{GUID}', [App\Http\Controllers\Secured\ForActionsController::class, 'project_app'])->name('project_app');
    
    Route::get('/Project', [App\Http\Controllers\Secured\ForActionsController::class, 'project'])->name('project');

    Route::post('/getRoutingHistory', [ForActionsController::class, 'getRoutingHistory'])->name('get.routing.history');

    Route::post('/getActivityAttachments', [ForActionsController::class, 'getActivityAttachments'])->name('getActivityAttachments');

    Route::post('/getCaseHandlerForActionsTable', [ForActionsController::class, 'getCaseHandlerForActionsTable'])->name('getCaseHandlerForActionsTable');

/// ASPNET USER CONTROLLER

    Route::get('/login', [AspnetUserController::class, 'index']); 

    Route::post('/login-user', [AspnetUserController::class, 'loginUser'])->name('login-user'); 

    Route::get('/logout', [AspnetUserController::class, 'logoutUser']); 

    Route::post('/getUsersList', [AspnetUserController::class, 'getUsersList'])->name('get.users.list');


/// NEW APPLICANT CONTROLLER

    Route::post('/getProjectType', [NewApplicationsController::class, 'getProjectType'])->name('getProjectType');

    Route::post('/getMunicipalities', [NewApplicationsController::class, 'getMunicipalities'])->name('getMunicipalities');

    Route::get('/getApplicationRequirements', [NewApplicationsController::class, 'getApplicationRequirements'])->name('getApplicationRequirements');

    Route::post('/getGeoCoordinates', [NewApplicationsController::class, 'getGeoCoordinates'])->name('getGeoCoordinates');

    Route::get('/NewApplications/{GUID}', [NewApplicationsController::class, 'application_tab'])->name('application_tab');


/// VIEW 

    Route::view('default', 'secured.for_actions.default');

    Route::view('new_document', 'secured.create_applications.application_tab');

    Route::view('documents', 'secured.ecc_applications.document');

});