<?php if ( in_array(get_field('page_download'), ['link', 'file'] ) ) : ?>

	<?php $url = get_field('page_download_file') ? get_field('page_download_file') : 	get_field('page_download_link'); ?>

	<a href="<?php echo $url; ?>" class="download-cta">

		<?php if ( $image = get_field('page_download_image') ) : ?>
			<img src="<?php echo $image['sizes']['2x1_460']; ?>" />
		<?php endif; ?>

		<div class="download-cta__content">

			<?php if ( get_field('page_download') === 'link' ) : ?>
				<span><?php _e('Link', 'ocp'); ?></span>
			<?php else : ?>
				<span><?php _e('Download', 'ocp'); ?></span>
			<?php endif; ?>

			<div class="heading-highlight">
				<h4><?php the_field('page_download_title'); ?></h4>
			</div>

		</div>

	</a>

<?php endif; ?>
