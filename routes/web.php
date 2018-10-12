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

use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/export', function () {
    return Excel::download(new \App\Exports\UsersExport(), 'users.xlsx');
});


/* ------------------ LOGIN SYSTEM ------------------*/

Route::group(['prefix'=>'raj-titans'], function ()
{
    Auth::routes();
});


/* ------------------ ADMINISTRATOR ------------------*/

Route::group(['middleware' => ['auth','role:titan']],function()
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

    // 


});

/* ------------------ PERSONNEL ------------------*/

Route::group(['middleware' => ['auth']],function()
{
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


    /* ------------------ PROFILE ------------------*/

    Route::get('profile/{profile}', 'Personnel\Profile\ProfileController@show')->name('profiles');

    /* ------------------ PERSONNEL LIST ------------------*/

    Route::get('/personnel', 'Personnel\Info\EmpBasicController@index')->name('personnel');

    /* ------------------ TEAM ------------------*/

    Route::get('/my-team', 'Personnel\Team\TeamController@index')->name('team');


    /* ------------------ PAF MANAGER ------------------ */

    Route::get('paf/search', 'Paf\RequestController@index')->name('paf.search');    

    Route::post('paf/search/result', 'Paf\RequestController@search')->name('paf.search.result');

    Route::get('paf/search/result/request/{emplid}', 'Paf\RequestController@show')->name('paf.search.result.show');    

    Route::post('paf/search/result/request/submit', 'Paf\RequestController@store')->name('paf.search.result.store');

    Route::get('paf/request/list/month={month}+year={year}', 'Paf\ReassessmentController@list')->name('paf.reassess.list');  

    Route::get('paf/request/show/{form}', 'Paf\ReassessmentController@show')->name('paf.reassess.list.show');

    Route::post('paf/request/show/store/{form}', 'Paf\ReassessmentController@store')->name('paf.reassess.list.store');

    /* ------------------ PAF HR ------------------ */ 

    Route::get('paf/assessment/list/month={month}+year={year}', 'Paf\AssessmentController@list')->name('paf.assessment.list');    

    Route::get('paf/assessment/list/show/{form}', 'Paf\AssessmentController@show')->name('paf.assessment.list.show'); 

    Route::post('paf/assessment/list/show/store', 'Paf\AssessmentController@assessment')->name('paf.assessment.list.store');

    /* ------------------ PAF EXECUTIVE------------------ */

    Route::get('paf/approval/list/month={month}+year={year}', 'Paf\ApprovalController@list')->name('paf.approval.list');

    Route::get('paf/approval/list/show/{form}', 'Paf\ApprovalController@show')->name('paf.approval.list.show');

    Route::post('paf/approval/list/store', 'Paf\ApprovalController@store')->name('paf.approval.list.store');

    /* ------------------ PAF USER ------------------ */

    Route::get('paf/my_request/list/month={month}+year={year}', 'Paf\UserPafController@list')->name('paf.myrequest.list');

    Route::get('paf/my_request/list/show/{form}', 'Paf\UserPafController@show')->name('paf.myrequest.list.show');

});

    /* ------------------ CONFIRMATION ------------------*/

Route::post('/register/confirmed', 'Auth\RecruitConfirmationController@store')->name('recruit.confirmed')->middleware('auth');
Route::get('/register/confirm', 'Auth\RecruitConfirmationController@create')->name('recruit.confirm');

