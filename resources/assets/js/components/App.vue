<template>
    <div>
        <div id="map"></div>
        <div class="header">
            <div class="container">
                Logo
                <a href="#" class="btn btn-white pull-right" v-on:click="showRequestForm">Сообщить о нарушении</a>
            </div>
        </div>
        <div class="body">
            <transition name="slide-down">
                <div class="form" v-if="isFormShown()">
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
                    <request-info :item="item" v-on:close-form="closeForm"></request-info>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                loading: false,
                state: null,
                placemark: null,
                success: false,
                requests: [],
                item: null,
                busy: false,
            }
        },
        methods: {
            showRequest() {},
            showRequestForm() {
                this.state = 'form';
            },
            isFormShown() {
                return 'form' == this.state;
            },
            isInfoShown() {
                return 'info' == this.state;
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
                this.busy = false;
            }
        },
        mounted() {
            ymaps.ready(init);
            var myMap;

            this.getRequests();

            const parent = this;

            function init(){
                myMap = new ymaps.Map ("map", {
                    center: [55.76, 37.64],
                    zoom: 7
                });

                myMap.controls.add(
                    new ymaps.control.ZoomControl()
                );
                myMap.behaviors.enable('scrollZoom');

                myMap.events.add('click', function (e) {
                    if (parent.busy) {
                        return false;
                    }

                    if (null === parent.placemark) {
                        parent.placemark = new ymaps.Placemark(e.get('coordPosition'));
                        myMap.geoObjects.add(parent.placemark);
                    } else {
                        myMap.geoObjects.remove(parent.placemark);
                        parent.placemark = new ymaps.Placemark(e.get('coordPosition'));
                        myMap.geoObjects.add(parent.placemark);
                    }
                });

                var i = 0;
                for (var request in parent.requests) {
                    var point = new ymaps.Placemark(parent.requests[request].map_point);
                    console.log(parent.requests[request].map_point);
                    point.__id = i++;//parent.requests[request].id;

                    point.events.add('click', function (event) {
                        point = event.get('target');
                        parent.state = 'info';
                        parent.item = point.__id;
                        parent.busy = true;
                    });

                    myMap.geoObjects.add(point);
                }
            }
        }
    }
</script>