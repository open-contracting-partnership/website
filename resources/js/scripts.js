import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'

window.Alpine = Alpine

Alpine.plugin(persist)

Alpine.start()

// search box resetting
const $searchBoxResetButtons = document.querySelectorAll('.search-box__reset');

[...$searchBoxResetButtons].forEach($searchBoxResetButton => {
    $searchBoxResetButton.addEventListener('click', (event) => {
        const $searchBox = event.target.closest('.search-box');
        const $searchBoxInput = $searchBox.querySelector('.search-box__input');

        $searchBoxInput.value = '';
    });
});
