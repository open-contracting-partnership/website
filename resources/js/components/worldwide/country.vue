<template>

	<div class="map-country">

		<div class="map-country__inner">

			<div class="country__header">

				<flag :code="selected_country.iso_a2.toLowerCase()" />
				<h1 class="country__heading" v-html="selected_country.name" />

				<button class="map-country__close" @click="closeCountry">
					<svg><use xlink:href="#icon-close" /></svg>
				</button>

			</div>

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

			<div class="country-improve">
				<a class="button" :href="'http://survey.open-contracting.org/#/forms/oc-status/' + selected_country.iso_a2.toLowerCase()" v-html="content.country.improve_data"></a>
			</div>

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

		watch: {



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
	@import "../../../scss/_bootstrap.scss";

	.map-country {

		background-color: color('white');
		height: 100%;
		overflow-y: auto;
		-webkit-overflow-scrolling: touch;
		width: 100%;

		@include from(L) {
			min-width: 599px;
		}

	}

		.map-country__inner {

			position: relative;
			padding: spacing(3) spacing(2);

			@include from(L) {
				padding: spacing(9) spacing(4);
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

					@include from(L) {
						font-size: 16px;
					}

				}

			}



	.country__header {

		display: flex;
		align-items: center;

		border-bottom: 1px solid color(lighter-grey);
		padding-bottom: spacing(1);
		margin-bottom: spacing(4);

		@include from(L) {
			padding-bottom: spacing(5);
		}

	}

		.country__header .flag-icon {

			flex: 0 0 36px;
			margin-right: spacing(1);

			@include from(L) {
				@include font-size(25);
			}

		}

		.country__heading {

			@include font-size(24);
			flex: 1 1 100%;
			margin-bottom: 0;
			margin-right: spacing(2);

			@include from(L) {
				@include font-size(29);
			}

		}


	.country-content {

		@include font-size(15);
		margin-bottom: spacing(3);
		width: 100%;

		@include from(ML) {
			display: flex;
		}

		a {
			color: inherit;
		}

	}

	.country-content__title {

		@include font-size(20);
		flex: 0 0 40%;

		@include from(L) {
			@include font-size(18);
		}

	}

	.country-content__items {

		@include font-size(16);
		border-bottom: 1px solid color(lighter-grey);
		padding-bottom: spacing(2);

		@include from(ML) {
			margin-left: spacing(3);
			flex: 1 1 60%;
		}

		a {
			text-decoration: underline;
		}

	}

		.country-content__item {
			margin-bottom: spacing(1);
		}

		.country-content__no-data {
			margin-bottom: 0;
		}

	.country-improve {
		text-align: right;
	}

</style>
