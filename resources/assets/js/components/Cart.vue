
<template>
    <table class="table table-bordered table-striped table-responsive">
        <thead>
        <th>No</th>
        <th>name</th>
        <th>quantity</th>
        <th>price</th>
        <th>actions</th>
        </thead>
        <tbody>

        <tr v-for="(task,index) in tasks">
            <td>{{ index+1 }}</td>
            <td>{{ task.title }}</td>
            <td class="qty">
                <span @click="addQty()">plus  </span>{{ qty }} <span @click="delQty()">  minus</span>
                <input type="hidden" name="qty" v-model="qty">
            </td>
            <td>{{ task.price }}</td>

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
    creating() {
      this.readTasks();
    },
    methods: {
        addQty() {
           return this.qty++
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
                    })
                    .catch(error => {
                          alert('error from delete');
                    });
        }
    }
}
</script>
