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
				$('.homepage-filter__twitter', $context).remove();
				break;

			case 'tweet':
				$('.homepage-filter__post', $context).remove();
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

	$('.mobile-menu').on('click', function() {
		$('body').toggleClass('mobile-active');
	});

	// SHAME
	$('.sub-menu').each(function() {
		$(this).prepend('<li class="nav__home"><a href="/">&nbsp;</a></li>');
	});

	if ( $('li.current-menu-item ul, li.current-menu-ancestor ul').length ) {
		$('main').addClass('menu--open');
	}

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

	$('.nav--in-page li:first-child').addClass('active');


	 //*************
	// TEAM MEMBERS

	var $team_members = $('.team-member');

	$('.team-member__selector').on('click', function(event) {

		event.preventDefault();

		var $team_member = $(this);

		$team_members
			.removeClass('active')
			.filter($team_member.attr('href'))
				.addClass('active');

		$('.team-member__selector').removeClass('active');
		$team_member.addClass('active');

	});

	$('.team-member__selector').first().trigger('click');

	$('.team-member__view-bio').on('click', function(event) {

		event.preventDefault();

		$(this).closest('.team-member').find('.team-member__bio').toggleClass('active');

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

});
