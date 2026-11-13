<template>
    <span class="flag-icon" :style="'background-image: url(' + flags_url + '/' + code + '.svg)'"></span>
</template>

<script>
    import getWordPressData from '@/js/wordpress-data';

    const { flags_url } = getWordPressData('page-worldwide');

    export default {
        props: ['code'],
        data() {
            return { flags_url }
        }
    }
</script>

<style lang="scss">
    // ATTN: this is not ideal, but webpack aliases aren't working
    @import "../../../../scss/_bootstrap.scss";

    .flag-icon {
        height: 1em;
        width: 1.333em;
        border-radius: .15em;
        box-shadow: 0 0 .2em rgba(0, 0, 0, .1);
        background-size: cover;
        background-position: 50% 50%;
        background-repeat: no-repeat;
        display: block;
    }
</style>
