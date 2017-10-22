<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'desc','slug','price','cat_id', 'img','approved','hit','new','qti',];

    //before save multiple upload images function in Http/Providers/AppServiceProvider


    public function category ()
    {
        return $this->belongsTo('App\AdminModels\Category','cat_id');
    }

    public function brand ()
    {
        return $this->belongsTo('App\AdminModels\Brand','brand_id');
    }

    public function tags ()
    {
        return $this->belongsToMany('App\AdminModels\Tag', 'products_tags', 'product_id', 'tag_id');
    }

    public function orders ()
    {
        return $this->belongsToMany('App\AdminModels\Order', 'orders_products', 'product_id', 'order_id');
    }

}
