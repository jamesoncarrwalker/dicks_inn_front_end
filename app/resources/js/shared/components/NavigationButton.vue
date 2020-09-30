<template>
    <button :class="['text-center']"
            :type="type">
        {{ title }}
    </button>

</template>

<script>

    import {mapGetters} from 'vuex';

    export default {

        components: {

        },

        props: {
            title:{
                type: String,
                required: true
            },

            destination: {
                type:String,
                required:true
            },
            type: String,
            default: 'button'
        },

        methods: {

        },
        computed: {

        }

    };
</script>