$(document).ready(function() {

	$('.page-content table').wrap('<div class="table-wrap" />');

	$('#lang_choice_1').addClass('custom-select');

	var $contract_sidebar = $('.contract-single .page-sidebar');
	var sidebar_waypoint;

	if ( $contract_sidebar.length ) {

		sidebar_waypoint = new Waypoint({
			element: $contract_sidebar[0],
			handler: function(direction) {

				if ( direction == 'down' ) {
					$contract_sidebar.addClass('fixed');
				}

				if ( direction == 'up' ) {
					$contract_sidebar.removeClass('fixed');
				}

			}
		});

	}

	var $contract_sections = $('.contract-single-section'),
		$contracts_nav = $('.contract-sidebar-nav'),
		$contracts_paginate = $('.contract-paginate'),
		waypoint;

	if ( $contract_sections.length ) {

		$contract_sections.each(function($index, $section) {

			waypoint = new Waypoint({
				element: document.getElementById($section.id),
				handler: function(direction) {

					if ( direction == 'down' ) {

						$contracts_nav.find('.number-heading--active').removeClass('number-heading--active');
						$contracts_nav.find('.mobile-active').removeClass('mobile-active');
						$contracts_nav.find('li:nth-child(' + ($index + 1) + ') a').addClass('number-heading--active');
						$contracts_nav.find('li:nth-child(' + ($index + 1) + ')').addClass('mobile-active');

					}

				},
				offset: '50%'
			});

			waypoint = new Waypoint({
				element: document.getElementById($section.id),
				handler: function(direction) {

					if ( direction == 'up' ) {

						$contracts_nav.find('.number-heading--active').removeClass('number-heading--active');
						$contracts_nav.find('.mobile-active').removeClass('mobile-active');
						$contracts_nav.find('li:nth-child(' + ($index + 1) + ') a').addClass('number-heading--active');
						$contracts_nav.find('li:nth-child(' + ($index + 1) + ')').addClass('mobile-active');

					}

				},
				offset: '112'
			});

		});

	}

	if ( $contracts_nav.length ) {

		$contracts_nav.find('a').on('click', function(event) {

			event.preventDefault();

			var section = this.dataset.section;

			history.pushState(null,null,'#' + section);

			$('html, body').animate({
				scrollTop: $('#' + section).offset().top - 112
			}, 500);

		});

	}

	if ( $contracts_paginate.length ) {

		$contracts_paginate.each(function() {

			$(this).on('click', function(event) {

				event.preventDefault();

				var direction = this.dataset.direction;
				var $link;
				var $section;

				if ( direction === 'prev' ) {
					$link = $('li.mobile-active').prev();
				} else if ( direction === 'next' ) {
					$link = $('li.mobile-active').next();
				}

				if ( $link.length ) {

					$section = $link.find('a').data('section');

					history.pushState(null,null,'#' + $section);

					$('html, body').animate({
						scrollTop: $('#' + $section).offset().top - 112
					}, 500);

					setTimeout(function() {
						$('li.mobile-active').removeClass('mobile-active');
						$link.addClass('mobile-active');
					}, 500);

				}

			})

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

		var $link = $(this),
			$target = $($link.attr('href'));

		// remove any existing active classes
		$('.nav--in-page li.active').removeClass('active');

		// set the current li to active
		$link.closest('li').addClass('active');


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

		// scroll to the target
		if ( ! active && ($profile.offset().top - 16 < $(window).scrollTop()) ) {
			$(window).scrollTop($profile.offset().top - 16)
		}

	});


	 //**********
	// SUBSCRIBE

	$('.js-subscribe-footer').on('click', function(event) {

		event.preventDefault();

		showMailingPopUp();


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


	 //****************
	// ADVISORY SLIDER

	if ( $.slick ) {

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
