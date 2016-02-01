<?php // archive-resource.php ?>

<?php get_header(); ?>

<form action="#" class="custom-checkbox">
	<label><input type="checkbox" name="name" value=""><span><svg><use xlink:href="#icon-close"></svg></span>Checkbox</label>
</form>

	<?php

		$resources = vue_posts([
			'query' => array(
				'post_type' => 'resource',
				'posts_per_page' => -1
			),
			'taxonomies' => ['resource-type', 'country', 'region'],
			'fields' => ['short_description'],
			'custom' => array(
				'year' => function($vue_post) {
					return date('Y', strtotime($vue_post->post_date));
				}

			)
		]);

		$resource_types = array_values(get_terms('resource-type'));

	?>

	<div id="resources" class="resources-overview">

		<header>

			<div class="wrapper">

				<div class="resource__header">

					<div class="resource-search__container">
						<input type="search" placeholder="Search" v-model="search" class="resource-search">
					</div>

					<p class="resources__popular">This week's popular items are <a href="#">report 1</a>, <a href="#">report 2</a> and <a href="#">report 3</a></p>

					<div class="resource__filter-container">

						<div class="resource__filter">

							<label>
								2011
								<input type="checkbox" value="2011" v-model="filter_years" />
							</label>

							<label>
								2012
								<input type="checkbox" value="2012" v-model="filter_years" />
							</label>

							<label>
								2013
								<input type="checkbox" value="2013" v-model="filter_years" />
							</label>

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

						</div>

						<div class="resource__filter">

							<label v-for="resource_type in resource_types">
								<input type="checkbox" value="{{ resource_type.slug }}" v-model="filter_resource_type" />
								{{ resource_type.name }}
							</label>

						</div>

					</div> <!-- / .resource__filter-container -->

				</div> <!-- / .resource__header -->

			</div> <!-- / .wrapper -->

		</header>

		<div class="wrapper">

			<div v-if="visibleResources.length">

				<div v-for="resource in visibleResources" class="resource">
					<resource :resource="resource"></resource>
				</div>

			</div>

			<p v-else>No resources available to display</p>

		</div>

		<template id="resource-template">

			<a href="{{resource.link}}">
				<img src="http://placehold.it/116x151" />
			</a>

			<h1><a href="{{resource.link}}">{{resource.title}}</a></h1>

			<p>
				<a v-for="type in resource.taxonomies['resource-type']" href="/resource-type/{{ $key }}">{{ type }}</a>
			</p>

			{{{ resource.fields.short_description }}}

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
