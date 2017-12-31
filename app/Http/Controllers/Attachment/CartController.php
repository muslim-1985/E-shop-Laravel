<?php

namespace App\Http\Controllers\Attachment;

use App\AdminModels\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends AppController
{
    public function CartShow ()
    {
        $products = session()->get('cart');
        //$request->session()->flush();
        //записываем текущую сессию в переменную и передаем ее во вью
        return view('attachment.layouts.partials._modal_body',compact('products'));
    }
    public function AddToCart (Request $request)
    {

        //сохраняем полученный продукт в сессии
        //используем метод push (а не put) так как put перезаписывает данные массива сессии
        //в то время как push добавляет данные к уже существующему массиву
        $request->session()->push('cart',$request->all());
        $products = session()->get('cart');
        //$request->session()->flush();
        //записываем текущую сессию в переменную и передаем ее во вью
        return response()->json(compact('products'), 200);
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
        return view('attachment.layouts.partials._modal_body',compact('products'));
    }

    public function DelQty ($id)
    {
        $products = session()->get('cart');
        //создаем ссылку на массив чтобы записать значения не в копию
        // а напрямую в оринальный массив (амперсанд перед массивом $value)
        foreach ($products as &$value) {
            if ($value['id'] == $id) {
                //прибавляем количество товара
                if ($value['qty'] > 1) {
                    $value['qty']--;
                }
                //в поле 'sum' изначальное значение которого стоимость товара
                //прибавляем стоимость товара так как количество его возросло на единицу
                if ($value['sum'] > $value['price']) {
                    $value['sum'] -= $value['price'];
                }
                break;
            }

        }
        //перезаписываем текущую сессию с новыми данными
        session()->put('cart',$products);
        return view('attachment.layouts.partials._modal_body',compact('products'));
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
        $products = session()->get('cart');
        return view('attachment.layouts.partials._modal_body',compact('products'));
    }

}
