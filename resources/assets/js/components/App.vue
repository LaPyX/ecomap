<template>

    <div>
        <div id="map"></div>
        <div class="header">
            <img src="/images/logo.png" title="Экологическая карта">

            <div class="navigation">
                <a href="#" @click.prevent="showMain">Главная</a>
                <a href="#" @click.prevent="about">О проекте</a>
                <a href="#" @click.prevent="news">Новости</a>
                <a href="#" @click.prevent="contacts">Контакты</a>
            </div>

            <div class="select-region">
                Выберите регион:
                <select class="form-control" name="region_name" @change="selectRegionFromList">
                    <option v-for="(region, index) in regions"
                            :data-id="region.id"
                            :value="index">{{ region.name }}</option>
                </select>
            </div>
        </div>
        <div class="body">
            <transition name="slide-down">
                <div class="form" v-if="isFormShown()">
                    <a href="#" class="close" v-on:click.prevent="closeForm" ></a>

                    <transition name="slide-down" mode="out-in">
                        <loader v-if="loading"></loader>
                        <div class="thank-you" v-if="success">
                            <div>
                                <h1>Спасибо!</h1>
                                <p>Ваше сообщение успешно отправлено и будет рассмотрено в ближайшее время.</p>
                                <p>Нарушение отобразится на карте после проверки уполномоченными лицами.</p>
                            </div>
                        </div>
                    </transition>

                    <request-form v-on:success="successSent" :placemark="placemark" v-on:close-form="closeForm"></request-form>
                </div>

                <div class="form" v-if="isInfoShown()">
                    <a href="#" class="close" v-on:click.prevent="closeForm" ></a>

                    <request-info :item="item" v-on:close-form="closeForm"></request-info>
                </div>

                <div class="form" v-if="isRegionShown()">
                    <a href="#" class="close" v-on:click.prevent="closeForm" ></a>

                    <request-region :region="region" v-on:close-form="closeForm" v-on:create-request="showRequestForm"></request-region>
                </div>
            </transition>

            <transition name="slide-down">
                <template v-if="isAboutShown()">
                    <about v-on:show-main="showMain"></about>
                </template>
                <template v-if="isContactsShown()">
                    <contacts v-on:show-main="showMain"></contacts>
                </template>
                <template v-if="isExpertsShown()">
                    <experts v-on:show-main="showMain"></experts>
                </template>
                <template v-if="isNewsShown()">
                    <news v-on:show-main="showMain" v-on:open-news="openNews"></news>
                </template>
                <template v-if="isNewsItemShown()">
                    <news-show v-on:show-main="showMain" :item="newsItem" v-on:show-news="news"></news-show>
                </template>
            </transition>
        </div>

        <div class="footer">
            <div class="pull-left">
                <img src="/images/logo_onf.png" title="Общероссийский народный фронт">

                <p class="credentials">
                    <strong>Интерактивная карта свалок</strong><br>
                    Проект Общероссийского Народного Фронта
                </p>
            </div>

            <div class="socials pull-right">
                Мы в соц. сетях:

                <a href="https://vk.com/ecoonf" target="_blank"><img src="/images/vk.png" ></a>
                <a href="https://www.facebook.com/ecoonf/" target="_blank"><img src="/images/facebook.png" ></a>
                <a href="https://twitter.com/ecoonf" target="_blank"><img src="/images/twitter.png" ></a>
                <a href="https://ok.ru/ecoonf" target="_blank"><img src="/images/ok.png" ></a>
                <a href="https://www.youtube.com/channel/UCsjCX2e5ywz-arCPN6_C-tQ" target="_blank"><img src="/images/youtube.png" ></a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                page: null,
                loading: false,
                state: null,
                placemark: null,
                success: false,
                requests: [],
                item: null,
                busy: true,
                ymap: null,
                region: null,
                lastCollection: 0,
                lastActiveRegion: 0,
                activeUser: false,
                newsItem: null,
                regions: []
            }
        },
        methods: {
            showRequest() {},
            showRequestForm() {
                this.busy = false;
                this.state = 'form';
            },
            isFormShown() {
                return 'form' == this.state;
            },
            isInfoShown() {
                return 'info' == this.state;
            },
            isRegionShown() {
                return 'region' == this.state;
            },
            isAboutShown() {
                return 'about' == this.page;
            },
            isContactsShown() {
                return 'contacts' == this.page;
            },
            isExpertsShown() {
                return 'experts' == this.page;
            },
            isNewsShown() {
                return 'news' == this.page;
            },
            isNewsItemShown() {
                return 'news-show' == this.page;
            },
            isMapShown() {
                return null == this.page;
            },
            successSent() {
                this.success = true;
                const parent = this;
                setTimeout(function() {
                    parent.success = false;

                    setTimeout(function() {
                        parent.state = null;
                        parent.placemark = null;
                    }, 500);
                }, 4000);
            },
            getRequests() {
                this.$http.get('/requests/ajax').then((response) => {
                    var requests = response.body.requests;

                    this.requests = requests;
                }, (response) => {
                });
            },
            logout() {
                this.$http.post('/logout').then((response) => {
                    window.location.href = '/';
                });
            },
            closeForm() {
                this.state = null;
                this.item = null;
                this.busy = true;
                this.region = null;

                this.ymap.geoObjects.remove(this.placemark);
                this.placemark = null;
            },
            about() {
                this.page = 'about';
            },
            contacts() {
                this.page = 'contacts';
            },
            experts() {
                this.page = 'experts';
            },
            news() {
                this.page = 'news';
            },
            showMain() {
                this.page = null;
            },
            openNews(item) {
                this.page = 'news-show';
                this.newsItem = item;
            },
            selectRegionFromList(e) {
                if (this.lastActiveRegion) {
                    this.lastActiveRegion.options.set('preset', {
                        fillColor: '#E6EE9C',
                        opacity: 0.5
                    });
                }

                var region = this.regions[e.target.value].obj;
                region.options.set('preset', {
                    fillColor: 'rgba(0,0,0,0)',
                    strokeColor: '4CAF50',
                    strokeWidth: 3
                });

                this.lastActiveRegion = region;
                this.ymap.setBounds(region.geometry.getBounds());

                this.state  = 'region';
                this.region = this.regions[e.target.value].name;
            }
        },
        mounted() {
            ymaps.ready(init);

            this.getRequests();

            const parent = this;

            this.activeUser = user;

            function sortRegions(a, b) {
                return a.name.localeCompare(b.name);
            }

            function init(){
                parent.ymap = new ymaps.Map ("map", {
                    center: [55.76, 37.64],
                    zoom: 5
                });

                parent.ymap.controls.add(
                    new ymaps.control.ZoomControl()
                );
                parent.ymap.behaviors.enable('scrollZoom');

                parent.ymap.events.add('click', function (e) {

                });

                setTimeout(function() {
                    var i = 0;
                    for (var request in parent.requests) {
                        var image = 'pointer_pending.png'
                        if (1 == parent.requests[request].status) {
                            image = 'pointer_pending.png';
                        }
                        if (2 == parent.requests[request].status) {
                            image = 'pointer_in_progress.png';
                        }
                        if (3 == parent.requests[request].status) {
                            image = 'pointer_done.png';
                        }

                        var point = new ymaps.Placemark(parent.requests[request].map_point, {}, {
                            iconImageHref: '/images/' + image,
                            iconImageSize: [32, 32],
                            iconImageOffset: [-16, -32]
                        });
                        point.__id = i++;

                        point.events.add('click', function (event) {
                            point = event.get('target');
                            parent.state = 'info';
                            parent.item = point.__id;
                            parent.busy = true;
                        });

                        parent.ymap.geoObjects.add(point);
                    }
                }, 1000);

                ymaps.regions.load('RU', {
                    lang: 'ru',
                    quality: 1
                }).then(function (result) {
                    var regions = result.geoObjects;

                    regions.each(function (reg) {
                        parent.regions.push({ id: reg.properties.get('osmId'), name: reg.properties.get('name'), obj: reg });

                        reg.options.set('preset', {
                            fillColor: '#E6EE9C',
                            opacity: 0.5
                        });
                    });

                    parent.regions.sort(sortRegions);

                    regions.events.add('click', function (event) {
                        var target = event.get('target');

                        if ('form' == parent.state) {
                            if (parent.busy) {
                                return false;
                            }

                            if (null !== parent.placemark) {
                                parent.ymap.geoObjects.remove(parent.placemark);
                            }

                            parent.placemark = new ymaps.Placemark(event.get('coordPosition'), {}, {
                                iconImageHref: '/images/pointer_inactive.png',
                                iconImageSize: [32, 32],
                                iconImageOffset: [-16, -32]
                            });
                            parent.ymap.geoObjects.add(parent.placemark);
                            parent.region = target.properties.get('name');
                            return;
                        }

                        if (parent.lastActiveRegion) {
                            parent.lastActiveRegion.options.set('preset', {
                                fillColor: '#E6EE9C',
                                opacity: 0.5
                            });
                        }
                        parent.lastActiveRegion = target;
                        parent.lastActiveRegion.options.set('preset', {
                            fillColor: 'rgba(0,0,0,0)',
                            strokeColor: '4CAF50',
                            strokeWidth: 3
                        });

                        var coord = event.get('coordPosition');
                        parent.ymap.setCenter(coord);

                        parent.state = 'region';
                        parent.region = target.properties.get('name');
                    });

                    parent.ymap.geoObjects.add(regions);
                }, function () {

                });
            }
        }
    }
</script>