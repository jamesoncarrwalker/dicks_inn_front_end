<template>
    <full-width-col classes="dicks-header text-center">
            <div :class="loggedIn ? 'col-xs-6 col-sm-9 col-md-9 col-9' : 'col-xs-12 -col-sm-12 col-md-12 col-lg-12'">

                <h2 v-if="hasHeading">{{ heading }}</h2>

                <div v-else-if="textBlocksCount > 2" v-for="(text, index) in textBlocks">
                    <third-width-col v-if="index < 3">
                        <h4>{{ text }}</h4>
                    </third-width-col>
                </div>

                <div v-else-if="textBlocksCount > 1" v-for="(text, index) in textBlocks">
                    <half-width-col v-if="index <= 2">
                        <h4>{{text}}</h4>
                    </half-width-col>
                </div>
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
            textBlocks: {
                type:Array,
                default: () => []
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