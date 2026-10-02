<?php

return [
    /**
     * List of directories to load Twig files from
     */
    'paths' => [
        'views',
    ],

    /**
     * Directory for compiled Twig templates, or false to compile them on every request. A template is
     * recompiled when its file is newer than its compiled copy.
     */
    'cache' => WP_CONTENT_DIR . '/cache/twig',
];
