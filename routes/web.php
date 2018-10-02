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
    /* ------------------ RECRUIT ------------------*/

    Route::get('new/recruit', 'Recruit\RecruitController@create')->name('create.recruit');

    Route::post('store/recruit', 'Recruit\RecruitController@store')->name('store.recruit');

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

    Route::get('paf/request/list', 'Paf\ReassessmentController@list')->name('paf.reassess.list');  

    Route::get('paf/request/show/{form}', 'Paf\ReassessmentController@show')->name('paf.reassess.list.show');

    Route::post('paf/request/show/store/{form}', 'Paf\ReassessmentController@store')->name('paf.reassess.list.store');

    /* ------------------ PAF HR ------------------ */ 

    Route::get('paf/assessment/list', 'Paf\AssessmentController@list')->name('paf.assessment.list');    

    Route::get('paf/assessment/list/show/{form}', 'Paf\AssessmentController@show')->name('paf.assessment.list.show'); 

    Route::post('paf/assessment/list/show/store', 'Paf\AssessmentController@assessment')->name('paf.assessment.list.store');

    /* ------------------ PAF EXECUTIVE------------------ */

    Route::get('paf/approval/list', 'Paf\ApprovalController@list')->name('paf.approval.list');

    Route::get('paf/approval/list/show/{form}', 'Paf\ApprovalController@show')->name('paf.approval.list.show');

    Route::post('paf/approval/list/store', 'Paf\ApprovalController@store')->name('paf.approval.list.store');

    /* ------------------ PAF USER ------------------ */

    Route::get('paf/my_request/list', 'Paf\UserPafController@list')->name('paf.myrequest.list');

    Route::get('paf/my_request/list/show/{form}', 'Paf\UserPafController@show')->name('paf.myrequest.list.show');

});

    /* ------------------ CONFIRMATION ------------------*/

Route::post('/register/confirmed', 'Auth\RecruitConfirmationController@store')->name('recruit.confirmed')->middleware('auth');
Route::get('/register/confirm', 'Auth\RecruitConfirmationController@create')->name('recruit.confirm');

