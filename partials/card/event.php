<?php

	if ( $date = get_field('event_date') ) {
		$date = strtotime($date);
	}

?>

<div class="card card--event">

    <div class="card-event__date">
        <span class="card-event__day"><?php echo date('j', $date); ?></span>
        <span class="card-event__month"><?php echo date('M', $date); ?></span>
    </div>

    <div class="card__content">

        <h6 class="card__heading">
            <a class="card__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h6>

    </div>

</div>
