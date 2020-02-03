const $card_quote = document.querySelectorAll('.card--quote');

$card_quote.forEach($card => {

	const $toggle = $card.querySelector('.card__toggle');

	if ( $toggle !== null ) {

		$toggle.addEventListener('click', event => {

			event.preventDefault();

			$card.classList.toggle('card--active');

		});

	}

});
