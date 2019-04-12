<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div id="get-started">
		<router-view></router-view>
	</div>

	<?php

		wp_localize_script('page-get-started', 'content', [
			'sections' => array(
				'what_happens' => __('What happens at this step?', 'ocp'),
				'key_outputs' => __('What are the key outputs?', 'ocp'),
				'resources' => __('What resources can I use?', 'ocp'),
				'other_publishers' => __('What have other publishers done?', 'ocp')
			),
			'key' => array(
				'title' => __('Key', 'ocp'),
				'connect' => __('Connect', 'ocp'),
				'complete' => __('Complete', 'ocp'),
				'read' => __('Read', 'ocp'),
				'get_inspired' => __('Get inspired', 'ocp')
			),
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
