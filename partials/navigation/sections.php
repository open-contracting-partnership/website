<?php if ( $sections = get_sections() ) : ?>

	<nav>

		<h3 class="border-top border-top--clean"><?php pll_e('Jump to section'); ?></h3>

		<ul class="nav nav--vertical nav--in-page">

			<?php foreach ( $sections as $id => $label ) : ?>
				<li class="active"><a href="#<?php echo $id; ?>"><?php echo $label; ?></a></li>
			<?php endforeach; ?>

		</ul>

	</nav>

<?php endif; ?>
