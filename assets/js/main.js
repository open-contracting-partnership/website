$(document).ready(function() {

	 //********************
	// SVG ERROR REPORTING

	// <img src="example.svg" data-fallback="example.png">

	if ( ! Modernizr.svg ) {

		$('img[data-fallback]').each(function() {

			// cache image element
			var $img = $(this);

			// replace svg with fallback
			$img.attr('src', $img.data('fallback'));

		});

	}


	 //***************
	// SCROLL TO TOP

	$('.to-top').on('click', function(e) {

		e.preventDefault();

		$('html, body').animate({
			scrollTop: 0
		}, 1000);

	});


	 //*************
	// POSTS FILTER

	if ( $('.posts-filter__button').length ) {

		$('.posts-filter__button').on('click', function(e) {

			e.preventDefault();

			$(this).parents('.posts-filter').toggleClass('active');

		});

	}

});
