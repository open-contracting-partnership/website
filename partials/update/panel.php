<div class="update-panel">

	<div class="update-panel__subscribe">

		<h3 class="update-panel__subscribe-title"><?php _e('Subscribe to our newsletter', 'ocp'); ?></h3>
		<p><?php _e('Sign up to our monthly email where you can recieve updates on our current work', 'ocp'); ?></p>

		<button class="js-subscribe-footer / button"><?php _e('Get our newsletter', 'ocp'); ?></button>

	</div>

	<div class="update-panel__follow">

		<p><?php _e('Follow us and keep up to date', 'ocp'); ?></p>

		<ul class="nav nav--horizontal">

			<?php if ( $twitter_url = get_field('twitter_url', 'options') ) : ?>
				<li><a href="<?php echo $twitter_url; ?>" target="_blank"><svg><use xlink:href="#icon-twitter" v-bind="{ 'xlink:href': '#icon-twitter' }" /></svg></a></li>
			<?php endif; ?>

			<?php if ( $facebook_url = get_field('facebook_url', 'options') ) : ?>
				<li><a href="<?php echo $facebook_url; ?>" target="_blank"><svg><use xlink:href="#icon-facebook" v-bind="{ 'xlink:href': '#icon-facebook' }" /></svg></a></li>
			<?php endif; ?>

			<?php if ( $linkedin_url = get_field('linkedin_url', 'options') ) : ?>
				<li><a href="<?php echo $linkedin_url; ?>" target="_blank"><svg><use xlink:href="#icon-linkedin" v-bind="{ 'xlink:href': '#icon-linkedin' }" /></svg></a></li>
			<?php endif; ?>

		</ul>

	</div>

</div>
