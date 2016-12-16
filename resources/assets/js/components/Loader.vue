<template>
    <div class="cssload-wrapper">
        <div class="cssload-loader"></div>

        <fade-transition :baseDelay="500" v-if="label">
            <div class="cssload-label" key="0">{{ label }}</div>
        </fade-transition>
    </div>
</template>

<script>
    export default {
        props: {
            label: {
                default: ''
            },
            isMainLoader: {
                default: false
            }
        },
        methods: {
            changeAnimationState: function(value) {
                if (this.isMainLoader) {
                    this.$emit('change-animation-state', value);
                }
            },
            leave: function(el) {
                if (this.isMainLoader) {
                    Velocity(
                        el,
                        { translateY: '140px' },
                        {
                            duration: 1500,
                            easing: 'easeOutExpo'
                        }
                    );

                    this.$emit('change-animation-state', false);
                }
            },
            afterLeave: function(el, done) {
                if (this.isMainLoader) {
                    this.$emit('change-animation-state', false);
                }
            }
        }
    }
</script>