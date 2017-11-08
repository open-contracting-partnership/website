<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="page__wrapper">

		<div class="page-team__title">
			<?php get_partial('page', 'title'); ?>
		</div>

		<aside class="page-team__sidebar">

			<?php if ( have_rows('team_members') ) : ?>

				<?php while ( have_rows('team_members') ) : the_row(); ?>

					<a class="profile-selector" href="#<?php echo sanitize_title(get_sub_field('name')); ?>">
						<h3 class="profile-selector__name"><?php the_sub_field('name'); ?></h3>
						<h5 class="profile-selector__position"><?php the_sub_field('role'); ?></h5>
					</a>

				<?php endwhile; ?>

			<?php endif; ?>

		</aside>

		<section class="page-team__content">

			<?php if ( have_rows('team_members') ) : ?>

				<?php while ( have_rows('team_members') ) : the_row(); ?>

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

								<?php if ( $twitter_name = get_sub_field('twitter_name') ) : ?>

									<p class="profile__twitter">

										<svg><use xlink:href="#icon-twitter"></use></svg>

										<a href="https://www.twitter.com/<?php echo $twitter_name; ?>">
											Follow me on Twitter
										</a>

									</p>

								<?php endif; ?>

								<p class="profile__position"><?php the_sub_field('role'); ?></p>

								<a href="#" class="profile__collapse">
									<svg><use xlink:href="#icon-arrow-down"></svg>
								</a>

							</div>

						</div> <!--  / .profile__header -->

						<article class="profile__bio">

							<?php if ( $twitter_name = get_sub_field('twitter_name') ) : ?>

								<p class="profile__twitter">

									<svg><use xlink:href="#icon-twitter"></use></svg>

									<a href="https://www.twitter.com/<?php echo $twitter_name; ?>">
										Follow me on Twitter
									</a>

								</p>

							<?php endif; ?>

							<?php the_sub_field('bio'); ?>

						</article>

					</div>

				<?php endwhile; ?>

			<?php endif; ?>

		</section>

	</div> <!-- / .page__wrapper -->

<?php get_footer(); ?>
