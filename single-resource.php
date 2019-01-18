<?php // single-resource.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page__wrapper">

		<div class="resource-single">

			<div class="resource-title resource-title--small">
				<svg><use xlink:href="#icon-resource" /></svg>
				<a href="/resources">View All Resources</a>
			</div>

			<?php if ( $type = get_field('resource_type') ) : ?>
				<span class="card__type" data-content-type="resource"><?php echo $type->name; ?></span>
			<?php endif; ?>

			<h1 class="resource-heading"><?php the_title(); ?></h1>

			<p class="resource__meta">

				<?php if ( $organisation = get_field('organisation') ) : ?>
					Published <?php the_date('Y'); ?>, <?php echo sprintf(__('By %s', 'ocp'), $organisation); ?>
				<?php else : ?>
					Published <?php the_date('Y'); ?>
				<?php endif; ?>

			</p>

			<?php if ( $attachments = get_field('attachments') ) : ?>

				<a
					onclick="_gaq.push(['_trackEvent', 'Resources', 'Download', '<?php the_title(); ?>']);"
					href="<?php echo $attachments[0]['file']; ?>"
					class="button button--large button--solid-green button--icon button--icon--reverse button--icon--stroke / resource-single__button"
				>Download resource<svg><use xlink:href="#icon-download" /></svg></a>

			<?php endif; ?>

			<?php if ( $link = get_field('link') ) : ?>

				<a
					onclick="_gaq.push(['_trackEvent', 'Resources', 'Visit', '<?php the_title(); ?>']);"
					href="<?php echo $link; ?>"
					class="button button--large button--solid-green / resource-single__button"
				>View resource</a>

			<?php endif; ?>

			<hr class="resource-line" data-colour="grey">

			<div class="resource__details">

				<?php if ( $terms = get_field('region') ) : ?>

					<ul class="tag-list">

						<li class="tag-list__title"><?php _e('Region', 'ocp'); ?>:</li>

						<?php foreach ( $terms as $term ) : ?>

							<li>
								<a href="/region/<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
							</li>

						<?php endforeach; ?>

					</ul>

				<?php endif; ?>

				<?php if ( $terms = get_field('issue') ) : ?>

					<ul class="tag-list">

						<li class="tag-list__title"><?php _e('Issue', 'ocp'); ?>:</li>

						<?php foreach ( $terms as $term ) : ?>

							<li>
								<a href="/issue/<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
							</li>

						<?php endforeach; ?>

					</ul>

				<?php endif; ?>

				<?php if ( $terms = get_field('open_contracting') ) : ?>

					<ul class="tag-list">

						<li class="tag-list__title"><?php _e('OC Framework', 'ocp'); ?>:</li>

						<?php foreach ( $terms as $term ) : ?>

							<li>
								<a href="/open-contracting/<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
							</li>

						<?php endforeach; ?>

					</ul>

				<?php endif; ?>

			</div> <!-- / .resource__details -->

			<article class="post-content / band--thick">
				<?php the_content(); ?>
			</article>

			<div class="share">

				<h3 class="zeta uppercase / share-title"><?php _e('Share', 'ocp'); ?></h3>

				<ul class="button__list button__social">
					<li><a href="<?php echo share_links()->facebook; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
					<li><a href="<?php echo share_links()->linkedin; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>
					<li><a href="<?php echo share_links()->twitter; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
					<li><a href="<?php echo share_links()->email; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-mail" /></svg></a></li>
				</ul>

			</div>

		</div> <!-- / .resource-single -->

	</div>

<?php get_footer(); ?>
