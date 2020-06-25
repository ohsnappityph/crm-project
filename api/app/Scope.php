<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scope extends Model
{
    use SoftDeletes; 

    protected $guarded = [];

    public function order() 
    {
        return $this->belongsTo('App\Order');
    }
}
