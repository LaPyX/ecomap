<template>
    <div class="form-group" :class="getValidationClass()">
        <label :for="id" v-if="label">{{ label }}</label>
        <div class="form-control__container">
            <textarea class="form-control"
                      :id="id"
                      aria-describedby="emailHelp"
                      :placeholder="placeholder"
                      @keyup.enter="send"
                      v-on:change="change"
            >{{ value }}</textarea>
            <transition name="fade">
                <i class="material-icons" v-if="showValidationStatus()">
                    <template v-if="isValid()">
                        done
                    </template>
                    <template v-if="!isValid()">
                        warning
                    </template>
                </i>
            </transition>
        </div>

        <transition name="slide-down">
            <div class="form-control__error" v-if="hint">
                <small class="form-text text-muted">
                    {{ hint }}
                </small>
            </div>
        </transition>

        <transition name="slide-down">
            <div class="form-control__error" v-if="error">
                <small class="form-text text-danger">{{ error }}</small>
            </div>
        </transition>
    </div>
</template>

<script>
    const input = require('./Input.vue');

    export default {
        extends: input,
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
            change: function(e) {
                this.$emit('input', e.target.value);
            }
        }
    }
</script>