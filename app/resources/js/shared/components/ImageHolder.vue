<template>

    <img class="img-responsive" :class="classes" :src="source" :alt="altText" />

</template>

<script>

    export default {

        components: {

        },

        props: {
            source:{
                type: String,
                required: true
            },
            altText: {
                type: String,
                default: "Dicks Icon"
            },
            classes: {
                type: String,
                default: ""
            }
        },

        methods: {

        },
        computed: {

        }

    };
</script>