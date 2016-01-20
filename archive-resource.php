<?php // archive-resource.php ?>

<?php get_header(); ?>

	<div id="resources">

		<input type="search" placeholder="Search" v-model="search">

		<h1>Resources</h1>

		<?php

			$resources = vue_posts([
				'query' => array(
					'post_type' => 'resource',
					'posts_per_page' => -1
				),
				'taxonomies' => ['resource-type', 'country', 'region'],
				'fields' => [],
				'custom' => array(
					'year' => function($vue_post) {
						return date('Y', strtotime($vue_post->post_date));
					}

				)
			]);

			$resource_types = array_values(get_terms('resource-type'));

		?>

		<p>

			<label>
				2014
				<input type="checkbox" value="2014" v-model="filter_years" />
			</label>
			<label>
				2015
				<input type="checkbox" value="2015" v-model="filter_years" />
			</label>
			<label>
				2016
				<input type="checkbox" value="2016" v-model="filter_years" />
			</label>

		</p>

		<p>

			<label v-for="resource_type in resource_types">
				{{ resource_type.name }}
				<input type="checkbox" value="{{ resource_type.slug }}" v-model="filter_resource_type" />
			</label>

		</p>

		<div v-if="visibleResources.length">

			<div v-for="resource in visibleResources">
				<resource :resource="resource"></resource>
			</div>

		</div>

		<p v-else>No resources available to display</p>

		<template id="resource-template">

			<div class="box">
				<h1><a href="{{resource.link}}">{{resource.title}}</a></h1>
				<pre>{{ resource | json }}</pre>
			</div>

		</template>

		<script src="https://cdn.jsdelivr.net/vue/latest/vue.js"></script>

		<script>

			// register the grid component
			Vue.component('resource', {
				template: '#resource-template',
				props: {
					resource: Object
				}
			})

			// bootstrap the demo
			var demo = new Vue({

				el: '#resources',

				data: {
					resources: <?php echo json_encode($resources); ?>,
					resource_types: <?php echo json_encode($resource_types); ?>,
					// search and filters
					search: '',
					filter_years: [],
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

					'filter_years':  function () {
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

						// apply year filter

						if ( this.filter_years.length ) {

							this.resources.forEach(function(resource, index) {

								if ( this.filter_years.indexOf(resource.year) === -1 ) {
									resource.display = false;
								}

							}.bind(this));

						}

						// apply resource type filter

						if ( this.filter_resource_type.length ) {

							this.resources.forEach(function(resource, index) {

								if ( ! intersection(Object.keys(resource.taxonomies['resource-type']), this.filter_resource_type) ) {
									resource.display = false;
								}

							}.bind(this));

						}


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
