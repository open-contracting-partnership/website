<?php // archive-resource.php ?>

<?php get_header(); ?>

	<?php

		$resources = vue_posts([
			'query' => array(
				'post_type' => 'resource',
				'posts_per_page' => -1
			),
			'taxonomies' => ['resource-type', 'region', 'issue', 'open-contracting'],
			'fields' => ['short_description', 'organisation'],
			'custom' => array(
				'year' => function($vue_post) {
					return date('d/m/y', strtotime($vue_post->post_date));
				}

			)
		]);

		$resource_types = array_values(get_terms('resource-type'));

	?>

	<div id="resources" class="resources-overview">

		<header>

			<div class="wrapper">

				<div class="resource__header">

					<div class="resource-search__container active">
						<input type="search" placeholder="Search for resources" v-model="search" class="resource-search">
					</div>

					<p class="resources__popular">This week's popular items are <a href="#">report 1</a>, <a href="#">report 2</a> and <a href="#">report 3</a></p>

					<div class="resource__filter-container" v-bind:class="{ 'active': display_filter }">

						<div class="resource__filter / custom-checkbox">

							<label v-for="resource_type in resource_types">
								<input type="checkbox" value="{{ resource_type.slug }}" v-model="filter_resource_type" />
								<span><svg><use xlink:href="#icon-close"></svg></span>
								{{ resource_type.name }}
							</label>

						</div>

						<p class="resource__filter-actions">
							<a href="#" class="button button--solid-white button--solid" v-on:click.prevent="display_filter = false">Close Filter</a>
							<a href="#" class="resource__filter-reset" v-on:click.prevent="reset()">Reset</a>
						</p>

						<a href="#" v-on:click.prevent="display_filter = true" class="resource__filter-button / button button--solid-white">Filter Results</a>

					</div> <!-- / .resource__filter-container -->

				</div> <!-- / .resource__header -->

			</div> <!-- / .wrapper -->

		</header>

		<div class="wrapper">

			<div v-if="visibleResources.length" class="resources-container">

				<div v-for="resource in visibleResources" class="post-object post-object--horizontal post-object--resource / media media--reversed">
					<resource :resource="resource"></resource>
				</div>

			</div>

			<p v-else>No resources available to display</p>

		</div>

		<template id="resource-template">

			<div class="post-object__media / media__object">
				<svg><use xlink:href="#icon-book"></svg>
			</div>

			<div class="post-object__content / media__body">

				<a href="{{resource.link}}"><h4>{{resource.title}}</h4></a>

				<p>
					By {{resource.fields.organisation}}
					<time>{{resource.custom.year}}</time>
				</p>

				<ul class="button__list">
					<li v-for="type in resource.taxonomies['resource-type']"><a href="/resource-type/{{ $key }}" class="button button--small button--uppercase button--tag">{{ type }}</a></li>
				</ul>

			</div>

		</template>

		<script src="https://cdn.jsdelivr.net/vue/latest/vue.js"></script>

		<script>

			// register the grid component
			Vue.component('resource', {
				template: '#resource-template',
				props: {
					resource: Object
				},
				methods: {

					taxonomyLabels: function(taxonomy) {
						return objectValues(this.resource.taxonomies[taxonomy]);
					}

				}
			});

function objectValues(object) {

	var array = [];

	Object.keys(object).forEach(function (key) {
		array.push(object[key]);
	});

	return array;

}

Vue.filter('objectValues', function (object) {
	console.log(objectValues(object));
  return objectValues(object);
});

			// bootstrap the demo
			var demo = new Vue({

				el: '#resources',

				data: {
					// data
					resources: <?php echo json_encode($resources); ?>,
					resource_types: <?php echo json_encode($resource_types); ?>,
					// state
					display_filter: false,
					// search and filters
					search: '',
					filter_resource_type: []
				},

				computed: {

					visibleResources: function () {

						var resources = [];

						this.resources.forEach(function(resource) {

							if ( resource.display === true ) {
								resources.push(resource);
							}

						});

						return resources;

					}

				},

				watch: {

					'search': function() {
						this.filter();
					},

					'filter_resource_type':  function () {
						this.filter();
					}

				},

				methods: {

					filter: function() {

						// reset all resources

						this.resources.forEach(function(resource, index) {
							resource.display = true;
						});

						// apply search

						if ( this.search !== "" ) {

							var re = new RegExp(this.search, "gi");

							this.resources.forEach(function(resource, index) {

								if ( resource.title.match(re) === null ) {
									resource.display = false;
								}

							});

						}

						// apply resource type filter

						if ( this.filter_resource_type.length ) {

							this.resources.forEach(function(resource, index) {

								if ( ! intersection(Object.keys(resource.taxonomies['resource-type']), this.filter_resource_type) ) {
									resource.display = false;
								}

							}.bind(this));

						}


					},

					reset: function() {
						this.search = "";
						this.filter_resource_type = [];
					}

				},

				filters: {

					objectValues: function() {
						console.log('bop');
					}

				}

			});

			var intersection = function (haystack, arr) {
				return arr.some(function (v) {
					return haystack.indexOf(v) >= 0;
				});
			};

		</script>

	</div> <!-- / #resources -->

<?php get_footer(); ?>
