<template>
    <div class="page">
        <a href="#" class="close" @click.prevent="showMain" ></a>

        <h1 style="text-align: center; margin: 0 0 1em;">О проекте</h1>

        <div v-html="text"></div>

        <h2 style="text-align: center; margin: 1em 0;">Партнёры:</h2>

        <table style="width: 60%; margin: 0 auto;">
            <tr>
                <td style="text-align: center;"><img src="/images/ccrf.png" width=300></td>
                <td style="text-align: center;"><img src="/images/russia-today.png"></td>
            </tr>
        </table>
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

            this.$http.get('/page?id=2').then((response) => {
                var page = response.body.page;

                parent.text = page.text;
            });
        }
    }
</script>