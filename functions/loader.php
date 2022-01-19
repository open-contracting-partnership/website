<?php


 //************
// AUTOLOADERS

$composer_autoloader = get_theme_root() . '/' . get_template() . '/vendor/autoload.php';
$theme_autooader = get_theme_root() . '/' . get_template() . '/classes/autoload.php';

if (file_exists($composer_autoloader)) {
    require $composer_autoloader;
}

if (file_exists($theme_autooader)) {
    require $theme_autooader;
}


 //*******************
// LOAD SIBLING FILES

// get the current path info
$function_path = pathinfo(__FILE__);

// loop through all php files within this functions directory...
foreach (glob($function_path['dirname'] . '/*.php') as $file) {
    // and if it's not loader.php, include it
    if (basename($file) !== 'loader.php') {
        include $file;
    }
}
