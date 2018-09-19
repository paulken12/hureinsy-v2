<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class MasterCitizenship extends Model
{
    protected $table = 'master_citizenship';
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = 'key';
}
