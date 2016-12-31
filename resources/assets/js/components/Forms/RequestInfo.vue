<template>
    <div>
        <p class="status small text-danger" v-if="isStatusPending()">
            <i class="fa fa-info-circle" aria-hidden="true"></i> Обращение находится в стадии рассмотрения
        </p>

        <p class="status small text-warning" v-if="isStatusDelivered()">
            <i class="fa fa-hourglass" aria-hidden="true"></i> В работе
        </p>

        <p class="status small text-success" v-if="isStatusInProgress()">
            <i class="fa fa-check" aria-hidden="true"></i> Проблема решена
        </p>

        <p v-if="$parent.requests[item].comment" style="margin: 1em 0 2.5em;">
            <i>{{ $parent.requests[item].comment }}</i>
        </p>

        <p>
            <strong>{{ $parent.requests[item].subject }}</strong>
        </p>

        <p>
            {{ $parent.requests[item].description }}
        </p>
        <p>
            <b>Адрес:</b><br>{{ $parent.requests[item].address }}
        </p>

        <div class="list" v-for="(n, index) in $parent.requests[this.item].photo" :data-index="index" style="margin-top: 3em; display: block;">
            <img @click="open($event)" :src="n" style="max-width: 100%;">
        </div>

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
            },
            open (e) {
              fancyBox(e.target, this.imageList);
            }
        }
    }
</script>