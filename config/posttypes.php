<?php

return [
    /**
     * List all the sub-classes of Rareloop\Lumberjack\Post in your app that you wish to
     * automatically register with WordPress as part of the bootstrap process.
     */
    'register' => [
        App\PostTypes\Event::class,
        App\PostTypes\News::class,
        App\PostTypes\Resource::class,
    ],
];
