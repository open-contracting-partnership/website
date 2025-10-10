import { tns } from "../../node_modules/tiny-slider/src/tiny-slider"

const $block_featured_stories_carousel = document.querySelectorAll('.block[data-block-type="featured-stories-carousel"]');

$block_featured_stories_carousel.forEach($block => {
    const $carousel = $block.querySelector('.block__carousel');

    var slider = tns({
        container: $carousel,
        mouseDrag: true,
        swipeAngle: false,
        speed: 400,
        controlsContainer: '.block__controls'
    });
});
