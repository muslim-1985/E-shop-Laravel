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
                <a ref="cartBtn" href="#" @click.prevent="addProduct (index)"
                   :data-id = "product.id"
                   :data-title = "product.title"
                   :data-price = "product.price"
                   class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
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
    //импортируем общий класс для обмена данными
    import{EventBus} from '../bus';
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
                const id = this.products[index].id;
                const title = this.products[index].title;
                const price = this.products[index].price;
                const qty = 1;
                const sum = price;
                this.data = this.products[index];
               axios.post('/cart/add/'+this.products[index].id, {id, title, price, qty, sum})
                   .then(response => {
                       this.cartSessionInner = response.data.products;
                       //создаем событие для того чтобы его словил компонент корзины и вызвал коллбек перезагрузки
                       //событие передается через общий класс Vue который импортируется в оба компонента
                       //таким образом позволяя им обмениваться данными без прямого наследования (вызова дочернего компонента)
                       EventBus.$emit('reloadCart');
                   })
                   .catch(error => {
                       console.log('server error');
                   })
            }
        }
    }
</script>
