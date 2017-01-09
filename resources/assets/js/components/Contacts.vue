<template>
    <div class="page">
        <a href="#" class="close" @click.prevent="showMain" ></a>

        <h1 style="text-align: center; margin: 0 0 1em;">Контакты</h1>

        <div v-html="text"></div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                text: null
            }
        },
        methods: {
            showMain() {
                this.$emit('show-main');
            }
        },
        mounted() {
            var parent = this;

            this.$http.get('/page?id=1').then((response) => {
                var page = response.body.page;

                parent.text = page.text;
            });
        }
    }
</script>