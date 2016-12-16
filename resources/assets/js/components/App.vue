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

                    <request-form v-on:success="successSent" :placemark="placemark"></request-form>
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
                success: false
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
            }
        },
        mounted() {
            ymaps.ready(init);
            var myMap;

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
                    if (null === parent.placemark) {
                        parent.placemark = new ymaps.Placemark(e.get('coordPosition'));
                        myMap.geoObjects.add(parent.placemark);
                    } else {
                        myMap.geoObjects.remove(parent.placemark);
                        parent.placemark = new ymaps.Placemark(e.get('coordPosition'));
                        myMap.geoObjects.add(parent.placemark);
                    }
                });
            }
        }
    }
</script>