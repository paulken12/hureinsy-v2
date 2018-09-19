<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class MasterExtension extends Model
{
    protected $guarded = [];
    public $incrementing = false;
    protected $primaryKey = 'key';
}
