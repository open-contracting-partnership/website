<template>

	<div class="map-filter">

		<div class="map-filter__inner" v-if="content">

			<button class="map-filter__close" @click="closeFilter()">
				<svg><use xlink:href="#icon-close" /></svg>
			</button>

			<h1 class="map-filter__title" v-html="content.title" />
			<div class="map-filter__strap" v-html="content.content" />

			<div class="map-filter__controls">

				<label class="filter-control__all">
					<input type="checkbox" :checked="filters.all" @change="toggleFilter('all')" />
					<span v-html="content.filter.all" />
				</label>

				<label>
					<input type="checkbox" :checked="filters.ocds" @change="toggleFilter('ocds')" />
					<span v-html="content.filter.ocds" />
				</label>

					<label class="filter-control__child">
						<input type="checkbox" :checked="filters.ocds_ongoing" @change="toggleFilter('ocds_ongoing')" />
						<strong v-html="content.filter.ocds_status" /> <ocds-status status="ongoing" />
					</label>

					<label class="filter-control__child">
						<input type="checkbox" :checked="filters.ocds_implementation" @change="toggleFilter('ocds_implementation')" />
						<strong v-html="content.filter.ocds_status" /> <ocds-status status="implementation" />
					</label>

					<label class="filter-control__child">
						<input type="checkbox" :checked="filters.ocds_historic" @change="toggleFilter('ocds_historic')" />
						<strong v-html="content.filter.ocds_status" /> <ocds-status status="historic" />
					</label>

				<label>
					<input type="checkbox" :checked="filters.commitments" @change="toggleFilter('commitments')" />
					<span v-html="content.filter.commitments" />
				</label>

				<label>
					<input type="checkbox" :checked="filters.innovations" @change="toggleFilter('innovations')" />
					<span v-html="content.filter.contract" />
				</label>

			</div>

		</div> <!-- / .map-filter__inner -->

	</div> <!-- / .map-filter -->

</template>

<script>

	import _ from 'underscore'
	import { mapGetters, mapActions } from 'vuex'

    export default {

		methods: {

			...mapActions([
				'toggleFilter',
			]),

			closeFilter() {
				this.$emit('closeFilter');
			}

		},

		computed: {

			...mapGetters([
				'content',
				'filters'
			])

		}

	}

</script>

<style lang="scss">

	// ATTN: this is not ideal, but webpack aliases aren't working
	@import "../../../scss/_bootstrap.scss";

	.map-filter {
		z-index: 10;
		background-color: color('white');
		height: 100%;
		overflow-y: auto;
		-webkit-overflow-scrolling: touch;
		min-width: 384px;
	}

	.map-filter__inner {

		padding: spacing(2);
		position: relative;

		@include from(L) {
			padding: spacing(3);
		}

	}

		.map-filter__close {

			position: absolute;
			top: 0;
			right: 0;
			padding: spacing(2);
			border: none;
			background: none;

			@include from(M) {
				display: none;
			}

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
			}

		}

		.map-filter__title {

			@include font-size(24);

			@include from(ML) {
				@include font-size(42);
			}

		}

		.map-filter__strap {

			@include font-size(16);

			@include from(ML) {
				@include font-size(18);
			}

		}

		.map-filter__controls label {

			@include font-size(14);
			margin-bottom: spacing(1);

			@include from(L) {
				@include font-size(16);
			}

		}


		label.filter-control__all {

			position: relative;
			margin-bottom: spacing(6);

			&::after {
				content: '';
				position: absolute;
				top: calc(100% + #{spacing(1)});
				left: spacing(1);
				display: block;
				height: spacing(4);
				width: 2px;
				background-color: currentColor;
			}

		}

		.filter-control__child {

			margin-left: spacing(3);

			strong {
				margin-right: spacing(1);
			}

		}

</style>
