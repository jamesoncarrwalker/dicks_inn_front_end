<template>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" :class="classes">

        <slot></slot>

    </div>

</template>
<script>

    export default {

        props: {
            classes:{
                type: String,
                default: ""
            }
        }

    };
</script>
