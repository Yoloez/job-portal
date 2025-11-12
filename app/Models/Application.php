<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        // Define fillable attributes here
        'user_id',
        'status',
        'job_id',
        'cv'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function job()
    {
        return $this->belongsTo(JobVacancy::class);
    }
}
