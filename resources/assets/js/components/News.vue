<template>
    <div class="page">
        <a href="#" class="close" @click.prevent="showMain" ></a>

        <h1 style="text-align: center; margin: 0 0 1em;">Новости</h1>

        <div class="news">
            <news-item v-for="item in news" :item="item" v-on:open="open"></news-item>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                news: []
            }
        },
        methods: {
            showMain() {
                this.$emit('show-main');
            },
            open(item) {
                this.$emit('open-news', item);
            }
        },
        mounted() {
            this.$http.get('/news').then((response) => {
                this.news = response.body.news;
            });
        }
    }
</script>
