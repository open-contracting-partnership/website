<?php // single-resource.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<?php

		if ( $date = get_field('event_date') ) {
			$date = strtotime($date);
		}

	?>

	<div class="wrapper">

		<article class="cf">

			<section>

				<div class="event__title">
					<svg><use xlink:href="#icon-event" /></svg>
					<?php if ( $date ) : ?>
						<time><?php echo date('j', $date); ?><span><?php echo date('S', $date); ?></span> <?php echo date('F Y', $date); ?></time>
					<?php else : ?>
						<time><span>To Be Announced</span></time>
					<?php endif; ?>
				</div>

				<h1 class="gamma"><?php the_title(); ?></h1>

				<p class="resource__meta">
					<?php echo sprintf(pll__('By %s'), get_field('organisation')); ?>
				</p>

				<?php if ( $attachments = get_field('attachments') ) : ?>
					<p><a onclick="_gaq.push(['_trackEvent', 'Resources', 'Download', '<?php the_title(); ?>']);" href="<?php echo $attachments[0]['file']; ?>" class="button button--block button--large button--icon button--icon--reverse button--icon--stroke">Download<svg><use xlink:href="#icon-download" /></svg></a></p>
				<?php endif; ?>

				<?php if ( $link = get_field('link') ) : ?>
					<p><a onclick="_gaq.push(['_trackEvent', 'Resources', 'Visit', '<?php the_title(); ?>']);" href="<?php echo $link; ?>" class="button button--block button--large">View</a></p>
				<?php endif; ?>

				<hr />

				<div class="post-content">
					<?php the_content(); ?>
				</div>

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

			</section>

		</article>

	</div>

<?php get_footer(); ?>
