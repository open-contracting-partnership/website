<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper / page__container">

		<aside class="page-team__sidebar">

			<h1><?php the_title(); ?></h1>

			<blockquote>
				<?php the_content(); ?>
			</blockquote>

			<?php if ( have_rows('team_members') ) : ?>

				<?php while ( have_rows('team_members') ) : the_row(); ?>

					<a class="team-member__selector" href="#<?php echo sanitize_title(get_sub_field('name')); ?>">
						<h3><?php the_sub_field('name'); ?></h3>
						<h5><?php the_sub_field('role'); ?></h3>
					</a>

				<?php endwhile; ?>

			<?php endif; ?>


		</aside>

		<article class="page-team__content">

			<?php if ( have_rows('team_members') ) : ?>

				<?php while ( have_rows('team_members') ) : the_row(); ?>

					<div class="team-member" id="<?php echo sanitize_title(get_sub_field('name')); ?>">

						<div class="team-member__image">
							<img src="http://placehold.it/926x395" />
						</div>

						<h3><?php the_sub_field('name'); ?></h3>
						<?php the_sub_field('bio'); ?>

					</div>

				<?php endwhile; ?>

			<?php endif; ?>

		</article>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
