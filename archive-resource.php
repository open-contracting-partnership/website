<?php // archive-resource.php ?>

<?php get_header(); ?>

	<?php

		$resources = vue_posts([
			'query' => array(
				'post_type' => 'resource',
				'posts_per_page' => -1
			),
			'taxonomies' => ['resource-type', 'region', 'issue', 'open-contracting'],
			'fields' => ['short_description', 'organisation', 'attachments', 'link'],
			'custom' => array(
				'year' => function($vue_post) {
					return date('Y', strtotime($vue_post->post_date));
				}
			)
		]);

		$resource_types = array_values(get_terms('resource-type'));

	?>

	<div id="resources" class="resources-overview / vue-loading">

		<div class="resource__header">

			<div class="wrapper">

				<div class="resource-search__container">
					<svg><use xlink:href="#icon-search"></svg>
					<input type="search" placeholder="<?php _e('Search for resources', 'ocp'); ?>" v-model="search" class="resource-search">
				</div>

				<div class="resource-filter__container" v-bind:class="{ active: display_filter === true }">

					<div class="resource-filter__controls / vue-load__component">

						<a href="#reset-filter" v-show="isFiltered" v-on:click.prevent="reset()"><?php _e('Reset Filter', 'ocp'); ?></a>
						<a href="#open-filter" v-show="display_filter === false" v-on:click.prevent="display_filter = true"><?php _e('Filter', 'ocp'); ?></a>

						<a href="#close-filter" v-on:click.prevent="display_filter = false">
							<svg><use xlink:href="#icon-close"></svg>
						</a>

					</div>

					<div class="resource-filter__inner">

						<label class="resource-filter / custom-checkbox / vue-load__component" v-for="resource_type in resource_types">

							<input type="checkbox" value="{{ resource_type.slug }}" v-model="filter_resource_type" />

							<span class="custom-checkbox__box">
								<svg><use xlink:href="#icon-close"></svg>
							</span>

							{{{ resource_type.name }}}

						</label>

					</div>

					<a href="#apply-filter" v-on:click.prevent="display_filter = false"><?php _e('Apply Filter', 'ocp'); ?></a>

				</div> <!-- / .resource__filter-container -->

			</div> <!-- / .wrapper -->

		</div> <!-- / .resource__header -->

		<div class="wrapper">

			<div v-if="visibleResources.length" class="resources-container">

				<div v-for="resource in visibleResources" v-on:click="openResource(resource, $event)" class="card card--primary / vue-load__component">
					<resource :resource="resource"></resource>
				</div>

			</div>

			<p v-else class="vue-load__component"><?php _e('No resources available to display', 'ocp'); ?></p>

		</div>

		<div class="resource__overlay" v-if="open_resource !== null" transition="resource" v-on:click.prevent="closeResource()"></div>

		<div class="resource / vue-load__component" v-if="open_resource !== null" transition="resource">

			<div class="resource-title">
				<svg><use xlink:href="#icon-resource" /></svg>
			</div>

			<h1 class="gamma">{{{ open_resource.title }}}</h1>

			<p class="resource__meta">

				<span class="resource__published-date">{{ open_resource.custom.year }}</span>

				<span v-if="resource.fields.organisation !== ''">
					By {{ open_resource.fields.organisation}}
				</span>

			</p>

			<p v-if="open_resource.fields.attachments">
				<a onclick="_gaq.push(['_trackEvent', 'Resources', 'Download', '{{{ open_resource.title }}}']);" href="{{ open_resource.fields.attachments[0].file }}" class="button button--block button--large button--icon button--icon--reverse button--icon--stroke">Download<svg><use xlink:href="#icon-download" /></svg></a>
			</p>

			<p v-if="open_resource.fields.link">
				<a onclick="_gaq.push(['_trackEvent', 'Resources', 'Visit', '{{{ open_resource.title }}}']);" href="{{ open_resource.fields.link }}" class="button button--block button--large">View</a>
			</p>

			<hr />

			<div class="post-content">
				{{{ open_resource.content }}}
			</div>

			<div class="band">

				<ul class="button__list button__social">
					<li><a href="https://www.facebook.com/sharer/sharer.php?u={{ open_resource.link | encodeURI }}" target="_blank" class="button"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use></svg></a></li>
					<li><a href="https://www.linkedin.com/cws/share?url={{ open_resource.link | encodeURI }}" target="_blank" class="button"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-linkedin"></use></svg></a></li>
					<li><a href="https://twitter.com/home?status={{ open_resource.title | encodeURI }} - {{ open_resource.link | encodeURI }}" target="_blank" class="button"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter"></use></svg></a></li>
					<li><a href="mailto:?subject={{ open_resource.title | encodeURI }}&amp;body=Hi,%0D%0A%0D%0AI thought you would be interested in this article on Open Contracting: {{ open_resource.title | encodeURI }} – {{ open_resource.link | encodeURI }}" target="_blank" class="button"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-mail"></use></svg></a></li>
				</ul>

			</div>

			<hr />

			<div class="band band--extra-thick">

				<ul class="tag-list" v-if="hasTerms(open_resource.taxonomies['region'])">

					<li class="tag-list__title"><?php _e('Region', 'ocp'); ?>:</li>

					<li v-for="region in open_resource.taxonomies['region']">
						<a href="/region/{{ $key }}">{{{ region }}}</a>
					</li>

				</ul>

				<ul class="tag-list" v-if="hasTerms(open_resource.taxonomies['issue'])">

					<li class="tag-list__title"><?php _e('Issue', 'ocp'); ?>:</li>

					<li v-for="issue in open_resource.taxonomies['issue']">
						<a href="/issue/{{ $key }}">{{{ issue }}}</a>
					</li>

				</ul>

				<ul class="tag-list" v-if="hasTerms(open_resource.taxonomies['open-contracting'])">

					<li class="tag-list__title"><?php _e('OC Framework', 'ocp'); ?>:</li>

					<li v-for="open_contracting in open_resource.taxonomies['open-contracting']">
						<a href="/open-contracting/{{ $key }}">{{{ open_contracting }}}</a>
					</li>

				</ul>

			</div>

			<a href="#" class="resource__close" v-on:click.prevent="closeResource()"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg></a>

		</div> <!-- / .resource -->

		<script type="x/templates" id="resource-template">

			<div class="card__header / card--content-spine" data-content-type="resource">

				<div class="content-spine__icon">
					<svg><use xlink:href="#icon-resource"></svg>
				</div>

				<span class="content-spine__title">{{{ type }}}</span>

				<span class="content-spine__meta">{{{ resource.custom.year }}}</span>

			</div>

			<div class="card__content">

				<div class="card__title">

					<h6 class="card__heading">
						<a class="card__link" href="{{ resource.link }}">{{{ resource.title }}}</a>
					</h6>

				</div>

				<p class="card__meta" v-if="resource.fields.organisation !== ''">
					<span class="card__author"><?php _e('By', 'ocp'); ?> {{ resource.fields.organisation }}</span>
				</p>

			</div>

		</script>

		<script>

			// register the grid component
			Vue.component('resource', {

				template: '#resource-template',
				props: {
					resource: Object
				},

				computed: {

					type: function() {
						return this.resource.taxonomies['resource-type'][Object.keys(this.resource.taxonomies['resource-type'])[0]];
					}

				}

			});

			// store the main resource url for use within push state
			var resource_url = window.location.protocol + '//' + window.location.hostname + window.location.pathname;

			var resource_vue = new Vue({

				el: '#resources',

				data: {
					// data
					resources: <?php echo json_encode($resources); ?>,
					resource_types: <?php echo json_encode($resource_types); ?>,
					// state
					display_filter: false,
					// search and filters
					search: '',
					filter_resource_type: [],
					// open resource
					open_resource: null
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

					},

					isFiltered: function() {
						return this.filter_resource_type.length;
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
					},

					hasTerms: function(taxonomy) {
						return Object.keys(taxonomy).length > 0;
					},

					openResource: function(resource, event) {

						var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

						if ( width > 810 ) {

							event.preventDefault();

							this.open_resource = resource;

							history.pushState({resource_id: resource.id}, null, resource.link);

						}

					},

					closeResource: function(update_url) {

						// close the current resource
						this.open_resource = null;

						// return back to the resources url
						if ( update_url !== false ) {
							history.pushState({}, null, resource_url);
						}

					}

				},

				filters: {

					encodeURI: function(string) {
						string = string.replace('&nbsp;', ' ');
						return encodeURIComponent(string);
					}

				},

				ready: function() {

					setTimeout(function() {

						// remove the vue loading class, blocking access to the output
						$(this.$el).removeClass('vue-loading');

					}.bind(this), 250);

				}

			});

			var intersection = function (haystack, arr) {

				return arr.some(function (v) {
					return haystack.indexOf(v) >= 0;
				});

			};

			window.addEventListener('popstate', function(event) {

				if ( event.state && typeof event.state.resource_id !== 'undefined' ) {

					// filter the resources to match by id
					var result = $.grep(resource_vue.resources, function(e){ return e.id == event.state.resource_id; });

					// if a result is returned, set the open resource
					if ( result.length ) {
						resource_vue.open_resource = result[0];
					}

				} else {

					// no resource has been specified, we must want to close
					// and return to the resources overview

					resource_vue.closeResource(false);

				}

			});

		</script>

	</div> <!-- / #resources -->

<?php get_footer(); ?>
