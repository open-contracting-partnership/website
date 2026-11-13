import { tns } from 'tiny-slider';

const $block_featured_stories_carousel = document.querySelectorAll('.block[data-block-type="featured-stories-carousel"]');

$block_featured_stories_carousel.forEach($block => {
    const $prev_button = $block.querySelector('.block__controls [rel="prev"]');
    const $next_button = $block.querySelector('.block__controls [rel="next"]');

    tns({
        container: $block.querySelector('.block__carousel'),
        swipeAngle: false,
        prevButton: $prev_button,
        nextButton: $next_button,
        speed: 400,
    });
});
