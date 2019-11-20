const $block_our_model = document.querySelectorAll('.block[data-block-type="our-model"]');

$block_our_model.forEach($block => {

	$diagram = $block.querySelector('.block__model-diagram > svg');
	$groups = $diagram.querySelectorAll('g[data-section]');
	$content = $block.querySelector('.block__model-content');

	$groups.forEach($group => {

		$group.addEventListener('click', event => {

			event.preventDefault();

			$diagram.setAttribute('data-section', $group.getAttribute('data-section'));
			$content.setAttribute('data-section', $group.getAttribute('data-section'));

		});

	});

});
