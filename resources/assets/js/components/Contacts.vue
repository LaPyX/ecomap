<template>
    <div class="page">
        <a href="#" class="close" @click.prevent="showMain" ></a>

        <h1 style="text-align: center; margin: 0 0 1em;">Контакты</h1>
    </div>
</template>

<script>
    export default {
        methods: {
            showMain() {
                this.$emit('show-main');
            }
        }
    }
</script>