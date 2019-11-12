const $profile_blocks = document.querySelectorAll('.block[data-block-type="team-profile"]');

$profile_blocks.forEach($block => {

	$triggers = $block.querySelectorAll('.block__list a, .block__avatar');
	$profiles = $block.querySelectorAll('.block__profile');

	let scroll_into_view = false;

	$triggers.forEach($trigger => {

		$trigger.addEventListener('click', event => {

			event.preventDefault();

			// replace the url has without triggering a jump tp
			history.replaceState('', '', $trigger.getAttribute('href'));

			$profiles.forEach($profile => {
				$profile.classList.toggle('active', $trigger.getAttribute('href').replace('#', '') === $profile.id);
			});

			if ( scroll_into_view ) {

				$block.querySelector('.block__profile.active').scrollIntoView({
					behavior: "smooth",
					block: "start"
				});

			}

			scroll_into_view = true;

		});

	});

	// try and get the target link based on the window location hash
	let $target = $block.querySelector('.block__list a[href="' + window.location.hash + '"]');

	// otherwise, set it to the first in the list
	if ( ! $target ) {
		$target = $triggers[0];
	}

	$target.click();

});
