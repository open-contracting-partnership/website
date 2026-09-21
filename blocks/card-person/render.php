<?php

use Timber\Timber;

$context = Timber::context();

$context['card']['avatar'] = get_field('avatar');
$context['card']['name'] = get_field('name');
$context['card']['title'] = get_field('title');
$context['card']['role'] = get_field('role');
$context['card']['name_bio'] = implode(', <br/>', array_filter([
    $context['card']['name'],
    $context['card']['role'],
]));
$context['card']['email_address'] = get_field('email_address');
$context['card']['twitter_url'] = get_field('twitter_url');

Timber::render('views/cards/person.twig', $context);
