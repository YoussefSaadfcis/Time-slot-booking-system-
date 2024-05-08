<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->hasMany(Service::class);
    }
    //branch has many schedule
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'branch_id');
    }
}
