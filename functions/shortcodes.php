<?php // functions/shortcodes.php


 //********
// SECTION

add_shortcode('section', function($atts, $content = null) {
	return '<h3 class="section__title" id="' . sanitize_title($content) . '">' . strip_tags($content) . '</h3>';
});

function get_sections() {

	global $post;
	$pattern = get_shortcode_regex();
	preg_match_all('/'.$pattern.'/s', $post->post_content, $matches, PREG_SET_ORDER);

	$sections = array();

	if ( is_array($matches) ) {

		foreach ( $matches as $match ) {

			if ( $match[2] === 'section' ) {
				$sections[sanitize_title($match[5])] = strip_tags($match[5]);
			}

		}

	}

	return $sections;

}


 //*****
// PULL

add_shortcode('pull', function($atts, $content = null) {

	$find = ['<div class="pull"></p>', '<p></div>'];
	$replace = ['<div class="pull">', '</div>'];

	// var_Dump($content);
	return str_replace($find, $replace, '<div class="pull">' . trim(wpautop($content)) . '</div>');

});


 //********
// RELATED

add_shortcode('related', function($atts, $content = null) {

	$args = (object) array_merge([
		'taxonomy' => NULL,
		'term' => NULL,
		'post_type' => 'any'
	], $atts);

	// don't proceed is the tax/term combination hasn't been set
	if ( $args->taxonomy === NULL || $args->term === NULL ) {
		return FALSE;
	}

	$related_posts = new query_loop([
		'post_type' => $args->post_type,
		'posts_per_page' => 6,
		'tax_query' => array(
			array(
				'taxonomy' => $args->taxonomy,
				'field'    => 'slug',
				'terms'    => $args->term,
			)
		)

	]);

	ob_start();

	?>

		<?php foreach ( $related_posts as $related_post ) : ?>
			<?php get_partial('post-object', 'basic'); ?>
		<?php endforeach; ?>

	<?php

	$var = ob_get_contents();
	ob_end_clean();

	return $var;

});
