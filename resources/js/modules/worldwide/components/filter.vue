<template>

	<div class="map-filter" v-if="content">

		<button class="map-filter__close" @click="closeFilter()">
			<svg><use xlink:href="#icon-close" /></svg>
		</button>

		<h1 class="map-filter__title" v-html="content.title" />

		<div class="map-view-toggle">

			<span class="map-view-toggle__item" @click="showTable()">
				<span v-html="content.table_view" />
				<svg><use xlink:href="#icon-table" /></svg>
			</span>

			<span class="map-view-toggle__item" @click="showMap()">
				<span v-html="content.map_view" />
				<svg><use xlink:href="#icon-target" /></svg>
			</span>

		</div>

		<div class="map-filter__strap" v-html="content.content" />

		<div class="map-filter__controls">

			<label class="filter-control__all" @click="toggleFilter('all')">
				<tick :checked="filters.all" colour="light-green" />
				<span v-html="content.filter.all" />
			</label>

			<label @click="toggleFilter('ocds')">
				<tick :checked="filters.ocds" />
				<span v-html="content.filter.ocds" />
			</label>

			<div class="filter-control__children">

				<p v-html="content.filter.ocds_status"></p>

				<label @click="toggleFilter('ocds_ongoing')">
					<tick :checked="filters.ocds_ongoing" colour="blue" />
					<span v-html="content.filter.ocds_ongoing" />
				</label>

				<label @click="toggleFilter('ocds_historic')">
					<tick :checked="filters.ocds_historic" colour="teal" />
					<span v-html="content.filter.ocds_historic" />
				</label>

			</div>

			<label @click="toggleFilter('commitments')">
				<tick :checked="filters.commitments" />
				<span v-html="content.filter.commitments" />
			</label>

			<label @click="toggleFilter('innovations')">
				<tick :checked="filters.innovations" />
				<span v-html="content.filter.contract" />
			</label>

		</div>

	</div> <!-- / .map-filter -->

</template>

<script>

	import _ from 'underscore'
	import { mapGetters, mapActions } from 'vuex'

    export default {

		methods: {

			...mapActions([
				'toggleFilter'
			]),

			closeFilter() {
				this.$emit('closeFilter');
			},

			showTable() {

				this.$router.push({
					name: 'table'
				})

			},

			showMap() {

				this.$router.push({
					name: 'map'
				})

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
	@import "../../../../scss/_bootstrap.scss";

	.map-filter {

		position: relative;
		z-index: 10;
		background-color: $ui-white;
		padding: spacing(2);
		height: 100%;

		@include from(M) {
			min-width: 384px;
		}

		@include from(M) {
			padding: spacing(6) spacing(8);
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

			font-size: 24px;

			@include from(M) {
				font-size: 42px;
				margin-bottom: spacing(3);
			}

		}

		.map-filter__strap {

			font-size: 16px;
			@include font('secondary');
			margin-bottom: spacing(2);

			@include from(M) {
				margin-bottom: spacing(4);
			}

			> :last-child {
				margin-bottom: 0;
			}

		}

		.map-filter__controls {
			font-size: 12px;
			@include font('secondary', 'bold');
			color: $ui-grey-4;
		}

		.map-filter__controls label {

			font-size: 12px;
			margin-bottom: spacing(2);
			display: flex;
			align-items: center;
			user-select: none;
			text-transform: none;

			.tick {
				flex: 0 0 1em;
				margin-right: spacing(2);
			}

			span {
				margin-top: .1em;
			}

		}

		label.filter-control__all {
			padding-bottom: spacing(2);
			margin-bottom: spacing(2);
			border-bottom: 4px solid $ui-brand-2;
		}

		.filter-control__children {

			padding-left: calc(21px + #{spacing(2)});
			display: flex;
			flex-wrap: wrap;
			margin-top: spacing(-1);

			p {
				flex: 0 0 100%;
				margin-bottom: spacing(1);
				color: $ui-grey-9;
			}

			label {
				margin-right: spacing(4);
			}

		}


	.map-view-toggle {

		display: flex;
		flex-wrap: wrap;
		align-items: center;
		margin-bottom: spacing(4);

		@include upto(M) {
			display: none;
		}

	}

		.map-view-toggle__item {

			font-size: 14px;
			@include font('primary', 'semibold');
			display: flex;
			align-items: center;
			cursor: pointer;

			&:not(:last-child) {
				margin-right: spacing(2);
			}

			> svg {
				font-size: 16px;
				width: 1em;
				height: 1em;
				fill: currentColor;
				margin-left: spacing(.5);
			}

		}

	// map-view-toggle__item

</style>
