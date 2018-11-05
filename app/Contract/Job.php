<?php

namespace App\Contract;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
