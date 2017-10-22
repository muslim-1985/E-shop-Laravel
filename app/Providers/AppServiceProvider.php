<?php

namespace App\Providers;

use App\AdminModels\Category;
use App\AdminModels\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //триггер сохранения изображений в папке на сервере перед сохранением в БД
        Product::creating(function ($model){
            //объявление переменной с пустым массивом для сохранения в нем данных с названиями файлов
            $arr=[];
            if($model->img) {
                foreach ($model->img as $image) {
                    //сохранение файлов в папке на сервере public/images(создаем папку) и присвоение им уникального имени
                    //перед сохранением обязательно меняем стандартный путь функции store() в файле config/filesystems.php
                    //'root'=>public_path('images')
                    $imageName = $image->store('image');
                    //сохрание файлов в массиве
                    $arr[] = $imageName;
                }
            }
            //преобразование массива снова в строку для сохранения в БД (в реляционных БД массивы не храняться)
            $images = implode(' ', $arr);
            //присвоение столбцу строки с файлами изображений разделенные пробелом
            $model->img = $images;
            //проверка и запись чекбоксов
            $model->hit = $model->hit === null ? false:true;
            $model->new = $model->new === null ? false:true;
            $model->approved = $model->approved === null ? false:true;

        });
        //триггер
        //удаление изображений из папки на сервере после удаления из БД
        Product::deleted(function($model){
            //конвертация данных из БД в массив
            $img = explode(' ', $model->img);
            //проходимся циклом по созданному массиву и удаляем все изображения
            // привязанные к модели из папки на сервере
            foreach ($img as $image) {
                //собачка вначале директивы позволяет не добавлять условный оператор проверки наличия файла перед удалением
                @unlink(public_path("images/$image"));
            }

        });

        //вызываем функцию доступа ко всем категориям из любого места
        \View::composer('admin.layouts.partials._nav', function ($view){

            $view->with('categories', Category::all());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
