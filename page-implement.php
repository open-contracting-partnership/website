<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div id="get-started">
		<router-view></router-view>
	</div>

	<script>

		let landing_page = <?php echo json_encode([
			'introduction' => get_field('introduction'),
			'secondary_copy_1st_column' => get_field('secondary_copy_1st_column'),
			'secondary_copy_2nd_column' => get_field('secondary_copy_2nd_column'),
			'links' => get_field('links')
		]); ?>;

		let steps = <?php echo json_encode(get_field('steps')); ?>;

	</script>

	<script src="<?php bloginfo('template_directory'); ?>/dist/js/get-started.js"></script>

<?php get_footer(); ?>
