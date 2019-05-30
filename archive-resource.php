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

		wp_localize_script('resources', 'content', [
			'resources' => $resources,
			'resource_types' => $resource_types
		]);

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

							<input type="checkbox" :value="resource_type.slug" v-model="filter_resource_type" />

							<span class="custom-checkbox__box">
								<svg><use xlink:href="#icon-close"></use></svg>
							</span>

							<span class="resource-filter__label" v-html="resource_type.name"></span>

						</label>

					</div>

					<a href="#apply-filter" v-on:click.prevent="display_filter = false"><?php _e('Apply Filter', 'ocp'); ?></a>

				</div> <!-- / .resource__filter-container -->

			</div> <!-- / .wrapper -->

		</div> <!-- / .resource__header -->

		<div class="wrapper">

			<div v-if="visibleResources.length" class="resources-container">
				<resource v-for="(resource, index) in visibleResources" :key="index" :resource="resource" @clicked="openResource"></resource>
			</div>

			<p v-else class="vue-load__component"><?php _e('No resources available to display', 'ocp'); ?></p>

		</div>

		<transition name="resource-overlay">
			<div v-cloak class="resource__overlay" v-if="open_resource !== null" v-on:click.prevent="closeResource()"></div>
		</transition>

		<transition name="resource">

			<div v-cloak class="resource" v-if="open_resource !== null">

				<div class="resource-title">
					<svg><use xlink:href="#icon-resource" /></svg>
				</div>

				<!-- <?php if ( $type = get_field('resource_type') ) : ?>
					<span class="card__type" data-content-type="resource"><?php echo $type->name; ?></span>
				<?php endif; ?> -->

				<h1 class="gamma / resource-heading" v-html="open_resource.title"></h1>

				<p class="resource__meta">

					<span class="resource__published-date">{{ open_resource.custom.year }}</span>

					<span v-if="open_resource.fields.organisation !== ''">
						By {{ open_resource.fields.organisation}}
					</span>

				</p>

				<p v-if="open_resource.fields.attachments">

					<a
						@click="trackClick('Download', open_resource.title)"
						:href="open_resource.fields.attachments[0].file"
						class="button button--block button--large button--solid-green button--icon button--icon--reverse button--icon--stroke"
					>
						Download<svg><use xlink:href="#icon-download" /></svg>
					</a>

				</p>

				<p v-if="open_resource.fields.link">

					<a
						@click="trackClick('Download', open_resource.title)"
						:href="open_resource.fields.link"
						class="button button--block button--solid-green button--large"
					>
						View
					</a>

				</p>

				<hr data-colour="grey">

				<div class="post-content" v-html="open_resource.content"></div>

				<div class="band">

					<ul class="button__list button__social">
						<li><a :href="socialLinks.facebook" target="_blank" class="button"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use></svg></a></li>
						<li><a :href="socialLinks.linkedin" target="_blank" class="button"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-linkedin"></use></svg></a></li>
						<li><a :href="socialLinks.twitter" target="_blank" class="button"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-twitter"></use></svg></a></li>
						<li><a :href="socialLinks.email" target="_blank" class="button"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-mail"></use></svg></a></li>
					</ul>

				</div>

				<hr data-colour="grey">

				<div class="band band--extra-thick">

					<ul class="tag-list" v-if="hasTerms(open_resource.taxonomies['region'])">

						<li class="tag-list__title"><?php _e('Region', 'ocp'); ?>:</li>

						<li v-for="(region, index) in open_resource.taxonomies['region']">
							<a :href="'/region/' + index" v-html="region"></a>
						</li>

					</ul>

					<ul class="tag-list" v-if="hasTerms(open_resource.taxonomies['issue'])">

						<li class="tag-list__title"><?php _e('Issue', 'ocp'); ?>:</li>

						<li v-for="(issue, index) in open_resource.taxonomies['issue']">
							<a :href="'/issue/' + index" v-html="issue"></a>
						</li>

					</ul>

					<ul class="tag-list" v-if="hasTerms(open_resource.taxonomies['open-contracting'])">

						<li class="tag-list__title"><?php _e('OC Framework', 'ocp'); ?>:</li>

						<li v-for="(open_contracting, index) in open_resource.taxonomies['open-contracting']">
							<a :href="'/open-contracting/' + index" v-html="open_contracting"></a>
						</li>

					</ul>

				</div>

				<a href="#" class="resource__close" v-on:click.prevent="closeResource()"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg></a>

			</div> <!-- / .resource -->

		</transition>

	</div> <!-- / #resources -->

<?php get_footer(); ?>
