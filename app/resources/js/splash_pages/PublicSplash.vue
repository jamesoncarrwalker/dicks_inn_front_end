<template>
    <div>
        <div class="row">

            <dicks-header v-bind:text-blocks="['No egos', 'No trunks after 10', 'No pheasants']"></dicks-header>

        </div>


        <div class="row router-view-container">

            <router-view></router-view>

        </div>


        <div class="row">

            <third-width-col classes="text-center">

                <navigation-button
                        title="Sign in"
                        destination="sign-in"
                > </navigation-button>

            </third-width-col>

            <third-width-col classes="text-center">

                <navigation-button
                        title="Register"
                        destination="register"
                > </navigation-button>

            </third-width-col>

            <third-width-col classes="text-center">

                <navigation-button
                        title="Quiz as a guest"
                        destination="guest"
                > </navigation-button>

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