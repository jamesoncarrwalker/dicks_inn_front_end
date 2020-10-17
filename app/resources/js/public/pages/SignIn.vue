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
                            <div class="form-group">
                                <form-input placeHolder="Enter username" :inputValue.sync="usernameValue" class="pull-right" input-name="username" input-type="text" id="username_input"></form-input>
                            </div>
                        </half-width-col>

                        <half-width-col class="pull-right">
                            <div class="form-group">
                                <form-input :inputValue.sync="passwordValue" class="pull-left" input-name="password" input-type="password" id="password_input" placeHolder="Enter password"></form-input>
                            </div>

                        </half-width-col>

                    </full-width-col>

                    <full-width-col class="text-center">

                        <submit-button
                                @click_login="doLogin"
                                :title="'Sign in'"
                                :eventTarget="'login'"
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
            doLogin: function (event) {
                console.log(event, 'trying loggin in now....');
                this.submitting = true;
                this.$axios.post(env.API_URL + '/login',{username:this.usernameValue, password:this.passwordValue})
                        .then(function (response) {
                                console.log(response)
                                //access this variable from the response
                                console.log(this.submitting);
                                this.submitting = false;
                                console.log(this.submitting);
                        });
            }
        },
        data() {
            return {
                loginEndpoint: env.API_URL + '/login',
                passwordValue:'',
                usernameValue: '',
                submitting: false
            };
        },
        computed: {
            buttonActive() {
                return this.passwordValue.length >= env.MINIMUM_PASSWORD_LENGTH
                        && this.usernameValue.length >= env.MINIMUM_USERNAME_LENGTH
                        && !this.submitting
                            }

        },

    };
</script>