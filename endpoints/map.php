<link rel="stylesheet" href="/wp-content/themes/ocp-v1/assets/map/styles/main-9f505b5fc2.css">
<script src="/wp-content/themes/ocp-v1/assets/map/scripts/vendor-f502083317.js"></script>
<script src="/wp-content/themes/ocp-v1/assets/map/scripts/bundle-c3c893c47f.js"></script>

<div class="js-worldmap-container">

	<div class="oc-map--map-widget"></div>
	<script>
		OC_MAP.initMapWidget(document.querySelector('.oc-map--map-widget'));
	</script>

	<!-- <div class="oc-map--table-widget"></div> -->
	<script>
		// OC_MAP.initTableWidget(document.querySelector('.oc-map--table-widget'));
	</script>

</div>

<style>

	body, html {
		margin: 0;
		padding: 0;
	}

	.js-worldmap-container {
		overflow: hidden;
	}

	.oc-map--map-widget {
		margin-right: 0;
		margin-top: 0;
		margin-left: 0;
	}

	.oc-map--table-widget {
		margin-right: 0;
		margin-left: 0;
	}

</style>

<script>

	function resizeWindow() {

		var height = document.querySelectorAll('.js-worldmap-container')[0].offsetHeight;

		// introduce an extra 100px to attempt to prevent shaking
		window.parent.postMessage(['setHeight', height], '*');

	}

	document.addEventListener('DOMContentLoaded', resizeWindow, false);

	window.setInterval(function() {
		resizeWindow();
	}, 1000);

	resizeWindow();

</script>
