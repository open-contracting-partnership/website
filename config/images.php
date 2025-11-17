<?php

return [
    'imgix_signing_key' => $_ENV['IMGIX_SIGNING_KEY'],
    'imgix_base_url' => $_ENV['IMGIX_BASE_URL'],
    'imgix_domain' => $_ENV['IMGIX_DOMAIN'],

    /**
     * List of image sizes to register, each image size looks like:
     *     [
     *         'name' => 'thumb'
     *         'width' => 100,
     *         'height' => 200,
     *         'crop' => true,
     *     ]
     */
    'sizes' => [
    ],
];
