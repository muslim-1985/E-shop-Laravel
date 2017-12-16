<?php

namespace Tests\Feature;

use App\AdminModels\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductAdminViewsTest extends TestCase
{
    //отключаем аутентификацию чтобы пройти тесты на возврат данных
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRedirectProductAdmin()
    {
        $route = $this->get('/admin');
        $route->assertStatus(200);
    }

    public function testViewIndexTableProductAdmin()
    {
        $responce = $this->get('/admin');
        $responce->assertViewIs('admin.product.index');
        $responce->assertViewHas('products');
    }

    public function testViewCreateProductAdmin()
    {
        $responce = $this->get('/admin/product/create');
        $responce->assertViewIs('admin.product.create');
        $responce->assertViewHas(compact('tags','rootCategories','brands'));
    }

    public function testViewEditProductAdmin ()
    {
        $firstProduct = Product::first();

        $responce = $this->get(route('admin.prod.edit',$firstProduct->id));


        $responce->assertViewIs('admin.product.edit');
        $responce->assertViewHas(compact('product','categories', 'tags','brands'));
    }
}
