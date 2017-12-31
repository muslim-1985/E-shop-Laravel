<?php

namespace App\Http\Controllers\Attachment;

use App\AdminModels\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends AppController
{
    public function index ()
    {
        $products = Product::all();
        return view('attachment.index', compact('products'));
    }
    public function indexGetJson ()
    {
        $products = Product::all();
        return response()->json(compact('products'),  200);
    }
}
