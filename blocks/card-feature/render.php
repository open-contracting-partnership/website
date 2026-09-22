<?php

use App\Cards\FeatureCard;
use Timber\Timber;

$context = Timber::context();

if (get_field('content') === 'resource') {
    $post = Timber::get_post(get_field('resource'));

    if ($post) {
        if ($post->post_status !== 'publish') {
            return;
        }

        $context['card'] = FeatureCard::convertTimberPost($post);
    }

    $context['card']['overlay'] = get_field('overlay');
} else {
    $context['card']['title'] = get_field('title');
    $context['card']['image_url'] = get_field('image')?->src;
    $context['card']['intro'] = get_field('introduction');
    $context['card']['url'] = get_field('url');
    $context['card']['overlay'] = get_field('overlay');
}

Timber::render('views/cards/feature.twig', $context);
