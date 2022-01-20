<?php

return [
    'imgix_host_transforms' => array_combine(
        explode(',', getenv('IMGIX_SOURCE_HOSTS')),
        explode(',', getenv('IMGIX_TRANSFORM_HOSTS'))
    ),

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
