<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
