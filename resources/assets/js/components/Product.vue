<template>
<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <?php $images = explode(' ',$product->img) ?>
                <img src="{{asset("images/$images[0]" )}}" alt="" />
                <h2>{{ $product->price }}</h2>
                <p>{{ $product->title }}</p>
                <a href="#"
                   class="btn btn-default add-to-cart"
                   data-url="{{ route('front.add.cart',$product->id) }}"
                   data-id="{{ $product->id }}"
                   data-title="{{ $product->title }}"
                   data-price="{{ $product->price }}">

                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                </a>
            </div>
        </div>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
            </ul>
        </div>
    </div>
</div>
</template>
