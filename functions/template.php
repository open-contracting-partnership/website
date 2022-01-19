<?php

/**
 * Includes partial templates, similar to get_template_part()
 * @param  string $collection
 * @param  string $object
 * @param  array  $options
 */
function the_partial()
{

    $arguments = func_get_args();
    $options = array();
    $paths = array();

    if (empty($arguments)) {
        return;
    }

    // check if the last array item is an array or options
    if (is_array(array_values(array_slice($arguments, -1))[0])) {
        // bring these out
        $options = array_values(array_slice($arguments, -1))[0];

        // remove the last array item
        $arguments = array_slice($arguments, 0, -1);
    }

    // prepend the partials directory to the arguments path
    array_unshift($arguments, 'partials');

    // explicit path
    $paths[] = implode('/', $arguments) . '.php';

    // default path if a directory
    $paths[] = implode('/', array_slice($arguments, 0, -1)) . '/default.php';

    // default path if not a directory
    $paths[] = implode('/', $arguments) . '/default.php';

    // expand the options into variables for use within the partial
    extract($options);

    include(locate_template($paths));
}

/**
 * Includes partial templates, similar to get_template_part() *
 * @param  string $collection
 * @param  string $object
 * @param  array  $options
 */
function get_partial()
{

    ob_start();

    call_user_func_array('the_partial', func_get_args());

    return ob_get_clean();
}

/**
 * Returns an array of merge partial options
 * @param  array $options
 * @param  array $defaults
 * @return array
 */
function get_partial_options($options = array(), $defaults = array())
{
    return (object) array_merge($defaults, $options);
}
