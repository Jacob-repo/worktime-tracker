<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
    protected $fillable = ['employee_id', 'started_at', 'ended_at', 'work_day'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

