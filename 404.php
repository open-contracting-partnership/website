<?php // 404.php ?>

<?php get_header(); ?>

	<div class="four-oh-four__page">

		<div class="wrapper">

			<section class="four-oh-four__container">

				<div class="four-oh-four__section">

					<h1 class="four-oh-four__title / border-top / gamma"><?php _e('Something went wrong.', 'ocp'); ?><br><?php _e('This is probably how too many people feel when trying to access a government contract', 'ocp'); ?></h1>

					<p><?php _e('Were you looking for a blog post, or a specific resource?', 'ocp'); ?><br><?php _e('We suggest you try again checking the address or using the main navigation.', 'ocp'); ?></p>
					<p><?php _e('And please let us know if the problem persists, so that we can point you in the right direction.', 'ocp'); ?></p>

					<a href="/" class="button button--white">Take me Home</a>

				</div>

				<div class="four-oh-four__section four-oh-four__section-img">
					<img src="<?php bloginfo('template_directory'); ?>/resources/img/404.svg" alt="" />
				</div>

				<div class="four-oh-four__section four-oh-four__section-logo">
					<img src="<?php bloginfo('template_directory'); ?>/resources/img/404-box.svg" alt="" />
				</div>

			</section>

		</div>

	</div>

<?php get_footer(); ?>
