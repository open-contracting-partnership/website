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

document.addEventListener('DOMContentLoaded', function () {
    const navMainItems = document.querySelectorAll('.nav-main-item');

    function adjustNavDropPosition(navDrop) {
        const rect = navDrop.getBoundingClientRect();
        const viewportWidth = window.innerWidth;

        if (rect.right > viewportWidth) {
            navDrop.style.left = `${viewportWidth - (64 + rect.right)}px`;
        } else {
            navDrop.style.left = '';
        }
    }

    navMainItems.forEach(navMainItem => {
        const navDrops = navMainItem.querySelectorAll('.nav-drop, .nav-drop-simple');

        navDrops.forEach(navDrop => {
            navMainItem.addEventListener('mouseenter', function () {
                adjustNavDropPosition(navDrop);
            });
			
			// Reset the position on mouseleave - else it only works every other time!
            navMainItem.addEventListener('mouseleave', function () {
                navDrop.style.left = '';
            });

            // Adjust position on window resize, just in case
            window.addEventListener('resize', function () {
                adjustNavDropPosition(navDrop);
            });
        });
    });
});
