<?php

use App\Fields\BlockSpacingControls;
use Timber\Timber;

$context = Timber::context();

$context['block']['is_preview'] = $is_preview;
$shorts = get_field('youtube_shorts') ?: [];

// Process shorts to extract video IDs
foreach ($shorts as &$short) {
    if (!empty($short['video_url'])) {
        // Extract video ID from YouTube Shorts URL
        preg_match('/(?:youtube\.com\/shorts\/|youtu\.be\/)([^\/?]+)/', $short['video_url'], $matches);
        $short['video_id'] = $matches[1] ?? '';
    }
}
unset($short); // Break reference

$context['block']['youtube_shorts'] = $shorts;
$context['block']['block_spacing'] = BlockSpacingControls::makeContext();

Timber::render('_youtube-shorts.twig', $context);
