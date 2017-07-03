<div class="card card--content">

	<div class="card--content__inner">

	    <div class="card__icon" data-content-type="<?php echo get_post_type(); ?>">
	        <svg><use xlink:href="#icon-<?php echo get_post_type(); ?>"></svg>
	    </div>

	    <div class="card__content">

	        <span class="card-content__type"><?php the_post_type_label(); ?></span>

	        <p class="card__heading">
	            <a class="card__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	        </p>

	    </div>

	</div>

</div>
