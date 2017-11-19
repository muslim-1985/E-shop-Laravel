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

Route::get('/welcome', function () {
    return view('welcome');
});

//Backend routes
Route::namespace('Admin')->middleware('checkAdminRole')->group(function ()
{
    //Product CRUD routes
    Route::get('/admin','ProductController@index')->name('admin.home');
    Route::get('/admin/product/create', 'ProductController@create')->name('admin.prod.create');
    Route::post('/admin/product/store', 'ProductController@store')->name('admin.prod.store');
    Route::get('/admin/product/{id}','ProductController@show')->name('admin.prod.show');
    Route::get('/admin/product/{id}/edit','ProductController@edit')->name('admin.prod.edit');
    Route::patch('/admin/product/{id}', 'ProductController@update')->name('admin.prod.update');
    Route::delete('/admin/product/{id}','ProductController@destroy')->name('admin.prod.delete');
    //Category CRUD
    Route::get('/admin/category','CategoryController@index')->name('admin.category');
    Route::get('/admin/category/create', 'CategoryController@create')->name('admin.cat.create');
    Route::post('/admin/category/store', 'CategoryController@store')->name('admin.cat.store');
    Route::get('/admin/category/{id}','CategoryController@show')->name('admin.cat.show');
    Route::get('/admin/category/{id}/edit','CategoryController@edit')->name('admin.cat.edit');
    Route::patch('/admin/category/{id}', 'CategoryController@update')->name('admin.cat.update');
    Route::delete('/admin/category/{id}','CategoryController@destroy')->name('admin.cat.delete');
    //Brand CRUD
    Route::get('/admin/brand','BrandController@index')->name('admin.brand');
    Route::get('/admin/brand/create', 'BrandController@create')->name('admin.brand.create');
    Route::post('/admin/brand/store', 'BrandController@store')->name('admin.brand.store');
    Route::get('/admin/brand/{id}','BrandController@show')->name('admin.brand.show');
    Route::get('/admin/brand/{id}/edit','BrandController@edit')->name('admin.brand.edit');
    Route::patch('/admin/brand/{id}', 'BrandController@update')->name('admin.brand.update');
    Route::delete('/admin/brand/{id}','BrandController@destroy')->name('admin.brand.delete');

    //Tag CRUD vue js one page application
    Route::get('/admin/tag',function (){
        return view('admin.tag.index');
    })->name('admin.tag');
    Route::get('/admin/tag/view','TagController@index');
    Route::get('/admin/tag/create', 'TagController@create')->name('admin.tag.create');
    Route::post('/admin/tag/store', 'TagController@store')->name('admin.tag.store');
    Route::patch('/admin/tag/{id}', 'TagController@update')->name('admin.tag.update');
    Route::delete('/admin/tag/{id}','TagController@destroy')->name('admin.tag.delete');

    //обновление чекбокса публикации бренда
    Route::patch('/admin/brand/{id}/approve','BrandController@ApprovedBrand')->name('admin.brand.approved');
    //Brand filter
    Route::get('/admin/post/brand/{id}','BrandController@BrandFilter')->name('admin.brand.filter');

    //обновление чекбокса публикации категории
    Route::patch('/admin/category/{id}/approve','CategoryController@ApprovedCategory')->name('admin.cat.approved');
    //Category filter
    Route::get('/admin/post/category/{id}','ProductController@CategoryFilter')->name('admin.category.filter');
    Route::get('/admin/post/category/{id}/child','CategoryController@ParentCategoryFilter')->name('admin.parent.category.filter');
    //Tag filter
    Route::get('/admin/post/tag/{id}','TagController@TagFilter')->name('admin.tag.filter');
});

Auth::routes();
//frontend routes
Route::get('/home', 'HomeController@index')->name('home');
Route::namespace('Attachment')->group(function (){
    Route::get('/','SiteController@index')->name('front.main');
    Route::get('/cart/add/{id}','CartController@AddToCart')->name('front.add.cart');
    Route::get('/cart','CartController@GetCartData')->name('front.cart');
    Route::get('/cart/plusqty/{id}','CartController@AddQty')->name('front.add.qty');
    Route::get('/cart/ordering','CartController@Ordering')->name('ordering.cart');
    Route::delete('/cart/delete/{id}','CartController@DeleteCartData')->name('front.cart.delete');
});
