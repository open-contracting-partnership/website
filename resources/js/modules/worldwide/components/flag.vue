<template>

	<span class="flag-icon" :style="'background-image: url(/wp-content/themes/ocp-v1/dist/node_modules/flag-icon-css/flags/4x3/' + code  + '.svg)'"></span>

</template>

<script>

    export default {
		props: ['code']
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
