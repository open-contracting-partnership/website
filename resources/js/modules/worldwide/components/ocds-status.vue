<template>
    <span class="ocds-status" :data-status="status">
        <slot></slot>
    </span>
</template>

<script>
    export default {
        props: ['status']
    }
</script>

<style lang="scss">
    // ATTN: this is not ideal, but webpack aliases aren't working
    @import "../../../../scss/_bootstrap.scss";

    .ocds-status {
        font-size: 14px;
        color: $ui-white;
        padding: em(2, 14) em(7, 14);
        display: inline-block;

        &[data-status="ongoing"] {
            background-color: #497AF3;
        }

        &[data-status="implementation"] {
            background-color: #FD843D;
        }

        &[data-status="historic"] {
            background-color: #23B2A7;
        }
    }
</style>
