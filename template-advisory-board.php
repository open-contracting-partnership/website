<?php
/**
 * Template Name: Advisory Board
 */
?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper / page__container page--padding">

		<div class="page-advisory-board__intro / band band--extra-thick">

			<h1><?php the_title(); ?></h1>

			<p class="strapline">
				<?php the_field('advisory_introduction'); ?>
			</p>

		</div>

		<?php if ( have_rows('advisory_meeting_notes') ) : ?>

			<div class="page-advisory-board__minutes / band band--extra-thick">

				<h3>Download minutes from the Advisory Board meetings:</h3>

				<div class="timeline">

					<?php while ( have_rows('advisory_meeting_notes') ) : the_row(); ?>

						<div class="timeline-item">
							<span class="timeline-item__date"><?php the_sub_field('date'); ?></span>
							<a class="timeline-item__title" href="<?php the_sub_field('file'); ?>" title="Download minutes from <?php echo strip_tags(get_sub_field('title')); ?>"><?php the_sub_field('title'); ?></a>
						</div>

					<?php endwhile; ?>

				</div>

			</div>

		<?php endif; ?>

		<?php if ( have_rows('advisory_members') ) : ?>

			<h3>Meet our Advisory Board members</h3>

			<div class="page-advisory-board__members">

				<?php while ( have_rows('advisory_members') ) : the_row(); ?>

					<a class="team-member__selector" href="#<?php echo sanitize_title(get_sub_field('name')); ?>">

						<h3><?php the_sub_field('name'); ?></h3>

						<?php if ( get_sub_field('role') ) : ?>
							<h5><?php the_sub_field('role'); ?></h5>
						<?php endif; ?>

					</a>

				<?php endwhile; ?>

			</div>

			<div class="page-advisory-board__member-bio">

				<?php while ( have_rows('advisory_members') ) : the_row(); ?>

					<div class="team-member" id="<?php echo sanitize_title(get_sub_field('name')); ?>">

						<div class="team-member__meta">

							<?php if ( $avatar = get_sub_field('image') ) : ?>

								<div class="team-member__avatar">
									<img src="<?php echo $avatar['sizes']['thumbnail']; ?>" />
								</div>

							<?php endif; ?>

							<div class="team-member__name">
								<h3><?php the_sub_field('name'); ?></h3>
								<a href="#" class="team-member__view-bio">View profile</a>
							</div>
	
						</div> <!--  / .team-member__meta -->

						<div class="team-member__bio">

							<?php the_sub_field('bio'); ?>

							<?php if ( $disclosure_file = get_sub_field('disclosure_file') ) : ?>
								<p><a href="<?php echo $disclosure_file; ?>" class="button">Disclosure File</a></p>
							<?php endif; ?>

						</div>

					</div>

				<?php endwhile; ?>

			</div>

		<?php endif; ?>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>