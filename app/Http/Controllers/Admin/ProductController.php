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
        $products = Product::with('tags','brand','category','orders')->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function create (Category $cat)
    {
        $tags = Tag::all();
        $rootCategories = $cat->rootCategory();

        $brands = Brand::all();
        return view('admin.product.create',compact('tags','rootCategories','brands'));
    }

    public function store (Request $request) {
        $request->validate ([
            'title' => 'required|max:255',
            'desc' => 'required',
        ]);
        //предварительная работа с чекбоксами и изображениями ведется в Http/Provides/AppServiceProvider
        $product = Product::create($request->all());

        if($request->input('tags')) {
            $product->tags()->sync($request->input('tags'));
        }

        //редирект на индексную страницу
        return redirect('/admin');
    }

    public function show($id)
    {
        $product = Product::find($id);
        $images = explode(' ', $product->img);
        return view('admin.product.show',compact('images','product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $tags = Tag::all();
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.edit', compact('product','categories', 'tags','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate ([
            'title' => 'max:255',
            'desc' => 'max:255',
        ]);

        $product = Product::find($id);

        $pr = new Product();
        //очистка папки на сервере перед обновлением
        $pr->ClearImageFiles($product->img);

//        $request->has('hit') ? $product->hit = 1:$product->hit = 0;
//        $request->has('new') ? $product->new = 1:$product->new = 0;

        //удаляем старые теги
        if($product->tags)
        {
            $product->tags()->detach();
            $product->tags()->delete();
        }
        //добавляем новые
        if($request->input('tags')) {
            $product->tags()->sync($request->input('tags'));
        }

        //обновляем таблицу и редиректим
        $product->update($request->all());
        return redirect('/admin');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->tags()->detach();
        $product->delete();
        return redirect('/admin');
    }

    //category filter function
    public function CategoryFilter($id)
    {
        $category = Category::find($id);
        return view('admin.product.category-filter',compact('category'));
    }
}
