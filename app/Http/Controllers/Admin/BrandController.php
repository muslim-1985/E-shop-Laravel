<?php

namespace App\Http\Controllers\Admin;

use App\AdminModels\Brand;
use App\Http\Helpers\Contracts\SearchEngine;
use App\Jobs\ElasticSave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{

    public function index ()
    {
        $brands = Brand::with('products')->get();
        return view('admin.brand.index',compact('brands'));
    }

    public function ApprovedBrand (Request $request,$id)
    {
        //выбмраем текущую категорию
        $brand = Brand::where('id',$id);
        //присваеваем чекбоксу значение отличное от нуля
        $br = $request->input('approved')===null?false:true;
        //обновляем чекбокс
        $brand->update(['approved'=>$br]);
        return redirect('admin/brand');
    }


    public function create ()
    {
        $brands = Brand::all();

        return view('admin.brand.create',compact('brands'));
    }

    public function store (Request $request, SearchEngine $searchEngine)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
        ]);
        $brand = Brand::create($request->all());
        $indexArr = [
            'index' => 'brand',
            'type' => 'brand',
            'id' => $brand->id,
            'body' => [
                'title' => $brand->desc,
                'img' => $brand->img,
                'slug' => $brand->slug,
                'approved' => $brand->approved,
                'created_at' => $brand->created_at,
                'updated_at' => $brand->updated_at
            ]
        ];
        //откладываем в очередь
        ElasticSave::dispatch($indexArr);

        return redirect('admin/brand');
    }

    public function show ($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.show',compact('brand'));
    }

    public function edit (Brand $brand, $id)
    {
        $brands = Brand::all();
        $brand = Brand::find($id);
        return view('admin.brand.edit',compact('brand','brands'));
    }

    public function update (Request $request, $id)
    {
        $request->validate ([
            'title' => 'max:255',
            'slug' => 'required',
        ]);
        Brand::find($id)->update($request->all());
        return redirect('admin/brand');
    }

    public function destroy ($id)
    {
        Brand::find($id)->delete();
        return redirect('admin/brand');
    }
}
