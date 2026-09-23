import { tns } from "../../node_modules/tiny-slider/src/tiny-slider"

const $cardCarousels = document.querySelectorAll('.cards-carousel');

$cardCarousels.forEach($block => {
    const $carousel = $block.querySelector('.cards-carousel__carousel');

    // each card needs to be wrapped in a div to isolate paddings
    [...$carousel.children].forEach($child => {
        const $wrapper = document.createElement('div');
        $wrapper.classList.add('cards-carousel__carousel-item');
        $wrapper.appendChild($child.cloneNode(true));
        $carousel.replaceChild($wrapper, $child);
    });

    const $prevButton = $block.querySelector('.cards-carousel__carousel-controls [rel="prev"]');
    const $nextButton = $block.querySelector('.cards-carousel__carousel-controls [rel="next"]');

    tns({
        container: $block.querySelector('.cards-carousel__carousel'),
        swipeAngle: false,
        prevButton: $prevButton,
        nextButton: $nextButton,
        nav: false,
        speed: 400,
        items: 1,
        gutter: 16,
        responsive: {
            768: {
                items: 2,
            },
            1024: {
                items: 3,
            }
        }
    });
});
