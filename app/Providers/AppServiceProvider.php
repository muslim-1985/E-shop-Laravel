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
            //функция записывает преобразованную и хешированную (из входящего массива) строку с файлами в
            //публичное свойство images модели Product
            $model->SaveImages($model->img);
            //добавляем это свойство с названиями и путями файлов
            //к свойству img (столбцу в БД)
            $model->img = $model->images;
            //проверка и запись чекбоксов
            $model->hit = $model->hit === null ? false:true;
            $model->new = $model->new === null ? false:true;

        });
        //триггер обновления
        Product::updating(function ($model){
            $model->SaveImages($model->img);
            $model->img = $model->images;

            //проверка и запись чекбоксов
            $model->hit = $model->hit === null ? false:true;
            $model->new = $model->new === null ? false:true;

            //удаляем старые теги
            if($model->tags)
            {
                $model->tags()->detach();
                $model->tags()->delete();
            }

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
