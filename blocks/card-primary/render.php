
<?php

use App\Cards\PrimaryCard;
use Timber\Timber;

$context = Timber::context();

if (get_field('content') === 'post') {
    $post = Timber::get_post(get_field('post'));

    if ($post) {
        if ($post->post_status !== 'publish') {
            return;
        }

        $context['card'] = PrimaryCard::convertTimberPost($post);
    }
} else {
    $context['card']['title'] = get_field('title');
    $context['card']['image_url'] = get_field('image')?->src;
    $context['card']['introduction'] = strip_tags(get_field('introduction') ?: '');
    $context['card']['url'] = get_field('url');
}

Timber::render('views/cards/primary.twig', $context);
