<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders ()
    {
        return $this->hasMany('App\AdminModels\Order','customer_id');
    }
}
