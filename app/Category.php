<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function stocks()
    {
        return $this->hasMany('App\Stock');
    }
}
