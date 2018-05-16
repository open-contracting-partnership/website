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
						<th data-field="publisher" v-bind:class="{ 'sortAsc': order_by === 'publisher' && order_asc === true, 'sortDesc': order_by === 'publisher' && order_asc === false }">Who are using Open Contracting Standards</th>
						<th data-field="year" v-bind:class="{ 'sortAsc': order_by === 'year' && order_asc === true, 'sortDesc': order_by === 'year' && order_asc === false }">Year first implemented</th>
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

						<td>

							<div class="country-table__agency">

								<ocds-status v-if="publisher.status" :status="publisher.status.slug" v-html="publisher.status.name" />

								<p v-if="publisher.name">
									<a :href="publisher.url" v-html="publisher.name" />
									<svg><use xlink:href="#icon-external-link" /></svg>
								</p>

							</div>

						</td>

						<td>
							<span class="country-table__year" v-html="publisher.year"></span>
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
	@import "../../../scss/_bootstrap.scss";

	.map-table {

		background-color: color('white');
		display: flex;
		flex-direction: column;
		align-items: flex-end;
		padding: spacing(2) spacing(1);

		@include from(ML) {
			padding: spacing(3) spacing(2);
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
	}

	.country-table__country {
		display: flex;
		align-items: center;
	}

		.country-table__country .flag-icon {
			font-size: 25px;
			flex: 0 0 36px;
			margin-right: spacing(1);
		}

		.country-table__country a {
			flex: 1 1 100%;
		}


	.country-table {

		table-layout: auto;
		border-spacing: 0;
		border-collapse: separate;
		margin-bottom: 0;

		thead {

			tr:first-child th {
				background: white;
				position: sticky;
				top: 0;
				z-index: 10;
				text-align: center;
			}

			th {

				cursor: pointer;
				user-select: none;

				&.sortAsc::after {
					content: ' ▲';
				}

				&.sortDesc::after {
					content: ' ▼';
				}

			}

		}

		th {

			@include font-size(14);
			background-color: color('white');
			color: color('body');
			border: 0 solid color('body');
			border-width: 1px 0;

			&:first-child {
				border-left-width: 1px;
			}

			&:last-child {
				border-right-width: 1px;
			}

		}

		td {

			border: 0 solid color('body');
			border-width: 0 0 0 1px;

			&:last-child {
				border-right-width: 1px;
			}

		}

		tr:last-child td {
			border-bottom-width: 1px;
		}

		th, td {
			width: auto;
		}

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

	.country-table__year {
		@include font-size(18);
	}

</style>
