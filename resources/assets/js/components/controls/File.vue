<template>
    <input-block
            type="file"
            :id="id"
            :label="label"
            :placeholder="placeholder"
            :hint="hint"
            :valid="valid"
            :ghost="ghost"
            :value="value"
            :error="error"
            v-on:input-trigger="inputTrigger"
            v-on:send-event="send"
            v-on:change-file="change"
            :hideHelpers="hideHelpers"
            :multiple="multiple"
    ></input-block>
</template>

<script>
    const input = require('./Input.vue');

    export default {
        extends: input,
        methods: {
            change(e) {
                this.$emit('change-file', e);
            }
        }
    }
</script>