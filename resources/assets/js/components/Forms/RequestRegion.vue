<template>
    <div>
        <div class="text" style="margin: 2em 0;">
            <template v-if="isMoscow()">
                <p><strong>РЕГИОНАЛЬНОЕ ОТДЕЛЕНИЕ ОНФ В МОСКОВСКОЙ ОБЛАСТИ</strong></p>

                <p>
                    Контакты: 123001, г. Москва, Большой Патриарший переулок, дом 3 , стр.1<br>
                    8 (495) 981-56-99<br>
                    50region@onf.ru
                </p>

                <p>
                    ГЛАВА ИСПОЛКОМА: Даутов Алексей Леонидович<br>
                    Координатор РГ по проблемам экологии и защиты леса: Антон Юрьевич Хлынов
                </p>
            </template>

            <template v-if="isKrasnoyarsk()">
                <p><strong>РЕГИОНАЛЬНОЕ ОТДЕЛЕНИЕ ОНФ В КРАСНОЯРСКОМ КРАЕ</strong></p>

                <p>
                    Контакты: 660 049, Красноярский край, г. Красноярск, ул. Ленина, д. 49<br>
                    8 (391) 200-32-01<br>
                    24region@onf.ru
                </p>

                <p>
                    ГЛАВА ИСПОЛКОМА: Ларионова Оксана Владимировна
                </p>
            </template>
        </div>

        <div>
            <a href="#" class="btn btn-primary" v-on:click.prevent="showRequestForm">Сообщить о нарушении</a><br>
            <a href="#" class="btn btn-secondary" v-on:click.prevent="hideForm" style="margin-top: 1em;">Закрыть</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            region: ''
        },
        methods: {
            isMoscow() {
                return 'Московская область' == this.region;
            },
            isKrasnoyarsk() {
                return 'Красноярский край' == this.region;
            },
            showRequestForm() {
                this.$emit('create-request');
            },
            hideForm() {
                this.$emit('close-form');
            }
        }
    }
</script>