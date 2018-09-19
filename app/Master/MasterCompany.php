<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class MasterCompany extends Model
{
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = 'key';
}
