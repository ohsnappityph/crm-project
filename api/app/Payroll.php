<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use SoftDeletes; 

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
