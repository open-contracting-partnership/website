const whereWeWorkButtons = document.querySelectorAll('.where-we-work__list .button');

if (whereWeWorkButtons) {
    [...whereWeWorkButtons].forEach(button => {
        const $mapContainer = button.closest('.where-we-work__map-container');

        button.addEventListener('mouseover', (event) => {
            $mapContainer.dataset.activeRegion = event.target.dataset.region;
        });

        button.addEventListener('mouseout', () => {
            $mapContainer.dataset.activeRegion = '';
        });
    });
}
