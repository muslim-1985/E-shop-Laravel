<?php

namespace App\Http\Controllers\Attachment;

use App\AdminModels\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends AppController
{
    public function AddToCart (Request $request)
    {

        //сохраняем полученный продукт в сессии
        //используем метод push (а не put) так как put перезаписывает данные массива сессии
        //в то время как push добавляет данные к уже существующему массиву
        $request->session()->push('cart',$request->all());
        //$request->session()->flush();
        //записываем текущую сессию в переменную и передаем ее во вью
        return var_dump(session()->get('cart'));//response(session()->get('cart'));
    }
    public function GetCartData ()
    {
        //получаем данные массива сессии
        $tasks = session()->get('cart');
        //отправляем их в обработчик на js vue js шаблон
        return response()->json([
            'tasks'    => $tasks,
        ], 200);
    }
    public function DeleteCartData (Request $request)
    {
        $cartData = $request->session()->get('cart');
        // foreach ($cartData as $key => $value) {
        //     if($value['id'] == $request->id) {
        //         unset($cartData[$key]);
        //     }
        // }
        $request->session()->push('cart',$cartData);
        return dump($request->id);//redirect()->back();
    }
}
