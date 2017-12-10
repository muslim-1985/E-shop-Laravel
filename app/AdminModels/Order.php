<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
               'qti' => 'array',
                'price'=>'array',
               'sum' => 'array',
               'status' => 'boolean',
            ];
    protected $fillable = [
            'customer_name', 'customer_email', 'customer_phone','qti','price','sum','status', 'total',
       ];
    public function products ()
    {
        return $this->belongsToMany('App\AdminModels\Product', 'orders_products', 'order_id', 'product_id');
    }

    public function customer ()
    {
        return $this->belongsTo('App\AdminModels\Customer','customer_id');
    }
}
