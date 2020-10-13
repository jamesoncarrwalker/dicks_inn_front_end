<template>
    <div class="container-fluid">

        <splash-banner classes="max-300"></splash-banner>

        <div class="row" >

            <full-width-col classes="text-center hand-written">

                <h2 v-text="'Sometimes you wanna go...'"></h2>

            </full-width-col>

            <full-width-col class="text-center">

                <form class="form-inline">

                    <full-width-col>

                        <half-width-col >

                            <label class="pull-right" for="username_input">Username</label>

                        </half-width-col>

                        <half-width-col class="pull-left">

                            <label class="pull-left" for="password_input">Password</label>

                        </half-width-col>

                    </full-width-col>

                    <full-width-col>

                        <half-width-col >

                            <form-input :inputValue.sync="usernameValue" class="pull-right" input-name="username" input-type="text" id="username_input"></form-input>

                        </half-width-col>

                        <half-width-col class="pull-right">

                            <form-input :inputValue.sync="passwordValue" class="pull-left" input-name="password" input-type="password" id="password_input"></form-input>

                        </half-width-col>

                    </full-width-col>

                    <full-width-col class="text-center">

                        <submit-button
                                :title="'Sign in'"
                                v-on:click="login"
                                :buttonActive="buttonActive"
                        ></submit-button>

                    </full-width-col>

                </form>


            </full-width-col>

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
            login: function (event) {event.preventDefault();console.log('trying loggin in now....');}
        },
        data() {
            return {
                loginEndpoint: env.API_URL + '/login',
                passwordValue:'',
                usernameValue: ''
            };
        },
        computed: {
            buttonActive() {
                return this.passwordValue.length >= env.MINIMUM_PASSWORD_LENGTH
                        && this.usernameValue.length >= env.MINIMUM_USERNAME_LENGTH
                            }

        },

    };
</script>