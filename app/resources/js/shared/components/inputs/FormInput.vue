<template>
    <div :class="formGroup">
        <label v-if="inputLabel != ''" :for="getInputId">{{ inputLabel }}</label>
        <input class="form-control" :type="inputType" :class="inputClasses" :name="inputName" :id="getInputId" :autocomplete="autoComplete" />
    </div>

</template>

<script>


    export default {

        components: {

        },

        props: {
            formGroup:{
                type:String,
                default: 'form-group'
            },
            inputType:{
                type: String,
                required: true
            },
            inputName:{
                type: String,
                required: true
            },
            inputId: {
                type: String,
                default: ''
            },
            inputLabel: {
                type: String,
                default: ''
            },
            inputClasses: {
                type: String,
                default: ''
            },
            autoComplete: {
                type: Boolean,
                default:true
            }
        },

        methods: {

        },
        computed: {
            getInputId() {
                return this.inputId != '' ? this.inputId : this._uid;
            }
        }

    };
</script>