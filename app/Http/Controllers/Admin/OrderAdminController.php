<?php

namespace App\Http\Controllers\Admin;

use App\AdminModels\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderAdminController extends Controller
{
    public function index ()
    {
        $orders = Order::with('products')->get();
        return view('admin.order.index',compact('orders'));
    }

    public function ApprovedOrder (Request $request,$id)
    {
            //выбмраем текущую категорию
            $order = Order::where('id',$id);
            //присваеваем чекбоксу значение отличное от нуля
            $br = $request->input('status')===null?false:true;
            //обновляем чекбокс
            $order->update(['status'=>$br]);
            return redirect('/admin/order');
    }

    public function show ($id)
    {
            $order = Order::find($id);
            return view('admin.order.show',compact('order'));
    }

    public function destroy($id)
    {
            $order = Order::find($id);
            $order->delete();
            return redirect('/admin/order');
    }
}
