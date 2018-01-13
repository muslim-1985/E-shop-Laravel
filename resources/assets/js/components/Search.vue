<template>
    <div class="search_box pull-right">
        <input type="text" v-model="title" @change="changeInputSearch" placeholder="Search"/>
        <h4>{{ title }}</h4>
    </div>
</template>
<script>
    //импортируем общий класс для обмена данными
    import{EventBus} from '../bus';
    export default {
        data() {
            return {
                title: ''
            }
        },
        methods: {
            changeInputSearch () {
                 EventBus.$emit('changeInput', this.title);
            }
        }
    }
</script>