<?php

namespace App\Http\Controllers\Attachment;

use App\AdminModels\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends AppController
{
    public function index ()
    {
        return view('attachment.index');
    }
    public function indexGetJson ()
    {
        //выводим только те продукты которые находятся в опубликованных категориях
        //сортируем их по дате публикации (выводим последние)
        //не более 9 единиц
        $products = Product::whereHas('category', function($query) {
            $query->where('approved', 1);
        })
            ->orderBy('created_at', 'desc')
            ->take(9)
            ->get();
        return response()->json(compact('products'),  200);
    }
    public function SearchProdutsByName ()
    {
        //используем метод родительского класса чтобы не было повторений
        return $this->GetProductsInApprovedCategory();
    }
}
