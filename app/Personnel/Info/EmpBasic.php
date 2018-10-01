<?php

namespace App\Personnel\Info;

use App\Master\MasterAddressType;
use App\Master\MasterCitizenship;
use App\Master\MasterCivilStatus;
use App\Master\MasterExtension;
use App\Master\MasterGender;
use App\User;
use App\Paf\PafNatureOfAction;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed reporting_to
 */
class EmpBasic extends Model
{
    protected $guarded = [];

    protected $dates = ['date_of_birth'];

    public function path() {
        return 'profile/'. $this->slug;
    }

    public function getFullNameAttribute()
    {
        return sprintf('%s %s',
            $this->first_name,
            $this->last_name
        );
    }

    /**
     * Get the route key name.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function contract() {
        return $this->hasMany(EmpContract::class);
    }

    public function address() {
        return $this->hasMany(EmpAddress::class);
    }

    public function contact() {
        return $this->hasMany(EmpContact::class);
    }

    public function benefit() {
        return $this->hasMany(EmpBenefit::class);
    }

    public function family() {
        return $this->hasMany(EmpFamily::class);
    }

    public function education() {
        return $this->hasMany(EmpEducation::class);
    }

    public function experience() {
        return $this->hasMany(EmpExperience::class);
    }

    public function training() {
        return $this->hasMany(EmpTraining::class);
    }

    public function criminalInfo() {
        return $this->hasMany(EmpConviction::class);
    }

    public function reference() {
        return $this->hasMany(EmpReference::class);
    }

    public function emergency() {
        return $this->hasMany(EmpEmergencyContact::class);
    }

    public function medical() {
        return $this->hasMany(EmpMedical::class);
    }

    public function skill() {
        return $this->hasMany(EmpSkill::class);
    }

    public function gender() {
        return $this->belongsTo(MasterGender::class, 'master_gender_key');
    }

    public function getGenderAttribute() {
        return  $this->gender()->pluck('gender')->first();
    }

    public function civilStatus() {
        return $this->belongsTo(MasterCivilStatus::class, 'master_civil_status_key');
    }

    public function getCivilStatusAttribute() {
        return  $this->civilStatus()->pluck('civil_status')->first();
    }

    public function citizenship() {
        return $this->belongsTo(MasterCitizenship::class, 'master_citizenship_key');
    }

    public function getCitizenshipAttribute() {
        return  $this->citizenship()->pluck('citizenship')->first();
    }

    public function extension() {
        return $this->belongsTo(MasterExtension::class, 'master_extension_key');
    }

    public function reportingTo() {
        if(!empty($this->reporting_to))
        {
            $reporting = User::find($this->reporting_to)->basicInfo->first();
            return $reporting->first_name." ".$reporting->last_name;
        }
        return "n/a";
    }

    public function reportToSlug() {

        if(!empty($this->reporting_to))
        {
            $report = User::find($this->reporting_to)->basicInfo->first();
            return $report->slug;
        }
        return $this->slug;

    }

    public function scopeLastId() {

        $user_id = EmpBasic::orderBy('id','desc')->first();
        return $user_id->company_id + 1;
    }

    public function isVerified($employee) {
        return $employee->user->verified === true ? true : false;
    }

    public function natureOfAction() {
        return $this->hasMany(PafNatureOfAction::class);
    }
}
