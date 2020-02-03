<template>

	<div class="map-table">

		<router-link class="country-table__close" :to="{ name: 'map' }">
			<svg><use xlink:href="#icon-close" /></svg>
		</router-link>

		<div class="country-table__container">

			<table class="country-table">

				<thead>

					<tr @click="sortColumn">
						<th data-field="country" v-bind:class="{ 'sortAsc': order_by === 'country' && order_asc === true, 'sortDesc': order_by === 'country' && order_asc === false }">Country</th>
						<th data-field="publisher" v-bind:class="{ 'sortAsc': order_by === 'publisher' && order_asc === true, 'sortDesc': order_by === 'publisher' && order_asc === false }">Who is publishing Open Contracting Data</th>
						<th>Status</th>
						<th data-field="year" v-bind:class="{ 'sortAsc': order_by === 'year' && order_asc === true, 'sortDesc': order_by === 'year' && order_asc === false }">First published</th>
						<th>Download Data</th>
					</tr>

				</thead>

				<tbody>

					<tr v-for="publisher in publishers">

						<td>

							<div class="country-table__country">
								<flag :code="publisher.country.code" />
								<router-link :to="{ name: 'country', params: { code: publisher.country.code } }" v-html="publisher.country.name" />
							</div>

						</td>

						<td class="country-table__agency" v-html="publisher.name"></td>

						<td class="country-table__status-container">
							<span v-if="publisher.status" class="country-table__status" :title="publisher.status.name" :data-status="publisher.status.slug"></span>
						</td>

						<td class="country-table__year" v-html="publisher.year"></td>

						<td class="country-table__data">

							<a class="arrow-link" data-size="small" :href="publisher.url">
								<svg class="arrow-link__icon"><use xlink:href="#icon-arrow-circle"></use></svg>
							</a>

						</td>

					</tr>

				</tbody>

			</table>

		</div> <!-- / .country-table__container -->

	</div>

</template>

<script>

	import _ from 'underscore'
	import { mapGetters, mapActions } from 'vuex'

	export default {

		data() {

			return {
				order_by: null,
				order_asc: true
			}

		},

		computed: {

			...mapGetters([
				'countries'
			]),

			publishers() {

				let publishers = [];

				_.each(this.countries, (country) => {

					_.each(country.publishers, function(publisher) {

						let agency = {
							country: {
								name: country.name,
								code: country.iso_a2.toLowerCase()
							},
							name: publisher.publisher,
							url: publisher.publisher_link,
							year: publisher.year_first_implemented,
							status: null
						};

						let status = null;

						if ( typeof publisher.ocds_historic_data && publisher.ocds_historic_data === true ) {

							agency.status = {
								slug: 'historic',
								name: 'Historic'
							}

						}

						if ( typeof publisher.ocds_ongoing_data && publisher.ocds_ongoing_data === true ) {

							agency.status = {
								slug: 'ongoing',
								name: 'Ongoing'
							}

						}

						publishers.push(agency);

					});

				});


				 //*****
				// SORT

				let order_by = this.order_by !== null ? this.order_by : 'country';

				// sort the publishers by the given field
				publishers = _.sortBy(publishers, (publisher) => {

					let value = null;

					if ( order_by === 'country' ) {
						value = publisher.country.name;
					} else if ( order_by === 'publisher' ) {
						value = publisher.name;
					} else if ( order_by === 'year' ) {
						value = publisher.year;
					}

					if ( typeof value === 'undefined' ) {
						return false;
					}

					return value.trim();

				});

				// if reverse the order if we're not ascending
				if ( ! this.order_asc ) {
					publishers = publishers.reverse();
				}

				return publishers;

			}

		},

		methods: {

			sortColumn(event) {

				const field = event.target.dataset.field;

				// we only care about fields that exist
				if ( typeof field === 'undefined' ) {
					return;
				}

				// new
				if ( this.order_by !== field ) {
					this.order_by = field;
					this.order_asc = true;
					return;
				}

				// existing + sort
				if ( this.order_by === field && this.order_asc ) {
					this.order_asc = false;
					return;
				}

				// reset
				this.order_by = null;
				this.order_asc = true;

			}

		}

	}

</script>

<style lang="scss">

	// ATTN: this is not ideal, but webpack aliases aren't working
	@import "../../../../scss/_bootstrap.scss";

	.map-table {

		font-size: 13px;
		background-color: $ui-white;
		display: flex;
		flex-direction: column;
		align-items: flex-end;
		padding: spacing(2) spacing(1);
		text-align: left;

		@include from(T) {
			padding: spacing(3) spacing(2);
		}

	}
		.map-table a {

			text-decoration: none;

			&:hover,
			&:focus,
			&:active {
				text-decoration: underline;
			}

		}

	.country-table__close {

		font-size: 16px;
		display: block;
		margin-bottom: spacing(2);
		flex: 0 0 1em;

		> svg {
			width: 1em;
			height: 1em;
			display: block;
		}

	}

	.country-table__container {
		width: 100%;
		position: relative;
		overflow-x: hidden;
	}

	.country-table__country {
		display: flex;
		align-items: center;
	}

		.country-table__country .flag-icon {
			font-size: 20px;
			flex: 0 0 auto;
			margin-right: spacing(2);
		}

		.country-table__country a {
			flex: 1 1 100%;
		}
		

	.country-table__agency {

		.ocds-status {
			margin-bottom: spacing(.5);
		}

		p {
			margin-bottom: 0;
		}

		p > svg {
			font-size: 9px;
			height: 1em;
			width: 1.09em;
			display: inline-block;
			margin-left: spacing(.5);
		}

	}

	.country-table__status-container {
		display: flex;
		justify-content: center;
	}

		.country-table__status {

			display: block;
			font-size: 21px;
			height: 1em;
			width: 1em;
			border-radius: 50%;

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

	.country-table__year {
		text-align: center;
	}

	.country-table__data {
		display: flex;
		justify-content: center;
	}

</style>
