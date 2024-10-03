import { tns } from "../../node_modules/tiny-slider/src/tiny-slider"

const $block_quote_carousel = document.querySelectorAll('.block[data-block-type="quote-carousel"]');

$block_quote_carousel.forEach($block => {

	const $prev_button = $block.querySelector('.block__carousel-controls [rel="prev"]');
	const $next_button = $block.querySelector('.block__carousel-controls [rel="next"]');

	var slider = tns({
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
				items: 1,
			},
			992: {
				items: 2,
			}
		}
	});

	// bind function to event
	slider.events.on('transitionStart', info => {

		// remove all existing active classes
		$block.querySelectorAll('.block__carousel-item--active').forEach($item => $item.classList.remove('block__carousel-item--active'));

		// set the active index
		setActiveIndex();

	});

	function setActiveIndex() {

		const $active = $block.querySelectorAll('.tns-slide-active');
		const index = Math.floor($active.length / 2);

		$active[index].classList.add('block__carousel-item--active');

	}

	setActiveIndex();

});
