<template>
    <div class="form-group" :class="getValidationClass()">
        <label :for="id" v-if="label">{{ label }}</label>
        <div class="form-control__container">
            <input :type="type"
                   class="form-control"
                   :class="{ 'form-control--ghost': ghost }"
                   :id="id"
                   aria-describedby="emailHelp"
                   :placeholder="placeholder"
                   :value="value"
                   v-on:input="updateValue($event.target.value)"
                   @keyup.enter="send"
                   v-on:change="change"
            >
        </div>

        <div class="form-control__error" v-if="!hideHelpers">
            <transition name="slide-down">
                <small class="form-text text-danger" v-if="error">{{ error }}</small>
                <small class="form-text text-muted" v-if="hint">{{ hint }}</small>
            </transition>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                default: ''
            },
            type: {
                default: ''
            },
            valid: {
                default: null
            },
            error: {
                default: null
            },
            ghost: {
                default: false
            },
            label: {
                default: ''
            },
            placeholder: {
                default: ''
            },
            value: { },
            hint: {
                default: ''
            },
            hideHelpers: {
                default: false
            }
        },
        methods: {
            isValid: function() {
                return this.showValidationStatus() && this.valid;
            },
            showValidationStatus() {
                return ! _.isNull(this.valid);
            },
            getValidationClass: function() {
                return true === this.valid ? 'has-success' : false === this.valid ? 'has-error' : '';
            },
            updateValue: function (value) {
                this.$emit('input-trigger', value);
            },
            inputTrigger: function (value) {
                this.$emit('input', value);
            },
            send: function () {
                this.$emit('send-event');
            },
            change: function(e) {
                this.$emit('change-file', e);
            }
        }
    }
</script>