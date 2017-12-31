<template>
<div class="features_items"><!--features_items-->
<h2 class="title text-center">Features Items</h2>
<div class="col-sm-4"  v-for="(product, index) in products">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <img :src="'/images/' +product.img.split(' ')[0]" alt="no image" />
                <h2>{{ product.price }}</h2>
                <p>{{  product.title }}</p>
                <a href="#" @click="addProduct (index)" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
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
</div>
</template>
<script>
    export default {
        data() {
            return {
                errors: [],
                products: [],
                cartSessionInner: [],
                data: {}
            }
        },
        mounted() {
            this.showProducts();
        },
        methods: {
            showProducts() {
                axios.get('/parse')
                    .then(response => {
                        this.products = response.data.products;
                    })
                    .catch(error => {
                        alert('error');
                    });
            },
            addProduct (index) {
                this.data = this.products[index];
               axios.get('/cart/add/'+this.products[index].id, this.data)
                   .then(response => {
                       this.cartSessionInner = response.data.products;
                       console.log(this.cartSessionInner);
                   })
                   .catch(error => {
                       console.log('server error');
                   })
            }
        }
    }
</script>
