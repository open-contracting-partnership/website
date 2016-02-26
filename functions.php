<?php // functions.php


 //*****************
// FUNCTIONS LOADER

// bury groups of functionality within the functions/ directory
// loader.php will include all .php files from within

require_once('functions/loader.php');


 //**************
// THEME SUPPORT

add_theme_support('post-thumbnails');
add_theme_support('menus');


 //****************
// REGISTER IMAGES

// standard images
add_image_size('standard_image', 100, 100, TRUE);
add_image_size('hemo_horizontal', 122, 154, TRUE);

// aspect ratio
add_aspect_ratio('2x1', 460, 2, 1);

add_aspect_ratio('4x3', 230, 4, 3);
add_aspect_ratio('4x3', 460, 4, 3);

add_aspect_ratio('16x9', 690, 16, 9);
add_aspect_ratio('16x9', 930, 16, 9);
