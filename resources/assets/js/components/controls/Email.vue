<template>
    <input-block
        type="email"
        :id="id"
        :label="label"
        :placeholder="placeholder"
        :hint="hint"
        :valid="valid"
        :ghost="ghost"
        :error="error"
        :value="value"
        v-on:input-trigger="inputTrigger"
        v-on:send-event="send"
    ></input-block>
</template>

<script>
    const input = require('./Input.vue');

    export default {
        extends: input
    }
</script>