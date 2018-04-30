<template>

	<div class="map-table">

		<router-link class="country-table__close" :to="{ name: 'map' }">
			<svg><use xlink:href="#icon-close" /></svg>
		</router-link>

		<div class="country-table__container">

			<table class="country-table">

				<thead>

					<tr>
						<th>Country</th>
						<th>Who are using Open Contracting Standards</th>
					</tr>

				</thead>

				<tbody>

					<tr v-for="country in agencies">

						<td>

							<div class="country-table__country">
								<flag :code="country.country.iso_a2.toLowerCase()" />
								<router-link :to="{ name: 'country', params: { code: country.country.iso_a2.toLowerCase() } }" v-html="country.country.name" />
							</div>

						</td>

						<td>

							<div class="country-table__agency" v-for="agency in country.agencies">

								<ocds-status :status="agency.status.slug" />

								<p v-if="agency.name">
									<a :href="agency.url" v-html="agency.name" />
									<svg><use xlink:href="#icon-external-link" /></svg>
								</p>

							</div>

						</td>

					</tr>

				</tbody>

			</table>

		</div> <!-- / .country-table__container -->

	</div>

</template>

<script>

	import { mapGetters, mapActions } from 'vuex'

	export default {

		computed: {

			...mapGetters([
				'agencies'
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

	.map-table {

		background-color: color('white');
		display: flex;
		flex-direction: column;
		padding: spacing(2) spacing(1);

		@include from(ML) {
			padding: spacing(3) spacing(2);
		}

	}

	.country-table__close {

		font-size: 16px;
		display: block;
		float: right;
		margin-bottom: spacing(2);
		margin-left: auto;
		flex: 0 0 1em;

		> svg {
			width: 1em;
			height: 1em;
			display: block;
		}

	}

	.country-table__container {
		flex: 1 1 100%;
		overflow-y: auto;
		-webkit-overflow-scrolling: touch;
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

		margin-bottom: spacing(2);

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

</style>
