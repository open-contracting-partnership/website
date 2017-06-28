<?php
/**
 * Template Name: Two column
 */
?>

<?php get_header(); ?>

<?php the_post(); ?>

<div class="page__container page--template-two-column">

	<div class="wrapper / page__wrapper / page--padding">

		<aside class="sidebar page-sidebar">

			<?php get_partial('navigation', 'sections'); ?>

			<div class="band--extra-thick">

				<h6 class="drop / border-top border-top--clean"><?php _e('Relevant Sources', 'ocp'); ?></h6>

				<p>News 1</p>
				<p>News 2</p>
				<p>News 3</p>
				<p>News 4 Featured</p>

			</div>

			<div class="band--extra-thick">

				<h6 class="drop / border-top border-top--clean"><?php _e('Subscribe to our newsletter', 'ocp'); ?></h6>
				<p class="text--micro / drop"><?php _e('Sign up to our monthly email where you can receive updates on our current work', 'ocp'); ?></p>

				<div class="js-subscribe">

					<form class="flex-field" action="" method="post">
						<input class="secondary" type="email" placeholder="<?php _e('Enter your email', 'ocp'); ?>" name="email" required>
						<button><?php _e('Send', 'ocp'); ?></button>
					</form>

				</div>

			</div>

			<div class="band--extra-thick">

				<h6 class="drop / border-top border-top--blue border-top--clean"><?php _e('Upcoming Events', 'ocp'); ?></h6>

				<p>Event 1</p>
				<p>Event 2</p>

			</div>

		</aside>

		<article class="page-content cf">

			<?php get_partial('page', 'title'); ?>

			<section>
				<?php the_content(); ?>
			</section>

		</article>

	</div> <!-- / .wrapper -->

	<?php get_partial('page', 'strips'); ?>

</div> <!-- / .page__container -->

 <?php get_footer(); ?>
