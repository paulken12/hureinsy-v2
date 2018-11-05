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
use Maatwebsite\Excel\Facades\Excel;

class Order{
    public $id;

    public function __construct($id) {
        $this->id = $id;
    }
}
Route::get('/', function () {
    return view('welcome');
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

Route::group(['middleware' => ['auth','role:titan|admin']],function()
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

    // 

    /* ------------------ REPORTS ------------------*/

    Route::get('/reports', 'Personnel\Report\ReportController@index')->name('reports');

    Route::post('/generate/report', 'Personnel\Report\ReportController@report')->name('generate.reports');

    /* ------------------ ATTENDANCE ------------------*/

    Route::get('/attendances', 'Attendance\Schedule\AttScheduleController@index')->name('attendances');

    Route::get('/employee/attendance', 'Attendance\Schedule\AttScheduleController@create')->name('employee.attendance');

    /* ------------------ ATTENDANCE ------------------*/

    Route::get('/import', 'Attendance\Raw\ImportRawController@index')->name('import');

    Route::post('/import/file', 'Attendance\Raw\ImportRawController@store')->name('import.file');
});

/* ------------------ PERSONNEL ------------------*/

Route::group(['middleware' => ['auth']],function()
{
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


    /* ------------------ PROFILE ------------------*/

    Route::get('profile/{profile}', 'Personnel\Profile\ProfileController@show')->name('profiles');

    Route::patch('profile/{profile}', 'Personnel\Profile\ProfileController@upadteAddress');

    /* ------------------ PERSONNEL LIST ------------------*/

    Route::get('/personnel', 'Personnel\Info\EmpBasicController@index')->name('personnel');

    /* ------------------ TEAM ------------------*/

    Route::get('/my-team', 'Personnel\Team\TeamController@index')->name('team');

    /* ------------------ PAF MANAGER ------------------ */

    Route::get('paf/search', 'Paf\RequestController@index')->name('paf.search');    

    Route::post('paf/search/result', 'Paf\RequestController@search')->name('paf.search.result');

    Route::get('paf/search/result/request/{emplid}', 'Paf\RequestController@show')->name('paf.search.result.show');    

    Route::post('paf/search/result/request/submit/{form}', 'Paf\RequestController@store')->name('paf.search.result.store');

    Route::get('paf/search/result/request/emergency/{form}', 'Paf\RequestController@create')->name('paf.search.result.create');    

    Route::get('paf/request/list/month={month}+year={year}', 'Paf\ReassessmentController@list')->name('paf.reassess.list');  

    Route::get('paf/request/show/{form}', 'Paf\ReassessmentController@show')->name('paf.reassess.list.show');

    Route::post('paf/request/show/store/{form}', 'Paf\ReassessmentController@store')->name('paf.reassess.list.store');

    /* ------------------ PAF HR ------------------ */ 

    Route::get('paf/assessment/list/month={month}+year={year}', 'Paf\AssessmentController@list')->name('paf.assessment.list');    

    Route::get('paf/assessment/list/show/{form}', 'Paf\AssessmentController@show')->name('paf.assessment.list.show'); 

    Route::post('paf/assessment/list/show/store/{form}', 'Paf\AssessmentController@assessment')->name('paf.assessment.list.store');

    /* ------------------ PAF EXECUTIVE------------------ */

    Route::get('paf/approval/list/month={month}+year={year}', 'Paf\ApprovalController@list')->name('paf.approval.list');

    Route::get('paf/approval/list/show/{form}', 'Paf\ApprovalController@show')->name('paf.approval.list.show');

    Route::post('paf/approval/list/store/{form}', 'Paf\ApprovalController@store')->name('paf.approval.list.store');

    /* ------------------ PAF SUPERVISOR------------------ */

    Route::get('paf/view/list/month={month}+year={year}', 'Paf\ViewPafController@list')->name('paf.view.list');

    Route::get('paf/view/list/show/{form}', 'Paf\ViewPafController@show')->name('paf.view.list.show');

    /* ------------------ PAF USER ------------------ */

    Route::get('paf/my_request/list/month={month}+year={year}', 'Paf\UserPafController@list')->name('paf.myrequest.list');

    Route::get('paf/my_request/list/show/{form}', 'Paf\UserPafController@show')->name('paf.myrequest.list.show');

    Route::get('paf/my_request/list/show/accept/{form}', 'Paf\UserPafController@store')->name('paf.myrequest.list.store');

    /* ------------------ CHANGE PASSWORD ------------------*/

    Route::get('change-password', 'Auth\ChangePasswordController@show')->name('change.password');

    Route::post('changing/password', 'Auth\ChangePasswordController@change')->name('changing.password');

});

    /* ------------------ CONFIRMATION ------------------*/

Route::post('/register/confirmed', 'Auth\RecruitConfirmationController@store')->name('recruit.confirmed')->middleware('auth');
Route::get('/register/confirm', 'Auth\RecruitConfirmationController@create')->name('recruit.confirm');

