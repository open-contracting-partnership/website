<template>

	<div>

		<router-link class="country-table__close" :to="{ name: 'map' }">
			<svg><use xlink:href="#icon-close" /></svg>
		</router-link>

		<table class="country-table">

			<thead>

				<tr>
					<th>Country</th>
					<th>Agency</th>
					<th>State</th>
				</tr>

			</thead>

			<tbody>

				<tr v-for="agency in agencies">

					<td>

						<div class="country-table__country">
							<flag :code="agency.country.iso_a2.toLowerCase()" />
							<router-link :to="{ name: 'country', params: { code: agency.country.iso_a2.toLowerCase() } }" v-html="agency.country.name" />
						</div>

					</td>

					<td>
						<a :href="agency.url" v-html="agency.name" />
					</td>

					<td>
						<ocds-status :status="agency.status.slug" />
					</td>

				</tr>

			</tbody>

		</table>

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

	.country-table__close {

		display: block;
		float: right;
		margin-bottom: spacing(2);

		> svg {
			font-size: 16px;
			width: 1em;
			height: 1em;
			display: block;
		}

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

		thead {
			border: 1px solid color('body');
		}

		th {
			@include font-size(14);
			background-color: color('white');
			color: color('body');
		}

		td {

			border: none;

			&:not(:last-child) {
				border-right: 1px solid color('body');
			}

		}

		tbody {
			border: 1px solid color('body');
		}

	}

</style>
