<?php

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

use App\Events\NotifyAdminUpdate;
use App\User;
use App\Events\PafEvent;
use Maatwebsite\Excel\Facades\Excel;
use App\Helper\Paf\PersonnelActionManagement;

class Order{
    public $id;

    public function __construct($id) {
        $this->id = $id;
    }
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notif', function() {
    PafEvent::dispatch(PersonnelActionManagement::get_employee_info(1));
});

Route::get('/update',function(){
    NotifyAdminUpdate::dispatch(new Order(4));
});

Route::get('/sample', function () {

    $user = User::find(auth()->user()->id)->first();

    $e = $user->basicInfo->pluck('id')->first();

    dd($e);
    return view('admin.role-management.role');
});

/* ------------------ LOGIN SYSTEM ------------------*/

Route::group(['prefix'=>'raj-titans'], function ()
{
    Auth::routes();
});


/* ------------------ ADMINISTRATOR ------------------*/

Route::group(['middleware' => ['auth','role:titan|admin|human resource','verified']],function()
{
    /* ------------------ RECRUIT ------------------ */

    Route::get('new/recruit', 'Recruit\RecruitController@create')->name('create.recruit');

    Route::post('store/recruit', 'Recruit\RecruitController@store')->name('store.recruit');

    /* ------------------ MASTERS ------------------ */

    // DEPARTMENTS

    Route::get('setting/masters/departments', 'Master\MasterDepartmenController@index')->name('setting.masters.departments');

    Route::post('setting/masters/departments/store', 'Master\MasterDepartmenController@store')->name('setting.masters.departments.store');

    Route::get('setting/masters/departments/edit={id}', 'Master\MasterDepartmenController@edit')->name('setting.masters.departments.edit');

    Route::post('setting/masters/departments/update={id}', 'Master\MasterDepartmenController@update')->name('setting.masters.departments.update');

    Route::get('setting/masters/departments/destroy={id}', 'Master\MasterDepartmenController@destroy')->name('setting.masters.departments.destroy');

    // TITLES

    Route::get('setting/masters/titles', 'Master\MasterJobTitleController@index')->name('setting.masters.titles');

    Route::post('setting/masters/titles/store', 'Master\MasterJobTitleController@store')->name('setting.masters.titles.store');

    Route::get('setting/masters/titles/edit={id}', 'Master\MasterJobTitleController@edit')->name('setting.masters.titles.edit');

    Route::post('setting/masters/titles/update={id}', 'Master\MasterJobTitleController@update')->name('setting.masters.titles.update');

    Route::get('setting/masters/titles/destroy={id}', 'Master\MasterJobTitleController@destroy')->name('setting.masters.titles.destroy');

    // COMPANIES

    Route::get('setting/masters/companies', 'Master\MasterCompanyController@index')->name('setting.masters.companies');

    Route::post('setting/masters/companies/store', 'Master\MasterCompanyController@store')->name('setting.masters.companies.store');

    Route::get('setting/masters/companies/edit={id}', 'Master\MasterCompanyController@edit')->name('setting.masters.companies.edit');

    Route::post('setting/masters/companies/update={id}', 'Master\MasterCompanyController@update')->name('setting.masters.companies.update');

    Route::get('setting/masters/companies/destroy={id}', 'Master\MasterCompanyController@destroy')->name('setting.masters.companies.destroy');

    // EMPLOYEE STATUS 
    
    Route::get('setting/masters/employeestatuses', 'Master\MasterEmpStatuController@index')->name('setting.masters.employeestatuses');

    Route::post('setting/masters/employeestatuses/store', 'Master\MasterEmpStatuController@store')->name('setting.masters.employeestatuses.store');

    Route::get('setting/masters/employeestatuses/edit={id}', 'Master\MasterEmpStatuController@edit')->name('setting.masters.employeestatuses.edit');

    Route::post('setting/masters/employeestatuses/update={id}', 'Master\MasterEmpStatuController@update')->name('setting.masters.employeestatuses.update');

    Route::get('setting/masters/employeestatuses/destroy={id}', 'Master\MasterEmpStatuController@destroy')->name('setting.masters.employeestatuses.destroy');

    // ADDRESS TYPES

    Route::get('setting/masters/address', 'Master\MasterAddressTypeController@index')->name('setting.masters.address');

    Route::post('setting/masters/address/store', 'Master\MasterAddressTypeController@store')->name('setting.masters.address.store');

    Route::get('setting/masters/address/edit={id}', 'Master\MasterAddressTypeController@edit')->name('setting.masters.address.edit');

    Route::post('setting/masters/address/update={id}', 'Master\MasterAddressTypeController@update')->name('setting.masters.address.update');

    Route::get('setting/masters/address/destroy={id}', 'Master\MasterAddressTypeController@destroy')->name('setting.masters.address.destroy');

    // BLOOD TYPES

    Route::get('setting/masters/blood', 'Master\MasterBloodTypController@index')->name('setting.masters.blood');

    Route::post('setting/masters/blood/store', 'Master\MasterBloodTypController@store')->name('setting.masters.blood.store');

    Route::get('setting/masters/blood/edit={id}', 'Master\MasterBloodTypController@edit')->name('setting.masters.blood.edit');

    Route::post('setting/masters/blood/update={id}', 'Master\MasterBloodTypController@update')->name('setting.masters.blood.update');

    Route::get('setting/masters/blood/destroy={id}', 'Master\MasterBloodTypController@destroy')->name('setting.masters.blood.destroy');

    // CIVIL

    Route::get('setting/masters/civil', 'Master\MasterCivilStatuController@index')->name('setting.masters.civil');

    Route::post('setting/masters/civil/store', 'Master\MasterCivilStatuController@store')->name('setting.masters.civil.store');

    Route::get('setting/masters/civil/edit={id}', 'Master\MasterCivilStatuController@edit')->name('setting.masters.civil.edit');

    Route::post('setting/masters/civil/update={id}', 'Master\MasterCivilStatuController@update')->name('setting.masters.civil.update');

    Route::get('setting/masters/civil/destroy={id}', 'Master\MasterCivilStatuController@destroy')->name('setting.masters.civil.destroy');

    // EDUCATION

    Route::get('setting/masters/education', 'Master\MasterEducationTypController@index')->name('setting.masters.education');

    Route::post('setting/masters/education/store', 'Master\MasterEducationTypController@store')->name('setting.masters.education.store');

    Route::get('setting/masters/education/edit={id}', 'Master\MasterEducationTypController@edit')->name('setting.masters.education.edit');

    Route::post('setting/masters/education/update={id}', 'Master\MasterEducationTypController@update')->name('setting.masters.education.update');

    Route::get('setting/masters/education/destroy={id}', 'Master\MasterEducationTypController@destroy')->name('setting.masters.education.destroy');

    // CITIZENSHIP

    Route::get('setting/masters/citizenship', 'Master\MasterCitizenshiController@index')->name('setting.masters.citizenship');

    Route::post('setting/masters/citizenship/store', 'Master\MasterCitizenshiController@store')->name('setting.masters.citizenship.store');

    Route::get('setting/masters/citizenship/edit={id}', 'Master\MasterCitizenshiController@edit')->name('setting.masters.citizenship.edit');

    Route::post('setting/masters/citizenship/update={id}', 'Master\MasterCitizenshiController@update')->name('setting.masters.citizenship.update');

    Route::get('setting/masters/citizenship/destroy={id}', 'Master\MasterCitizenshiController@destroy')->name('setting.masters.citizenship.destroy');

    // EXTENSION

    Route::get('setting/masters/extension', 'Master\MasterExtensionController@index')->name('setting.masters.extension');

    Route::post('setting/masters/extension/store', 'Master\MasterExtensionController@store')->name('setting.masters.extension.store');

    Route::get('setting/masters/extension/edit={id}', 'Master\MasterExtensionController@edit')->name('setting.masters.extension.edit');

    Route::post('setting/masters/extension/update={id}', 'Master\MasterExtensionController@update')->name('setting.masters.extension.update');

    Route::get('setting/masters/extension/destroy={id}', 'Master\MasterExtensionController@destroy')->name('setting.masters.extension.destroy');

    // FAMILY TYPE

    Route::get('setting/masters/family', 'Master\MasterFamilyTypController@index')->name('setting.masters.family');

    Route::post('setting/masters/family/store', 'Master\MasterFamilyTypController@store')->name('setting.masters.family.store');

    Route::get('setting/masters/family/edit={id}', 'Master\MasterFamilyTypController@edit')->name('setting.masters.family.edit');

    Route::post('setting/masters/family/update={id}', 'Master\MasterFamilyTypController@update')->name('setting.masters.family.update');

    Route::get('setting/masters/family/destroy={id}', 'Master\MasterFamilyTypController@destroy')->name('setting.masters.family.destroy');

    // CONTRACT CHANGE

    Route::get('setting/masters/contract', 'Master\MasterContractChaController@index')->name('setting.masters.contract');

    Route::post('setting/masters/contract/store', 'Master\MasterContractChaController@store')->name('setting.masters.contract.store');

    Route::get('setting/masters/contract/edit={id}', 'Master\MasterContractChaController@edit')->name('setting.masters.contract.edit');

    Route::post('setting/masters/contract/update={id}', 'Master\MasterContractChaController@update')->name('setting.masters.contract.update');

    Route::get('setting/masters/contract/destroy={id}', 'Master\MasterContractChaController@destroy')->name('setting.masters.contract.destroy');

    // SCHEDULE REQUEST

    Route::get('setting/masters/schedrequest', 'Master\MasterScheduleReqController@index')->name('setting.masters.schedrequest');

    Route::post('setting/masters/schedrequest/store', 'Master\MasterScheduleReqController@store')->name('setting.masters.schedrequest.store');

    Route::get('setting/masters/schedrequest/edit={id}', 'Master\MasterScheduleReqController@edit')->name('setting.masters.schedrequest.edit');

    Route::post('setting/masters/schedrequest/update={id}', 'Master\MasterScheduleReqController@update')->name('setting.masters.schedrequest.update');

    Route::get('setting/masters/schedrequest/destroy={id}', 'Master\MasterScheduleReqController@destroy')->name('setting.masters.schedrequest.destroy');


    /* ------------------ REPORTS ------------------*/

    Route::get('/reports', 'Personnel\Report\ReportController@index')->name('reports');

    Route::post('/generate/report', 'Personnel\Report\ReportController@report')->name('generate.reports');

    /* ------------------ ATTENDANCE ------------------*/

    Route::get('/attendances', 'Attendance\Schedule\AttScheduleController@index')->name('attendances');

    Route::get('/employee/attendance', 'Attendance\Schedule\AttScheduleController@create')->name('employee.attendance');

    Route::get('/employee/attendance/{id}', 'Attendance\Schedule\AttScheduleController@show')->name('employee.attendance.show');

    Route::post('/employee/attendance/store', 'Attendance\Schedule\AttScheduleController@store')->name('employee.attendance.store');

    /* ------------------ ATTENDANCE ------------------*/

    Route::get('/att', 'Attendance\AttImportController@index')->name('att');
    
    Route::post('/att/import', 'Attendance\AttImportController@import')->name('att.import');

    Route::get('/att/import/table{dtr_id}', 'Attendance\AttImportController@table')->name('att.import.table');

    /* ------------------ SIL Management ------------------*/

    Route::get('/sil', 'Attendance\SILManagementController@index')->name('sil');

    Route::patch('/sil/update/{id}', 'Attendance\SILManagementController@update')->name('sil.update');

    /* ------------------ DTR ------------------*/

    Route::get('/dtrlist', 'Attendance\DTR\MyDTR@list')->name('dtrlist');

    Route::get('/dtrlist/{dtr}', 'Attendance\DTR\MyDTR@index')->name('dtrlist.dtr');

    /* ------------------ HOLIDAY ------------------*/

    Route::get('/holiday', 'Attendance\Schedule\AttHolidayController@index')->name('holiday');

    Route::post('/holiday/store', 'Attendance\Schedule\AttHolidayController@store')->name('holiday.store');

    Route::delete('/holiday/delete/{id}', 'Attendance\Schedule\AttHolidayController@delete')->name('holiday.delete');

    /* ------------------ SHIFTS ------------------*/

    Route::get('/shift', 'Attendance\Schedule\AttShiftController@index')->name('shift');

    Route::post('/shift/store', 'Attendance\Schedule\AttShiftController@store')->name('shift');
    
    Route::delete('/shift/delete/{id}', 'Attendance\Schedule\AttShiftController@delete')->name('shift');

    /* ------------------ TASK ------------------*/
    
    Route::get('/att/task', 'Attendance\AttTaskController@index')->name('att.task');

    /* ------------------ FORMS ------------------*/
    //Official Business
    Route::get('/forms/ob', 'Attendance\AppriseForms\AttOBFormController@index')->name('forms.ob');

    Route::post('/forms/ob/store', 'Attendance\AppriseForms\AttOBFormController@store')->name('forms.ob.store');

    Route::patch('/forms/ob/update/{id}', 'Attendance\AppriseForms\AttOBFormController@update')->name('forms.ob.update');

    Route::get('/authorize/forms/ob', 'Attendance\AuthorizeForms\AttAuthorizeOBFormController@index')->name('authorize.forms.ob');

    Route::patch('/authorize/forms/ob/{id}', 'Attendance\AuthorizeForms\AttAuthorizeOBFormController@update')->name('authorize.forms.ob.update');

    //Time Validation
    Route::get('/forms/tv', 'Attendance\AppriseForms\AttTVFormController@index')->name('forms.tv');

    Route::post('/forms/tv/store', 'Attendance\AppriseForms\AttTVFormController@store')->name('forms.tv.store');

    Route::patch('/forms/tv/update/{id}', 'Attendance\AppriseForms\AttTVFormController@update')->name('forms.tv.update');

    Route::get('/authorize/forms/tv', 'Attendance\AuthorizeForms\AttAuthorizeTVFormController@index')->name('authorize.forms.tv');

    Route::patch('/authorize/forms/tv/{id}', 'Attendance\AuthorizeForms\AttAuthorizeTVFormController@update')->name('authorize.forms.tv.update');

    //Leave Form
    Route::get('/forms/leave', 'Attendance\AppriseForms\AttLeaveFormController@index')->name('forms.tv');

    Route::post('/forms/leave/store', 'Attendance\AppriseForms\AttLeaveFormController@store')->name('forms.tv.store');

    //Route::patch('/forms/leave/update/{id}', 'Attendance\AppriseForms\AttLeaveFormController@update')->name('forms.tv.update');
/*
    Route::get('/authorize/forms/leave', 'Attendance\AuthorizeForms\AttLeaveFormController@index')->name('authorize.forms.tv');

    Route::patch('/authorize/forms/leave/{id}', 'Attendance\AuthorizeForms\AttLeaveFormController@update')->name('authorize.forms.tv.update');*/

    //Change of Shift
    Route::get('/forms/cs', 'Attendance\AppriseForms\AttCSFormController@index')->name('forms.cs');

    Route::post('/forms/cs/store', 'Attendance\AppriseForms\AttCSFormController@store')->name('forms.cs.store');
    
    Route::patch('/forms/cs/update/{id}', 'Attendance\AppriseForms\AttCSFormController@update')->name('forms.cs.update');

    Route::get('/authorize/forms/cs', 'Attendance\AuthorizeForms\AttAuthorizeCSFormController@index')->name('authorize.forms.cs');

    Route::patch('/authorize/forms/cs/{id}', 'Attendance\AuthorizeForms\AttAuthorizeCSFormController@update')->name('authorize.forms.cs.update');

    //Early Timeout
    Route::get('/forms/et', 'Attendance\AppriseForms\AttETFormController@index')->name('forms.et');

    Route::post('/forms/et/store', 'Attendance\AppriseForms\AttETFormController@store')->name('forms.et.store');
    
    Route::patch('/forms/et/update/{id}', 'Attendance\AppriseForms\AttETFormController@update')->name('forms.et.update');

    Route::get('/authorize/forms/et', 'Attendance\AuthorizeForms\AttAuthorizeETFormController@index')->name('authorize.forms.et');

    Route::patch('/authorize/forms/et/{id}', 'Attendance\AuthorizeForms\AttAuthorizeETFormController@update')->name('authorize.forms.et.update');

    //Over Time
    Route::get('/forms/ot', 'Attendance\AppriseForms\AttOTFormController@index')->name('forms.ot');

    Route::post('/forms/ot/store', 'Attendance\AppriseForms\AttOTFormController@store')->name('forms.ot.store');
    
    Route::patch('/forms/ot/update/{id}', 'Attendance\AppriseForms\AttOTFormController@update')->name('forms.ot.update');

    Route::get('/authorize/forms/ot', 'Attendance\AuthorizeForms\AttAuthorizeOTFormController@index')->name('authorize.forms.ot');

    Route::patch('/authorize/forms/ot/{id}', 'Attendance\AuthorizeForms\AttAuthorizeOTFormController@update')->name('authorize.forms.ot.update');

    //Leave Form
    Route::get('/forms/lf', 'Attendance\AppriseForms\AttOTFormController@index')->name('forms.lf');

    Route::post('/forms/lf/store', 'Attendance\AppriseForms\AttOTFormController@store')->name('forms.lf.store');
    
    Route::patch('/forms/lf/update/{id}', 'Attendance\AppriseForms\AttOTFormController@update')->name('forms.lf.update');

    Route::get('/authorize/forms/lf', 'Attendance\AuthorizeForms\AttAuthorizeOTFormController@index')->name('authorize.forms.lf');

    Route::patch('/authorize/forms/lf/{id}', 'Attendance\AuthorizeForms\AttAuthorizeOTFormController@update')->name('authorize.forms.lf.update');

});

/* ------------------ PERSONNEL ------------------*/

Route::group(['middleware' => ['auth','verified']],function()
{
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


    /* ------------------ PROFILE ------------------*/

    Route::get('profile/{profile}', 'Personnel\Profile\ProfileController@show')->name('profiles');

    Route::patch('profile/{profile}/address', 'Personnel\Profile\ProfileController@updateAddress');

    Route::patch('profile/{profile}/contact', 'Personnel\Profile\ProfileController@updateContact');

    Route::patch('profile/{profile}/emergency', 'Personnel\Profile\ProfileController@updateEmergency');

    Route::patch('profile/{profile}/medical', 'Personnel\Profile\ProfileController@updateMedical');

    Route::patch('profile/{profile}/experience', 'Personnel\Profile\ProfileController@updateExperience');

    Route::patch('profile/{profile}/benefit', 'Personnel\Profile\ProfileController@updateBenefit');

//    Route::post('profile/{profile}/experience/insert', 'Personnel\Profile\ProfileController@storeExperience');

    Route::delete('profile/experience/{id}', 'Personnel\Profile\ProfileController@deleteExperience');
    
    Route::delete('profile/education/{id}', 'Personnel\Profile\ProfileController@deleteEducation');

    Route::delete('profile/family/{id}', 'Personnel\Profile\ProfileController@deleteFamily');

    Route::delete('profile/training/{id}', 'Personnel\Profile\ProfileController@deleteTraining');

    Route::delete('profile/reference/{id}', 'Personnel\Profile\ProfileController@deleteReference');

    Route::patch('profile/{profile}/education', 'Personnel\Profile\ProfileController@updateEducation');

    Route::patch('profile/{profile}/family', 'Personnel\Profile\ProfileController@updateFamily');

    Route::patch('profile/{profile}/objective', 'Personnel\Profile\ProfileController@updateObjective');

    Route::patch('profile/{profile}/reference', 'Personnel\Profile\ProfileController@updateReference');

    Route::patch('profile/{profile}/training', 'Personnel\Profile\ProfileController@updateTraining');

    Route::patch('profile/{profile}/benefit', 'Personnel\Profile\ProfileController@updateBenefit');

    Route::post('profile/{profile}/education/insert', 'Personnel\Profile\ProfileController@storeEducation');

    /* ------------------ PERSONNEL LIST ------------------*/

    Route::get('/personnel', 'Personnel\Info\EmpBasicController@index')->name('personnel');

    /* ------------------ TEAM ------------------*/

    Route::get('/my-team', 'Personnel\Team\TeamController@index')->name('team');

    /* ------------------ PAF MANAGER ------------------ */

    Route::get('paf/search', 'Paf\RequestController@index')->name('paf.search');   

    Route::post('paf/search/store', 'Paf\RequestController@store')->name('paf.search.store');  

    Route::get('paf/request/list', 'Paf\ReassessmentController@list')->name('paf.reassess.list');  

    Route::get('paf/request/list/show/{id}', 'Paf\ReassessmentController@show')->name('paf.reassess.list.show');

    Route::patch('paf/request/list/show/store/{id}', 'Paf\ReassessmentController@store')->name('paf.reassess.list.show.store');

    /* ------------------ PAF HR ------------------ */ 

    Route::get('paf/assessment/list', 'Paf\AssessmentController@list')->name('paf.assessment.list');    

    Route::get('paf/assessment/list/show/{id}', 'Paf\AssessmentController@show')->name('paf.assessment.list.show'); 

    Route::patch('paf/assessment/list/show/store/{id}', 'Paf\AssessmentController@assessment')->name('paf.assessment.list.show.store');

    /* ------------------ PAF EXECUTIVE------------------ */

    Route::get('paf/approval/list', 'Paf\ApprovalController@list')->name('paf.approval.list');

    Route::get('paf/approval/list/show/{id}', 'Paf\ApprovalController@show')->name('paf.approval.list.show');

    Route::patch('paf/approval/list/show/store/{id}', 'Paf\ApprovalController@store')->name('paf.approval.list.show.store');

    /* ------------------ PAF SUPERVISOR------------------ */

    Route::get('paf/view/list', 'Paf\ViewPafController@list')->name('paf.view.list');

    Route::get('paf/view/list/show/{id}', 'Paf\ViewPafController@show')->name('paf.view.list.show');

    /* ------------------ PAF USER ------------------ */

    Route::get('paf/my_request/list', 'Paf\UserPafController@list')->name('paf.myrequest.list');

    Route::get('paf/my_request/list/show/{id}', 'Paf\UserPafController@show')->name('paf.myrequest.list.show');

    Route::patch('paf/my_request/list/show/store/{id}', 'Paf\UserPafController@store')->name('paf.myrequest.list.show.store');

    /* ------------------ CHANGE PASSWORD ------------------*/

    Route::get('change-password', 'Auth\ChangePasswordController@show')->name('change.password');

    Route::post('changing/password', 'Auth\ChangePasswordController@change')->name('changing.password');

});

    /* ------------------ CONFIRMATION ------------------*/

Route::post('/register/confirmed', 'Auth\RecruitConfirmationController@store')->name('recruit.confirmed')->middleware('auth');
Route::get('/register/confirm', 'Auth\RecruitConfirmationController@create')->name('recruit.confirm');

