
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
    $context['block']['title'] = get_field('title');
    $context['block']['image'] = get_field('image');
    $context['block']['strapline'] = strip_tags(get_field('strapline') ?: '', '<p><strong><ul><ol><li>');
    $context['block']['url'] = get_field('url');

    if (get_field('button_label') && $context['block']['url']) {
        $context['block']['button'] = [
            'title' => get_field('button_label'),
            'url' => get_field('url'),
        ];
    }
}

$context['block']['size'] = get_field('size') ?: 'normal';

Timber::render('views/cards/primary.twig', $context);
