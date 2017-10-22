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

    //category filter function
    public function CategoryFilter ()
    {
        return true;
    }
}
