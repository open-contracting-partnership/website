<?php

use Extended\ACF\Fields\Email;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\URL;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → Card Person',
    'fields' => [
        Image::make('Avatar', 'avatar')
            ->format('array')
            ->library('all')
            ->previewSize('medium'),

        Text::make('Name', 'name')
            ->required(),

        Text::make('Role', 'role'),

        Email::make('Email Address', 'email_address'),

        URL::make('Twitter URL', 'twitter_url'),
    ],
    'location' => [
        Location::where('block', 'app/card-person'),
    ],
]);
