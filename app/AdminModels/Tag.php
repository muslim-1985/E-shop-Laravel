<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function products ()
    {
        return $this->belongsToMany('App\AdminModels\Product', 'products_tags', 'tag_id', 'product_id');
    }
}
