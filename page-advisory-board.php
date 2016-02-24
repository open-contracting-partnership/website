<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper / page__container page--padding">

		<div class="page-advisory-board__intro">

			<h1><?php the_title(); ?></h1>

			<blockquote>
				<?php the_content(); ?>
			</blockquote>

		</div>

		<div class="page-advisory-board__minutes">

			<h3>Download minutes from the Advisory Board meetings:</h3>

			<div class="timeline">

				<div class="timeline-item">
					<span class="timeline-item__date">19-11-2014</span>
					<a class="timeline-item__title" href="#">1st Advisory <br />Board Meeting</a>
				</div>

				<div class="timeline-item">
					<span class="timeline-item__date">19-11-2014</span>
					<a class="timeline-item__title" href="#">1st Advisory <br />Board Meeting</a>
				</div>

				<div class="timeline-item">
					<span class="timeline-item__date">19-11-2014</span>
					<a class="timeline-item__title" href="#">1st Advisory <br />Board Meeting</a>
				</div>

				<div class="timeline-item">
					<span class="timeline-item__date">19-11-2014</span>
					<a class="timeline-item__title" href="#">1st Advisory <br />Board Meeting</a>
				</div>

				<div class="timeline-item">
					<span class="timeline-item__date">19-11-2014</span>
					<a class="timeline-item__title" href="#">1st Advisory <br />Board Meeting</a>
				</div>

			</div>

		</div>

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
