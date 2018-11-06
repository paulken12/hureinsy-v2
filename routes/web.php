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
    /* ------------------ RECRUIT ------------------*/

    Route::get('new/recruit', 'Recruit\RecruitController@create')->name('create.recruit');

    Route::post('store/recruit', 'Recruit\RecruitController@store')->name('store.recruit');

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

    Route::patch('profile/{profile}/address', 'Personnel\Profile\ProfileController@updateAddress');

    Route::patch('profile/{profile}/contact', 'Personnel\Profile\ProfileController@updateContact');

    Route::patch('profile/{profile}/emergency', 'Personnel\Profile\ProfileController@updateEmergency');

    Route::patch('profile/{profile}/medical', 'Personnel\Profile\ProfileController@updateMedical');

    Route::patch('profile/{profile}/experience', 'Personnel\Profile\ProfileController@updateExperience');

    /* ------------------ PERSONNEL LIST ------------------*/

    Route::get('/personnel', 'Personnel\Info\EmpBasicController@index')->name('personnel');

    /* ------------------ TEAM ------------------*/

    Route::get('/my-team', 'Personnel\Team\TeamController@index')->name('team');

    /* ------------------ CHANGE PASSWORD ------------------*/

    Route::get('change-password', 'Auth\ChangePasswordController@show')->name('change.password');

    Route::post('changing/password', 'Auth\ChangePasswordController@change')->name('changing.password');

});

    /* ------------------ CONFIRMATION ------------------*/

Route::post('/register/confirmed', 'Auth\RecruitConfirmationController@store')->name('recruit.confirmed')->middleware('auth');
Route::get('/register/confirm', 'Auth\RecruitConfirmationController@create')->name('recruit.confirm');

