<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div id="get-started">
		<router-view></router-view>
	</div>

	<script>
		let steps = <?php echo json_encode(get_field('steps')); ?>;
	</script>

	<script src="<?php bloginfo('template_directory'); ?>/dist/js/get-started.min.js"></script>

<?php get_footer(); ?>
