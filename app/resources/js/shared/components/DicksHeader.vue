<template>
    <div class="container-fluid text-center">
        <div class="row">
            <div :class="loggedIn ? 'col-xs-6 col-sm-9 col-md-9 col-9' : 'col-xs-12 -col-sm-12 col-md-12 col-lg-12'">
                <h2>{{ heading }}</h2>
            </div>

            <div v-if="loggedIn" class="col-xs-3 col-xs-offset-3 col-sm-1 col-sm-offset-2 col-md-offset-1 col-md-2 col-lg-offset-1 col-lg-2 icon pull-right">
                <image-holder source="assets/shield.png"></image-holder>
            </div>

        </div>

    </div>

</template>

<script>


    export default {

        components: {

        },

        props: {
            heading:{
                type: String,
                required: true
            },
            showIcon: {
                type:Boolean,
                default:false
            }
        },

        methods: {

        },
        computed: {
            loggedIn() {
                return false;
            }
        }

    };
</script>