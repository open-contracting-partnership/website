<?php // single-resource.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper">

		<article class="cf">

			<section>

				<div class="resource-title">
					<svg><use xlink:href="#icon-resource" /></svg>
					<a href="/resources">View All Resources</a>
				</div>

				<div class="resource__content-col">

					<h1 class="gamma"><?php the_title(); ?></h1>

					<p class="resource__meta">
						<span class="resource__published-date"><?php the_date('Y'); ?></span>
						<?php echo sprintf(__('By %s', 'ocp'), get_field('organisation')); ?>
					</p>

					<div class="post-content">
						<?php the_content(); ?>
					</div>

				</div>

				<div class="resource__meta-col">

					<div class="band">

						<?php if ( $attachments = get_field('attachments') ) : ?>
							<p><a onclick="_gaq.push(['_trackEvent', 'Resources', 'Download', '<?php the_title(); ?>']);" href="<?php echo $attachments[0]['file']; ?>" class="button button--block button--large button--icon button--icon--reverse button--icon--stroke">Download<svg><use xlink:href="#icon-download" /></svg></a></p>
						<?php endif; ?>

						<?php if ( $link = get_field('link') ) : ?>
							<p><a onclick="_gaq.push(['_trackEvent', 'Resources', 'Visit', '<?php the_title(); ?>']);" href="<?php echo $link; ?>" class="button button--block button--large">View</a></p>
						<?php endif; ?>

					</div>

					<div class="band">

						<h3><?php _e('Share', 'ocp'); ?></h3>

						<ul class="button__list button__social">
							<li><a href="<?php echo share_links()->facebook; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-facebook" /></svg></a></li>
							<li><a href="<?php echo share_links()->linkedin; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-linkedin" /></svg></a></li>
							<li><a href="<?php echo share_links()->twitter; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-twitter" /></svg></a></li>
							<li><a href="<?php echo share_links()->email; ?>" target="_blank" class="button"><svg><use xlink:href="#icon-mail" /></svg></a></li>
						</ul>

					</div>

					<?php if ( $terms = get_field('region') ) : ?>

						<div class="band">

							<h3><?php _e('Region', 'ocp'); ?></h3>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/region/<?php echo $term->slug; ?>" class="button button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

					<?php if ( $terms = get_field('issue') ) : ?>

						<div class="band">

							<h3><?php _e('Issue', 'ocp'); ?></h3>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/issue/<?php echo $term->slug; ?>" class="button button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

					<?php if ( $terms = get_field('open_contracting') ) : ?>

						<div class="band">

							<h3><?php _e('OC Framework', 'ocp'); ?></h3>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/open-contracting/<?php echo $term->slug; ?>" class="button button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

				</div> <!-- / .resource__meta-col -->

			</section>

		</article>

	</div>

<?php get_footer(); ?>
