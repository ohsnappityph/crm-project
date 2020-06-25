<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timesheet extends Model
{
    use SoftDeletes; 
    
    protected $guarded = [];

    public function attendance()
    {
        return $this->belongsTo('App\Attendance');
    }
}
