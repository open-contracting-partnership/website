const $mailchimp_forms = document.querySelectorAll('.js-mailchimp-form');

$mailchimp_forms.forEach($form => {

	$form.addEventListener('submit', event => {

		event.preventDefault();

		$form.querySelector('.js-mailchimp-form__message').innerHTML = '&nbsp;';

		fetch(mailchimp_options.root + 'ocp/v1/mailchimp/add-subscriber', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			credentials: 'same-origin',
			body: JSON.stringify({
				email: $form.email.value
			})
		})
		.then(response => response.json())
		.then(data => {
			$form.querySelector('.js-mailchimp-form__message').innerHTML = data.message;
		})
		.catch(error => {
			$form.querySelector('.js-mailchimp-form__message').innerHTML = mailchimp_options.error_text;
		});

	});

});
