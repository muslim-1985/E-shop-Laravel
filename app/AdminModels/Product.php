<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'desc','slug','price','cat_id', 'img','approved','hit','new','qti',];

    //публичное свойство для записи строки с файлами изображения вызывается в AppServiceProvider
    public $images;

    //before save multiple upload images function in Http/Providers/AppServiceProvider
    public function SaveImages(array $img)
    {
        //объявление переменной с пустым массивом для сохранения в нем данных с названиями файлов
        $arr=[];
            foreach ($img as $image) {
                //сохранение файлов в папке на сервере public/images(создаем папку) и присвоение им уникального имени
                //перед сохранением обязательно меняем стандартный путь функции store() в файле config/filesystems.php
                //'root'=>public_path('images')
                $imageName = $image->store('image');
                //сохрание файлов в массиве
                $arr[] = $imageName;
            }
        //преобразование массива снова в строку для сохранения в БД (в реляционных БД массивы не храняться)
        $images = implode(' ', $arr);
        //присвоение публичному свойству строки с файлами изображений разделенные пробелом
        $this->images = $images;
    }

    public function category ()
    {
        return $this->belongsTo('App\AdminModels\Category','cat_id');
    }

    public function brand ()
    {
        return $this->belongsTo('App\AdminModels\Brand','brand_id');
    }

    public function tags ()
    {
        return $this->belongsToMany('App\AdminModels\Tag', 'products_tags', 'product_id', 'tag_id');
    }

    public function orders ()
    {
        return $this->belongsToMany('App\AdminModels\Order', 'orders_products', 'product_id', 'order_id');
    }

}
