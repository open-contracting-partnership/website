<?php

$svg = file_get_contents('map-original.svg');

$svg = str_replace('fill="black"', 'fill="#000000"', $svg);
$svg = str_replace('id="', 'class="', $svg);

$pattern = '/<path class="Vector([_0-9]+)?" d="M([0-9\.?]+) ([0-9\.?]+)C([0-9\.? CZ]+)" fill="#([0-9a-fA-F]+)"\/>/';

function callback ($matches) {
    $radius = 2.75;

    $x = floatval($matches[2]);
    $y = $matches[3] - $radius;

    $y = round($y, 1);
    $x = round($x, 1);

    return sprintf(
        '<circle cx="%s" cy="%s" r="2.75" />',
        $x,
        $y
    );
}

$svg = preg_replace_callback($pattern, 'callback', $svg);

file_put_contents('map-new.svg', $svg);

echo $svg;
