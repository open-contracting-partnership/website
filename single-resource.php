<?php // single-resource.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<div class="wrapper">

		<article class="cf">

			<section>

				<div class="resource__title">
					<img src="<?php bloginfo('template_directory'); ?>/assets/img/icons/icon--book.svg" />
				</div>

				<h1 class="gamma"><?php the_title(); ?></h1>

				<p class="resource__meta">
					<span class="resource__published-date"><?php the_date(); ?></span>
					<?php echo sprintf(pll__('By %s'), get_field('organisation')); ?>
				</p>

				<hr />

				<?php the_content(); ?>

				<hr />

				<div class="band band--extra-thick">

					<?php if ( $terms = get_field('region') ) : ?>

						<div class="resource__terms / band">

							<p><?php pll_e('Region'); ?></p>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/region/<?php echo $term->slug; ?>" class="button button--small button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

					<?php if ( $terms = get_field('issue') ) : ?>

						<div class="resource__terms / band">

							<p><?php pll_e('Issue'); ?></p>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/issue/<?php echo $term->slug; ?>" class="button button--small button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

					<?php if ( $terms = get_field('open_contracting') ) : ?>

						<div class="resource__terms / band">

							<p><?php pll_e('OC Framework'); ?></p>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/open-contracting/<?php echo $term->slug; ?>" class="button button--small button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

				</div>

				<?php if ( $attachments = get_field('attachments') ) : ?>
					<p><a href="<?php echo $attachments[0]['file']; ?>" class="button button--block button--large">Download</a></p>
				<?php endif; ?>

			</section>

		</article>

	</div>

<?php get_footer(); ?>
