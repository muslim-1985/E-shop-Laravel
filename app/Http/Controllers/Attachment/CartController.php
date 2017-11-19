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
        return response(session()->get('cart'));
    }

    public function AddQty ($id)
    {
        $products = session()->get('cart');
        //создаем ссылку на массив чтобы записать значения не в копию
        // а напрямую в оринальный массив (амперсанд перед массивом $value)
        foreach ($products as &$value) {
            if ($value['id'] == $id) {
                //прибавляем количество товара
                $value['qty']++;
                //в поле 'sum' изначальное значение которого стоимость товара
                //прибавляем стоимость товара так как количество его возросло на единицу
                $value['sum'] += $value['price'];
                break;
            }

        }
        //перезаписываем текущую сессию с новыми данными
        $prodNew = session()->put('cart',$products);
        return response(var_dump($prodNew[0]['qty']));
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

    public function DeleteCartData ($id)
    {
        $cartData = session()->get('cart');
        foreach ($cartData as $key => $value) {
            if($value['id'] == $id) {
                unset($cartData[$key]);
            }
        }
        session()->put('cart',$cartData);
        return redirect()->back();
    }
}
