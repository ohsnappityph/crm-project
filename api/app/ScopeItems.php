<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


class ScopeItems extends Model
{
    use SoftDeletes; 

    protected $guarded = [];

    public function scope()
    {
        return $this->belongsTo('App\Scope');
    }

    public function item()
    {
        return $this->belongsTo('App\Items');
    }
}
