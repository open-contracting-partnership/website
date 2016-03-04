<?php

	if ( $date = get_field('event_date') ) {
		$date = strtotime($date);
	}

?>

<a href="/events/#<?php echo basename(get_the_permalink()); ?>" class="post-object post-object--event">

	<div class="post-object__media">
		<?php if ( $date ) : ?>
			<time><?php echo date('j', $date); ?><em><?php echo date('M', $date); ?></em></time>
		<?php else : ?>
			<em>TBA</em>
		<?php endif; ?>
	</div>

	<div class="post-object__content">
		<h4><?php the_title(); ?></h4>
	</div>

</a>
