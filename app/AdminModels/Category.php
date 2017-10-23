<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products ()
    {
        return $this->hasMany('App\AdminModels\Product','cat_id');
    }
}
