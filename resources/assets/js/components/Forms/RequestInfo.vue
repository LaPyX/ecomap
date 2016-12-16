<template>
    <div>
        <p class="small text-danger" v-if="isStatusPending()">
            На рассмотрении
        </p>

        <p class="small text-info" v-if="isStatusDelivered()">
            Соответствующие органы осведомлены
        </p>

        <p class="small text-success" v-if="isStatusInProgress()">
            В работе
        </p>

        <p>
            <b>Тема:</b><br>{{ $parent.requests[item].subject }}
        </p>

        <p>
            <b>Описание:</b><br>{{ $parent.requests[item].description }}
        </p>
        <p>
            <b>Адрес:</b><br>{{ $parent.requests[item].address }}
        </p>

        <p v-if="getImage" style="margin-top: 3em; display: block;">
            <img :src="getImage()" style="max-width: 100%;">
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
            isStatusPending() {
                return 1 == parseInt(this.$parent.requests[this.item].status);
            },
            isStatusDelivered() {
                return 2 == parseInt(this.$parent.requests[this.item].status);
            },
            isStatusInProgress() {
                return 3 == parseInt(this.$parent.requests[this.item].status);
            },
            getImage() {
                return this.$parent.requests[this.item].photo ? this.$parent.requests[this.item].photo : false;
            },
            hideForm() {
                this.$emit('close-form');
            }
        }
    }
</script>