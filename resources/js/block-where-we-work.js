const whereWeWorkButtons = document.querySelectorAll('.where-we-work__list .button');

if (whereWeWorkButtons) {
    [...whereWeWorkButtons].forEach(button => {
        const $mapContainer = button.closest('.where-we-work');

        button.addEventListener('mouseover', (event) => {
            let $target = event.target;

            if ($target.dataset.region === undefined) {
                $target = $target.closest('[data-region]');
            }

            $mapContainer.dataset.activeRegion = $target.dataset.region;
        });

        button.addEventListener('mouseout', () => {
            $mapContainer.dataset.activeRegion = '';
        });
    });
}
