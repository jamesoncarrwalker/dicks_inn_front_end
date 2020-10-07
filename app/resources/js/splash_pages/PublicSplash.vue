<template>
    <div>
        <div class="row">

            <dicks-header :heading="'The Dicks Inn'" :links="{'sign-in':'Sign in', 'register':'Sign up', 'guest':'Just quiz'}"></dicks-header>

        </div>


        <div class="row router-view-container">

            <router-view></router-view>

        </div>

        <hr class="dicks-section-break">

        <div class="row">

            <third-width-col classes="text-center">

                <h4>No egos</h4>

            </third-width-col>

            <third-width-col classes="text-center">

                <h4>No Pheasants</h4>

            </third-width-col>

            <third-width-col classes="text-center">

                <h4>No trunks after 10</h4>

            </third-width-col>

        </div>

    </div>

</template>

<script>

    export default {

        components: {

        },

        props: {

        },

        methods: {

        },
        computed: {

        }

    };
</script>