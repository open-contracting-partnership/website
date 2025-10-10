import { tns } from "../../node_modules/tiny-slider/src/tiny-slider"

const $block_download_carousel = document.querySelectorAll('.block[data-block-type="download-carousel"]');

$block_download_carousel.forEach($block => {
    const $prev_button = $block.querySelector('.block__carousel-controls [rel="prev"]');
    const $next_button = $block.querySelector('.block__carousel-controls [rel="next"]');

    const $items = $block.querySelectorAll('.block__carousel .block__carousel-item');

    var slider = tns({
        container: $block.querySelector('.block__carousel'),
        swipeAngle: false,
        prevButton: $prev_button,
        nextButton: $next_button,
        loop: false,
        nav: false,
        speed: 400,
        items: 2,
        startIndex: $items.length - 2,
        responsive: {
            600: {
                items: 4,
                startIndex: $items.length - 4,
            },
            1024: {
                items: 5,
                startIndex: $items.length - 5,
            }
        }
    });
});
