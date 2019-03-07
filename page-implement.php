<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div id="get-started">
		<router-view></router-view>
	</div>

	<?php

		wp_localize_script('page-get-started', 'content', [
			'landing_page' => array(
				'title' => get_the_title(),
				'introduction' => get_field('introduction'),
				'secondary_copy_1st_column' => get_field('secondary_copy_1st_column'),
				'secondary_copy_2nd_column' => get_field('secondary_copy_2nd_column'),
				'links' => get_field('links')
			),
			'steps' => get_field('steps')
		]);

	?>

<?php get_footer(); ?>
