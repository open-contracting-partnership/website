<template>

	<div class="tick" :data-colour="colour" :checked="checked" role="checkbox" :aria-checked="checked" v-bind:class="{
			'checked': checked,
		}">
	</div>

</template>

<script>

    export default {
		props: ['checked', 'colour']
	}

</script>

<style lang="scss">

	// ATTN: this is not ideal, but webpack aliases aren't working
	@import "../../../../scss/_bootstrap.scss";

	.tick {

		--colour: #{$ui-grey-4};

		font-size: 21px;
		border: 3px solid var(--colour);
		background-color: $ui-white;
		width: 1em;
		height: 1em;
		cursor: pointer;
		user-select: none;
		border-radius: 50%;

		&.checked {
			background-color: var(--colour);
		}

		&[data-colour="blue"] {
			--colour: #{$ui-blue};
		}

		&[data-colour="teal"] {
			--colour: #{$ui-teal};
		}

		&[data-colour="light-green"] {
			--colour: #{$ui-brand-2};
		}

	}

</style>
