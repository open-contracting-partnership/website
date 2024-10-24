import { tns } from "../../node_modules/tiny-slider/src/tiny-slider"

const $block_quote_carousel = document.querySelectorAll('.block[data-block-type="quote-carousel"]');

$block_quote_carousel.forEach($block => {
    const $prev_button = $block.querySelector('.block__carousel-controls [rel="prev"]');
    const $next_button = $block.querySelector('.block__carousel-controls [rel="next"]');

    tns({
        container: $block.querySelector('.block__carousel'),
        swipeAngle: false,
        prevButton: $prev_button,
        nextButton: $next_button,
        nav: false,
        speed: 400,
        items: 1,
        gutter: 16,
        responsive: {
            768: {
                items: 2,
            },
        }
    });
});
