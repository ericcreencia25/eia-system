<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspnetUserController;
use App\Http\Controllers\Secured\AdministrationsController;
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


Route::get('/welcome', [AspnetUserController::class, 'index'])->name('index');

// Route::view('forTesting/HazardHunterPH', 'georisk');


// Auth::routes();

Route::group(['middleware'=>'web'], function(){
    $GUID = Uuid::generate()->string;
    Route::get('/forTesting/HazardHunterPH', [ApiController::class, 'georisk'])->name('georisk');

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

    Route::get('/documents', [EccApplicationsController::class, 'documents'])->name('documents');

    Route::get('/searchDocuments', [EccApplicationsController::class, 'searchDocuments'])->name('searchDocuments');

    Route::get('/ProjectComp', [EccApplicationsController::class, 'project_comp'])->name('project_comp');

    Route::get('/ProjectView', [EccApplicationsController::class, 'project_view'])->name('project_view');

    // Route::view('documents', 'secured.ecc_applications.document');

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

    Route::get('/dynamic_pdf/EvaluationReport/{GUID}/{ActivityGUID}', [ForActionsController::class, 'generateEvaluationReport'])->name('generateEvaluationReport');

    Route::get('/dynamic_pdf/OrderOfPayment/{GUID}/{ActivityGUID}', [ForActionsController::class, 'generateOrderOfPayment'])->name('generateOrderOfPayment');

    Route::get('/dynamic_pdf/DraftCerticate/{GUID}/{ActivityGUID}', [ForActionsController::class, 'generateDraftCerticate'])->name('generateDraftCerticate');

    Route::post('acceptApplication', [ForActionsController::class, 'acceptApplication'])->name('acceptApplication');

    Route::get('/dynamic_pdf/DraftDenialLetter/{GUID}/{ActivityGUID}', [ForActionsController::class, 'generateDenialLetter'])->name('generateDenialLetter');

    Route::post('/getActionRequired', [ForActionsController::class, 'getActionRequired'])->name('getActionRequired');

    Route::post('/deleteTempAttachment', [ForActionsController::class, 'deleteTempAttachment'])->name('deleteTempAttachment');

    Route::post('/reviewerPDF', [ForActionsController::class, 'reviewerPDF'])->name('reviewerPDF');

    Route::post('/decideApplication', [ForActionsController::class, 'decideApplication'])->name('decideApplication');

    Route::post('/revertApplication', [ForActionsController::class, 'revertApplication'])->name('revertApplication');

    Route::get('/reviewer/{GUID}', [ForActionsController::class, 'reviewer'])->name('reviewer');

    Route::get('/generate-qrcode', [ForActionsController::class, 'generateQrCode'])->name('generateQrCode');

    Route::get('/convertDocxToPDF/{GUID}', [ForActionsController::class, 'convertDocxToPDF'])->name('convertDocxToPDF');

    Route::get('/default', [ForActionsController::class, 'default'])->name('default');

    Route::get('/holidays', [ForActionsController::class, 'holidays'])->name('holidays');

    Route::post('/getHolidaysTable', [ForActionsController::class, 'getHolidaysTable'])->name('getHolidaysTable');

    Route::post('/addHolidays', [ForActionsController::class, 'addHolidays'])->name('addHolidays');

    Route::post('/getSpecificHolidays', [ForActionsController::class, 'getSpecificHolidays'])->name('getSpecificHolidays');

    Route::post('/getCompliantsCount', [ForActionsController::class, 'getCompliantsCount'])->name('getCompliantsCount');

    Route::post('/updateBasicProjectInformation', [ForActionsController::class, 'updateBasicProjectInformation'])->name('updateBasicProjectInformation');

    Route::post('/autoForwardingProponent', [ForActionsController::class, 'autoForwardingProponent'])->name('autoForwardingProponent');

    Route::post('/getApplicationsList', [ForActionsController::class, 'getApplicationsList'])->name('get.applications.list');

    Route::post('/getECCDraftTemplate', [ForActionsController::class, 'getECCDraftTemplate'])->name('getECCDraftTemplate');

    Route::get('/ecc-draft-certificate', [ForActionsController::class, 'ECCDraftCertificate'])->name('ECCDraftCertificate');

    Route::get('/ecc-draft-print/{GUID}', [ForActionsController::class, 'ECCDraftPrint'])->name('ECCDraftPrint');

    Route::post('/ecc-draft-certificate/compose/page-save', [ForActionsController::class, 'PageSave'])->name('PageSave');

    Route::post('/ecc-draft-data', [ForActionsController::class, 'ECCDraftData'])->name('ECCDraftData');

    Route::post('/generate-template', [ForActionsController::class, 'generateTemplate'])->name('generateTemplate');


/// ASPNET USER CONTROLLER

    Route::get('/login/{GUID}', [AspnetUserController::class, 'login']); 

    Route::post('/login-user', [AspnetUserController::class, 'loginUser'])->name('login-user');

    Route::post('/login-user-crs', [ApiController::class, 'loginCRS'])->name('login-user-crs');

    Route::post('/first-time-login-user', [AspnetUserController::class, 'firstTimeLoginUser'])->name('first-time-login-user');

    Route::get('/logout', [AspnetUserController::class, 'logoutUser'])->name('logout'); 

    Route::post('/getProponentInformation', [AspnetUserController::class, 'getProponentInformation'])->name('getProponentInformation');

    Route::post('/getProponentInformationComparison', [AspnetUserController::class, 'getProponentInformationComparison'])->name('getProponentInformationComparison');

    Route::get('/createNewGUID', [AspnetUserController::class, 'createNewGUID'])->name('createNewGUID');

    Route::get('/verification/{GUID}', [AspnetUserController::class, 'verification'])->name('verification');

    Route::get('/authentication/registerUrAccount', [AspnetUserController::class, 'registerUrAccount'])->name('registerUrAccount');

    Route::post('/saveRegister', [AspnetUserController::class, 'saveRegister'])->name('saveRegister');

    Route::get('/secured/manageAccount', [AspnetUserController::class, 'manageAccount'])->name('manageAccount');

    Route::post('/updateAccount', [AspnetUserController::class, 'updateAccount'])->name('updateAccount');

    Route::post('/UserStatusModal', [AspnetUserController::class, 'UserStatusModal'])->name('UserStatusModal');

    

    Route::get('/company-data', [ApiController::class, 'companyData'])->name('companyData');

    Route::get('/log-in/lockscreen', [ApiController::class, 'lockScreen'])->name('lockScreen');

    Route::get('/crs-login', [ApiController::class, 'loginCRSUSers'])->name('loginCRSUSers');
    

/// NEW APPLICANT CONTROLLER
    Route::match(['get','post'], '/ProjectTypeTable', [NewApplicationsController::class, 'ProjectTypeTable'])->name('ProjectTypeTable');


    Route::get('/getGeoTable', [NewApplicationsController::class, 'getGeoTable'])->name('getGeoTable');

    Route::post('/getProjectType', [NewApplicationsController::class, 'getProjectType'])->name('getProjectType');

    Route::post('/getComponents', [NewApplicationsController::class, 'getComponents'])->name('getComponents');

    Route::post('/getProjectTypeStep2', [NewApplicationsController::class, 'getProjectTypeStep2'])->name('getProjectTypeStep2');

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

    Route::get('/dynamic_pdf/ProjectDescription/{GUID}', [NewApplicationsController::class, 'ProjectDescription'])->name('ProjectDescription');

    Route::get('/dynamic_pdf/SwornStatement', [NewApplicationsController::class, 'SwornStatement'])->name('SwornStatement');

    Route::post('/LinkProjectType', [NewApplicationsController::class, 'LinkProjectType'])->name('LinkProjectType');

    Route::get('/search/project-type', [NewApplicationsController::class, 'searchProjectType'])->name('searchProjectType');

    Route::post('/addBindData', [NewApplicationsController::class, 'addBindData'])->name('addBindData');

    Route::post('/addCompanyDetailsECC', [NewApplicationsController::class, 'addCompanyDetailsECC'])->name('addCompanyDetailsECC');

    Route::post('/unBindData', [NewApplicationsController::class, 'unBindData'])->name('unBindData');

    Route::post('/searchCompany', [NewApplicationsController::class, 'searchCompany'])->name('searchCompany');

    Route::post('/getBindedData', [NewApplicationsController::class, 'getBindedData'])->name('getBindedData');

    Route::post('/insertProjectRequirement', [NewApplicationsController::class, 'insertProjectRequirement'])->name('insertProjectRequirement');

    ////ADMIN

    Route::get('/administration/default', [AdministrationsController::class, 'manageCredentials'])->name('manageCredentials');

    Route::get('/administration/signatories', [AdministrationsController::class, 'manageSignatories'])->name('manageSignatories');

    Route::post('/administration/getRegisteredUsers', [AdministrationsController::class, 'getRegisteredUsers'])->name('getRegisteredUsers');

    Route::get('/administration/getSignatories', [AdministrationsController::class, 'getSignatories'])->name('getSignatories');

    Route::get('/administration/getOffice', [AdministrationsController::class, 'getOffice'])->name('getOffice');

    Route::post('/administration/getUserAction', [AdministrationsController::class, 'getUserAction'])->name('getUserAction');

    Route::post('/administration/getRegionalInformation', [AdministrationsController::class, 'getRegionalInformation'])->name('getRegionalInformation');

    Route::get('/administration/getUserApplications', [AdministrationsController::class, 'getUserApplications'])->name('getUserApplications');

    Route::post('/administration/getUserApplicationsTable', [AdministrationsController::class, 'getUserApplicationsTable'])->name('getUserApplicationsTable');

    Route::get('/administration/ECC', [AdministrationsController::class, 'getECCData'])->name('getECCData');

    Route::post('/administration/getProjectTypeAdmin', [AdministrationsController::class, 'getProjectTypeAdmin'])->name('getProjectTypeAdmin');

    Route::post('/administration/getUserAccountsAdmin', [AdministrationsController::class, 'getUserAccountsAdmin'])->name('getUserAccountsAdmin');

    Route::post('/administration/getAttachmentsAdmin', [AdministrationsController::class, 'getAttachmentsAdmin'])->name('getAttachmentsAdmin');

    Route::post('/administration/getRoutingHistoryAdmin', [AdministrationsController::class, 'getRoutingHistoryAdmin'])->name('getRoutingHistoryAdmin');

    Route::post('/administration/getRequirementsAdmin', [AdministrationsController::class, 'getRequirementsAdmin'])->name('getRequirementsAdmin');

    Route::post('/administration/getProcessingTimeAdmin', [AdministrationsController::class, 'getProcessingTimeAdmin'])->name('getProcessingTimeAdmin');

    Route::post('/administration/adminUploadFile', [AdministrationsController::class, 'adminUploadFile'])->name('adminUploadFile');
    
    Route::post('/administration/eccDraftDataAdmin', [AdministrationsController::class, 'ECCDraftDataAdmin'])->name('ECCDraftDataAdmin');

    Route::get('/administration/ECCDraftCertficate', [AdministrationsController::class, 'ECCDraftCertficateAdmin'])->name('ECCDraftCertficateAdmin');

    Route::post('/administration/PageSaveAdmin', [AdministrationsController::class, 'PageSaveAdmin'])->name('PageSaveAdmin');
/// VIEW 

    Route::view('google_map', 'secured.create_applications.google_map');
    Route::view('draw_map', 'secured.create_applications.draw_map');

    Route::view('map', 'secured.create_applications.map');

    Route::view('search_project_type', 'secured.create_applications.search_project_type');

    Route::view('reviewer', 'secured.for_actions.reviewer');

    Route::view('{GUID}/map', 'secured.create_applications.clickable_map');

    Route::view('stepper', 'secured.new_applications_v3.application_tab');

    Route::view('admin', 'secured.manage_credentials.admin');

    Route::view('NIPAS', 'secured.create_applications.NIPAS');

    Route::view('login-crs', 'auth.login-crs');

    Route::view('preview', 'pdf.ecc_preview');

    // Route::view('ecc-draft-certificate', 'secured.for_actions.compose');

});