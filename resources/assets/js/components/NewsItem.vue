<template>
    <transition name="slide-down">
        <div class="news__item">
            <a href="#" @click.prevent="open">{{ item.name }}</a>
        </div>
    </transition>
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
            open() {
                this.$emit('open', this.item);
            }
        },
    }
</script>