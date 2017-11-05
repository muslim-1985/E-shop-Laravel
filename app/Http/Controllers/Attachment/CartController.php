<?php

namespace App\Http\Controllers\Attachment;

use App\AdminModels\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends AppController
{
    public function AddToCart ($id)
    {
        $cart = Product::find($id);
        dump($cart);
    }
}
