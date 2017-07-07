/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);

$(document).ready(function() {


	$('#lang_choice_1').addClass('custom-select');


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

		document.querySelector('.posts-filter__inner').addEventListener('click', function(e) {
			e.stopPropagation();
		}, false);

		document.body.addEventListener('click', function() {

			var posts_filter = document.querySelector('.posts-filter__inner');

			if ( posts_filter.classList.contains('active') ) {
				posts_filter.classList.remove('active');
			}

		}, false);

	}

	 //****************
	// HOMEPAGE FILTER

	$('.js-homepage-filter').on('change', 'input', function() {

		$('.homepage-filter__items').html($('.homepage-filter__items-pool').html());

		var $self = $(this),
			$context = $('.homepage-filter__items');

		switch ( $self.val() ) {

			case 'post':
				$('.homepage-filter__item:not(.homepage-filter__post)', $context).remove();
				break;

			case 'news':
				$('.homepage-filter__item:not(.homepage-filter__news)', $context).remove();
				break;

			case 'tweet':
				$('.homepage-filter__item:not(.homepage-filter__twitter)', $context).remove();
				break;

			case 'resource':
				$('.homepage-filter__item:not(.homepage-filter__resource)', $context).remove();
				break;

		}

		$('.homepage-filter__item', $context).slice(6).remove();

	});

	$('.js-homepage-filter input[checked]').trigger('change');



	 //*******
	// SEARCH

	$('.header-search a').on('click', function(event) {

		event.preventDefault();

		$('.site-header__top').toggleClass('search--active');

		$('.site-header__top [type="search"]').focus();

	});

	$('.header-search, .header__search').on('click', function(event) {
		event.stopPropagation();
	});

	$('body, .search__close').on('click', function() {

		// close the search box
		$('.site-header__top').removeClass('search--active');

	});

	// escape key
	$(document).keyup(function(event) {

		if (event.keyCode == 27) {

			if ( $('.site-header__top.search--active') ) {
				$('.site-header__top').removeClass('search--active');
			}

			if ( typeof resource_vue !== 'undefined' ) {
				resource_vue.open_resource = null;
			}

		}

	});


	 //*****
	// MENU

	$('.mobile-menu').on('click', function(event) {
		event.stopPropagation();
		$('body').toggleClass('mobile-active');
	});

	// stop event bubbling for next handler
	$('.primary-nav').on('click', function(event) {
		event.stopPropagation();
	});

	// close mobile menu on body click
	$('body').on('click', function(event) {

		var $this = $(this);

		if ( $this.hasClass('mobile-active') ) {
			$this.removeClass('mobile-active');
		}

	});

	$('.nav--in-page a').on('click', function(event) {

		event.preventDefault();

		var $link = $(this),
			$target = $($link.attr('href'));

		// remove any existing active classes
		$('.nav--in-page li.active').removeClass('active');

		// set the current li to active
		$link.closest('li').addClass('active');

		// scroll to the target
		$('html, body').animate({
			scrollTop: $target.offset().top - parseInt($target.css('margin-top'))
		}, 1000);

	});

	$('.nav--in-page').each(function() {

		var $self = $(this);

		if ( $self.data('nav-active') === false ) {
			return;
		}

		$self.find('li:first-child').addClass('active');

	});


	 //********
	// PROFILE

	// used on team and advisory pages

	var $profiles = $('.profile'),
		$profile_selectors = $('.profile-selector');

	$profile_selectors.on('click', function(event) {

		event.preventDefault();

		var $profile = $(this);

		$profiles
			.removeClass('active')
			.filter($profile.attr('href'))
				.addClass('active');

		$profile_selectors.removeClass('active');
		$profile.addClass('active');

	});

	$profile_selectors.first().trigger('click');

	$('.profile__collapse').on('click', function(event) {

		event.preventDefault();

		var $profile = $(this).closest('.profile'),
			active = $profile.hasClass('active');

		// remove any previous active profiles
		$('.profile.active').removeClass('active');

		// make this profile active
		$profile.toggleClass('active', ! active);

	});


	 //**********
	// SUBSCRIBE

	$('.js-subscribe form').on('submit', function(event) {

		event.preventDefault();

		var $form = $(this);

		$.ajax({
			url: template_url + '/endpoints/subscribe.php',
			dataType: 'json',
			method: 'POST',
			data: {
				email: $form.find('[name="email"]').val()
			}
		})
		.done(function(response) {

			// remove any existing alerts
			$('.subscribe__alert').remove();

			var $alert = $('<p class="subscribe__alert"></p>').insertAfter($form);

			if ( response.success === true ) {
				$alert.html('Subscribed successful!');
			} else {
				$alert.html('<svg><use xlink:href="#icon-close"></use></svg> Subscribe unsuccessful');
			}

		});

	});


	 //*********
	// WORLDMAP

	window.addEventListener('message', function (e) {

		var $iframe = $('#worldmap'),
			eventName = e.data[0],
			data = e.data[1];

		switch (eventName) {

			case 'setHeight':
				$iframe.height(data);
				break;

		}

	}, false);



	 //*******
	// STRIPS

	var $last_item = $('.page__container > :last-child');

	if ( $last_item.length && $last_item.hasClass('page-strip') ) {

		$('.page__container').css('margin-bottom', '0');
		$last_item.css('margin-bottom', '0');

	}


	 //****************
	// ADVISORY SLIDER

	$('.timeline').slick({
		infinite: false,
		speed: 300,
		initialSlide: $('.timeline-item').length - 5,
		slidesToShow: 5,
		slidesToScroll: 1,
		prevArrow: '<a href="#" class="slick-prev"><svg><use xlink:href="#icon-arrow"></svg></a>',
		nextArrow: '<a href="#" class="slick-next"><svg><use xlink:href="#icon-arrow"></svg></a>',
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



});
