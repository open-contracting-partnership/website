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
 * @param  mixed $post_type
 * @param  boolean $plural
 * @return NULL
 */
function the_post_type_label($post_type = null, $plural = false)
{
    echo get_post_type_label($post_type, $plural);
}


 //********************
// ARRAY MULTI IMPLODE

/**
* impodes an array with both standard and last items glue
* @param  string $standard_glue
* @param  string $last_nodes_glue
* @param  array $array
* @return array
*/
function array_multi_implode($standard_glue, $last_nodes_glue, $array)
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

function get_post_authors($post_id)
{

    // set the initial authors array as the normal post author...
    $authors = array(get_author_object(get_post_field('post_author', $post_id)));

    // but if multiple authors have been set, completely overwrite this array
    if (have_rows('authors', $post_id)) {
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
        'name' => get_the_author_meta('display_name', $author_id),
        'url' => get_author_posts_url($author_id)
    );
}

function get_authors($post_id = null, $with_links = false)
{

    // we should never display an author for news posts
    if (get_post_type() === 'news') {
        return '';
    }

    // and we should only ever show the organisation for resources
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
