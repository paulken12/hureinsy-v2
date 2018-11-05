<?php

namespace App;

use App\Contract\Job;
use App\Exports\UsersExport;
use App\Personnel\Info\EmpBasic;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Maatwebsite\Excel\Facades\Excel;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use Authorizable {
        LaratrustUserTrait::can insteadof Authorizable;
        Authorizable::can as laravelCan;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'verified'=>'boolean'
    ];

    public function basicInfo(){

        return $this->hasMany(EmpBasic::class);
    }
    /**
     * return if user has a image if null return default
     * @param $avatar
     * @return string
     */
    public function getAvatarPathAttribute($avatar){

        return $avatar ? asset('storage/'.$avatar) :  asset('images/avatars/guest.png');
    }

    /**
     * verified the user
     * delete the token
     * update table
     */
    public function verified() {


        $this->verified = true;

        $this->verification_token = null;

        $this->save();
    }

    /**
     * Check if the user is verified
     * @return mixed
     */
    public function confirmed() {

        return auth()->user()->verified;
    }
    
    public function export() {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }
}
