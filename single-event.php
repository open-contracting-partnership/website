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

			<section class="open-event">

				<div class="event__title">
					<svg><use xlink:href="#icon-event" /></svg>
					<?php if ( $date ) : ?>
						<time><?php echo date('j', $date); ?><span><?php echo date('S', $date); ?></span> <?php echo date('F Y', $date); ?></time>
					<?php else : ?>
						<time><span>To Be Announced</span></time>
					<?php endif; ?>
				</div>

				<h1 class="gamma"><?php the_title(); ?></h1>

				<p class="event__meta">

					<?php echo sprintf(pll__('Organisation: %s'), get_field('organisation')); ?>

					<?php if ( $event_location = get_field('event_location') ) : ?>
							<span>, <?php echo $event_location; ?></span>
					<?php endif; ?>

				</p>

				<hr />

				<div class="post-content">

					<?php the_content(); ?>

					<?php if ( $link = get_field('link') ) : ?>
						<p><a href="<?php echo $link; ?>">View more details</a></p>
					<?php endif; ?>

				</div>

				<hr />

				<div class="band band--extra-thick">

					<?php if ( $terms = get_field('region') ) : ?>

						<div class="event__terms">

							<span><?php pll_e('Location'); ?></span>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/region/<?php echo $term->slug; ?>" class="button button--small button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

					<?php if ( $terms = get_field('issue') ) : ?>

						<div class="event__terms">

							<span><?php pll_e('Issue'); ?></span>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/issue/<?php echo $term->slug; ?>" class="button button--small button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

					<?php if ( $terms = get_field('audience') ) : ?>

						<div class="event__terms">

							<span><?php pll_e('Audience'); ?></span>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/audience/<?php echo $term->slug; ?>" class="button button--small button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

					<?php if ( $terms = get_field('open_contracting') ) : ?>

						<div class="event__terms">

							<span><?php pll_e('OC Framework'); ?></span>

							<ul class="button__list">

								<?php foreach ( $terms as $term ) : ?>
									<li><a href="/open-contracting/<?php echo $term->slug; ?>" class="button button--small button--tag"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

					<?php if ( $attachments = get_field('attachments') ) : ?>

						<hr>

						<div class="event__terms">

							<p><?php pll_e('Attachments'); ?></p>

							<ul class="arrow-list">

								<?php foreach ( $attachments as $attachment ) : ?>
									<li><a href="<?php echo $attachment['file']; ?>"><?php echo $attachment['name']; ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					<?php endif; ?>

				</div>

			</section>

		</article>

	</div>

<?php get_footer(); ?>
