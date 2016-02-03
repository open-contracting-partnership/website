<?php // partials/breadcrumbs/default.php ?>

<?php if ( $breadcrumbs = get_breadcrumbs() ) : ?>

	<nav>

		<ul class="nav nav--horizontal nav--breadcrumbs">

			<?php foreach ( $breadcrumbs as $breadcrumb ) : ?>

				<?php if ( key($breadcrumb) !== "" ) : ?>

					<li>
						<a href="<?php echo key($breadcrumb); ?>"><?php echo current($breadcrumb); ?></a>
					</li>

				<?php else : ?>

					<li>
						<a href="<?php the_permalink(); ?>"><?php echo current($breadcrumb); ?></a>
					</li>

				<?php endif; ?>

			<?php endforeach; ?>

		</ul>

	</nav>

<?php endif; ?>
