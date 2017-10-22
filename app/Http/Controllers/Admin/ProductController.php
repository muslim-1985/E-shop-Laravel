<?php

namespace App\Http\Controllers\Admin;

use App\AdminModels\Brand;
use App\AdminModels\Category;
use App\AdminModels\Product;
use App\AdminModels\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index ()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create ()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create',compact('tags','categories','brands'));
    }

    public function store (Request $request) {
        $request->validate ([
            'title' => 'required|max:255',
            'desc' => 'required',
        ]);
        //предвариетельная работа с чекбоксами и изображениями ведеться в Http/Provides/AppServiceProvider
        $product = Product::create($request->all());

        if($request->input('tags')) {
            $product->tags()->sync($request->input('tags'));
        }

        //редирект на индексную страницу
        return redirect('/admin');
    }


    //category filter function
    public function CategoryFilter ()
    {
        return true;
    }
}
