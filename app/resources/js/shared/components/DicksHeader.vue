<template>
    <full-width-col classes="dicks-header text-center">
        <div :class="loggedIn ? 'col-xs-6 col-sm-9 col-md-9 col-9 pull-left' : 'col-xs-12 -col-sm-12 col-md-12 col-lg-12'">

            <h1 class="pull-right dicks-heading heading-l home-link">The Dicks Inn</h1>

            <navigation-button class="pull-left dicks-heading heading-s" v-for="(value, key) in links"
                :title="value"
                :destination="key"
                :type="''"
                :key="value"
            ></navigation-button>

        </div>

        <div v-if="loggedIn" class="col-xs-3 col-xs-offset-3 col-sm-1 col-sm-offset-2 col-md-offset-1 col-md-2 col-lg-offset-1 col-lg-2 icon pull-right">
        <image-holder source="assets/shield.png"></image-holder>
        </div>

    </full-width-col>

</template>

<script>


    export default {

        components: {

        },

        props: {
            heading:{
                type: String,
                default: ""
            },
            links: {
                type: Object,
                default: () => ({})
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
            },

            textBlocksCount() {
                return this.textBlocks.length;
            },

            hasHeading() {
                return this.heading != '';
            }
        }

    };
</script>