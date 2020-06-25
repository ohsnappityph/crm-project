<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItems extends Model
{
    use SoftDeletes; 

    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
