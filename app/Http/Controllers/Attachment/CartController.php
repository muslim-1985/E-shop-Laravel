<?php

namespace App\Http\Controllers\Attachment;

use App\AdminModels\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends AppController
{
    public function AddToCart (Request $request, $id)
    {
        $cart = Product::find($id);
        if (empty($cart)){
            return false;
        }
        session()->put('title',$cart->title);
        session()->put('price',$cart->price);
        session()->put('qti',$cart->qti);
        session()->save();
    }
}
