<?php

namespace App\Http\Controllers\Admin;

use App\AdminModels\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index ()
    {
        $orders = Order::with('products')->paginate(5);
        return view('admin.order.index', compact('orders'));
    }

    public function create ()
    {
        $cart = session()->get('cart');
        return view('attachment.order.create',compact('cart'));
    }

    public function store (Request $request) {
        $request->validate ([
            'customer_name' => 'required|max:255',
            'customer_email' => 'required',
            'customer_phone' => 'required',
//            'qti' => 'required',
//            'sum' => 'required',
        ]);
        //предварительная работа с чекбоксами ведется в Http/Provides/AppServiceProvider
        $order = Order::create($request->all());
        if($request->input('products')) {
            $order->products()->sync($request->input('products'));
        }
        //редирект на индексную страницу
        return redirect('/');
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('admin.order.show',compact('order'));
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

        $order = Order::find($id);

        //обновляем таблицу и редиректим
        $order->update($request->all());
        return redirect('/admin');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect('/admin');
    }
}
