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
            <i>{{ $parent.requests[item].comment }}</i><br>

            <span class="info__note info__note--time"><i class="fa fa-clock-o"></i> {{ $parent.requests[item].updated_at|moment('DD.MM.YYYY') }}</span>
        </p>

        <div class="info">
            <p class="info__header">
                {{ $parent.requests[item].subject }}
            </p>

            <p class="info__description">
                {{ $parent.requests[item].description }}
            </p>

            <p class="info__note">
                <i class="fa fa-map-marker"></i> {{ $parent.requests[item].address }}
            </p>
        </div>

        <p v-for="photo in $parent.requests[this.item].photo" style="margin-top: 3em; display: block;">
            <a :href="photo" rel="gallery" class="fancybox"><img :src="photo" style="max-width: 100%;"></a>
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
            },
            open (e) {
              fancyBox(e.target, this.imageList);
            }
        }
    }
</script>