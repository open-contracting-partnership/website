<template>

	<div class="map">

		<link href='/wp-content/themes/ocp-v1/node_modules/mapbox-gl/dist/mapbox-gl.css' rel='stylesheet' />

		<div id='map'></div>

	</div>

</template>

<script>

	import mapboxgl from 'mapbox-gl'

	export default {

		data: () => {

			return {
				map_loaded: false
			}

		},
		computed: {


		},

		methods: {

			setMap() {

				mapboxgl.accessToken = 'pk.eyJ1IjoidGhlaWRlYWJ1cmVhdSIsImEiOiJVaU9wVmlVIn0.OCGZoNkQ1GU3vOMwspFvBw';
				this.map = new mapboxgl.Map({
					container: 'map',
					style: 'mapbox://styles/theideabureau/cj98q867x2m1x2slgf3d860hl',
					zoom: 1
				});

				this.map.once('load', function loaded() {

					// mark the map as being loaded
					this.map_loaded = true;

				}.bind(this));

			}

		},

		watch: {


		},

		mounted: function() {
		console.log('aaa');
		this.setMap();
		}

	}

</script>
