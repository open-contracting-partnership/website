<template>

	<div class="tick" :checked="checked" role="checkbox" :aria-checked="checked" v-bind:class="{
			'tick--small': size === 'small',
			'checked': checked,
		}">
		<svg v-show="checked === true" data-icon="tick"><use xlink:href="#icon-tick" /></svg>
		<svg v-show="checked === false" data-icon="plus"><use xlink:href="#icon-plus" /></svg>

	</div>

</template>

<script>

    export default {
		props: ['checked', 'size']
	}

</script>

<style lang="scss">

	// ATTN: this is not ideal, but webpack aliases aren't working
	@import "../../../../scss/_bootstrap.scss";

	.tick {

		font-size: 18px;
		border: 1px solid $ui-grey-3;
		background-color: $ui-white;
		color: $ui-grey-3;
		width: 1em;
		height: 1em;
		display: flex;
		align-items: center;
		justify-content: center;
		user-select: none;

		> svg {

			fill: currentColor;
			width: 1em;
			height: 1em;

			&[data-icon="plus"] {
				font-size: em(8, 18);
				transform: rotate(45deg);
			}

			&[data-icon="tick"] {
				font-size: em(9, 18);
			}

		}

		&.checked {
			background-color: $ui-brand;
		}

	}

		.tick--small {
			font-size: 14px;
		}

</style>
