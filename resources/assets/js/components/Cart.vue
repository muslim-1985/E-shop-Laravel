
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
            <td>1 </td>
            <td>{{ task.price }}</td>

            <td>
                <button @click="deleteTask(index)" type="button" class="btn btn-xs">Delete</button>
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
            tasks: []
        }
    },
    mounted() {
        this.readTasks();
    },
    methods: {
        readTasks() {
            axios.get('http://test/cart')
                    .then(response => {
                        this.tasks = response.data.tasks;
                        this.readTasks();
                    })
                    .catch(error => {
                        alert('error');
                    });
        },
        deleteTask(index)
        {
                axios.delete('/cart/delete/' + this.tasks[index].id)
                    .then(response => {

                        this.tasks.splice(index, 1);

                    })
                    .catch(error => {

                    });
        }
    }
}
</script>