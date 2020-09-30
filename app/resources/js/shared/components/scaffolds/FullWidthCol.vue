<template>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" :class="classes">

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
