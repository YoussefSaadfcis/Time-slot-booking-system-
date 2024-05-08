<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    //services belongs to branch 
    public function branch()
    {
        return $this->belongsTo(Branches::class);
    }
    //service has many schedule
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'service_id');
    }
}
