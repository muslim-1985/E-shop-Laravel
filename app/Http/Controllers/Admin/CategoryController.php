<?php

namespace App\Http\Controllers\Admin;

use App\AdminModels\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index ()
    {
        $categories = Category::with('childs')->get();
        return view('admin.category.index',compact('categories'));
    }

    public function ApprovedCategory (Request $request,$id)
    {
        //выбмраем текущую категорию
        $category = Category::where('id',$id);
        //присваеваем чекбоксу значение отличное от нуля
        $cat = $request->input('approved')===null?false:true;
        //обновляем чекбокс
        $category->update(['approved'=>$cat]);
        return redirect('admin/category');
    }


    public function create ()
    {
        $categories = Category::all();
        return view('admin.category.create',compact('categories'));
    }

    public function store (Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
        ]);
        Category::create($request->all());
        return redirect('admin/category');
    }

    public function show ($id)
    {
        $category = Category::find($id);
        return view('admin.category.show',compact('category'));
    }

    public function edit ($id)
    {
        $categories = Category::all();
        $category = Category::find($id);
        return view('admin.category.edit',compact('category','categories'));
    }

    public function update (Request $request, $id)
    {
        $request->validate ([
            'title' => 'max:255',
            'slug' => 'required',
        ]);
        Category::find($id)->update($request->all());
        return redirect('admin/category');
    }

    public function destroy ($id)
    {
        Category::find($id)->delete();
        return redirect('admin/category');
    }

    public function ParentCategoryFilter ($id)
    {
        $category = Category::find($id);
        return view('admin.category.parent-filter',compact('category'));
    }
}
