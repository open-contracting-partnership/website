<?php

// autoload classes based on a 1:1 mapping from namespace to directory structure.
spl_autoload_register(function($className) {

    # Usually I would just concatenate directly to $file variable below
    # this is just for easy viewing on Stack Overflow)
    $ds = DIRECTORY_SEPARATOR;
    $dir = __DIR__;

    // replace namespace separator with directory separator (prolly not required)
    $className = str_replace('\\', $ds, $className);

    // get full name of file containing the required class
    $file = "{$dir}{$ds}{$className}.php";

    // get file if it is readable
    if (is_readable($file)) require_once $file;
	
});
