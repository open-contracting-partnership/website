<template>

	<div class="tick / input-circle" :data-colour="colour" :checked="checked" role="checkbox" :aria-checked="checked" v-bind:class="{
			'checked': checked,
		}">
	</div>

</template>

<script>

    export default {
		props: ['checked', 'colour']
	}

</script>
