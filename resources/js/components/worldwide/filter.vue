<template>

	<div class="map-filter">

		<div class="map-filter__inner" v-if="content">

			<button class="map-filter__close" @click="closeFilter()">
				<svg><use xlink:href="#icon-close" /></svg>
			</button>

			<h1 class="map-filter__title" v-html="content.title" />
			<div class="map-filter__strap" v-html="content.content" />

			<div class="map-filter__controls">

				<label class="filter-control__all" @click="toggleFilter('all')">
					<tick :checked="filters.all" />
					<span v-html="content.filter.all" />
				</label>

				<label @click="toggleFilter('ocds')">
					<tick :checked="filters.ocds" />
					<span v-html="content.filter.ocds" />
				</label>

					<label class="filter-control__child" @click="toggleFilter('ocds_ongoing')">
						<tick :checked="filters.ocds_ongoing" size="small" />
						<span>
							<strong v-html="content.filter.ocds_status" />
							<ocds-status status="ongoing" />
						</span>
					</label>

					<label class="filter-control__child" @click="toggleFilter('ocds_implementation')">
						<tick :checked="filters.ocds_implementation" size="small" />
						<span>
							<strong v-html="content.filter.ocds_status" />
							<ocds-status status="implementation" />
						</span>
					</label>

					<label class="filter-control__child" @click="toggleFilter('ocds_historic')">
						<tick :checked="filters.ocds_historic" size="small" />
						<span>
							<strong v-html="content.filter.ocds_status" />
							<ocds-status status="historic" />
						</span>
					</label>

				<label @click="toggleFilter('commitments')">
					<tick :checked="filters.commitments" />
					<span v-html="content.filter.commitments" />
				</label>

				<label @click="toggleFilter('innovations')">
					<tick :checked="filters.innovations" />
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
			display: flex;
			user-select: none;

			.tick {
				flex: 0 0 1em;
				margin-top: em(4, 18);
				margin-right: spacing(1);
			}

			.tick--small {
				margin-top: em(5, 14);
			}

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
