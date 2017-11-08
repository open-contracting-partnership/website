<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page__wrapper">

		<div class="page-advisory-board__intro / band band--extra-thick">
			<?php get_partial('page', 'title'); ?>
		</div>

		<?php if ( have_rows('advisory_meeting_notes') ) : ?>

			<div class="page-advisory-board__minutes / band band--extra-thick">

				<h4>Download minutes from the Advisory Board meetings:</h4>

				<div class="timeline">

					<?php while ( have_rows('advisory_meeting_notes') ) : the_row(); ?>

						<div class="timeline-item">
							<span class="timeline-item__date"><?php the_sub_field('date'); ?></span>
							<a class="timeline-item__title" href="<?php the_sub_field('file'); ?>" title="Download minutes from <?php echo strip_tags(get_sub_field('title')); ?>"><?php the_sub_field('title'); ?></a>
						</div>

					<?php endwhile; ?>

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

			<h4>Meet our Advisory Board members</h4>

			<div class="page-advisory-board__members">

				<?php while ( have_rows('advisory_members') ) : the_row(); ?>

					<a class="profile-selector" href="#<?php echo sanitize_title(get_sub_field('name')); ?>">

						<h3 class="profile-selector__name"><?php the_sub_field('name'); ?></h3>

						<?php if ( get_sub_field('role') ) : ?>
							<h5 class="profile-selector__position"><?php the_sub_field('role'); ?></h5>
						<?php endif; ?>

					</a>

				<?php endwhile; ?>

			</div>

			<div class="page-advisory-board__member-bio">

				<?php while ( have_rows('advisory_members') ) : the_row(); ?>

					<div class="profile" id="<?php echo sanitize_title(get_sub_field('name')); ?>">

						<div class="profile__header">

							<div class="profile__avatar">

								<?php if ( $avatar = get_sub_field('image') ) : ?>
									<img src="<?php echo $avatar['sizes']['1x1_368']; ?>" />
								<?php else : ?>
									<img src="<?php bloginfo('template_directory'); ?>/assets/img/missing-avatar.png" />
								<?php endif; ?>

							</div>

							<div class="profile__meta">

								<h3 class="profile__name"><?php the_sub_field('name'); ?></h3>

								<p class="profile__position"><?php the_sub_field('role'); ?></p>

								<a href="#" class="profile__collapse">
									<svg><use xlink:href="#icon-arrow-down"></svg>
								</a>

							</div>

						</div> <!--  / .profile__header -->

						<div class="profile__bio">

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
