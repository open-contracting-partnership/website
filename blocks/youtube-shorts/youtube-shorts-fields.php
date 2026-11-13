<?php

use App\Fields\BlockSpacingControls;
use Extended\ACF\Fields\Repeater;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\Image;
use Extended\ACF\Location;

register_extended_field_group([
    'title' => 'Block → YouTube Shorts',
    'key' => 'block_youtube_shorts',
    'fields' => [
        Repeater::make('YouTube Shorts', 'youtube_shorts')
            ->fields([
                Text::make('Video URL', 'video_url')
                    ->required()
                    ->helperText('Paste the full YouTube Shorts URL'),

                Image::make('Poster Image', 'poster_image')
                    ->format('array')
                    ->helperText('Optional. Display a custom poster image instead of the video thumbnail.'),
            ]),

        ...BlockSpacingControls::fields(),
    ],
    'location' => [
        Location::where('block', 'app/youtube-shorts'),
    ],
]);
