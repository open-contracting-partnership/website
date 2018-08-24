<?php
/**
 * Template Name: Two column
 */
?>

<?php get_header(); ?>

<?php the_post(); ?>

<div class="page--two-column">

	<div class="page__wrapper">

		<aside class="sidebar page-sidebar">

			<?php get_partial('navigation', 'sections'); ?>

			<?php if ( get_field('display_relevant_sources') && have_rows('relevant_sources') ) : ?>

				<div class="sidebar__section sidebar__section-relevant-sources">

					<h6 class="drop / border-top border-top--clean"><?php _e('Relevant Sources', 'ocp'); ?></h6>

					<?php while ( have_rows('relevant_sources') ) : the_row(); ?>

	   					<?php if ( get_row_layout() == 'internal_link' ) : ?>

							<?php setup_postdata($post = get_sub_field('post')); ?>

							<?php get_partial('card', 'content', [
								'thumbnail_id' => get_sub_field('image') ? get_sub_field('image')['ID'] : FALSE
							]); ?>

							<?php wp_reset_postdata(); ?>

						<?php elseif ( get_row_layout() == 'external_link' ) : ?>

							<div class="card card--content">

								<?php if ( $image = get_sub_field('image') ) : ?>

									<div class="card__header">
										<img class="card__featured-media" src="<?php echo $image['sizes']['2x1_460']; ?>">
									</div>

								<?php endif; ?>

								<div class="card--content__inner">

									<div class="card__icon" data-content-type="link">
										<svg><use xlink:href="#icon-link"></svg>
									</div>

									<div class="card__content">

										<span class="card-content__type">Link</span>

										<p class="card__heading">
											<a class="card__link" href="<?php the_sub_field('link'); ?>"><?php the_sub_field('label'); ?></a>
										</p>

									</div>

								</div>

							</div>

						<?php endif; ?>

					<?php endwhile; ?>

				</div>

			<?php endif; ?>

			<?php if ( get_field('display_upcoming_events') ) : ?>

				<?php

					$upcoming_events = new query_loop([
						'post_type' => 'event',
						'posts_per_page' => 2,
						'orderby'	=> 'meta_value_num',
						'order'	  => 'ASC',
						'meta_key' => ' event_date',
						'meta_query' => array(
							array(
								'key' => 'event_date',
								'value' => date('Ymd'),
								'compare' => '>='
							),
						)
					]);

				?>

				<?php if ( $upcoming_events->have_posts() ) : ?>

					<div class="sidebar__section sidebar__section-upcoming-events">

						<h6 class="drop / border-top border-top--blue border-top--clean"><?php _e('Upcoming Events', 'ocp'); ?></h6>

						<?php foreach ( $upcoming_events as $event ) : ?>

							<?php get_partial('card', 'event'); ?>

						<?php endforeach; ?>

					</div>

				<?php endif; ?>

			<?php endif; ?>

		</aside>

		<article class="page-content cf">

			<?php get_partial('page', 'title'); ?>

			<section>
				<?php the_content(); ?>
			</section>

		</article>

	</div> <!-- / .page__wrapper -->

	<?php get_partial('page', 'strips'); ?>

</div> <!-- / .page--two-column -->

 <?php get_footer(); ?>
