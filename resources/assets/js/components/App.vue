<template>
    <div>
        <div id="map"></div>
        <div class="header">
            <img src="/images/logo.png" title="Экологическая карта">

            <div class="navigation">
                <a href="#" @click.prevent="showMain">Главная</a>
                <a href="#" @click.prevent="about">О проекте</a>
                <a href="#">Эксперты</a>
                <a href="#">Контакты</a>
            </div>

            <div class="auth">
                <template v-if="!activeUser">
                    <a href="/login">Вход</a>
                </template>
                <template v-if="activeUser">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ activeUser }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/logout"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="/logout" method="POST" style="display: none;">

                                </form>
                            </li>
                        </ul>
                    </li>
                </template>
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
                <template v-if="!isMapShown()">
                    <div class="page">
                        <a href="#" class="close" @click.prevent="showMain" ></a>

                        <h1 style="text-align: center; margin: 0 0 1em;">О проекте</h1>
                        <p>
                            Президент России, лидер Общероссийского народного фронта Владимир Путин по итогам «Форума действий» ОНФ, выступил за создание общественной Интернет-карты, на который любой пользователь мог бы оставить сообщение и обозначить на ней незаконную свалку. В исполнении поручения Президента, Центр общественного мониторинга ОНФ по проблемам экологии и защиты леса в Год экологии (2017) запустил «Интерактивную карту незаконных свалок».
                        </p>

                        <h2 style="text-align: center; margin: 1em 0;">Партнёры:</h2>

                        <table style="width: 60%; margin: 0 auto;">
                            <tr>
                                <td style="text-align: center;"><img src="/images/ccrf.png" width=300></td>
                                <td style="text-align: center;"><img src="/images/russia-today.png"></td>
                            </tr>
                        </table>
                    </div>
                </template>
            </transition>
        </div>

        <div class="footer">
            <div class="pull-left">
                <img src="/images/logo_onf.png" title="Общероссийский народный фронт">

                <p class="credentials">
                    <strong>Интерактивная карта незаконных свалок</strong><br>
                    Проект Общероссийского Народного Фронта
                </p>
            </div>

            <div class="socials pull-right">
                Мы в соц. сетях: <img src="/images/socials.png" >
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
                activeUser: false
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
            closeForm() {
                this.state = null;
                this.item = null;
                this.busy = true;
                this.region = null;

                this.ymap.geoObjects.remove(this.placemark);
                this.placemark = null;
            },
            about() {
                this.page = true;
            },
            showMain() {
                this.page = null;
            }
        },
        mounted() {
            ymaps.ready(init);

            this.getRequests();

            const parent = this;

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
                        point.__id = i++;//parent.requests[request].id;

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
                    var regions = result.geoObjects; // ссылка на коллекцию GeoObjectCollection

                    regions.each(function (reg) {
                        reg.options.set('preset', {
                            fillColor: '#E6EE9C',
                            opacity: 0.5
                        });
                    });


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