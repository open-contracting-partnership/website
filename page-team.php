<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper / page__container">

		<aside class="page-team__title">

			<h1><?php the_title(); ?></h1>

			<div class="strapline">
				<?php the_content(); ?>
			</div>

		</aside>

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

		<article class="page-team__content">

			<?php if ( have_rows('team_members') ) : ?>

				<?php while ( have_rows('team_members') ) : the_row(); ?>

					<div class="profile" id="<?php echo sanitize_title(get_sub_field('name')); ?>">

						<div class="profile__meta">

							<?php if ( $avatar = get_sub_field('image') ) : ?>

								<div class="profile__avatar">
									<img src="<?php echo $avatar['sizes']['thumbnail']; ?>" />
								</div>

							<?php endif; ?>

							<div class="profile__name">

								<h3><?php the_sub_field('name'); ?></h3>

								<?php if ( $twitter_name = get_sub_field('twitter_name') ) : ?>

									<p class="profile__twitter">

										<svg><use xlink:href="#icon-twitter"></use></svg>

										<a href="https://www.twitter.com/<?php echo $twitter_name; ?>">
											Follow me on Twitter
										</a>

									</p>

								<?php endif; ?>

								<a href="#" class="profile__view-bio">View profile</a>

							</div>

						</div> <!--  / .profile__meta -->

						<div class="profile__bio">

							<?php if ( $twitter_name = get_sub_field('twitter_name') ) : ?>

								<p class="profile__twitter">

									<svg><use xlink:href="#icon-twitter"></use></svg>

									<a href="https://www.twitter.com/<?php echo $twitter_name; ?>">
										Follow me on Twitter
									</a>

								</p>

							<?php endif; ?>

							<?php the_sub_field('bio'); ?>

						</div>

					</div>

				<?php endwhile; ?>

			<?php endif; ?>

		</article>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
