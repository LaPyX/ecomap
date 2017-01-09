<template>
    <div class="page">
        <a href="#" class="close" @click.prevent="showMain" ></a>

        <h1 style="text-align: center; margin: 0 0 1em;">Новости</h1>

        <div class="news">
            <transition-group appear
                              v-bind:css="false"
                              v-on:enter="enter"
                              v-on:leave="leave"
                              v-on:beforeEnter="beforeEnter">
                <news-item v-for="(item, index) in news" :item="item" v-on:open="open" key="item.id" :data-index="item.id"></news-item>
            </transition-group>
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
            },
            beforeEnter: function (el) {
              el.style.opacity = 0
              el.style.top = -10
            },
            enter: function (el, done) {
              var delay = el.dataset.index * 150
              setTimeout(function () {
                Velocity(
                  el,
                  { opacity: 1, translateY: 10 },
                  { easing: 'easeOutExpo', duration: 1000 }
                )
              }, delay)
            },
            leave: function (el, done) {
                var delay = el.dataset.index * 150
                setTimeout(function () {
                    Velocity(
                        el,
                        { opacity: 0 },
                        { complete: done }
                  )
                }, delay)
            }
        },
        mounted() {
            this.$http.get('/news').then((response) => {
                this.news = response.body.news;
            });
        }
    }
</script>
