<template>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"
         :class="classes"
    >

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