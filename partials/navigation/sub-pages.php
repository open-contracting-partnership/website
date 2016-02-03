<?php // partials/navigation/sub-pages.php ?>

<?php

	global $post;

	$parent_id = $post->post_parent ? $post->post_parent : $post->ID;

	$child_pages = array_merge(
		array(
			get_post($parent_id)
		),
		get_pages(array(
			'sort_order' => 'ASC',
			'sort_column' => 'menu_order',
			'child_of' => $parent_id
		))
	);

?>

<?php if ( count($child_pages) > 1 ) : ?>

	<nav>

		<h3 class="border-top border-top--clean">Further Information</h3>

		<ul class="nav nav--vertical nav--sub-page">

			<?php foreach ( $child_pages as $child_page ) : ?>

				<li>
					<a href="<?php echo get_permalink($child_page->ID); ?>" <?php if ($post->ID == $child_page->ID) : ?> class="selected" <?php endif; ?>><?php echo get_the_title($child_page->ID); ?></a>
				</li>

			<?php endforeach; ?>

		</ul>

	</nav>

<?php endif; ?>
