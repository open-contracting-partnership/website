<template>

	<div class="map">

		<div class="mapbox-container">
			<link href='/wp-content/themes/ocp-v1/dist/node_modules/mapbox-gl/mapbox-gl.css' rel='stylesheet' />
			<div id='map'></div>
		</div>

		<div class="map__filter" ref="filter" v-bind:class="{ 'open': display_filter }">
			<country-filter @closeFilter="show_filter = false" />
		</div>

		<div class="map__header">

			<country-search @change="setCountry" :placeholder="content.search.placeholder" />

			<div class="map-zoom">

				<span @click="zoomIn">
					<svg><use xlink:href="#icon-plus" /></svg>
				</span>

				<span @click="zoomOut">
					<svg><use xlink:href="#icon-minus" /></svg>
				</span>

			</div>

		</div>

		<div class="map__country" ref="country" v-bind:class="{ 'open': selected_country }">
			<country v-if="selected_country" />
		</div>

		<div class="map__footer">
			<button class="button--naked / map__filter-cta" v-if="! show_filter" @click.prevent="show_filter = ! show_filter" v-html="content.map.filter"></button>
			<button class="button--naked / map__filter-cta" v-if="show_filter" @click.prevent="show_filter = ! show_filter" v-html="content.map.close"></button>
		</div>

		<data-table v-show="display_table"></data-table>

	</div>

</template>

<script>

	import mapboxgl from 'mapbox-gl'
	import _ from 'underscore'
	import { mapGetters, mapActions } from 'vuex'

	export default {

		data: () => {

			return {
				content: content,
				map_loaded: false,
				show_filter: false
			}

		},

		computed: {

			...mapGetters([
				'countries',
				'geo_countries',
				'filters',
				'selected_country'
			]),

			ocds_all() {
				return this.filters.ocds_ongoing && this.filters.ocds_historic;
			},

			ocds_any() {
				return this.filters.ocds_ongoing || this.filters.ocds_historic;
			},

			display_filter() {

				if ( ['map', 'table'].indexOf(this.$route.name) === -1 ) {
					return false;
				}

				return this.show_filter;

			},

			display_table() {
				return this.$route.name === 'table';
			},

			can_load_map() {
				return this.map_loaded && this.countries !== null && this.geo_countries !== null;
			},

			mapbox_filters() {

				const others = this.filters.ocds
					|| this.filters.ocds_ongoing
					|| this.filters.ocds_historic
					|| this.filters.commitments
					|| this.filters.innovations;

				let filters = {
					active: [],
					inactive: [],
					ocds_historic: [],
					ocds_ongoing: []
				}

				_.each(this.countries, (country) => {

					const code = country.iso_a2;

					// OCDS ongoing
					if ( this.filters.ocds_ongoing && country.filter_ocds_ongoing ) {
						filters.ocds_ongoing.push(code);
						return;
					}

					// OCDS historic
					if ( this.filters.ocds_historic && country.filter_ocds_historic ) {
						filters.ocds_historic.push(code);
						return;
					}

					// OCDS catch-all
					if ( this.filters.ocds && country.filter_ocds ) {
						filters.active.push(code);
						return;
					}

					// commitments
					if ( this.filters.commitments && country.filter_commitments ) {
						filters.active.push(code);
						return;
					}

					// innovations
					if ( this.filters.innovations && country.filter_innovations ) {
						filters.active.push(code);
						return;
					}

					// if only "all" has been selected, but nothing else, but
					// the country has data, show this as active. this prevents
					// situations where ocds is enabled but so are all active
					// countries

					if ( this.filters.all && ! others && country.has_data ) {
						filters.active.push(code);
						return;
					}

					// if we've sailed through to here, the country is inactive
					filters.inactive.push(code);

				});

				_.each(filters, (filter, index) => {

					let mb_filters = [];

					filter.forEach((code) => {
						mb_filters.push(['==', 'iso_a2', code]);
					});

					filters[index] = mb_filters;

				});

				return filters;

			}

		},

		watch: {

			can_load_map() {

				this.map.addSource('countries', {
					type: 'geojson',
					data: this.geo_countries
				});

				this.map.addLayer({
					'id': 'ocp-country-inactive-fill',
					'type': 'fill',
					'source': 'countries',
					'layout': {},
					'paint': {
						'fill-color': '#D5D5D7',
						'fill-opacity': .35
					},
					'filter': ['==', 'name', '']
				});

				this.map.addLayer({
					'id': 'ocp-country-active-fill',
					'type': 'fill',
					'source': 'countries',
					'layout': {},
					'paint': {
						'fill-color': '#D6E100',
						'fill-opacity': .35
					},
					'filter': ['==', 'name', '']
				});

				this.map.addLayer({
					'id': 'ocp-country-ocds-historic-fill',
					'type': 'fill',
					'source': 'countries',
					'layout': {},
					'paint': {
						'fill-color': '#23B2A7',
						'fill-opacity': .35
					},
					'filter': ['==', 'name', '']
				});

				this.map.addLayer({
					'id': 'ocp-country-ocds-ongoing-fill',
					'type': 'fill',
					'source': 'countries',
					'layout': {},
					'paint': {
						'fill-color': '#497AF3',
						'fill-opacity': .35
					},
					'filter': ['==', 'name', '']
				});

				this.map.addLayer({
					'id': 'ocp-country-borders',
					'type': 'line',
					'source': 'countries',
					'layout': {},
					'paint': {
						'line-color': '#979797',
						'line-width': 1,
						'line-opacity': .1
					},
					'filter': ['==', 'has_data', true]
				});

				// initiate the map colouring
				this.setMapStyles();

				const mousemove = (e) => {
					this.map.getCanvas().style.cursor = 'pointer';
				};

				const mouseleave = (e) => {
					this.map.getCanvas().style.cursor = '';
				};

				const click = (e) => {

					const code = e.features[0].properties.iso_a2.toLowerCase();

					this.setCountry(code);

				};

				const re = /ocp-country-(.*?)-fill/;

				_.each(this.map.getStyle().layers, (layer) => {

					if ( layer.id.match(re) !== null ) {
						this.map.on('mousemove', layer.id, mousemove.bind(this));
						this.map.on('mouseleave', layer.id, mouseleave.bind(this));
						this.map.on('click', layer.id, click.bind(this));
					}

				});

			},

			filters: {

				handler() {
					this.setMapStyles();
				},

				deep: true

			}

		},

		methods: {

			setMap() {

				mapboxgl.accessToken = 'pk.eyJ1IjoidGhlaWRlYWJ1cmVhdSIsImEiOiJVaU9wVmlVIn0.OCGZoNkQ1GU3vOMwspFvBw';

				this.map = new mapboxgl.Map({
					container: 'map',
					style: 'mapbox://styles/theideabureau/cj98q867x2m1x2slgf3d860hl',
					zoom: 1.3
				});

				// disable mouse wheel scrolling
				this.map.scrollZoom.disable();

				this.map.once('load', function() {

					// mark the map as being loaded
					this.map_loaded = true;

					if ( window.innerWidth >= 1024 ) {

						const padding = 0
						let left_padding = 385;

						// fit the map to the bounds of the available countries
						this.map.fitBounds(this.map.getBounds(), {
							padding: {
								top: padding + 200,
								right: padding,
								bottom: padding,
								left: left_padding,
							}
						});

					}

				}.bind(this));

			},

			setMapStyles() {

				if ( this.map_loaded ) {

					// loop through the available filters and apply either the filter or a bank
					_.each(this.mapbox_filters, (filter, key) => {

						// always unset filter to enforce the correct layer order
						this.map.setFilter('ocp-country-' + key.replace('_', '-') + '-fill', ['==', 'name', '']);

						if ( filter.length ) {
							this.map.setFilter('ocp-country-' + key.replace('_', '-') + '-fill', ['any'].concat(filter));
						}

					});

				}

			},

			setCountry(code) {

				this.$router.push({
					name: 'country',
					params: {
						code: code
					}
				})

			},

			zoomIn() {
				this.map.zoomIn();
			},

			zoomOut() {
				this.map.zoomOut();
			}

		},

		mounted() {

			this.$nextTick(() => {
				this.setMap();
			});

		}

	}

</script>

<style lang="scss">

	// ATTN: this is not ideal, but webpack aliases aren't working
	@import "../../../../scss/_bootstrap.scss";

	.map {

		display: grid;
		grid-template-rows: [all-start] minmax(min-content, max-content) 1fr repeat(2, minmax(min-content, max-content)) [all-end];
		grid-template-columns: [all-start] 1fr [all-end];
		z-index: 1;
		position: relative;
		min-height: calc(100vh - 88px);

		@include from(M) {
			grid-template-rows: [all-start] minmax(min-content, max-content) auto [all-end];
			grid-template-columns: [all-start] 450px auto 570px [all-end];
			// reduce the min-height by the header height, and then an amount to all the footer to show through
			min-height: calc((100vh - 162.5px) - 50px);
		}

	}

	[id="map"] {
		height: 100%;
	}

	.map__filter-cta {

		flex: 0 0 auto;
		margin-bottom: 0;

		@include from(M) {
			display: none;
		}

	}

	.map__filter {

		grid-row: all / -2;
		grid-column: all;
		z-index: 4;

		@include from(M) {
			grid-row: all;
			grid-column: 1;
		}

		&:not(.open) {

			@include upto(M) {
				display: none;
			}

		}

	}

		.map-zoom {

			@include upto(M) {
				position: absolute;
				bottom: spacing(10);
				right: spacing(2);
			}

			@include from(M) {
				margin-left: spacing(2);
			}

			span {
				font-size: 24px;
				height: 1em;
				width: 1em;
				background-color: $ui-grey-4;
				border-radius: 50%;
				display: block;
				padding: 4px;
				margin-bottom: 4px;
				cursor: pointer;
				display: flex;
				align-items: center;
				justify-content: center;
			}

			span > svg {
				font-size: em(14, 24);
				width: 1em;
				height: 1em;
				display: block;
				fill: $ui-white;
			}

		}

	.map__country {

		grid-row: all;
		grid-column: all;
		z-index: 5;

		@include from(M) {
			grid-row: 2;
			grid-column: 3;
			padding: spacing(5) spacing(6) spacing(5);
			z-index: 2;
		}

		&:not(.open) {
			display: none;
		}

	}

	.map__header {

		grid-row: 1;
		grid-column: all;
		padding: spacing(3);
		display: flex;
		justify-content: center;
		z-index: 3;

		@include from(M) {
			grid-row: 1;
			grid-column: 2 / 4;
			justify-content: flex-end;
			padding: spacing(4) spacing(6) spacing(1);
		}

	}

	.map__footer {

		grid-row: 4;
		grid-column: all;
		z-index: 2;

		@include from(M) {
			display: none;
		}

		button {
			display: block;
			width: 100%;
			background-color: $ui-grey;
			color: $ui-white;
			padding: spacing(1);
			font-size: 14px;
			@include font('secondary', 'bold');
			text-transform: uppercase;
		}

	}

	.mapbox-container {

		grid-row: all / -2;
		grid-column: all;
		z-index: 1;

		@include from(M) {
			grid-row: all;
		}

	}

	.map-table {

		grid-row: all;
		grid-column: all;
		z-index: 6;

		@include from(M) {
			grid-row: all;
			grid-column: 2 / all;
		}

	}

</style>
