const $block_our_model = document.querySelectorAll('.block[data-block-type="our-model"]');

$block_our_model.forEach($block => {

	$diagram = $block.querySelector('.block__model-diagram > svg');
	$sections = $diagram.querySelectorAll('g[data-section]');
	$section_container = $diagram.querySelector('.section-container');

	$content = $block.querySelector('.block__model-content');

	$sections.forEach($section => {

		$section.addEventListener('click', event => {

			event.preventDefault();

			// remove the current class from any other section…
			$sections.forEach($section => $section.classList.remove('current'));

			// …and add it to the current section
			$section.classList.add('current');

			// set the data section attributes, to control the displayed content and states
			$diagram.setAttribute('data-section', $section.getAttribute('data-section'));
			$content.setAttribute('data-section', $section.getAttribute('data-section'));

			// move the current section to the top of the dom tree, this allows
			// the SVG to render the latter elements on top, this is needed to
			// fix a lack of z-index in SVG

			const $first_section = $section_container.querySelector('g[data-section]:first-child');
			$section_container.insertBefore($section, $first_section);

		});

	});

});
