<?php

namespace App\Providers;

use App\AdminModels\Brand;
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
            //метод подготавливает изображения: хеширует, перемещает в папку,
            // преобразовывает входящий массив в строку
            $model->img = $model->PreparedImages($model->img);
            //проверка и запись чекбоксов
            $model->hit = $model->hit === null ? false:true;
            $model->new = $model->new === null ? false:true;

        });

        //триггер обновления
        Product::updating(function ($model){
            $model->img = $model->PreparedImages($model->img);
            //чекбоксы не проверяем, используем скрытое поле во вьюшке со значением "0"
            //и таким же именем столбца так как в Request::all() если чекбокс не выставлен он просто не попадает
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

        Category::creating(function ($model){
            if (isset($model->img)) {
                $imageName = $model->img->store('cat-img');
                $model->img = $imageName;
            }
            $model->approved = $model->approved === null ? false:true;
        });
        Category::updating(function($model){
            if ($model->img) {
                $imageName = $model->img->store('cat-img');
                $model->img = $imageName;
            }
        });

        Category::deleted(function ($model){
            @unlink(public_path("images/$model->img"));
        });

        Brand::creating(function ($model){
            if (isset($model->img)) {
                $imageName = $model->img->store('brand-img');
                $model->img = $imageName;
            }
            $model->approved = $model->approved === null ? false:true;
        });
        Brand::updating(function($model){
            if ($model->img) {
                $imageName = $model->img->store('brand-img');
                $model->img = $imageName;
            }
        });

        Category::deleted(function ($model){
            @unlink(public_path("images/$model->img"));
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
