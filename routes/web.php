<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Backend routes
Route::namespace('Admin')->middleware('auth')->group(function ()
{
    //Product CRUD routes
    Route::get('/admin','ProductController@index')->name('admin.home');
    Route::get('/admin/product/create', 'ProductController@create')->name('admin.prod.create');
    Route::post('/admin/product/store', 'ProductController@store')->name('admin.prod.store');
    Route::get('/admin/product/{id}','ProductController@show')->name('admin.product.show');
    Route::get('/admin/product/{id}/edit','ProductController@edit')->name('admin.prod.edit');
    Route::patch('/admin/product/{id}', 'ProductController@update')->name('admin.prod.update');
    Route::delete('/admin/product/{id}','ProductController@destroy')->name('admin.prod.delete');
    //Category filter
    Route::get('/admin/post/category/{id}','ProductController@CategoryFilter')->name('admin.category.filter');
    //Tag filter
    Route::get('/admin/post/tag/{id}','TagController@TagFilter')->name('admin.tag.filter');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
