<template>

    <div class="row" >
        <full-width-col classes="text-center">
            <image-holder source="assets/sign.png" altText="The Dicks Inn Banner" classes="center-block" :class="classes"></image-holder>
        </full-width-col>
    </div>

</template>

<script>

    export default {

        components: {

        },

        props: {
            source:{
                type: String,
                default: 'assets/sign.png'
            },
            altText: {
                type: String,
                default: "The Dicks Inn Banner"
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