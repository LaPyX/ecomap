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

            <a href="#" @click.prevent="prevPage" v-if="prev_page">Предыдущая страница</a>
            <a href="#" @click.prevent="nextPage" v-if="next_page">Следующая страница</a>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                news: [],
                next_page: null,
                prev_page: null
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
            },
            nextPage: function() {
                this.$http.get(this.next_page).then((response) => {
                    this.news      = response.body.news.data;
                    this.next_page = response.body.news.next_page_url;
                    this.prev_page = response.body.news.prev_page_url;
                });
            },
            prevPage: function() {
                this.$http.get(this.prev_page).then((response) => {
                    this.news      = response.body.news.data;
                    this.next_page = response.body.news.next_page_url;
                    this.prev_page = response.body.news.prev_page_url;
                });
            }
        },
        mounted() {
            this.$http.get('/news').then((response) => {
                this.news      = response.body.news.data;
                this.next_page = response.body.news.next_page_url;
                this.prev_page = response.body.news.prev_page_url;
            });
        }
    }
</script>
