<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class MasterDepartment extends Model
{
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = 'key';
}
