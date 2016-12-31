<template>
    <div>
        <div class="text" style="margin: 2em 0;">
            <p><strong>{{ name }}</strong></p>

            <div v-html="description"></div>

            <div v-html="contacts"></div>

            <div class="personals" style="margin: 2em 0;">
                <div class="personal" v-for="item in personal" style="margin: 0 0 1em;">
                    <strong>{{ item.name }}</strong><br>
                    {{ item.position }}<br>
                    {{ item.contacts }}
                </div>
            </div>
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
        data: function() {
            return {
                name: '',
                description: '',
                contacts: '',
                personal: []
            }
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
            },
            getData() {
                this.name = this.region;
                this.description = '';
                this.contacts = '';
                this.personal = null;

                var formData = new FormData();
                formData.append('region_name', this.region);

                this.$http.post('/departments', formData).then((response) => {
                    var response = response.body;

                    if (response.status == 'ok') {
                        this.name = response.department.name;
                        this.description = response.department.description;
                        this.contacts = response.department.contacts;
                        this.personal = response.department.personal;
                    }
                });
            }
        },
        watch: {
            region: 'getData'
        },
        mounted() {
            this.getData();
        }
    }
</script>