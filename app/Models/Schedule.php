<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branches::class, 'branch_id');
    }
    
}
