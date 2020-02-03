<?php

/**
 * The Template for displaying all single posts
 */

namespace App;

use App\Cards\PrimaryCard;
use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class SingleController extends Controller
{
	public function handle()
	{
		$context = Timber::get_context();
		$post = new Post();

		$context['post'] = $post;
		$context['title'] = $post->title;
		$context['authors'] = get_authors($post->ID, true);
		$context['content'] = $post->content;
		$context['date'] = get_the_date('j M Y', $post->ID);
		$context['featued_image'] = false;
		$context['more_stories'] = [];

		$context['tags'] = wp_get_post_terms(get_the_ID(), 'post_tag', array(
			'orderby' => 'count',
			'order' => 'DESC'
		));

		$context['tags'] = array_map(function($term) {
			$term->url = get_term_link($term);
			return $term;
		}, $context['tags']);

		$context['type'] = [
			'type' => $post->post_type,
			'label' => get_post_type_label($post->post_type)
		];

		$context['back_link'] = [
			'url' => get_post_type_archive_link($post->post_type),
			'label' => __('Back to latest')
		];

		if ( $attachment_id = get_post_thumbnail_id($post->ID) ) {

			$context['featued_image'] = [
				'url' => wp_get_attachment_url($attachment_id),
				'caption' => wp_get_attachment_caption($attachment_id)
			];

		}

		if ( $context['authors'] ) {
			$context['authors'] = __('By', 'ocp') . ' ' . $context['authors'];
		}

		$context['single']['i18n']['related_tags_heading'] = _x(
			'Related Tags',
			'The related tags heading on blog posts',
			'ocp'
		);

		$context['single']['i18n']['discussion_heading'] = _x(
			'Your comments? Thoughts? What do you think?',
			'The discussion heading on blog posts',
			'ocp'
		);

		$context['single']['i18n']['discussion_content'] = _x(
			'Share your thoughts on social media or join our discussion groups.',
			'The discussion content on blog posts',
			'ocp'
		);

		$more_posts = Timber::get_posts([
			'posts_per_page' => 3,
			'post__not_in' => [$post->ID]
		]);

		$context['more_stories'] = PrimaryCard::convertCollection($more_posts);

		return new TimberResponse('templates/single.twig', $context);
	}
}
