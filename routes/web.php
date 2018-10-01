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

Route::group(['middleware' => ['auth','role:titan|admin']],function()
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

});

    /* ------------------ CONFIRMATION ------------------*/

Route::post('/register/confirmed', 'Auth\RecruitConfirmationController@store')->name('recruit.confirmed')->middleware('auth');
Route::get('/register/confirm', 'Auth\RecruitConfirmationController@create')->name('recruit.confirm');

