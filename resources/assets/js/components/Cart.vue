
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
                {{ task.qty }} <span @click="addQty(index)"> plus</span>
            </td>
            <td>{{ task.price }}</td>
            <td>{{ task.sum }}</td>

            <td class="delete">
                <button @click="deleteTask(task,index)" type="button" class="btn btn-xs">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            tasks: [],
            qty: 1
        }
    },
    mounted() {
        this.readTasks();
    },

    methods: {
        addQty(index) {
           axios.get('/cart/plusqty/'+ this.tasks[index].id)
               .then(response => {
                   this.readTasks();
               })
        },
        delQty() {
            if(this.qty <= 1){
                return
            }
             this.qty--
        },
        readTasks() {
            axios.get('/cart')
                    .then(response => {
                        this.tasks = response.data.tasks;
                    })
                    .catch(error => {
                        alert('error');
                    });
        },
        deleteTask(task,index)
        {
                axios.delete('/cart/delete/' + this.tasks[index].id)
                    .then(response => {
                        this.tasks.$remove(task);
                        this.readTasks();
                    })
                    .catch(error => {
                        this.readTasks();
                    });

        }
    }
}
</script>
