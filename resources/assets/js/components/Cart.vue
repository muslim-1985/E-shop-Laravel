
<template>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <th>No</th>
        <th>name</th>
        <th>quantity</th>
        <th>price</th>
        <th>sum</th>
        <th>actions</th>
        </thead>
        <tbody>

        <tr v-for="(task,index) in tasks">
            <td>{{ index+1 }}</td>
            <td>{{ task.title }}</td>
            <td class="qty">
                <span @click="delQty(index)"> minus</span> {{ task.qty }} <span @click="addQty(index)"> plus</span>
            </td>
            <td>{{ task.price }}</td>
            <td>{{ task.sum }}</td>

            <td class="delete">
                <button @click="deleteTask(index)" type="button" class="btn btn-xs">Delete</button>
                </td>
            </tr>
        <tr>
            <td><strong>total: {{ total }}</strong></td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    import {EventBus} from '../bus'
export default {
    data() {
        return {
            errors: [],
            tasks: [],
            qty: 1,
        }
    },
    mounted() {
        this.readTasks();
    },
    //подписка на событие клика по кнопке "добавить в корзину" в компоненте Product
    //вызываем функцию перезагрузки корзины с помощью метода - события vue js created()
    // данное событие автоматически запускается после того как элементы корзины успешно прогрузяться
    created() {
        EventBus.$on('reloadCart', this.readTasks);
    },
    computed: {
        /* total price */
        total() {
            if(this.tasks.length > 0) {
                //"+" number because "sum" is object property is string
                return this.tasks.reduce((acc, cur) => +acc + +cur.sum, 0);
            }
        },
    },
    methods: {
        addQty(index) {
           axios.post('/cart/plusqty/'+ this.tasks[index].id)
               .then(response => {
                   this.readTasks();
               })
        },
        delQty(index) {
            axios.post('/cart/minusqty/'+ this.tasks[index].id)
                .then(response => {
                    this.readTasks();
                })
        },
        readTasks() {
            axios.get('/cart')
                    .then(response => {
                        this.tasks = response.data.tasks;
                    })
                    .catch(error => {
                        console.log('products not found');
                    });
        },
        deleteTask(index)
        {
                axios.delete('/cart/delete/' + this.tasks[index].id)
                    .then(response => {
                        this.tasks.splice(index, 1);
                        this.readTasks();
                    })
                    .catch(error => {
                        this.readTasks();
                    });

        }
    }
}
</script>
