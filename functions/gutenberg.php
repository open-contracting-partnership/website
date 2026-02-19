<?php

add_action('admin_head', function () {
    echo '
        <style type="text/css">
        /* Main column width */
        .wp-block {
            max-width: 1200px;
        }

        /* Width of "wide" blocks */
             .wp-block[data-align="wide"] {
             max-width: 1080px;
        }

        /* Width of "full-wide" blocks */
        .wp-block[data-align="full"] {
            max-width: none;
        }
        </style>
    ';
});

add_action('after_setup_theme', function () {
    // enable responsive embds
    add_theme_support('responsive-embeds');

    // add support for editor styles.
    add_theme_support('editor-styles');

    // enqueue editor styles.
    $gutenberg_path = App\Assets::getPath('resources/scss/gutenberg.scss');
    if ($gutenberg_path) {
        add_editor_style($gutenberg_path);
    }
});
