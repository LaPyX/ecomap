<template>
    <input :type="type"
           class="btn"
           :class="{ 'form-control--ghost': ghost }"
           :id="id"
           :value="value">
</template>

<script>
    const input = require('./Input.vue');

    export default {
        extends: input
    }
</script>