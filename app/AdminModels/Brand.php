<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function products ()
    {
        return $this->hasMany('App\AdminModels\Product','brand_id');
    }
}
