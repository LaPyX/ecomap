<template>
    <div class="page">
        <a href="#" class="close" @click.prevent="showMain" ></a>

        <h1 style="text-align: center; margin: 0 0 1em;">{{ item.name }}</h1>

        <a href="#" @click.prevent="showNews" style="font-size: .9em; margin-bottom: 2em; display: block;">Вернуться к новостям</a>

        <div class="news" v-html="item.text"></div>
    </div>
</template>

<script>
    export default {
        props: {
            item: {}
        },
        methods: {
            showMain() {
                this.$emit('show-main');
            },
            showNews() {
                this.$emit('show-news');
            }
        },
    }
</script>
