<template>

	<div class="map-country">

		<div class="country__header">

			<flag :code="selected_country.iso_a2.toLowerCase()" />
			<h1 class="country__heading" v-html="selected_country.name" />

			<button class="map-country__close" @click="closeCountry">
				<svg><use xlink:href="#icon-close" /></svg>
			</button>

		</div>

		<div class="country-content__container">

			<div class="country-content">

				<h3 class="country-content__title" v-html="content.country.ocds"></h3>

				<div class="country-content__items">

					<template v-if="typeof selected_country.publishers !== 'undefined' && selected_country.publishers.length">

						<div class="country-content__item" v-for="publisher in selected_country.publishers">
							<a :href="publisher.publisher_link">{{ publisher.publisher }}</a>
						</div>

					</template>

					<p v-else class="country-content__no-data" v-html="content.country.no_data"></p>

				</div>

			</div>

			<div class="country-content">

				<h3 class="country-content__title" v-html="content.country.commitments"></h3>

				<div class="country-content__items">

					<template v-if="typeof selected_country.ogp_commitments !== 'undefined' && selected_country.ogp_commitments.length">

						<div class="country-content__item" v-for="commitment in selected_country.ogp_commitments">
							<a :href="commitment.ogp_commitment_link">{{ commitment.ogp_commitment }}</a>
						</div>

					</template>

					<p v-else class="country-content__no-data" v-html="content.country.no_data"></p>

				</div>

			</div>

			<div class="country-content">

				<h3 class="country-content__title" v-html="content.country.contract"></h3>

				<div class="country-content__items">

					<template v-if="typeof selected_country.innovations !== 'undefined' && selected_country.innovations.length">

						<div class="country-content__item" v-for="innovation in selected_country.innovations">
							<a :href="innovation.innovation_link">{{ innovation.innovation_description }}</a>
						</div>

					</template>

					<p v-else class="country-content__no-data" v-html="content.country.no_data"></p>

				</div>

			</div>

			<div class="country-content">

				<h3 class="country-content__title" v-html="content.country.impact_stories"></h3>

				<div class="country-content__items">

					<template v-if="typeof selected_country.impacts_stories !== 'undefined' && selected_country.impacts_stories.length">

						<div class="country-content__item" v-for="impacts_story in selected_country.impacts_stories">
							<a :href="impacts_story.story_url">{{ impacts_story.story_title }}</a>
						</div>

					</template>

					<p v-else class="country-content__no-data" v-html="content.country.no_data"></p>

				</div>

			</div>

		</div> <!-- / .country-content__container -->

		<div class="country-improve">

			<a class="arrow-link" data-size="small" data-icon-color="grey" data-text-color="black" :href="'http://survey.open-contracting.org/#/forms/oc-status/' + selected_country.iso_a2.toLowerCase()">
				<svg class="arrow-link__icon"><use xlink:href="#icon-arrow-circle"></use></svg>
				<span class="arrow-link__label" v-html="content.country.improve_data"></span>
			</a>

		</div>

	</div>

</template>

<script>

	import { mapGetters, mapActions } from 'vuex'

	export default {

		computed: {

			...mapGetters([
				'content',
				'selected_country'
			])

		},

		methods: {

			closeCountry() {
				this.$router.push({ name: 'map' });
			}

		}

	}

</script>

<style lang="scss">

	// ATTN: this is not ideal, but webpack aliases aren't working
	@import "../../../../scss/_bootstrap.scss";

	.map-country {

		background-color: $ui-white;
		height: 100%;
		overflow-y: auto;
		-webkit-overflow-scrolling: touch;
		width: 100%;
		padding: spacing(3) spacing(2);

		@include from(M) {
			padding: spacing(3) spacing(4);
			box-shadow: 10px 4px 50px rgba(0, 0, 0, 0.25);
			border-radius: spacing(4) spacing(.5) spacing(.5) spacing(.5);
			display: flex;
			flex-direction: column;
		}

	}

		.map-country__close {

			border: none;
			background: none;
			padding: 0;
			margin: 0 0 0 auto;

			&:hover,
			&:active,
			&.active {
				color: inherit;
				background-color: inherit;
				text-decoration: none;
				border-color: inherit;
			}

			> svg {

				font-size: 14px;
				height: 1em;
				width: 1em;

				@include from(M) {
					font-size: 16px;
				}

			}

		}

		.country__header {

			display: flex;
			align-items: center;
			flex: 0 0 auto;

			border-bottom: 6px solid $ui-brand;
			padding-bottom: spacing(1);
			margin-bottom: spacing(4);

			@include from(M) {
				padding-bottom: spacing(2.5);
			}

		}

			.country__header .flag-icon {

				flex: 0 0 36px;
				margin-right: spacing(1);

				@include from(M) {
					font-size: 25px;
					margin-right: spacing(2);
					margin-bottom: em(6, 25);
				}

			}

			.country__heading {

				font-size: 24px;
				flex: 1 1 100%;
				margin-bottom: 0;
				margin-right: spacing(2);

				@include from(M) {
					font-size: 29px;
				}

			}


		.country-content__container {
			flex: 1 1 100%;
			overflow-y: auto;
		}

			.country-content {

				font-size: 15px;
				margin-bottom: spacing(3);
				width: 100%;

				a {
					color: inherit;
				}

			}

			.country-content__title {
				font-size: 14px;
				color: $ui-grey-4;
			}

			.country-content__items {

				font-size: 12px;

				a {
					text-decoration: underline;
				}

			}

				.country-content__item {
					margin-bottom: spacing(.5);
				}

				.country-content__no-data {
					margin-bottom: 0;
				}

		.country-improve {
			flex: 0 0 auto;
			display: flex;
			justify-content: flex-end;
		}

</style>
