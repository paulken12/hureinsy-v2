<?php

namespace App\Personnel\Info;

use App\Master\MasterAddressType;
use Illuminate\Database\Eloquent\Model;

class EmpAddress extends Model
{
    protected $guarded = [];

    public function basicInfo()
    {
        return $this->belongsTo(EmpBasic::class);
    }

    public function address() {
        return $this->belongsTo(MasterAddressType::class, 'master_address_key');
    }

    public function getAddressAttribute() {
        return  $this->address()->pluck('address_type')->first();
    }
}
