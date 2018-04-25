<template>

	<div class="map__container">

		<div class="map">

			<div class="map-controls">

				<transition name="map-filter">

					<div class="map-controls__filter" v-if="display_filter">
						<country-filter @closeFilter="show_filter = false" />
					</div>

				</transition>

				<div class="map-controls__middle">

					<country-search @change="setCountry" />

					<div class="map-zoom">

						<span @click="zoomIn">
							<svg><use xlink:href="#icon-plus" /></svg>
						</span>

						<span @click="zoomOut">
							<svg><use xlink:href="#icon-minus" /></svg>
						</span>

					</div>

					<data-table v-if="display_table" />

				</div>

				<transition name="map-country">

					<div class="map-controls__country" v-if="selected_country">
						<country />
					</div>

				</transition>

			</div>

			<link href='/wp-content/themes/ocp-v1/node_modules/mapbox-gl/dist/mapbox-gl.css' rel='stylesheet' />
			<div id='map'></div>

		</div>

		<button class="button button--dark / map__filter-cta" v-if="! show_filter" @click.prevent="show_filter = ! show_filter">Filter Options</button>
		<button class="button button--brand / map__filter-cta" v-if="show_filter" @click.prevent="show_filter = ! show_filter">Close</button>

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
				show_filter: false,
				is_mobile: false,
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
				return this.ocds.ongoing && this.ocds.implemented && this.ocds.historic;
			},

			ocds_any() {
				return this.ocds.ongoing || this.ocds.implemented || this.ocds.historic;
			},

			display_filter() {

				if ( ['map', 'table'].indexOf(this.$route.name) === -1 ) {
					return false;
				}

				if ( ! this.is_mobile ) {
					return true;
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

				let filters = {
					active: [],
					inactive: [],
					ocds_historic: [],
					ocds_implementation: [],
					ocds_ongoing: []
				}

				// get initial pool with a deep copy
				let base_countries = _.map(this.countries, _.clone);

				base_countries = _.filter(base_countries, (country) => {
					return country.has_data;
				});


				 //*******
				// ACTIVE

				filters.active = _.filter(base_countries, (country) => {

					let keep = true;

					if ( this.filters.all === false ) {
						keep = false;
					}

					if ( this.filters.ocds && ! country.filter_ocds ) {
						keep = false;
					}

					if ( this.filters.commitments && ! country.filter_commitments ) {
						keep = false;
					}

					if ( this.filters.innovations && ! country.filter_innovations ) {
						keep = false;
					}

					return keep;

				});


				 //*********
				// INACTIVE

				filters.active.forEach((country) => {

					const index = _.findIndex(base_countries, (base_country) => {
						return base_country.iso_a2 === country.iso_a2;
					});

					if ( index !== -1 ) {
						base_countries.splice(index, 1);
					}

				});

				filters.inactive = base_countries;


				 //*****
				// OCDS

				if ( this.filters.ocds_ongoing ) {

					filters.active.forEach((country, index) => {

						if ( country.filter_ocds_ongoing ) {
							filters.ocds_ongoing.push(country);
							filters.active.splice(index, 1);
						}

					});

				}

				if ( this.filters.ocds_implementation ) {

					filters.active.forEach((country, index) => {

						if ( country.filter_ocds_implementation ) {
							filters.ocds_implementation.push(country);
							filters.active.splice(index, 1);
						}

					});

				}

				if ( this.filters.ocds_historic ) {

					filters.active.forEach((country, index) => {

						if ( country.filter_ocds_historic ) {
							filters.ocds_historic.push(country);
							filters.active.splice(index, 1);
						}

					});

				}



				_.each(filters, (filter, index) => {

					let mb_filters = [];

					filter.forEach((item) => {
						mb_filters.push(['==', 'iso_a2', item.iso_a2]);
					});

					filters[index] = mb_filters;

				});

				return filters;

			}

		},

		watch: {

			filter(new_value, old_value) {

				if ( this.filter === 'ocds' && ! this.ocds_any ) {
					this.ocds.ongoing = true;
					this.ocds.implemented = true;
					this.ocds.historic = true;
				}

				if ( this.filter !== 'ocds' ) {
					this.ocds.ongoing = false;
					this.ocds.implemented = false;
					this.ocds.historic = false;
				}

			},

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
					'id': 'ocp-country-ocds-implementation-fill',
					'type': 'fill',
					'source': 'countries',
					'layout': {},
					'paint': {
						'fill-color': '#FD843D',
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

				// loop through the available filters and apply either the filter or a bank
				_.each(this.mapbox_filters, (filter, key) => {

					// always unset filter to enforce the correct layer order
					this.map.setFilter('ocp-country-' + key.replace('_', '-') + '-fill', ['==', 'name', '']);

					if ( filter.length ) {
						this.map.setFilter('ocp-country-' + key.replace('_', '-') + '-fill', ['any'].concat(filter));
					}

				});

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

			var resizeThrottled = _.throttle(function() {
				this.is_mobile = window.innerWidth <= 800;
			}.bind(this), 500);

			window.addEventListener('resize', resizeThrottled);

			resizeThrottled();

			this.setMap();

		}

	}

</script>

<style lang="scss">

	// ATTN: this is not ideal, but webpack aliases aren't working
	@import "../../../scss/_bootstrap.scss";

	.map__container {
		flex: 1 1 100%;
		display: flex;
		flex-direction: column;
	}

	.map {
		position: relative;
		flex: 1 1 100%;
		display: flex;
		flex-direction: column;
	}

	[id="map"] {
		flex: 1 1 100%;
	}


	.map__filter-cta {

		flex: 0 0 auto;
		margin-bottom: 0;

		@include from(M) {
			display: none;
		}

	}

	.map-controls {
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		z-index: 9;
		display: flex;
		justify-content: space-between;
		pointer-events: none;
	}

		.map-controls__filter {

			@include upto(M) {
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
			}

			flex: 0 0 385px;
			pointer-events: all;
			overflow: hidden;
			display: flex;
			justify-content: flex-end;

		}

			.map-filter-enter-active,
			.map-filter-leave-active {
				transition: flex-basis 1s ease;
			}

			.map-filter-enter,
			.map-filter-leave-to {
				flex-basis: 0;
			}


		.map-controls__middle {

			flex: 1 1 100%;
			position: relative;
			padding: spacing(5);
			display: flex;
			justify-content: center;
			align-items: flex-start;
			pointer-events: none;

			> * {
				pointer-events: all;
			}

		}

		.map-zoom {

			position: absolute;

			@include upto(910) {
				bottom: spacing(5);
				right: spacing(2);
			}

			@include from(910) {
				top: spacing(5);
				right: spacing(5);
			}

			span {
				border: 1px solid color('body');
				background-color: color('white');
				display: block;
				padding: 4px;
				margin-bottom: 4px;
				cursor: pointer;
			}

			span > svg {
				font-size: 8px;
				width: 1em;
				height: 1em;
				display: block;
			}

		}

		.map-controls__country {

			@include upto(M) {
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
			}

			flex: 0 0 600px;
			pointer-events: all;
			overflow: hidden;
			display: flex;
			justify-content: start;

		}

			.map-country-enter-active,
			.map-country-leave-active {
				transition: flex-basis 1s ease;
			}

			.map-country-enter,
			.map-country-leave-to {
				flex-basis: 0;
			}

</style>
