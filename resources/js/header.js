document.body.addEventListener('click', event => {

	// target hamburger, return to prevent continuing
	if ( event.target && event.target.closest('.site-header__hamburger') ) {
		event.stopPropagation();
		document.body.classList.toggle('mobile-menu-active');
		return;
	}

	// target navigation, return to prevent continuing
	if ( event.target && event.target.closest('.site-header__navigation') ) {
		event.stopPropagation();
		return;
	}

	// target navigation, return to prevent continuing
	if ( event.target && event.target.closest('.header-mobile-nav') ) {
		event.stopPropagation();
		return;
	}

	document.body.classList.remove('mobile-menu-active');

});
