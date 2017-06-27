<?php if ( $sections = get_sections() ) : ?>

	<nav class="page__section-nav">

		<h6 class="border-top border-top--clean"><?php _e('Jump to section', 'ocp'); ?></h6>

		<ul class="nav nav--vertical nav--in-page">

			<?php foreach ( $sections as $id => $label ) : ?>
				<li><a href="#<?php echo $id; ?>"><?php echo $label; ?></a></li>
			<?php endforeach; ?>

		</ul>

	</nav>

<?php endif; ?>
