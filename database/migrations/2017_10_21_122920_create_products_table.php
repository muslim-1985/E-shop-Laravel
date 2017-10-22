<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('price');
            $table->text('desc');
            $table->text('img');
            $table->boolean('hit');
            $table->boolean('new');
            $table->boolean('approved');
            $table->integer('qti')->nullable();
            $table->integer('cat_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table){
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
