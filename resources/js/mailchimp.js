import _ from 'lodash';

const $mailchimp_forms = document.querySelectorAll('.js-mailchimp-form');

$mailchimp_forms.forEach($form => {
    $form.addEventListener('submit', event => {
        event.preventDefault();

        let params = new FormData($form);

        $form.querySelector('.js-mailchimp-form__message').innerHTML = '';

        fetch(mailchimp_options.root + 'ocp/v1/mailchimp/add-subscriber', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                email: params.get('email'),
                regions: params.getAll('regions'),
            })
        })
        .then(function(response) {
            if (response.ok) {
                return response.json();
            }

            $form.querySelector('.js-mailchimp-form__message').innerHTML = mailchimp_options.error_text;

            throw new Error('Something went wrong.');
        })
        .then(() => {
            $form.reset();
            $form.closest('[data-mailchimp-success]').dataset.mailchimpSuccess = 'true';
        })
        .catch(error => {
            $form.querySelector('.js-mailchimp-form__message').innerHTML = mailchimp_options.error_text;
        });
    });
});
