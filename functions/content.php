<?php

 //********
// EXCERPT

$excerpt_length = 15;

/**
 * output custom excerpt length
 * @param integer $length
 */
function _the_excerpt($length = 15)
{
    global $excerpt_length;

    $excerpt_length = $length;

    the_excerpt();
}

add_filter('excerpt_length', function ($length) {
    global $excerpt_length;
    return $excerpt_length;
}, 999);

add_filter('excerpt_more', function () {
    return '…';
});

function prevent_widow($text)
{
    return preg_replace('|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', $text);
}


 //*****************
// POST TYPE LABELS

/**
 * returns the label for a given post type
 * @param  mixed $post_type
 * @param  boolean $plural
 * @return string
 */
function get_post_type_label($post_type = null, $plural = false)
{
    $post_type = $post_type ?: get_post_type();
    $post_type_object = get_post_type_object($post_type);
    $label = false;

    if ($post_type_object) {
        if ($plural === true) {
            $label = $post_type_object->labels->name;
        } else {
            $label = $post_type_object->labels->singular_name;
        }
    }

    return $label;
}

/**
 * echo alias of `get_post_type_label`
 */
function the_post_type_label($post_type = null, bool $plural = false): void
{
    echo get_post_type_label($post_type, $plural);
}


 //********************
// ARRAY MULTI IMPLODE

/**
* impodes an array with both standard and last items glue
*/
function array_multi_implode(string $standard_glue, string $last_nodes_glue, array $array): string
{
    $length = count($array);

    if ($length > 1) {
        $array[$length - 2] = $array[$length - 2] . $last_nodes_glue . $array[$length - 1];
        unset($array[$length - 1]);
    }

    return implode($standard_glue, $array);
}


 //********
// AUTHORS

/** ID of the shared "Open Contracting" account, which the REST API leaves out of bylines. */
const SHARED_AUTHOR_ID = 29;

/**
 * Return the post's authors in display order: users (with id, slug and url) and guest text (name only).
 */
function get_post_authors($post_id)
{
    // we should never display an author for news posts
    if (get_post_type($post_id) === 'news') {
        return array();
    }

    // set the initial authors array as the normal post author...
    $authors = array(get_author_object(get_post_field('post_author', $post_id)));

    // but if multiple authors have been set, completely overwrite this array
    if (\have_rows('authors', $post_id)) {
        $authors = array();

        // loop through the rows of data
        while (have_rows('authors', $post_id)) {
            the_row();

            switch (get_row_layout()) {
                case 'wordpress_user':
                    if (get_sub_field('user')) {
                        $authors[] = get_author_object(get_sub_field('user')['ID']);
                    }

                    break;

                case 'custom_user':
                    $authors[] = (object) array('name' => get_sub_field('user'));
                    break;
            }
        }
    }

    return $authors;
}

function get_author_object($author_id = null)
{
    if (! $author_id) {
        $author_id = get_the_author_meta('ID');
    }

    return (object) array(
        'id' => (int) $author_id,
        'name' => get_the_author_meta('display_name', $author_id),
        'slug' => get_the_author_meta('user_nicename', $author_id),
        'url' => get_author_posts_url($author_id)
    );
}

function get_authors($post_id = null, $with_links = false)
{
    // we should only ever show the organisation for resources
    if (get_post_type() === 'resource') {
        return get_field('organisation');
    }

    $link_template = '<a href="%s">%s</a>';

    $authors = get_post_authors($post_id);
    $output = array();

    foreach ($authors as $key => $author) {
        if (empty($author->name)) {
            continue;
        }

        if ($with_links && isset($author->url)) {
            $output[] = sprintf($link_template, $author->url, $author->name);
        } else {
            $output[] = $author->name;
        }
    }

    return array_multi_implode(', ', ' and ', $output);
}

function the_authors($post_id = null, $with_links = false)
{
    echo get_authors($post_id, $with_links);
}

/**
 * Return the post's byline for the REST API, without the shared account. Author URLs are in the current language.
 */
function get_byline(int $post_id): array
{
    $staff = array();
    $guests = array();
    $names = array();

    foreach (get_post_authors($post_id) as $author) {
        if (empty($author->name)) {
            continue;
        }

        if (isset($author->url)) {
            if ($author->id === SHARED_AUTHOR_ID) {
                continue;
            }

            $staff[] = array(
                'name' => $author->name,
                'slug' => $author->slug,
                'url' => $author->url
            );
        } else {
            $guests[] = $author->name;
        }

        $names[] = $author->name;
    }

    return array(
        'staff' => $staff,
        'guests' => $guests ? array_multi_implode(', ', ' and ', $guests) : null,
        'text' => $names ? trim(array_multi_implode(', ', ' and ', $names)) : null
    );
}

add_action('rest_api_init', function () {
    $nullable_string = array('type' => array('string', 'null'));

    register_rest_field(array('post', 'news'), 'byline', array(
        'get_callback' => function ($post) {
            $current = apply_filters('wpml_current_language', null);
            $language = apply_filters('wpml_element_language_code', null, array(
                'element_id' => $post['id'],
                'element_type' => get_post_type($post['id'])
            ));

            // Build author URLs in the post's language, as on the post's page.
            if ($language && $language !== $current) {
                do_action('wpml_switch_language', $language);
            }

            $byline = get_byline($post['id']);

            if ($language && $language !== $current) {
                do_action('wpml_switch_language', $current);
            }

            return $byline;
        },
        'schema' => array(
            'description' => 'The byline: staff in display order, guest text as entered, and the byline as text.',
            'type' => 'object',
            'context' => array('view', 'edit', 'embed'),
            'readonly' => true,
            'properties' => array(
                'staff' => array(
                    'type' => 'array',
                    'items' => array(
                        'type' => 'object',
                        'properties' => array(
                            'name' => array('type' => 'string'),
                            'slug' => array('type' => 'string'),
                            'url' => array('type' => 'string', 'format' => 'uri')
                        )
                    )
                ),
                'guests' => $nullable_string,
                'text' => $nullable_string
            )
        )
    ));
});


 //**************
// SHARING LINKS

/**
 * Return the social sharing URLs for a page.
 */
function get_share_links(string $url, string $title): array
{
    $links = new \ImLiam\ShareableLink($url, $title);

    return array(
        'twitter' => $links->twitter,
        // The package builds facebook.com/dialog/share, which rejects requests without an app ID.
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url),
        'linkedin' => $links->linkedin
    );
}
