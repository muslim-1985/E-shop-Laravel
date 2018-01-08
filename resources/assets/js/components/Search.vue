<template>
    <div class="search_box pull-right">
        <input type="text" v-model="title" placeholder="Search"/>
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
        }
    }
</script>