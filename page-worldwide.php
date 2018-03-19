<?php // page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<script>

		// ATTN: using `` ES6 template literals, this is not supported in IE11
		const content = {
			title: '<?php the_title(); ?>',
			content: `<?php the_content(); ?>`,
			filter: {
				all: '<?php _e('Active countries…', 'ocp'); ?>',
				ocds: '<?php _e('Who are using the Open Contracting Data Standard', 'ocp'); ?>',
				ocds_status: '<?php _e('Status:', 'ocp'); ?>',
				ocds_ongoing: '<?php _e('Ongoing', 'ocp'); ?>',
				ocds_implementation: '<?php _e('Implementation', 'ocp'); ?>',
				ocds_historic: '<?php _e('Historic', 'ocp'); ?>',
				commitments: '<?php _e('With documented commitments', 'ocp'); ?>',
				contract: '<?php _e('Who demonstrate innovation in contract monitoring & use', 'ocp'); ?>',
			}
		}

	</script>

	<div id="worldwide">
		<router-view></router-view>
	</div>

	<script src="<?php bloginfo('template_directory'); ?>/dist/js/worldwide.js"></script>

<?php get_footer(); ?>
