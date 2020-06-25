<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentItems extends Model
{
    use SoftDeletes; 

    protected $guarded = [];

    public function payment()
    {
        return $this->belongsTo('App\Payments');
    }
}
