<template>

    <router-link :type="navType" role="button" :to="{name: destination}" :class="['text-center', 'btn-dicks']" exact>{{ title }}</router-link>

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
            navType: {
                type: String,
                default: 'button',
            },

        },

        methods: {

        },
        computed: {

        }

    };
</script>