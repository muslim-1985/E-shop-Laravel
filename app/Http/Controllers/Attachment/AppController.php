<?php

namespace App\Http\Controllers\Attachment;

use App\AdminModels\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class AppController extends Controller
{
    public function GetProductsInApprovedCategory (string $title)
    {
        //выборка по подтвержденными категориям + поиск
        $getAllProducts = Product::whereHas('category', function($query) {
            $query->where('approved', 1);
        })
            ->where('title', 'LIKE', "%".$title."%")
            ->get();
        return response()->json(compact('getAllProducts'),  200);
    }
}
