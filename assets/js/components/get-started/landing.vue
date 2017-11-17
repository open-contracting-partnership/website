<template>

	<div>

		<div class="">
			<a href="#">

			</a>

			<router-link v-if="step < 7" :to="{ name: 'detail', params: { step: step + 1 } }"></router-link>

		</div>

	</div>

</template>

<script>

    export default {

		computed: {

			step() {
				return this.$route.params.step.split('-')[0];
			},

			detail() {
				return this.$root.bob;
			}

		}

	}

</script>
