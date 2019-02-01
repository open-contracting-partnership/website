$(document).ready(function() {


	 //****************
	// ADVISORY SLIDER

	if ( jQuery().slick ) {

		$('.timeline').slick({
			infinite: false,
			speed: 300,
			initialSlide: $('.timeline-item').length - 5,
			slidesToShow: 5,
			slidesToScroll: 1,
			swipeToSlide: true,
			prevArrow: '<a href="#" class="slick-prev"><svg><use xlink:href="#icon-arrow-left"></svg>Previous</a>',
			nextArrow: '<a href="#" class="slick-next">Next<svg><use xlink:href="#icon-arrow-right"></svg></a>',
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						initialSlide: $('.timeline-item').length - 4,
						slidesToShow: 4,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 600,
					settings: {
						initialSlide: $('.timeline-item').length - 2,
						slidesToShow: 2,
						slidesToScroll: 1
					}
				}
			]
		});

	}

});
