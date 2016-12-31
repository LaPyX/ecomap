<template>
    <div>
        <div class="form__fields">
            <text-block placeholder="Тема"
                        v-model="fields.subject.value"
                        :error="fields.subject.error"
                        :valid="fields.subject.valid"></text-block>

            <text-block placeholder="Адрес обнаружения проблемы" hideHelpers="true"
                        v-model="fields.address.value"
                        :error="fields.address.error"
                        :valid="fields.address.valid"></text-block>

            <transition name="slide-down" mode="out-in">
                <div v-if="!placemark" class="text-info" style="margin-bottom: 1em;"><i class="material-icons">info outline</i> Укажите место на карте</div>
                <div v-if="placemark" class="text-success" style="margin-bottom: 1em;"><i class="material-icons">done</i> Место указано</div>
            </transition>

            <textarea-block placeholder="Описание жалобы"
                            v-model="fields.description.value"
                            :error="fields.description.error"
                            :valid="fields.description.valid"></textarea-block>

            <div class="form__header">Дополнительная информация</div>
            <file-block label="Фото и/или видео" hint="Несколько файлов, не более 50 Мб"
                        v-model="fields.photo.value"
                        :error="fields.photo.error"
                        :valid="fields.photo.valid"
                        @change-file="fileChange"
                        multiple="true"></file-block>

            <div class="form__header">Контактная информация</div>
            <text-block placeholder="Ваше ФИО" hint="Видны только администрации сайта"
                        v-model="fields.name.value"
                        :error="fields.name.error"
                        :valid="fields.name.valid"></text-block>

            <text-block placeholder="Номер телефона"
                        v-model="fields.phone.value"
                        :error="fields.phone.error"
                        :valid="fields.phone.valid"></text-block>
        </div>


        <a href="#" class="btn btn-primary" v-on:click.prevent="submit">Сообщить о нарушении</a>
        <a href="#" class="btn btn-secondary" v-on:click.prevent="hideForm">Отмена</a>
    </div>
</template>

<script>
    export default {
        props: {
            placemark: {}
        },
        data() {
            return {
                loading: false,
                file: null,
                fields: {
                    subject: {
                        value: '',
                        valid: null,
                        error: null,
                    },
                    description: {
                        value: '',
                        valid: null,
                        error: null,
                    },
                    map_point: {
                        value: '',
                        valid: null,
                        error: null,
                    },
                    address: {
                        value: '',
                        valid: null,
                        error: null,
                    },
                    photo: {
                        value: '',
                        valid: null,
                        error: null,
                    },
                    name: {
                        value: '',
                        valid: null,
                        error: null,
                    },
                    phone: {
                        value: '',
                        valid: null,
                        error: null,
                    },
                }
            }
        },
        methods: {
            hideForm() {
                this.$emit('close-form');
            },
            fileChange(value) {
                var files = value.target.files || value.dataTransfer.files;
                if (!files.length) {
                    return;
                }
                console.log(files);
                this.file = files;
            },
            submit: function() {
                this.clearErrors();

                var formData = new FormData();
                formData.append('subject', this.fields.subject.value);
                formData.append('description', this.fields.description.value);
                formData.append('address', this.fields.address.value);

                for (var file in this.file) {
                    formData.append('photo[]', this.file[file]);
                }

                formData.append('name', this.fields.name.value);
                formData.append('phone', this.fields.phone.value);
                formData.append('region_name', this.$parent.region);

                if (null !== this.placemark) {
                    formData.append('map_point', this.placemark.geometry.getCoordinates());
                }

                this.$http.post('/requests', formData).then((response) => {
                    var response = response.body;

                    if (response.status == 'ok') {
                        this.$emit('success');
                    }
                }, (response) => {
                    for (var field in this.fields) {
                        if (field in response.body.errors) {
                            this.fields[field].valid = false;
                            this.fields[field].error = response.body.errors[field][0];
                        } else {
                            this.fields[field].valid = true;
                            this.fields[field].error = null;
                        }
                    }
                });
            },
            clearErrors: function() {
                for (var field in this.fields) {
                    this.fields[field].valid = true;
                    this.fields[field].error = null;
                }
            }
        }
    }
</script>