<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public function status()
    {
        return $this->belongsToMany(Status::class);
    }
    
    public function sub_status()
    {
        return $this->belongsToMany(SubStatus::class);
    }
}
