<template>

    <button :type="navType" role="button"
            :class="['text-center','btn', 'btn-dicks', 'btn-submit', (buttonActive ? 'btn-active' : 'btn-inactive')]"
            @click="performClick($event)"
    >{{ title }}</button>

</template>

<script>

    import {mapGetters} from 'vuex';

    export default {

        props: {
            title:{
                type: String,
                required: true
            },

            navType: {
                type: String,
                default: 'button'
            },
            buttonActive: {
                type: Boolean,
                required: true
            },
            eventTarget: {
                type: String,
                required: true
            }

        },
        methods : {
            performClick(event) {
                event.preventDefault();
                this.$emit('click_' + this.eventTarget,event);
            }
        }

    };
</script>