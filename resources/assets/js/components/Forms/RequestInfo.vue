<template>
    <div>
        <p>
            <b>Тема:</b><br>{{ $parent.requests[item].subject }}
        </p>
        <p>
            <b>Описание:</b><br>{{ $parent.requests[item].description }}
        </p>
        <p>
            <b>Адрес:</b><br>{{ $parent.requests[item].address }}
        </p>

        <p v-if="getImage">
            <img :src="getImage" style="max-width: 100%;">
        </p>

        <a href="#" class="btn btn-primary" v-on:click.prevent="hideForm" style="margin-top: 3em;">Закрыть</a>
    </div>
</template>

<script>
    export default {
        props: {
            item: {}
        },
        methods: {
            getImage() {
                return this.$parent.requests[item].photo ? '/images/requests/' + this.$parent.requests[item].photo : false;
            },
            hideForm() {
                this.$emit('close-form');
            }
        }
    }
</script>