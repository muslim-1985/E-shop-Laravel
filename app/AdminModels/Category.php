<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title','desc','img','slug','approved','parent_id'];

    public function parent ()
    {
        return $this->belongsTo('App\AdminModels\Category','parent_id','id');
    }

    public function childs ()
    {
        return $this->hasMany('App\AdminModels\Category','parent_id','id');
    }

    public function products ()
    {
        return $this->hasMany('App\AdminModels\Product','cat_id');
    }
}
