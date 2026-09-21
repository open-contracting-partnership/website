<?php

use App\Cards\ResourceCard;
use Timber\Timber;

$context = Timber::context();

if (get_field('content') === 'resource') {
    $post = Timber::get_post(get_field('resource'));

    if ($post) {
        if ($post->post_status !== 'publish') {
            return;
        }

        $context['card'] = ResourceCard::convertTimberPost($post);
    }
} else {
    $context['card']['title'] = get_field('title');
    $context['card']['image_url'] = get_field('image')?->src;
    $context['card']['excerpt'] = strip_tags(get_field('excerpt') ?: '');
    $context['card']['url'] = get_field('url');
    $context['card']['type_label'] = get_field('type_label');
}

Timber::render('views/cards/resource.twig', $context);
