<template>
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" :class="classes">

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
