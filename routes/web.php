<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspnetUserController;
use App\Http\Controllers\Secured\EccApplicationsController;
use App\Http\Controllers\Secured\ForActionsController;
use App\Http\Controllers\Secured\NewApplicationsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiController;

use Webpatser\Uuid\Uuid;


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


// Route::get('/welcome', function () {
//     return view('welcome');
// });



Route::get('/welcome', [AspnetUserController::class, 'index']); 

Route::view('georisk', 'georisk');



// Auth::routes();

Route::group(['middleware'=>'web'], function(){
    $GUID = Uuid::generate()->string;
    

    Route::post('/tokenGeneration', [ApiController::class, 'tokenGeneration'])->name('tokenGeneration');

    Route::post('/hazardAssessmentGeneration', [ApiController::class, 'hazardAssessmentGeneration'])->name('hazardAssessmentGeneration');

////ECC APPLICATIONS CONTROLLER
    
    

    Route::get('/index', [App\Http\Controllers\Secured\EccApplicationsController::class, 'index'])->name('index');

    Route::get('/index', [App\Http\Controllers\Secured\EccApplicationsController::class, 'index'])->name('index'); 

    Route::get('/Search', [App\Http\Controllers\Secured\EccApplicationsController::class, 'search'])
    ->name('search'); 

    Route::post('/getECCApplications', [EccApplicationsController::class, 'getECCApplications'])->name('get.ecc.applications');

    Route::post('/getECCApplicationsCaseHandler', [EccApplicationsController::class, 'getECCApplicationsCaseHandler'])->name('get.ecc.applications.casehandler');

    Route::post('/getUnderProcessPerStatus', [EccApplicationsController::class, 'getUnderProcessPerStatus'])->name('getUnderProcessPerStatus');

    Route::post('/getUnderProcessECCApplication', [EccApplicationsController::class, 'getUnderProcessECCApplication'])->name('getUnderProcessECCApplication');

    Route::post('/getApplicationsDecided', [EccApplicationsController::class, 'getApplicationsDecided'])->name('getApplicationsDecided');

    Route::get('/ECCDashboard', [EccApplicationsController::class, 'ECCDashboard'])->name('ECCDashboard');


//// FOR ACTIONS CONTROLLER
    Route::get('index', [App\Http\Controllers\Secured\ForActionsController::class, 'index'])->name('index');

    Route::get('/ProjectApp/{GUID}/{ActivityGUID}', [App\Http\Controllers\Secured\ForActionsController::class, 'project_app'])->name('project_app');
    
    Route::get('/Project', [App\Http\Controllers\Secured\ForActionsController::class, 'project'])->name('project');

    Route::post('/getRoutingHistory', [ForActionsController::class, 'getRoutingHistory'])->name('get.routing.history');

    Route::post('/getRoutingHistoryCaseHandler', [ForActionsController::class, 'getRoutingHistoryCaseHandler'])->name('getRoutingHistoryCaseHandler');

    Route::post('/getActivityAttachments', [ForActionsController::class, 'getActivityAttachments'])->name('getActivityAttachments');

    Route::post('/getActivityAttachmentsList', [ForActionsController::class, 'getActivityAttachmentsList'])->name('getActivityAttachmentsList');

    Route::post('/getCaseHandlerForActionsTable', [ForActionsController::class, 'getCaseHandlerForActionsTable'])->name('getCaseHandlerForActionsTable');

    Route::post('/getListOfAttachments', [ForActionsController::class, 'getListOfAttachments'])->name('getListOfAttachments');

    Route::post('/getProjectActivity', [ForActionsController::class, 'getProjectActivity'])->name('getProjectActivity');

    Route::post('/getApplicationRequirementLists', [ForActionsController::class, 'getApplicationRequirementLists'])->name('getApplicationRequirementLists');

    Route::post('/getRegisteredAccount', [ForActionsController::class, 'getRegisteredAccount'])->name('getRegisteredAccount');

    Route::post('/getProcessingDays', [ForActionsController::class, 'getProcessingDays'])->name('getProcessingDays');

    Route::post('/UserListsOnRegion', [ForActionsController::class, 'UserListsOnRegion'])->name('UserListsOnRegion');

    Route::post('/getApplicationRequirementsModal', [ForActionsController::class, 'getApplicationRequirementsModal'])->name('getApplicationRequirementsModal');

    Route::post('/SaveAppReq', [ForActionsController::class, 'SaveAppReq'])->name('SaveAppReq');

    Route::post('/SaveAppReqApprover', [ForActionsController::class, 'SaveAppReqApprover'])->name('SaveAppReqApprover');

    Route::post('/EndorseApplication', [ForActionsController::class, 'EndorseApplication'])->name('EndorseApplication');

    Route::post('/addNewActivityGUID', [ForActionsController::class, 'addNewActivityGUID'])->name('addNewActivityGUID');

    Route::post('uploadFileEndorseApp', [ForActionsController::class, 'uploadFileEndorseApp'])->name('uploadFileEndorseApp');

    Route::post('getUploadedFile', [ForActionsController::class, 'getUploadedFile'])->name('getUploadedFile');
        
    Route::post('uploadFileEndorseApplicant', [ForActionsController::class, 'uploadFileEndorseApplicant'])->name('uploadFileEndorseApplicant');

    Route::post('/ReturnApplication', [ForActionsController::class, 'ReturnApplication'])->name('ReturnApplication');

    Route::get('/dynamic_pdf/EvaluationReport/{GUID}', [ForActionsController::class, 'generateEvaluationReport'])->name('generateEvaluationReport');

    Route::get('/dynamic_pdf/OrderOfPayment/{GUID}', [ForActionsController::class, 'generateOrderOfPayment'])->name('generateOrderOfPayment');

    Route::get('/dynamic_pdf/DraftCerticate/{GUID}/{ActivityGUID}', [ForActionsController::class, 'generateDraftCerticate'])->name('generateDraftCerticate');

    Route::post('acceptApplication', [ForActionsController::class, 'acceptApplication'])->name('acceptApplication');

    Route::get('/dynamic_pdf/DraftDenialLetter/{GUID}/{ActivityGUID}', [ForActionsController::class, 'generateDenialLetter'])->name('generateDenialLetter');

    Route::post('/getActionRequired', [ForActionsController::class, 'getActionRequired'])->name('getActionRequired');

    Route::post('/deleteTempAttachment', [ForActionsController::class, 'deleteTempAttachment'])->name('deleteTempAttachment');

    Route::post('/reviewerPDF', [ForActionsController::class, 'reviewerPDF'])->name('reviewerPDF');

    Route::post('/decideApplication', [ForActionsController::class, 'decideApplication'])->name('decideApplication');

    Route::get('/reviewer/{GUID}', [ForActionsController::class, 'reviewer'])->name('reviewer');

    // Route::get('/reviewer/{GUID}', [ForActionsController::class, 'reviewer'])->name('reviewer');

    // Route::view('reviewer', 'secured.for_actions.reviewer');

    Route::get('/generate-qrcode', [ForActionsController::class, 'generateQrCode'])->name('generateQrCode');

    Route::get('/verification/{GUID}', [ForActionsController::class, 'verification'])->name('verification');

    Route::get('/convertDocxToPDF/{GUID}', [ForActionsController::class, 'convertDocxToPDF'])->name('convertDocxToPDF');

/// ASPNET USER CONTROLLER

    Route::get('/login/{GUID}', [AspnetUserController::class, 'login']); 

    Route::post('/login-user', [AspnetUserController::class, 'loginUser'])->name('login-user');

    Route::get('/logout', [AspnetUserController::class, 'logoutUser']); 

    Route::post('/getUsersList', [AspnetUserController::class, 'getUsersList'])->name('get.users.list');

    Route::post('/getProponentInformation', [AspnetUserController::class, 'getProponentInformation'])->name('getProponentInformation');

    Route::get('/createNewGUID', [AspnetUserController::class, 'createNewGUID'])->name('createNewGUID');





/// NEW APPLICANT CONTROLLER
    Route::match(['get','post'], '/ProjectTypeTable', [NewApplicationsController::class, 'ProjectTypeTable'])->name('ProjectTypeTable');


    Route::get('/getGeoTable', [NewApplicationsController::class, 'getGeoTable'])->name('getGeoTable');

    Route::post('/getProjectType', [NewApplicationsController::class, 'getProjectType'])->name('getProjectType');

    Route::post('/getMunicipalities', [NewApplicationsController::class, 'getMunicipalities'])->name('getMunicipalities');

    Route::post('/onChangeMunicipalities', [NewApplicationsController::class, 'onChangeMunicipalities'])->name('onChangeMunicipalities');


    Route::post('/getApplicationRequirements', [NewApplicationsController::class, 'getApplicationRequirements'])->name('getApplicationRequirements');

    Route::post('/getGeoCoordinates', [NewApplicationsController::class, 'getGeoCoordinates'])->name('getGeoCoordinates');

    Route::get('/NewApplications/{GUID}', [NewApplicationsController::class, 'application_tab'])->name('application_tab');

    Route::get('/NewDocument/{GUID}', [NewApplicationsController::class, 'new_document'])->name('new_document'); 

    Route::post('/FirstStep', [NewApplicationsController::class, 'FirstStep'])->name('FirstStep');

    Route::post('/SecondStep', [NewApplicationsController::class, 'SecondStep'])->name('SecondStep');

    Route::post('/ThirdStep', [NewApplicationsController::class, 'ThirdStep'])->name('ThirdStep');

    Route::post('/FourthStep', [NewApplicationsController::class, 'FourthStep'])->name('FourthStep');

    Route::post('/FifthStep', [NewApplicationsController::class, 'FifthStep'])->name('FifthStep');

    Route::get('/ResetInputs', [NewApplicationsController::class, 'ResetInputs'])->name('ResetInputs');

    Route::post('uploadFile', [NewApplicationsController::class, 'uploadFile'])->name('uploadFile');

    Route::post('deleteFile', [NewApplicationsController::class, 'deleteFile'])->name('deleteFile');

    Route::post('SaveNewApplication', [NewApplicationsController::class, 'SaveNewApplication'])->name('SaveNewApplication');

    Route::post('getDocumentsUploaded', [NewApplicationsController::class, 'getDocumentsUploaded'])->name('getDocumentsUploaded');

    Route::post('putExistingDataInSession', [NewApplicationsController::class, 'putExistingDataInSession'])->name('putExistingDataInSession');

    Route::post('selectedArea', [NewApplicationsController::class, 'selectedArea'])->name('selectedArea');

    Route::post('SubmitApplication', [NewApplicationsController::class, 'SubmitApplication'])->name('SubmitApplication');

    Route::get('/dynamic_pdf/ProjectInformation', [NewApplicationsController::class, 'ProjectInformation'])->name('ProjectInformation');

    Route::get('/dynamic_pdf/SwornStatement', [NewApplicationsController::class, 'SwornStatement'])->name('SwornStatement');

    Route::post('/LinkProjectType', [NewApplicationsController::class, 'LinkProjectType'])->name('LinkProjectType');

/// VIEW 

    Route::view('default', 'secured.for_actions.default');
    Route::view('map', 'secured.create_applications.map');

    Route::view('search_project_type', 'secured.create_applications.search_project_type');

    Route::view('reviewer', 'secured.for_actions.reviewer');

    // Route::view('ECCDashboard', 'secured.ecc_applications.dashboard');

    // Route::view('new_document', 'secured\create_applications\new_application_tab');

    Route::view('documents', 'secured.ecc_applications.document');
    Route::view('{GUID}/map', 'secured.create_applications.clickable_map');

});