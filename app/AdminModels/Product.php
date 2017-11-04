<?php

namespace App\AdminModels;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'desc','slug','price','cat_id','brand_id', 'img','hit','new','qti',];
    //очистка папки на сервере перед обновлением
    public function ClearImageFiles (string $image)
    {
        $images = explode(' ',$image);

        foreach ($images as $img){
            @unlink(public_path("images/$img"));
        }
    }

    //before save multiple upload images function in Http/Providers/AppServiceProvider
    public function PreparedImages(array $img)
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
        //возвращаем подготовленную переменную с путями к файлам изображений для сохранения в БД
        return $images;
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
