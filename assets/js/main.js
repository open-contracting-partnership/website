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

	if ( document.querySelector('.posts-filter__button') ) {

		document.querySelector('.posts-filter__button').addEventListener('click', function(e) {

			e.preventDefault();
			e.stopPropagation();

			this.parentNode.classList.toggle('active');

		}, false);

	}

	document.querySelector('.posts-filter__inner').addEventListener('click', function(e) {
		e.stopPropagation();
	}, false);

	document.body.addEventListener('click', function() {

		var posts_filter = document.querySelector('.posts-filter__inner');

		if ( posts_filter.classList.contains('active') ) {
			posts_filter.classList.remove('active');
		}

	}, false);

});
