<?php // front-page.php ?>

<?php get_header(); ?>

	<?php the_post(); ?>

	<?php

		function article_image($field) {
			echo '//ocp.imgix.net' . parse_url(get_field($field))['path'];
		}

	?>

	<div class="homepage-stories__wrapper">

		<div class="wrapper / band--thick">

			<div class="homepage-stories">

				<div class="homepage-story homepage-story--1" style="background-image: url('<?php echo article_image('first_article_article_0_image'); ?>?blend=B8C600&amp;bm=normal&amp;balph=80&amp;fm=pjpg&amp;fit=max&amp;w=768')">

					<a href="<?php the_field('first_article_article_0_link'); ?>">
						<h2><?php the_field('first_article_article_0_title'); ?></h2>
					</a>

					<div class="homepage-story__content">
						<?php the_field('first_article_article_0_content'); ?>
					</div>

					<p><a href="<?php the_field('first_article_article_0_link'); ?>" class="button button--padded">View Post</a></p>

				</div>

				<div class="homepage-story__right">

					<div class="homepage-story__right-top">

						<div class="homepage-story homepage-story--2" style="background-image: url('<?php echo article_image('second_article_article_0_image'); ?>?blend=00BCAD&amp;bm=normal&amp;balph=80&amp;fm=pjpg&amp;fit=max&amp;w=385')">

							<a href="<?php the_field('second_article_article_0_link'); ?>">
								<h3><?php the_field('second_article_article_0_title'); ?></h3>
							</a>

							<?php the_field('second_article_article_0_content'); ?>

						</div>

						<div class="homepage-story homepage-story--3" style="background-image: url('<?php echo article_image('third_article_article_0_image'); ?>?blend=6C75E1&amp;bm=normal&amp;balph=80&amp;fm=pjpg&amp;fit=max&amp;w=385')">

							<a href="<?php the_field('third_article_article_0_link'); ?>">
								<h3><?php the_field('third_article_article_0_title'); ?></h3>
							</a>

							<?php the_field('third_article_article_0_content'); ?>

						</div>

					</div>

					<div class="homepage-story homepage-story--4" style="background-image: url('<?php echo article_image('fourth_article_article_0_image'); ?>?blend=FC4E2F&amp;bm=normal&amp;balph=80&amp;fm=pjpg&amp;fit=max&amp;w=768')">

						<a href="<?php the_field('fourth_article_article_0_link'); ?>">
							<h2><?php the_field('fourth_article_article_0_title'); ?></h2>
						</a>

						<?php the_field('fourth_article_article_0_content'); ?>

					</div>

				</div>

			</div>

		</div> <!-- / .wrapper -->

	</div>

	<section class="homepage-contracting / band band--thick / island island--thick island--dark">

		<div class="wrapper">

			<?php if ( $stats_title = get_field('statistics_title') ) : ?>

				<div class="homepage-title">
					<h1><?php echo $stats_title; ?></h1>
				</div>

			<?php endif; ?>

			<?php if ( have_rows('statistics') ) : ?>

				<div class="stat__container">

					<?php while ( have_rows('statistics') ) : the_row(); ?>

						<div class="stat-module">
							<span><?php the_sub_field('stat'); ?></span>
							<div><p><?php the_sub_field('copy'); ?></p></div>
						</div>

					<?php endwhile; ?>

				</div> <!-- / .stat-container -->

			<?php endif; ?>

		</div>

	</section> <!-- stat-modules -->

	<div class="wrapper">

		<section class="homepage-filter / band band--extra-thick">

			<div class="posts-filter / band">

				<div class="posts-filter__inner">

					<a href="#" class="posts-filter__button"><svg><use xlink:href="#icon-filter" /></svg><?php _e('Filter Blogs & Updates', 'ocp'); ?></a>

					<form action="#" class="posts-filter__form / custom-radio / js-homepage-filter">
						<label><input type="radio" name="name" value="all" checked="checked"><span></span>All</label>
						<label><input type="radio" name="name" value="post"><span></span>Blog</label>
						<label><input type="radio" name="name" value="news"><span></span>News</label>
						<label><input type="radio" name="name" value="resource"><span></span>Resources</label>
						<label><input type="radio" name="name" value="tweet"><span></span>Tweets</label>
					</form>

				</div>

			</div>

			<?php

				// tweets
				$tweets = get_tweets();
				$tweets['tweets'] = array_values($tweets['tweets']);

				// latest posts
				$latest_posts = new query_loop([
					'post_type' => 'post',
					'posts_per_page' => 6
				]);
				$latest_posts = $latest_posts->query->posts;

				// latest news
				$latest_news = new query_loop([
					'post_type' => 'news',
					'posts_per_page' => 6
				]);
				$latest_news = $latest_news->query->posts;

				// latest resources
				$latest_resources = new query_loop([
					'post_type' => 'resource',
					'posts_per_page' => 6
				]);
				$latest_resources = $latest_resources->query->posts;

			?>

			<div class="homepage-filter__items"></div>

			<div class="homepage-filter__items-pool">

				<div class="homepage-filter__item / homepage-filter__twitter">

					<p>

						<a href="https://twitter.com/opencontracting/status/<?php echo $tweets['tweets'][0]['id']; ?>" class="tweet__status-link">
							<svg><use xlink:href="#icon-twitter" /></svg>
						</a>

						<?php echo $tweets['tweets'][0]['content']; ?>

					</p>

				</div>

				<?php if ( load_post($latest_posts, 0) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<?php if ( load_post($latest_news, 0) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<?php if ( load_post($latest_posts, 1) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<div class="homepage-filter__item / homepage-filter__twitter">

					<p>

						<a href="https://twitter.com/opencontracting/status/<?php echo $tweets['tweets'][1]['id']; ?>" class="tweet__status-link">
							<svg><use xlink:href="#icon-twitter" /></svg>
						</a>

						<?php echo $tweets['tweets'][1]['content']; ?>

					</p>

				</div>

				<?php if ( load_post($latest_resources, 0) ) : ?>
					<?php get_partial('post-object', 'homepage-filter'); ?>
				<?php endif; ?>

				<?php

					//
					// SHOW EXCESS POST TYPES BELOW FOR FILTER PURPOSES
					//

				?>

				<?php for ( $i = 2; $i < 6; $i++ ) : ?>

					<div class="homepage-filter__item / homepage-filter__twitter">

						<p>

							<a href="https://twitter.com/opencontracting/status/<?php echo $tweets['tweets'][$i]['id']; ?>" class="tweet__status-link">
								<svg><use xlink:href="#icon-twitter" /></svg>
							</a>

							<?php echo $tweets['tweets'][$i]['content']; ?>

						</p>

					</div>

				<?php endfor; ?>

				<?php for ( $i = 2; $i < 6; $i++ ) : ?>

					<?php if ( load_post($latest_posts, $i) ) : ?>
						<?php get_partial('post-object', 'homepage-filter'); ?>
					<?php endif; ?>

				<?php endfor; ?>

				<?php for ( $i = 1; $i < 6; $i++ ) : ?>

					<?php if ( load_post($latest_news, $i) ) : ?>
						<?php get_partial('post-object', 'homepage-filter'); ?>
					<?php endif; ?>

				<?php endfor; ?>

				<?php for ( $i = 1; $i < 6; $i++ ) : ?>

					<?php if ( load_post($latest_resources, $i) ) : ?>
						<?php get_partial('post-object', 'homepage-filter'); ?>
					<?php endif; ?>

				<?php endfor; ?>

				<?php wp_reset_postdata(); ?>

			</div>

		</section>

		<section class="homepage-7-steps / band band--extra-thick">

			<div class="homepage-7-steps__introduction">

				<h3><?php the_field('7_steps_title'); ?></h3>
				<?php the_field('7_steps_introduction'); ?>

				<?php if ( have_rows('7_steps_links') ) : ?>

					<?php while ( have_rows('7_steps_links') ) : the_row(); ?>
						<a href="<?php echo get_sub_field('link')['url']; ?>" class="button button--white"><?php echo get_sub_field('link')['title']; ?></a>
					<?php endwhile; ?>

				<?php endif; ?>

			</div>

			<div class="homepage-7-steps__diagram">

				<svg viewBox="0 0 583 374" class="gs-diamonds"><defs><circle id="sidebar--circle-1" cx="396" cy="187" r="187"></circle> <mask id="sidebar--mask-1" width="374" height="374" x="0" y="0" fill="#fff"><use xlink:href="#sidebar--circle-1"></use></mask> <circle id="sidebar--circle-2" cx="187" cy="187" r="187"></circle> <mask id="sidebar--mask-2" width="374" height="374" x="0" y="0" fill="#fff"><use xlink:href="#sidebar--circle-2"></use></mask> <linearGradient id="sidebar--red-gradient" x1="75.32%" x2="23.93%" y1="25.85%" y2="74.31%"><stop stop-color="#F68774" offset="0%"></stop> <stop stop-color="#FB6045" offset="100%"></stop></linearGradient> <linearGradient id="sidebar--green-gradient" x1="75.32%" x2="23.93%" y1="25.85%" y2="74.31%"><stop stop-color="#2CDED0" offset="0%"></stop> <stop stop-color="#23B2A7" offset="100%"></stop></linearGradient> <linearGradient id="sidebar--purple-gradient" x1="75.32%" x2="23.93%" y1="25.85%" y2="74.31%"><stop stop-color="#949BF0" offset="0%"></stop> <stop stop-color="#6C75E1" offset="100%"></stop></linearGradient></defs> <g fill="none"><g><g><use fill="#FFF" stroke="#B7B7B7" stroke-width="2" mask="url(#sidebar--mask-1)" stroke-dasharray="11" xlink:href="#sidebar--circle-1" class="gs-diamonds__circle"></use> <g stroke="#B7B7B7"><use fill="#FFF" stroke-width="2" mask="url(#sidebar--mask-2)" stroke-dasharray="11" xlink:href="#sidebar--circle-2" class="gs-diamonds__circle"></use> <circle cx="186.6" cy="186.6" r="121.27"></circle></g> <g class="gs-diamonds__step"><path fill="#899A03" d="M171.98 163.63l-55.63-55.48c-3.13-3.12-3.13-8.2 0-11.32l55.63-55.5c3.13-3.1 8.18-3.1 11.3 0l55.64 55.5c3.13 3.1 3.13 8.17 0 11.3v.02l-55.64 55.48c-3.12 3.1-8.17 3.1-11.3 0z"></path> <g transform="translate(150 90)"><text class="gs-diamonds__step-number"><tspan x="21.06" y="51.72">1</tspan></text> <text class="gs-diamonds__step-title"><tspan x="0" y="16">DESIGN</tspan></text></g> <g class="gs-diamonds__step-icon"><path fill="#806346" d="M158 52.55c0 .8-.66 1.45-1.5 1.45s-1.5-.64-1.5-1.45v-10.1c0-.8.66-1.45 1.5-1.45s1.5.64 1.5 1.45v10.1z"></path> <path stroke="#262626" d="M158 52.55c0 .8-.66 1.45-1.5 1.45s-1.5-.64-1.5-1.45v-10.1c0-.8.66-1.45 1.5-1.45s1.5.64 1.5 1.45v10.1z"></path> <path fill="#806346" d="M162 50.55c0 .8-.66 1.45-1.5 1.45s-1.5-.64-1.5-1.45v-10.1c0-.8.66-1.45 1.5-1.45s1.5.64 1.5 1.45v10.1z"></path> <path stroke="#262626" d="M162 50.55c0 .8-.66 1.45-1.5 1.45s-1.5-.64-1.5-1.45v-10.1c0-.8.66-1.45 1.5-1.45s1.5.64 1.5 1.45v10.1z"></path> <path fill="#806346" d="M166.84 33.16c.33.6.13 1.33-.4 1.67-.58.35-1.27.13-1.6-.42l-4.68-8.56c-.33-.6-.13-1.33.4-1.67.58-.35 1.27-.13 1.6.42l4.68 8.56z"></path> <path stroke="#262626" d="M166.84 33.16c.33.6.13 1.33-.4 1.67-.58.35-1.27.13-1.6-.42l-4.68-8.56c-.33-.6-.13-1.33.4-1.67.58-.35 1.27-.13 1.6.42l4.68 8.56z"></path> <path fill="#FB6045" d="M162.96 25.3c0-2.36-2.25-3.02-4.98-1.44-2.73 1.58-4.98 4.83-4.98 7.2v11.5l2.5 1.44 7.5-4.3V25.3h-.04z"></path> <path stroke="#262626" d="M162.96 25.3c0-2.36-2.25-3.02-4.98-1.44-2.73 1.58-4.98 4.83-4.98 7.2v11.5l2.5 1.44 7.5-4.3V25.3h-.04z"></path> <path fill="#806346" d="M159.84 38.16c.33.6.12 1.33-.4 1.68-.58.34-1.27.12-1.6-.43l-4.68-8.56c-.33-.6-.13-1.33.4-1.67.58-.35 1.27-.13 1.6.42l4.68 8.56z"></path> <path stroke="#262626" d="M159.84 38.16c.33.6.12 1.33-.4 1.68-.58.34-1.27.12-1.6-.43l-4.68-8.56c-.33-.6-.13-1.33.4-1.67.58-.35 1.27-.13 1.6.42l4.68 8.56z"></path> <path fill="#806346" d="M158 19c2.2 0 4 1.8 4 4s-1.8 4-4 4-4-1.8-4-4 1.8-4 4-4"></path> <path stroke="#262626" stroke-width="1.6" d="M158 19c2.2 0 4 1.8 4 4s-1.8 4-4 4-4-1.8-4-4 1.8-4 4-4z"></path> <path fill="#262626" d="M160.25 23.07c.24-.14.55-.06.68.18.14.24.06.54-.18.68s-.55.06-.68-.18c-.14-.24-.06-.54.18-.68"></path> <path fill="#262626" d="M157.25 24.07c.24-.14.54-.06.68.18s.06.54-.18.68-.55.06-.68-.18c-.14-.24-.06-.54.18-.68"></path> <path fill="#464646" d="M162 21.73c-.6-1.6-2.1-2.73-3.87-2.73-2.28 0-4.13 1.86-4.13 4.16 0 .26.04.47.04.7.78.2 1.68.2 2.5-.14 1.2-.43 2.1-1.38 2.5-2.55.85.6 1.93.78 2.96.56"></path> <path stroke="#262626" d="M162 21.73c-.6-1.6-2.1-2.73-3.87-2.73-2.28 0-4.13 1.86-4.13 4.16 0 .26.04.47.04.7.78.2 1.68.2 2.5-.14 1.2-.43 2.1-1.38 2.5-2.55.85.6 1.93.78 2.96.56z"></path> <path fill="#FFCBA6" d="M190 54.55c0 .8.66 1.45 1.5 1.45s1.5-.64 1.5-1.45v-10.1c0-.8-.66-1.45-1.5-1.45s-1.5.64-1.5 1.45v10.1z"></path> <path stroke="#262626" d="M190 54.55c0 .8.66 1.45 1.5 1.45s1.5-.64 1.5-1.45v-10.1c0-.8-.66-1.45-1.5-1.45s-1.5.64-1.5 1.45v10.1z"></path> <path fill="#FFCBA6" d="M186 52.55c0 .8.66 1.45 1.5 1.45s1.5-.64 1.5-1.45v-10.1c0-.8-.66-1.45-1.5-1.45s-1.5.64-1.5 1.45v10.1z"></path> <path stroke="#262626" stroke-width="1.6" d="M186 52.55c0 .8.66 1.45 1.5 1.45s1.5-.64 1.5-1.45v-10.1c0-.8-.66-1.45-1.5-1.45s-1.5.64-1.5 1.45v10.1z"></path> <path fill="#FFCBA6" d="M185.4 31.52l-3.77 2.15c-.63.35-.8 1.1-.45 1.7.36.63 1.12.8 1.74.45l5.08-2.9v-5.7c0-.7-.58-1.22-1.25-1.22-.7 0-1.25.57-1.25 1.23v4.3h-.1z"></path> <path stroke="#262626" d="M185.4 31.52l-3.77 2.15c-.63.35-.8 1.1-.45 1.7.36.63 1.12.8 1.74.45l5.08-2.9v-5.7c0-.7-.58-1.22-1.25-1.22-.7 0-1.25.57-1.25 1.23v4.3h-.1z"></path> <path fill="#6C75E1" d="M185 27.3c0-2.36 2.26-3.02 5-1.44s5 4.83 5 7.2v11.5L192.48 46 185 41.66V27.3z"></path> <path stroke="#262626" d="M185 27.3c0-2.36 2.26-3.02 5-1.44s5 4.83 5 7.2v11.5L192.48 46 185 41.66V27.3z"></path> <path fill="#FFCBA6" d="M192.42 35.52l-3.8 2.15c-.62.35-.8 1.1-.44 1.7.36.63 1.12.8 1.74.45l5.08-2.9v-5.7c0-.7-.58-1.22-1.25-1.22-.7 0-1.25.57-1.25 1.23v4.3h-.08z"></path> <path stroke="#262626" d="M192.42 35.52l-3.8 2.15c-.62.35-.8 1.1-.44 1.7.36.63 1.12.8 1.74.45l5.08-2.9v-5.7c0-.7-.58-1.22-1.25-1.22-.7 0-1.25.57-1.25 1.23v4.3h-.08z"></path> <path fill="#FFCBA6" d="M189 20c2.2 0 4 1.8 4 4s-1.8 4-4 4-4-1.8-4-4 1.8-4 4-4"></path> <path stroke="#262626" d="M189 20c2.2 0 4 1.8 4 4s-1.8 4-4 4-4-1.8-4-4 1.8-4 4-4z"></path> <path stroke="#262626" stroke-width=".8" d="M187.03 24.33c.1-.26.38-.4.64-.3.26.1.4.38.3.64-.1.26-.38.4-.64.3-.26-.1-.4-.38-.3-.64z"></path> <path stroke="#262626" stroke-width=".8" d="M188.97 26c.1-.4-.03-.83-.3-.96-.28-.13-.58.05-.67.44"></path> <path stroke="#262626" stroke-width=".8" d="M189.03 25.33c.1-.26.38-.4.64-.3.26.1.4.38.3.64-.1.26-.38.4-.64.3-.26-.1-.4-.38-.3-.64z"></path> <path fill="#B79F57" d="M186 22.73c.6-1.6 2.1-2.73 3.87-2.73 2.28 0 4.13 1.86 4.13 4.16 0 .26-.04.47-.04.7-.78.2-1.68.2-2.5-.14-1.2-.43-2.1-1.38-2.5-2.55-.85.56-1.88.78-2.96.56"></path> <path stroke="#262626" d="M186 22.73c.6-1.6 2.1-2.73 3.87-2.73 2.28 0 4.13 1.86 4.13 4.16 0 .26-.04.47-.04.7-.78.2-1.68.2-2.5-.14-1.2-.43-2.1-1.38-2.5-2.55-.85.56-1.88.78-2.96.56z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#CC9E70" d="M209 65.55c0 .8.66 1.45 1.5 1.45s1.5-.64 1.5-1.45v-10.1c0-.8-.66-1.45-1.5-1.45s-1.5.64-1.5 1.45v10.1z"></path> <path stroke="#262626" stroke-width="1.6" d="M209 65.55c0 .8.66 1.45 1.5 1.45s1.5-.64 1.5-1.45v-10.1c0-.8-.66-1.45-1.5-1.45s-1.5.64-1.5 1.45v10.1z"></path> <path fill="#CC9E70" d="M204 62.55c0 .8.66 1.45 1.5 1.45s1.5-.64 1.5-1.45v-10.1c0-.8-.66-1.45-1.5-1.45s-1.5.64-1.5 1.45v10.1z"></path> <path stroke="#262626" d="M204 62.55c0 .8.66 1.45 1.5 1.45s1.5-.64 1.5-1.45v-10.1c0-.8-.66-1.45-1.5-1.45s-1.5.64-1.5 1.45v10.1z"></path> <path fill="#CC9E70" d="M199.16 45.16c-.33.6-.13 1.33.4 1.67.58.35 1.27.13 1.6-.43l4.68-8.56c.33-.6.13-1.33-.4-1.67-.58-.35-1.27-.13-1.6.43l-4.68 8.56z"></path> <path stroke="#262626" d="M199.16 45.16c-.33.6-.13 1.33.4 1.67.58.35 1.27.13 1.6-.43l4.68-8.56c.33-.6.13-1.33-.4-1.67-.58-.35-1.27-.13-1.6.43l-4.68 8.56z"></path> <path fill="#23B2A7" d="M203.04 38.3c0-2.36 2.25-3.02 4.98-1.44 2.73 1.58 4.98 4.83 4.98 7.2v11.5L210.5 57l-7.5-4.3V38.3h.04z"></path> <path stroke="#262626" d="M203.04 38.3c0-2.36 2.25-3.02 4.98-1.44 2.73 1.58 4.98 4.83 4.98 7.2v11.5L210.5 57l-7.5-4.3V38.3h.04z"></path> <path fill="#CC9E70" d="M211.42 46.54l-3.8 2.14c-.62.35-.8 1.1-.44 1.7.36.62 1.12.8 1.74.44l5.08-2.88v-5.72c0-.7-.58-1.22-1.25-1.22-.7 0-1.25.57-1.25 1.22v4.32h-.08z"></path> <path stroke="#262626" d="M211.42 46.54l-3.8 2.14c-.62.35-.8 1.1-.44 1.7.36.62 1.12.8 1.74.44l5.08-2.88v-5.72c0-.7-.58-1.22-1.25-1.22-.7 0-1.25.57-1.25 1.22v4.32h-.08z"></path> <path fill="#CC9E70" d="M208 31c2.2 0 4 1.8 4 4s-1.8 4-4 4-4-1.8-4-4 1.8-4 4-4"></path> <path stroke="#262626" d="M208 31c2.2 0 4 1.8 4 4s-1.8 4-4 4-4-1.8-4-4 1.8-4 4-4z"></path> <path fill="#262626" d="M205.03 35.33c.1-.26.38-.4.64-.3.26.1.4.38.3.64-.1.26-.38.4-.64.3-.26-.1-.4-.38-.3-.64"></path> <path fill="#262626" d="M208.03 36.33c.1-.26.38-.4.64-.3.26.1.4.38.3.64-.1.26-.38.4-.64.3-.26-.1-.4-.38-.3-.64"></path> <path fill="#71603F" d="M209 39c.83-.76 1.33-1.8 1.33-3.03 0-.25-.04-.5-.08-.72h-.17c-1.66 0-3.08-1-3.66-2.44-1.3.68-2.17 2-2.2 3.55-.14-.42-.22-.84-.22-1.3 0-2.24 1.8-4.05 4-4.05s4 1.8 4 4.04c.04 1.94-1.25 3.54-3 3.96"></path> <path stroke="#262626" d="M209 39c.83-.76 1.33-1.8 1.33-3.03 0-.25-.04-.5-.08-.72h-.17c-1.66 0-3.08-1-3.66-2.44-1.3.68-2.17 2-2.2 3.55-.14-.42-.22-.84-.22-1.3 0-2.24 1.8-4.05 4-4.05s4 1.8 4 4.04c.04 1.94-1.25 3.54-3 3.96z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M206.17 71L217 65l-7.22-4L199 67z"></path> <path stroke="#262626" d="M206.17 71L217 65l-7.22-4L199 67z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M206.17 70L217 64.03 209.78 60 199 66.02z"></path> <path stroke="#262626" d="M206.17 70L217 64.03 209.78 60 199 66.02z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M206.17 69L217 62.98 209.78 59 199 64.97z"></path> <path stroke="#262626" d="M206.17 69L217 62.98 209.78 59 199 64.97z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M206.17 68L217 62l-7.22-4L199 64z"></path> <path stroke="#262626" d="M206.17 68L217 62l-7.22-4L199 64z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M206.17 67L217 60.98 209.78 57 199 63.02z"></path> <path stroke="#262626" d="M206.17 67L217 60.98 209.78 57 199 63.02z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M181.58 63L157 48.73 175.42 38 200 52.27z"></path> <path stroke="#262626" d="M181.58 63L157 48.73 175.42 38 200 52.27z" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#262626" d="M186 49l-12-7" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#262626" d="M184 50l-12-7" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#262626" d="M182 51l-12-7" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#262626" d="M180 52l-12-7" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#262626" d="M177 54l-12-7" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#262626" d="M175 55l-12-7" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#262626" d="M180 56.63l2.22 1.26c.76.43 2.05.34 2.9-.14l3.75-2.1c.7-.38-.18-.9-.94-.5l-3.4 1.9-.2-.12 9.3-5.27c1-.57-.26-1.22-1.2-.7l-5.4 3.05-.2-.1 5.38-3.04c.95-.52-.25-1.22-1.23-.7l-9.33 5.27-.22-.13 3.4-1.9c.7-.4-.2-.93-.9-.54l-3.7 2.1c-.8.43-1.03 1.2-.23 1.65m.84.78c-.58-.33-1.6-.3-2.28.1-.67.4-.76.96-.18 1.26.6.35 1.6.3 2.28-.08.67-.35.76-.96.18-1.27"></path></g></g> <g class="gs-diamonds__step"><path fill="#A6BB05" d="M89.77 246.5L34.34 191.1c-3.12-3.12-3.12-8.2 0-11.3l55.43-55.44c3.12-3.12 8.2-3.12 11.3 0l55.44 55.43c3.14 3.12 3.14 8.2 0 11.3l-55.42 55.44c-3.12 3.14-8.2 3.14-11.3 0z"></path> <g transform="translate(80 174)"><text class="gs-diamonds__step-number"><tspan x="7" y="43">2</tspan></text> <text class="gs-diamonds__step-title"><tspan x="0" y="16">MAP</tspan></text></g> <g class="gs-diamonds__step-icon"><path fill="#806346" d="M77.8 137.95c0 .8-.64 1.45-1.45 1.45-.8 0-1.46-.64-1.46-1.45v-10.1c0-.8.64-1.44 1.45-1.44.8 0 1.45.65 1.45 1.46v10.1z"></path> <path stroke="#262626" stroke-width="1.6" d="M77.8 137.95c0 .8-.64 1.45-1.45 1.45-.8 0-1.46-.64-1.46-1.45v-10.1c0-.8.64-1.44 1.45-1.44.8 0 1.45.65 1.45 1.46v10.1z"></path> <path fill="#806346" d="M82.03 135.5c0 .82-.64 1.47-1.45 1.47-.8 0-1.45-.65-1.45-1.46v-10.07c0-.82.64-1.46 1.45-1.46.8 0 1.45.64 1.45 1.46v10.08z"></path> <path stroke="#262626" stroke-width="1.6" d="M82.03 135.5c0 .82-.64 1.47-1.45 1.47-.8 0-1.45-.65-1.45-1.46v-10.07c0-.82.64-1.46 1.45-1.46.8 0 1.45.64 1.45 1.46v10.08z"></path> <path fill="#806346" d="M85.54 111.84l3.63-2.1c.6-.34 1.32-.13 1.67.43.34.6.12 1.32-.43 1.67l-4.86 2.82-4.83-2.82c-.6-.35-.76-1.07-.42-1.67.34-.6 1.07-.77 1.67-.43l3.6 2.1z"></path> <path stroke="#262626" stroke-width="1.6" d="M85.54 111.84l3.63-2.1c.6-.34 1.32-.13 1.67.43.34.6.12 1.32-.43 1.67l-4.86 2.82-4.83-2.82c-.6-.35-.76-1.07-.42-1.67.34-.6 1.07-.77 1.67-.43l3.6 2.1z"></path> <path fill="#BDC733" d="M83.23 110.72c0-2.3-2.18-2.95-4.83-1.4-2.65 1.53-4.83 4.7-4.83 7v11.2l2.44 1.4 7.27-4.18v-14.02h-.04z"></path> <path stroke="#262626" d="M83.23 110.72c0-2.3-2.18-2.95-4.83-1.4-2.65 1.53-4.83 4.7-4.83 7v11.2l2.44 1.4 7.27-4.18v-14.02h-.04z"></path> <path fill="#806346" d="M75.24 119.2l3.63 2.08c.6.34.77 1.07.43 1.67-.35.6-1.07.77-1.67.42l-4.83-2.82V115c0-.7.56-1.2 1.2-1.2.68 0 1.2.56 1.2 1.2v4.2h.04z"></path> <path stroke="#262626" d="M75.24 119.2l3.63 2.08c.6.34.77 1.07.43 1.67-.35.6-1.07.77-1.67.42l-4.83-2.82V115c0-.7.56-1.2 1.2-1.2.68 0 1.2.56 1.2 1.2v4.2h.04z"></path> <path fill="#806346" d="M78.4 103.84c2.26 0 4.1 1.84 4.1 4.1 0 2.27-1.84 4.1-4.1 4.1-2.27 0-4.1-1.83-4.1-4.1 0-2.26 1.83-4.1 4.1-4.1"></path> <path stroke="#262626" d="M78.4 103.84c2.26 0 4.1 1.84 4.1 4.1 0 2.27-1.84 4.1-4.1 4.1-2.27 0-4.1-1.83-4.1-4.1 0-2.26 1.83-4.1 4.1-4.1z"></path> <path fill="#262626" d="M80.3 107.9c.23-.14.52-.06.65.16.13.23.05.52-.17.65-.23.14-.5.06-.64-.17-.13-.22-.06-.5.17-.64"></path> <path fill="#262626" d="M77.82 109.32c.23-.13.52-.05.65.17.13.22.05.5-.18.63-.23.13-.52.06-.65-.17-.13-.22-.05-.5.17-.64"></path> <path fill="#262626" d="M77.37 111.92c-.85-.77-1.37-1.84-1.37-3.08 0-.25.05-.5.1-.72h.16c1.7 0 3.16-1.03 3.76-2.48 1.33.68 2.23 2 2.27 3.6.12-.44.2-.87.2-1.34 0-2.26-1.84-4.1-4.1-4.1-2.27 0-4.1 1.84-4.1 4.1-.05 1.97 1.28 3.6 3.07 4.02"></path> <path stroke="#262626" d="M77.37 111.92c-.85-.77-1.37-1.84-1.37-3.08 0-.25.05-.5.1-.72h.16c1.7 0 3.16-1.03 3.76-2.48 1.33.68 2.23 2 2.27 3.6.12-.44.2-.87.2-1.34 0-2.26-1.84-4.1-4.1-4.1-2.27 0-4.1 1.84-4.1 4.1-.05 1.97 1.28 3.6 3.07 4.02z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M91 143.38l24.24-14.02-18.16-10.47-24.24 13.96z"></path> <path stroke="#262626" d="M91 143.38l24.24-14.02-18.16-10.47-24.24 13.96z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#DAD933" d="M95.28 136.15l1.45-10.04-5.47 1.08-4.27 8.6z"></path> <path fill="#DAD933" d="M102.76 131.84l-17.44.85 2.1-3.3 14.7-2.35z"></path> <path fill="#C1C42E" d="M96.73 126.1l-5.47 1.08-.85 1.75 6.08-.98z"></path> <path fill="#AFAF2F" d="M88.6 132.52l7.28-.34.6-4.23-6.07.98z"></path> <path fill="#C1C42E" d="M87.42 129.4l3-.47 5.6 3.25-10.7.5z"></path> <path fill="#919431" d="M90.4 128.93l-1.8 3.6 7.28-.35v-.1z"></path> <path fill="#515151" d="M108.57 150.8c0 .83-.64 1.47-1.45 1.47-.8 0-1.45-.64-1.45-1.46v-10.07c0-.82.64-1.46 1.45-1.46.8 0 1.45.64 1.45 1.46v10.08z"></path> <path stroke="#262626" d="M108.57 150.8c0 .83-.64 1.47-1.45 1.47-.8 0-1.45-.64-1.45-1.46v-10.07c0-.82.64-1.46 1.45-1.46.8 0 1.45.64 1.45 1.46v10.08z"></path> <path fill="#515151" d="M104.34 153.25c0 .8-.64 1.45-1.45 1.45-.82 0-1.46-.64-1.46-1.45v-10.1c0-.8.64-1.44 1.45-1.44.8 0 1.44.65 1.44 1.46v10.1z"></path> <path stroke="#262626" d="M104.34 153.25c0 .8-.64 1.45-1.45 1.45-.82 0-1.46-.64-1.46-1.45v-10.1c0-.8.64-1.44 1.45-1.44.8 0 1.44.65 1.44 1.46v10.1z"></path> <path fill="#FFCBA6" d="M103.36 133.5c-.34.6-.13 1.33.43 1.67.58.34 1.3.13 1.65-.43l4.92-8.5c.34-.6.13-1.33-.43-1.67-.6-.34-1.32-.13-1.67.43l-4.9 8.5z"></path> <path stroke="#262626" stroke-width="1.6" d="M103.36 133.5c-.34.6-.13 1.33.43 1.67.58.34 1.3.13 1.65-.43l4.92-8.5c.34-.6.13-1.33-.43-1.67-.6-.34-1.32-.13-1.67.43l-4.9 8.5z"></path> <path fill="#6C75E1" d="M109.8 126.02c0-2.3-2.17-2.94-4.82-1.4-2.65 1.53-4.83 4.7-4.83 7v11.2l2.44 1.4 7.25-4.18v-14.02h-.04z"></path> <path stroke="#262626" d="M109.8 126.02c0-2.3-2.17-2.94-4.82-1.4-2.65 1.53-4.83 4.7-4.83 7v11.2l2.44 1.4 7.25-4.18v-14.02h-.04z"></path> <path fill="#FFCBA6" d="M105.1 119.3c2.28 0 4.1 1.85 4.1 4.12 0 2.26-1.82 4.1-4.1 4.1-2.25 0-4.1-1.84-4.1-4.1 0-2.27 1.85-4.1 4.1-4.1"></path> <path stroke="#262626" d="M105.1 119.3c2.28 0 4.1 1.85 4.1 4.12 0 2.26-1.82 4.1-4.1 4.1-2.25 0-4.1-1.84-4.1-4.1 0-2.27 1.85-4.1 4.1-4.1z"></path> <path fill="#98760F" d="M105.45 119.3c.1 0 .17 0 .26.06 1.97.3 3.5 2 3.5 4.06 0 2.05-1.48 3.76-3.5 4.06-1.96-.3-3.5-2-3.5-4.06 0-.47.1-.94.22-1.37-.4.04-.8 0-1.24-.1l.13-.24v-.03l.14-.26v-.03c.04-.1.08-.18.12-.22v-.04c.05-.08.1-.16.18-.2 0 0 0-.05.04-.05.04-.08.13-.13.17-.2.04-.1.13-.14.2-.22l.05-.05c.13-.13.3-.25.43-.34l.05-.04c.08-.04.17-.1.2-.17l.22-.13s.05 0 .05-.04l.25-.13h.04c.1-.04.18-.04.22-.1h.04c.1-.03.17-.03.26-.07h.04c.1 0 .17-.05.26-.05h.04c.1 0 .17-.03.3-.03H105.28l.17.04"></path> <path stroke="#262626" d="M105.45 119.3c.1 0 .17 0 .26.06 1.97.3 3.5 2 3.5 4.06 0 2.05-1.48 3.76-3.5 4.06-1.96-.3-3.5-2-3.5-4.06 0-.47.1-.94.22-1.37-.4.04-.8 0-1.24-.1l.13-.24v-.03l.14-.26v-.03c.04-.1.08-.18.12-.22v-.04c.05-.08.1-.16.18-.2 0 0 0-.05.04-.05.04-.08.13-.13.17-.2.04-.1.13-.14.2-.22l.05-.05c.13-.13.3-.25.43-.34l.05-.04c.08-.04.17-.1.2-.17l.22-.13s.05 0 .05-.04l.25-.13h.04c.1-.04.18-.04.22-.1h.04c.1-.03.17-.03.26-.07h.04c.1 0 .17-.05.26-.05h.04c.1 0 .17-.03.3-.03H105.28l.17.04z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFCBA6" d="M96.1 137.7c-.35.6-.13 1.32.42 1.66.6.34 1.33.13 1.67-.43l4.9-8.5c.34-.6.13-1.33-.42-1.67-.6-.34-1.33-.13-1.67.43l-4.9 8.5z"></path> <path stroke="#262626" d="M96.1 137.7c-.35.6-.13 1.32.42 1.66.6.34 1.33.13 1.67-.43l4.9-8.5c.34-.6.13-1.33-.42-1.67-.6-.34-1.33-.13-1.67.43l-4.9 8.5z"></path></g></g> <g class="gs-diamonds__step"><path fill="#A6BB05" d="M179.77 333.5l-55.43-55.42c-3.12-3.12-3.12-8.2 0-11.3l55.43-55.44c3.12-3.12 8.2-3.12 11.3 0l55.44 55.43c3.14 3.12 3.14 8.2 0 11.3l-55.42 55.44c-3.12 3.14-8.2 3.14-11.3 0z"></path> <g transform="translate(163 263)"><text class="gs-diamonds__step-number"><tspan x="13.75" y="43.28">3</tspan></text> <text class="gs-diamonds__step-title"><tspan x="0" y="16">BUILD</tspan></text></g> <g class="gs-diamonds__step-icon"><path fill="#F2F2F2" d="M193 205.7l-5.68 3.3-11.32-6.65 5.68-3.35z"></path> <path stroke="#262626" stroke-width="1.6" d="M193 205.7l-5.68 3.3-11.32-6.65 5.68-3.35z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#F2F2F2" d="M192 206l-11-6.9V197l11 6.85z"></path> <path stroke="#262626" d="M192 206l-11-6.9V197l11 6.85z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#F2F2F2" d="M193 205.93l-6 3.07v-1.9l6-3.1z"></path> <path stroke="#262626" d="M193 205.93l-6 3.07v-1.9l6-3.1z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#F2F2F2" d="M182 198.9l-6 3.1v-1.93l6-3.07z"></path> <path stroke="#262626" d="M182 198.9l-6 3.1v-1.93l6-3.07z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#F2F2F2" d="M187 210l-11-6.85V201l11 6.9z"></path> <path stroke="#262626" d="M187 210l-11-6.85V201l11 6.9z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#E5E5E5" d="M161 204.83V218l17-9.87V195z"></path> <path stroke="#262626" d="M161 204.83l17-9.83v13.13L161 218z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#6C75E1" d="M162 205.46V214l15-8.5V197z"></path> <path stroke="#262626" d="M162 205.46V214l15-8.5V197z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#E5E5E5" d="M177.36 211L166 217.67l5.64 3.33 11.36-6.67z"></path> <path stroke="#262626" d="M177.36 211L166 217.67l5.64 3.33 11.36-6.67z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFCBA6" d="M180.64 226.38v2.38c0 .76-.6 1.37-1.38 1.37-.77 0-1.38-.6-1.38-1.37V224c0-.76.6-1.37 1.38-1.37.25 0 .5.08.7.2l4.14 2.38c.66.38.9 1.22.5 1.87-.37.64-1.23.88-1.88.48l-2.77-1.57"></path> <path stroke="#262626" d="M180.64 226.38v2.38c0 .76-.6 1.37-1.38 1.37-.77 0-1.38-.6-1.38-1.37V224c0-.76.6-1.37 1.38-1.37.25 0 .5.08.7.2l4.14 2.38c.66.38.9 1.22.5 1.87-.37.64-1.23.88-1.88.48l-2.77-1.57" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#A2A2A2" d="M186.8 234.48c1.9 1.1 1.9 2.86 0 3.95-1.92 1.1-5.02 1.1-6.93 0-1.9-1.1-1.9-2.86 0-3.95 1.87-1.1 5-1.1 6.92 0"></path> <path stroke="#262626" d="M186.8 234.48c1.9 1.1 1.9 2.86 0 3.95-1.92 1.1-5.02 1.1-6.93 0-1.9-1.1-1.9-2.86 0-3.95 1.87-1.1 5-1.1 6.92 0z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#A2A2A2" d="M184.47 235.33c0 .64-.53 1.13-1.14 1.13-.65 0-1.14-.53-1.14-1.13V231c0-.63.52-1.1 1.13-1.1.65 0 1.14.5 1.14 1.1v4.33z"></path> <path stroke="#262626" d="M184.47 235.33c0 .64-.53 1.13-1.14 1.13-.65 0-1.14-.53-1.14-1.13V231c0-.63.52-1.1 1.13-1.1.65 0 1.14.5 1.14 1.1v4.33z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#515151" d="M183.33 235.17l-6.92-3.95v-2.66l6.93-3.95 6.92 3.96v2.66z"></path> <path stroke="#262626" d="M183.33 235.17l-6.92-3.95v-2.66l6.93-3.95 6.92 3.96v2.66z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFCBA6" d="M175.68 228.15l3 1.74c.66.35 1.52.15 1.88-.5.37-.64.17-1.5-.48-1.85l-4.16-2.38c-.2-.12-.44-.2-.7-.2-.76 0-1.37.6-1.37 1.37v7.98c0 .77.6 1.37 1.38 1.37.77 0 1.4-.6 1.4-1.38v-5.6"></path> <path stroke="#262626" d="M175.68 228.15l3 1.74c.66.35 1.52.15 1.88-.5.37-.64.17-1.5-.48-1.85l-4.16-2.38c-.2-.12-.44-.2-.7-.2-.76 0-1.37.6-1.37 1.37v7.98c0 .77.6 1.37 1.38 1.37.77 0 1.4-.6 1.4-1.38v-5.6" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFCBA6" d="M183.4 214.65l-3.45-1.97c-.57-.32-1.26-.12-1.58.4-.33.57-.13 1.25.4 1.57l4.6 2.66 4.64-2.65c.58-.32.74-1 .42-1.57-.33-.56-1.02-.72-1.6-.4l-3.4 1.97z"></path> <path stroke="#262626" d="M183.4 214.65l-3.45-1.97c-.57-.32-1.26-.12-1.58.4-.33.57-.13 1.25.4 1.57l4.6 2.66 4.64-2.65c.58-.32.74-1 .42-1.57-.33-.56-1.02-.72-1.6-.4l-3.4 1.97z"></path> <path fill="#23B2A7" d="M187.93 214.05c0-2.18-2.08-2.78-4.6-1.33-2.52 1.45-4.6 4.43-4.6 6.6v10.57l2.32 1.32 6.92-3.95v-13.22h-.04z"></path> <path stroke="#262626" d="M187.93 214.05c0-2.18-2.08-2.78-4.6-1.33-2.52 1.45-4.6 4.43-4.6 6.6v10.57l2.32 1.32 6.92-3.95v-13.22h-.04z"></path> <path fill="#515151" d="M190.25 228.56l-6.92 3.95-2.32-1.28v-10.56l6.93-3.95 2.32 1.3z"></path> <path stroke="#262626" d="M190.25 228.56l-6.92 3.95-2.32-1.28v-10.56l6.93-3.95 2.32 1.3z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFCBA6" d="M183.5 207.72c2.15 0 3.9 1.74 3.9 3.87s-1.75 3.86-3.9 3.86c-2.16 0-3.9-1.73-3.9-3.87s1.74-3.88 3.9-3.88"></path> <path stroke="#262626" d="M183.5 207.72c2.15 0 3.9 1.74 3.9 3.87s-1.75 3.86-3.9 3.86c-2.16 0-3.9-1.73-3.9-3.87s1.74-3.88 3.9-3.88z"></path> <path fill="#464646" d="M183.82 207.68c.08 0 .16 0 .24.04 1.88.3 3.34 1.9 3.34 3.83 0 1.94-1.42 3.55-3.34 3.83-1.87-.28-3.33-1.9-3.33-3.83 0-.44.08-.9.2-1.3-.37.05-.77 0-1.18-.07l.12-.24v-.04l.12-.24v-.04l.1-.2v-.04c.06-.1.1-.17.18-.2 0 0 0-.05.04-.05.04-.08.12-.12.16-.2.04-.08.12-.12.2-.2l.05-.04c.12-.13.28-.25.4-.33l.04-.04c.08-.04.17-.08.2-.16.1-.04.17-.08.2-.12 0 0 .05 0 .05-.04l.25-.12h.04c.1-.04.17-.04.2-.08h.05c.08-.04.16-.04.24-.08h.04c.08 0 .16-.04.24-.04h.04c.08 0 .16-.04.3-.04h.64c.1.04.1.04.15.04"></path> <path stroke="#262626" d="M183.82 207.68c.08 0 .16 0 .24.04 1.88.3 3.34 1.9 3.34 3.83 0 1.94-1.42 3.55-3.34 3.83-1.87-.28-3.33-1.9-3.33-3.83 0-.44.08-.9.2-1.3-.37.05-.77 0-1.18-.07l.12-.24v-.04l.12-.24v-.04l.1-.2v-.04c.06-.1.1-.17.18-.2 0 0 0-.05.04-.05.04-.08.12-.12.16-.2.04-.08.12-.12.2-.2l.05-.04c.12-.13.28-.25.4-.33l.04-.04c.08-.04.17-.08.2-.16.1-.04.17-.08.2-.12 0 0 .05 0 .05-.04l.25-.12h.04c.1-.04.17-.04.2-.08h.05c.08-.04.16-.04.24-.08h.04c.08 0 .16-.04.24-.04h.04c.08 0 .16-.04.3-.04h.64c.1.04.1.04.15.04z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFCBA6" d="M176.5 218.6l-3.47-1.97c-.57-.32-1.26-.12-1.58.4-.33.57-.13 1.25.4 1.57l4.64 2.66 4.6-2.66c.56-.32.73-1 .4-1.57-.33-.56-1.02-.72-1.6-.4l-3.4 1.97z"></path> <path stroke="#262626" d="M176.5 218.6l-3.47-1.97c-.57-.32-1.26-.12-1.58.4-.33.57-.13 1.25.4 1.57l4.64 2.66 4.6-2.66c.56-.32.73-1 .4-1.57-.33-.56-1.02-.72-1.6-.4l-3.4 1.97z"></path></g></g> <g class="gs-diamonds__step"><path fill="#A6BB05" d="M265.77 248.5l-55.43-55.42c-3.12-3.12-3.12-8.2 0-11.3l55.43-55.44c3.12-3.12 8.2-3.12 11.3 0l55.44 55.43c3.14 3.12 3.14 8.2 0 11.3l-55.42 55.44c-3.12 3.14-8.2 3.14-11.3 0z"></path> <g transform="translate(240 174)"><text class="gs-diamonds__step-number"><tspan x="23.35" y="45">4</tspan></text> <text class="gs-diamonds__step-title"><tspan x="0" y="16">PUBLISH</tspan></text></g> <g class="gs-diamonds__step-icon"><path fill="#A2A2A2" d="M271.24 134.02c2.35 1.37 2.35 3.6 0 4.96-2.34 1.36-6.14 1.36-8.48 0-2.35-1.37-2.35-3.6 0-4.96 2.34-1.36 6.14-1.36 8.48 0"></path> <path stroke="#262626" d="M271.24 134.02c2.35 1.37 2.35 3.6 0 4.96-2.34 1.36-6.14 1.36-8.48 0-2.35-1.37-2.35-3.6 0-4.96 2.34-1.36 6.14-1.36 8.48 0z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#A2A2A2" d="M268 134.63c0 .78-.7 1.37-1.5 1.37-.86 0-1.5-.64-1.5-1.37v-5.26c0-.78.7-1.37 1.5-1.37.86 0 1.5.64 1.5 1.37v5.26z"></path> <path stroke="#262626" stroke-width="1.6" d="M268 134.63c0 .78-.7 1.37-1.5 1.37-.86 0-1.5-.64-1.5-1.37v-5.26c0-.78.7-1.37 1.5-1.37.86 0 1.5.64 1.5 1.37v5.26z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#515151" d="M266.5 135l-8.5-4.88v-3.24l8.5-4.88 8.5 4.88v3.24z"></path> <path stroke="#262626" d="M266.5 135l-8.5-4.88v-3.24l8.5-4.88 8.5 4.88v3.24z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#515151" d="M269 123.25l-8.3 4.75-2.7-1.55v-12.7l8.24-4.75 2.7 1.55z"></path> <path stroke="#262626" d="M269 123.25l-8.3 4.75-2.7-1.55v-12.7l8.24-4.75 2.7 1.55z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFCBA6" d="M271 141.32c0 .94-.7 1.68-1.6 1.68-.9 0-1.6-.74-1.6-1.68v-8.8l-4-2.4c-.76-.46-1.04-1.5-.57-2.3.42-.78 1.4-1.07 2.17-.58l4.8 2.92c.47.3.8.84.8 1.43v9.72z"></path> <path stroke="#262626" d="M271 141.32c0 .94-.7 1.68-1.6 1.68-.9 0-1.6-.74-1.6-1.68v-8.8l-4-2.4c-.76-.46-1.04-1.5-.57-2.3.42-.78 1.4-1.07 2.17-.58l4.8 2.92c.47.3.8.84.8 1.43v9.72z"></path> <path fill="#FFCBA6" d="M276 138.32c0 .94-.7 1.68-1.6 1.68-.9 0-1.6-.74-1.6-1.68v-8.8l-4-2.4c-.76-.46-1.04-1.5-.57-2.3.42-.78 1.4-1.07 2.17-.58l4.8 2.92c.47.3.8.84.8 1.43v9.72z"></path> <path stroke="#262626" d="M276 138.32c0 .94-.7 1.68-1.6 1.68-.9 0-1.6-.74-1.6-1.68v-8.8l-4-2.4c-.76-.46-1.04-1.5-.57-2.3.42-.78 1.4-1.07 2.17-.58l4.8 2.92c.47.3.8.84.8 1.43v9.72z"></path> <path fill="#FFCBA6" d="M273.98 110.67l4-2.46c.66-.4 1.46-.14 1.84.5.38.72.14 1.57-.47 1.97l-5.37 3.33-5.32-3.33c-.66-.4-.84-1.25-.47-1.96.37-.7 1.17-.9 1.83-.5l3.95 2.47z"></path> <path stroke="#262626" d="M273.98 110.67l4-2.46c.66-.4 1.46-.14 1.84.5.38.72.14 1.57-.47 1.97l-5.37 3.33-5.32-3.33c-.66-.4-.84-1.25-.47-1.96.37-.7 1.17-.9 1.83-.5l3.95 2.47z"></path> <path fill="#23B2A7" d="M271.95 108.64c0-2.7-2.47-3.46-5.47-1.66-3 1.8-5.48 5.52-5.48 8.23v13.14l2.76 1.66 8.24-4.9v-16.46h-.05z"></path> <path stroke="#262626" d="M271.95 108.64c0-2.7-2.47-3.46-5.47-1.66-3 1.8-5.48 5.52-5.48 8.23v13.14l2.76 1.66 8.24-4.9v-16.46h-.05z"></path> <path fill="#FFCBA6" d="M266.5 101c2.48 0 4.5 2 4.5 4.5s-2.02 4.5-4.5 4.5c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5"></path> <path stroke="#262626" d="M266.5 101c2.48 0 4.5 2 4.5 4.5s-2.02 4.5-4.5 4.5c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5z"></path> <path stroke="#262626" stroke-width=".8" d="M268.5 105.13c.48-.27 1.1-.1 1.37.37.27.48.1 1.1-.37 1.37-.48.27-1.1.1-1.37-.37-.27-.48-.1-1.1.37-1.37z"></path> <path stroke="#262626" stroke-width=".8" d="M267.16 107c-.32-.3-.13-.75.38-.9.5-.2 1.2-.08 1.46.23"></path> <path stroke="#262626" stroke-width=".8" d="M265.5 107.13c.48-.27 1.1-.1 1.37.37.27.48.1 1.1-.37 1.37-.48.27-1.1.1-1.37-.37-.27-.48-.1-1.1.37-1.37z"></path> <path fill="#98760F" d="M271 104.27c-.68-1.92-2.37-3.27-4.36-3.27-2.56 0-4.64 2.23-4.64 5 0 .3.05.56.05.82.87.26 1.9.26 2.8-.15 1.36-.52 2.38-1.67 2.8-3.07.98.73 2.2.93 3.35.67"></path> <path stroke="#262626" d="M271 104.27c-.68-1.92-2.37-3.27-4.36-3.27-2.56 0-4.64 2.23-4.64 5 0 .3.05.56.05.82.87.26 1.9.26 2.8-.15 1.36-.52 2.38-1.67 2.8-3.07.98.73 2.2.93 3.35.67z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFCBA6" d="M267.82 125.82c.37.7.14 1.58-.47 1.98-.65.4-1.44.16-1.8-.5l-5.37-10.12c-.37-.7-.14-1.58.47-1.98.65-.4 1.44-.16 1.8.5l5.37 10.12z"></path> <path stroke="#262626" d="M267.82 125.82c.37.7.14 1.58-.47 1.98-.65.4-1.44.16-1.8-.5l-5.37-10.12c-.37-.7-.14-1.58.47-1.98.65-.4 1.44-.16 1.8.5l5.37 10.12z"></path> <path fill="#F2F2F2" d="M276.9 123l-10.9 6.52 9.16 5.48 10.84-6.52z"></path> <path stroke="#262626" d="M276.9 123l-10.9 6.52 9.16 5.48 10.84-6.52z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#515151" d="M285 129.33l-8.2 4.67-5.8-3.33 8.2-4.67z"></path> <path stroke="#262626" stroke-width="1.6" d="M285 129.33l-8.2 4.67-5.8-3.33 8.2-4.67z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#F2F2F2" d="M278.77 124.34L290 118l-2.82 10.66L276 135z"></path> <path stroke="#262626" d="M278.77 124.34L290 118l-2.82 10.66L276 135z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#D1D871" d="M271.26 88.17L269.53 87l.1 2.12-1.63 1.33 2.05.53.74 2.02 1.1-1.8 2.1-.1-1.32-1.66.58-2.07z"></path> <path stroke="#333" d="M271.26 88.17L269.53 87l.1 2.12-1.63 1.33 2.05.53.74 2.02 1.1-1.8 2.1-.1-1.32-1.66.58-2.07z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#D1D871" d="M266.3 90.22L264.5 89l.17 2.18L263 92.5l2.03.53.74 1.97 1.14-1.8 2.1-.06-1.36-1.64.58-2.08z"></path> <path stroke="#333" d="M266.3 90.22L264.5 89l.17 2.18L263 92.5l2.03.53.74 1.97 1.14-1.8 2.1-.06-1.36-1.64.58-2.08z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#D1D871" d="M261.3 93.17L259.5 92l.17 2.12-1.67 1.33 2.04.53.73 2.02 1.14-1.8 2.1-.1-1.36-1.66.58-2.02z"></path> <path stroke="#333" d="M261.3 93.17L259.5 92l.17 2.12-1.67 1.33 2.04.53.73 2.02 1.14-1.8 2.1-.1-1.36-1.66.58-2.02z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#D1D871" d="M256.3 96.17L254.5 95l.17 2.12-1.67 1.33 2.04.53.73 2.02 1.14-1.8 2.1-.1-1.36-1.66.58-2.07z"></path> <path stroke="#333" d="M256.3 96.17L254.5 95l.17 2.12-1.67 1.33 2.04.53.73 2.02 1.14-1.8 2.1-.1-1.36-1.66.58-2.07z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#D1D871" d="M252.23 99.2L250.5 98l.12 2.16-1.62 1.3 2.03.54.74 2 1.1-1.84 2.13-.06-1.36-1.63.58-2.05z"></path> <path stroke="#333" d="M252.23 99.2L250.5 98l.12 2.16-1.62 1.3 2.03.54.74 2 1.1-1.84 2.13-.06-1.36-1.63.58-2.05z" stroke-linecap="round" stroke-linejoin="round"></path></g></g> <g class="gs-diamonds__step active"><path fill="url(#sidebar--red-gradient)" transform="translate(303 44)" d="M53.16 114.42L2.36 64.05c-3.13-3.1-3.15-8.18-.04-11.3l.05-.06L53.17 2.3c3.1-3.1 8.13-3.1 11.25 0l50.8 50.37c3.13 3.1 3.15 8.17.04 11.3l-.05.05-50.78 50.37c-3.12 3.1-8.15 3.1-11.26 0z"></path> <g transform="translate(344 91)"><text class="gs-diamonds__step-number"><tspan x="11.72" y="43.48">5</tspan></text> <text class="gs-diamonds__step-title"><tspan x="0" y="16">USE</tspan></text></g> <g class="gs-diamonds__step-icon"><path fill="#515151" d="M366 62.88c0 .63.44 1.12 1 1.12s1-.5 1-1.12v-7.76c0-.63-.44-1.12-1-1.12s-1 .5-1 1.12v7.76z"></path> <path stroke="#262626" d="M366 62.88c0 .63.44 1.12 1 1.12s1-.5 1-1.12v-7.76c0-.63-.44-1.12-1-1.12s-1 .5-1 1.12v7.76z"></path> <path fill="#515151" d="M363 60.88c0 .63.44 1.12 1 1.12s1-.5 1-1.12v-7.76c0-.63-.44-1.12-1-1.12s-1 .5-1 1.12v7.76z"></path> <path stroke="#262626" d="M363 60.88c0 .63.44 1.12 1 1.12s1-.5 1-1.12v-7.76c0-.63-.44-1.12-1-1.12s-1 .5-1 1.12v7.76z"></path> <path fill="#FFCBA6" d="M359.5 41.78l-3-1.64c-.48-.27-1.08-.1-1.36.33-.3.47-.1 1.04.35 1.3l4 2.23 4-2.22c.5-.27.64-.84.36-1.3-.3-.48-.9-.6-1.38-.34l-2.97 1.64z"></path> <path stroke="#262626" d="M359.5 41.78l-3-1.64c-.48-.27-1.08-.1-1.36.33-.3.47-.1 1.04.35 1.3l4 2.23 4-2.22c.5-.27.64-.84.36-1.3-.3-.48-.9-.6-1.38-.34l-2.97 1.64z"></path> <path fill="#6C75E1" d="M354 41l1.5-3 1.5 1-1.5 3z"></path> <path stroke="#262626" d="M354 41l1.5-3 1.5 1-1.5 3z" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#262626" d="M357 37c-.3-.6-.86-1-1.5-1s-1.2.4-1.5 1" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#262626" d="M355 37.27c.1-.14.27-.27.45-.27s.36.1.45.27" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#262626" d="M357 36.76c-.2-.44-.6-.76-1-.76-.45 0-.83.32-1 .76" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FB6045" d="M362.04 40.76c0-1.8 1.8-2.3 3.98-1.1 2.18 1.2 3.98 3.67 3.98 5.48v8.76l-2 1.1-6-3.28V40.76h.04z"></path> <path stroke="#262626" d="M362.04 40.76c0-1.8 1.8-2.3 3.98-1.1 2.18 1.2 3.98 3.67 3.98 5.48v8.76l-2 1.1-6-3.28V40.76h.04z"></path> <path fill="#FFCBA6" d="M368 52.02c0 .56.46.98 1 .98.57 0 1-.46 1-.98v-8.04c0-.56-.46-.98-1-.98-.57 0-1 .46-1 .98v8.04z"></path> <path stroke="#262626" d="M368 52.02c0 .56.46.98 1 .98.57 0 1-.46 1-.98v-8.04c0-.56-.46-.98-1-.98-.57 0-1 .46-1 .98v8.04z"></path> <path fill="#FFCBA6" d="M365.5 36c1.93 0 3.5 1.57 3.5 3.5s-1.57 3.5-3.5 3.5-3.5-1.57-3.5-3.5 1.57-3.5 3.5-3.5"></path> <path stroke="#262626" stroke-width="1.6" d="M365.5 36c1.93 0 3.5 1.57 3.5 3.5s-1.57 3.5-3.5 3.5-3.5-1.57-3.5-3.5 1.57-3.5 3.5-3.5z"></path> <path stroke="#262626" stroke-width=".8" d="M363.03 39.33c.1-.26.38-.4.64-.3.26.1.4.38.3.64-.1.26-.38.4-.64.3-.26-.1-.4-.38-.3-.64z"></path> <path stroke="#262626" stroke-width=".8" d="M364.97 40c.1-.4-.03-.83-.3-.96-.28-.13-.58.05-.67.44"></path> <path stroke="#262626" stroke-width=".8" d="M365.03 40.33c.1-.26.38-.4.64-.3.26.1.4.38.3.64-.1.26-.38.4-.64.3-.26-.1-.4-.38-.3-.64z"></path> <path fill="#A2A2A2" d="M366.37 43c.73-.66 1.17-1.58 1.17-2.65 0-.22-.04-.44-.07-.63h-.15c-1.46 0-2.7-.88-3.2-2.14-1.14.6-1.9 1.74-1.94 3.1-.1-.37-.18-.74-.18-1.14 0-1.96 1.57-3.54 3.5-3.54s3.5 1.58 3.5 3.54c.04 1.65-1.1 3.05-2.63 3.46"></path> <path stroke="#262626" d="M366.37 43c.73-.66 1.17-1.58 1.17-2.65 0-.22-.04-.44-.07-.63h-.15c-1.46 0-2.7-.88-3.2-2.14-1.14.6-1.9 1.74-1.94 3.1-.1-.37-.18-.74-.18-1.14 0-1.96 1.57-3.54 3.5-3.54s3.5 1.58 3.5 3.54c.04 1.65-1.1 3.05-2.63 3.46z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#CC9E70" d="M348 68.88c0 .63.44 1.12 1 1.12s1-.5 1-1.12v-7.76c0-.63-.44-1.12-1-1.12s-1 .5-1 1.12v7.76z"></path> <path stroke="#262626" d="M348 68.88c0 .63.44 1.12 1 1.12s1-.5 1-1.12v-7.76c0-.63-.44-1.12-1-1.12s-1 .5-1 1.12v7.76z"></path> <path fill="#CC9E70" d="M352 70.88c0 .63.44 1.12 1 1.12s1-.5 1-1.12v-7.76c0-.63-.44-1.12-1-1.12s-1 .5-1 1.12v7.76z"></path> <path stroke="#262626" d="M352 70.88c0 .63.44 1.12 1 1.12s1-.5 1-1.12v-7.76c0-.63-.44-1.12-1-1.12s-1 .5-1 1.12v7.76z"></path> <path fill="#CC9E70" d="M347 57.02c0 .56.46.98 1 .98.57 0 1-.46 1-.98v-8.04c0-.56-.46-.98-1-.98-.57 0-1 .46-1 .98v8.04z"></path> <path stroke="#262626" stroke-width="1.6" d="M347 57.02c0 .56.46.98 1 .98.57 0 1-.46 1-.98v-8.04c0-.56-.46-.98-1-.98-.57 0-1 .46-1 .98v8.04z"></path> <path fill="#23B2A7" d="M347.04 49.76c0-1.8 1.8-2.3 3.98-1.1 2.18 1.2 3.98 3.67 3.98 5.48v8.76l-2 1.1-6-3.28V49.76h.04z"></path> <path stroke="#262626" d="M347.04 49.76c0-1.8 1.8-2.3 3.98-1.1 2.18 1.2 3.98 3.67 3.98 5.48v8.76l-2 1.1-6-3.28V49.76h.04z"></path> <path fill="#CC9E70" d="M351.5 44c1.93 0 3.5 1.57 3.5 3.5s-1.57 3.5-3.5 3.5-3.5-1.57-3.5-3.5 1.57-3.5 3.5-3.5"></path> <path stroke="#262626" d="M351.5 44c1.93 0 3.5 1.57 3.5 3.5s-1.57 3.5-3.5 3.5-3.5-1.57-3.5-3.5 1.57-3.5 3.5-3.5z"></path> <path fill="#92613C" d="M350.8 44.04c-.06 0-.12 0-.18.03-1.47.26-2.62 1.72-2.62 3.47 0 1.75 1.12 3.2 2.62 3.46 1.47-.25 2.6-1.7 2.6-3.46 0-.4-.05-.8-.15-1.17.3.04.6 0 .93-.07l-.1-.22v-.04l-.1-.22v-.03c-.02-.1-.05-.16-.1-.2v-.03c-.02-.07-.05-.15-.1-.18 0 0 0-.05-.05-.05-.03-.07-.1-.1-.12-.18-.04-.08-.1-.1-.16-.2l-.04-.02c-.1-.1-.22-.22-.32-.3l-.02-.03c-.06-.04-.13-.07-.16-.15l-.16-.1s-.03 0-.03-.04l-.2-.1h-.02c-.06-.05-.12-.05-.15-.08h-.03c-.07-.04-.13-.04-.2-.08h-.03c-.07 0-.13-.03-.2-.03h-.03c-.06 0-.13-.04-.22-.04h-.51l-.13.04"></path> <path stroke="#262626" d="M350.8 44.04c-.06 0-.12 0-.18.03-1.47.26-2.62 1.72-2.62 3.47 0 1.75 1.12 3.2 2.62 3.46 1.47-.25 2.6-1.7 2.6-3.46 0-.4-.05-.8-.15-1.17.3.04.6 0 .93-.07l-.1-.22v-.04l-.1-.22v-.03c-.02-.1-.05-.16-.1-.2v-.03c-.02-.07-.05-.15-.1-.18 0 0 0-.05-.05-.05-.03-.07-.1-.1-.12-.18-.04-.08-.1-.1-.16-.2l-.04-.02c-.1-.1-.22-.22-.32-.3l-.02-.03c-.06-.04-.13-.07-.16-.15l-.16-.1s-.03 0-.03-.04l-.2-.1h-.02c-.06-.05-.12-.05-.15-.08h-.03c-.07-.04-.13-.04-.2-.08h-.03c-.07 0-.13-.03-.2-.03h-.03c-.06 0-.13-.04-.22-.04h-.51l-.13.04z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFDC00" d="M354.8 45.7c.1-.3.17-.56.2-.86-.28-.1-.52-.18-.8-.22-.73-1-1.88-1.62-3.17-1.62-2.22 0-4.03 1.92-4.03 4.27 0 .56.1 1.07.28 1.55-.1.3-.18.55-.2.85.27.1.5.18.8.22.37.06.75.1 1.17.1 2.68.04 4.94-1.77 5.74-4.3"></path> <path stroke="#262626" d="M354.8 45.7c.1-.3.17-.56.2-.86-.28-.1-.52-.18-.8-.22-.73-1-1.88-1.62-3.17-1.62-2.22 0-4.03 1.92-4.03 4.27 0 .56.1 1.07.28 1.55-.1.3-.18.55-.2.85.27.1.5.18.8.22.37.06.75.1 1.17.1 2.68.04 4.94-1.77 5.74-4.3z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#CC9E70" d="M356.5 53.78l3-1.64c.5-.27 1.08-.1 1.36.33.3.47.1 1.04-.35 1.3l-4 2.23-4-2.22c-.5-.27-.64-.84-.36-1.3.28-.48.88-.6 1.38-.34l2.98 1.64z"></path> <path stroke="#262626" d="M356.5 53.78l3-1.64c.5-.27 1.08-.1 1.36.33.3.47.1 1.04-.35 1.3l-4 2.23-4-2.22c-.5-.27-.64-.84-.36-1.3.28-.48.88-.6 1.38-.34l2.98 1.64z"></path> <path fill="#FFF" d="M383 71.15L374.74 76 361 67.88l8.26-4.88z"></path> <path stroke="#333" d="M383 71.15L374.74 76 361 67.88l8.26-4.88z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M383 70.12L374.74 75 361 66.88l8.26-4.88z"></path> <path stroke="#333" d="M383 70.12L374.74 75 361 66.88l8.26-4.88z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M383 69.12L374.74 74 361 65.85l8.26-4.85z"></path> <path stroke="#333" d="M383 69.12L374.74 74 361 65.85l8.26-4.85z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M383 68.15L374.74 73 361 64.88l8.26-4.88z"></path> <path stroke="#333" d="M383 68.15L374.74 73 361 64.88l8.26-4.88z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FB6045" d="M371 62.98l-1.4.17-.27.85-3.33-2 1.67-1z"></path> <path stroke="#333" d="M371 62.98l-1.4.17-.27.85-3.33-2 1.67-1z" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" stroke-width="1.6" d="M375 71l5-3" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M374 71l5-3" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M373 70l5-3" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M372 70l5-3" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M371 69l5-3" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M370 69l5-3" stroke-linecap="round" stroke-linejoin="round"></path></g></g> <g class="gs-diamonds__step"><path fill="url(#sidebar--purple-gradient)" transform="translate(388 133)" d="M56.95 123.1L2.35 68.36c-3.13-3.12-3.13-8.18 0-11.3l54.6-54.72c3.12-3.13 8.18-3.13 11.3 0h.02l54.6 54.72c3.13 3.12 3.13 8.18 0 11.3l-54.6 54.72c-3.12 3.1-8.18 3.12-11.3 0h-.02z"></path> <g transform="translate(421 176)"><text class="gs-diamonds__step-number"><tspan x="23.19" y="42.39">6</tspan></text> <text class="gs-diamonds__step-title" style="font-size: 13px;"><tspan x="0" y="13">EVALUATE</tspan></text></g> <g class="gs-diamonds__step-icon"><path fill="#FFF" d="M433 140.16L458.72 155 478 143.84 452.28 129z"></path> <path stroke="#262626" d="M458.72 155L433 140.16 452.28 129 478 143.84z" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M456.65 148l-6.65-3.64 4.35-2.36 6.65 3.64z" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" stroke-width="1.6" d="M450 145v-7.5l4-2.5v7.56z" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M460 146v-7.33l-6-3.67v7.33z" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M462 139v7" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M462 147.74l-1-.74" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M462 139.8l-1-.8" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" stroke-width="1.6" d="M448.05 137l-.05 7" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" stroke-width="1.6" d="M448 144.74l-1-.74" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" stroke-width="1.6" d="M448 137.8l-1-.8" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" stroke-width="1.6" d="M452 136v.27" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" stroke-width="1.6" d="M452 137v5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1.1 2.19"></path> <path stroke="#333" stroke-width="1.6" d="M452 143v.27" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M452 143l6 4" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1 2"></path> <path stroke="#333" d="M467 143l3 2" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M468 142l3 2" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M470 141l3 2" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#806346" d="M439.62 161.26c0 .85.67 1.52 1.52 1.52s1.52-.67 1.52-1.52v-10.53c0-.85-.67-1.52-1.52-1.52s-1.52.68-1.52 1.53v10.53z"></path> <path stroke="#262626" d="M439.62 161.26c0 .85.67 1.52 1.52 1.52s1.52-.67 1.52-1.52v-10.53c0-.85-.67-1.52-1.52-1.52s-1.52.68-1.52 1.53v10.53z"></path> <path fill="#806346" d="M444.05 163.8c0 .85.67 1.52 1.52 1.52s1.52-.67 1.52-1.5v-10.55c0-.84-.68-1.5-1.53-1.5s-1.52.66-1.52 1.5v10.54z"></path> <path stroke="#262626" d="M444.05 163.8c0 .85.67 1.52 1.52 1.52s1.52-.67 1.52-1.5v-10.55c0-.84-.68-1.5-1.53-1.5s-1.52.66-1.52 1.5v10.54z"></path> <path fill="#806346" d="M443.3 136.05l3.8-2.2c.6-.35 1.38-.12 1.73.46.36.63.14 1.4-.44 1.75l-5.1 2.94-5.07-2.95c-.62-.36-.8-1.12-.44-1.74.35-.62 1.1-.8 1.73-.44l3.76 2.2z"></path> <path stroke="#262626" d="M443.3 136.05l3.8-2.2c.6-.35 1.38-.12 1.73.46.36.63.14 1.4-.44 1.75l-5.1 2.94-5.07-2.95c-.62-.36-.8-1.12-.44-1.74.35-.62 1.1-.8 1.73-.44l3.76 2.2z"></path> <path fill="#FB6045" d="M438.32 135.38c0-2.4 2.28-3.08 5.06-1.47 2.77 1.6 5.05 4.9 5.05 7.32v11.7l-2.55 1.47-7.6-4.38v-14.64h.04z"></path> <path stroke="#262626" d="M438.32 135.38c0-2.4 2.28-3.08 5.06-1.47 2.77 1.6 5.05 4.9 5.05 7.32v11.7l-2.55 1.47-7.6-4.38v-14.64h.04z"></path> <path fill="#806346" d="M443.42 128.2c2.37 0 4.3 1.9 4.3 4.28 0 2.36-1.93 4.28-4.3 4.28s-4.3-1.92-4.3-4.28c0-2.37 1.93-4.3 4.3-4.3"></path> <path stroke="#262626" d="M443.42 128.2c2.37 0 4.3 1.9 4.3 4.28 0 2.36-1.93 4.28-4.3 4.28s-4.3-1.92-4.3-4.28c0-2.37 1.93-4.3 4.3-4.3z"></path> <path fill="#262626" d="M443.06 128.2c-.08 0-.17 0-.26.04-2.06.3-3.67 2.1-3.67 4.24s1.56 3.93 3.67 4.24c2.05-.3 3.66-2.1 3.66-4.24 0-.5-.1-.98-.22-1.43.4.04.85 0 1.3-.1l-.14-.26v-.05c-.04-.1-.1-.18-.13-.27v-.04l-.14-.23v-.03c-.04-.1-.1-.18-.17-.23 0 0 0-.04-.05-.04-.03-.1-.12-.13-.17-.22-.04-.1-.13-.14-.22-.23l-.04-.04c-.13-.13-.3-.26-.44-.35l-.05-.04c-.1-.04-.18-.08-.22-.17l-.23-.14s-.04 0-.04-.05l-.27-.13h-.03c-.1-.05-.18-.05-.23-.1h-.04c-.1-.04-.18-.04-.27-.08h-.04c-.1 0-.2-.05-.28-.05h-.05c-.1 0-.18-.05-.3-.05h-.73c-.13.04-.18.04-.18.04"></path> <path stroke="#262626" d="M443.06 128.2c-.08 0-.17 0-.26.04-2.06.3-3.67 2.1-3.67 4.24s1.56 3.93 3.67 4.24c2.05-.3 3.66-2.1 3.66-4.24 0-.5-.1-.98-.22-1.43.4.04.85 0 1.3-.1l-.14-.26v-.05c-.04-.1-.1-.18-.13-.27v-.04l-.14-.23v-.03c-.04-.1-.1-.18-.17-.23 0 0 0-.04-.05-.04-.03-.1-.12-.13-.17-.22-.04-.1-.13-.14-.22-.23l-.04-.04c-.13-.13-.3-.26-.44-.35l-.05-.04c-.1-.04-.18-.08-.22-.17l-.23-.14s-.04 0-.04-.05l-.27-.13h-.03c-.1-.05-.18-.05-.23-.1h-.04c-.1-.04-.18-.04-.27-.08h-.04c-.1 0-.2-.05-.28-.05h-.05c-.1 0-.18-.05-.3-.05h-.73c-.13.04-.18.04-.18.04z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M445.95 139.8l6.33-10.94 6.35 3.66-6.33 10.94z"></path> <path stroke="#262626" d="M445.95 139.8l6.33-10.94 6.35 3.66-6.33 10.94z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#806346" d="M450.9 140.42l3.8-2.2c.62-.34 1.38-.12 1.74.46.35.63.13 1.38-.45 1.74l-5.06 2.95-5.1-2.95c-.63-.36-.8-1.1-.45-1.74.35-.62 1.1-.8 1.73-.45l3.76 2.2z"></path> <path stroke="#262626" d="M450.9 140.42l3.8-2.2c.62-.34 1.38-.12 1.74.46.35.63.13 1.38-.45 1.74l-5.06 2.95-5.1-2.95c-.63-.36-.8-1.1-.45-1.74.35-.62 1.1-.8 1.73-.45l3.76 2.2z"></path></g></g> <g class="gs-diamonds__step"><path fill="url(#sidebar--green-gradient)" transform="translate(299 217)" d="M57.84 124.38L2.62 69.16c-3.13-3.13-3.13-8.2 0-11.32L57.84 2.62c3.13-3.13 8.2-3.13 11.32 0l55.22 55.22c3.13 3.13 3.13 8.2 0 11.32l-55.22 55.22c-3.13 3.13-8.2 3.13-11.32 0z"></path> <g transform="translate(325 259)"><text class="gs-diamonds__step-number"><tspan x="31.56" y="57.76">7</tspan></text> <text class="gs-diamonds__step-title" style="font-size: 14px;"><tspan x="8.76" y="12.99">LEARN &amp;</tspan> <tspan x="14.56" y="26.99">SHARE</tspan></text></g> <g class="gs-diamonds__step-icon"><path fill="#806346" d="M442.1 321.7c0 .65-.53 1.18-1.2 1.18-.66 0-1.2-.53-1.2-1.2v-8.26c0-.67.54-1.2 1.2-1.2.67 0 1.2.53 1.2 1.2v8.27z"></path> <path stroke="#262626" d="M442.1 321.7c0 .65-.53 1.18-1.2 1.18-.66 0-1.2-.53-1.2-1.2v-8.26c0-.67.54-1.2 1.2-1.2.67 0 1.2.53 1.2 1.2v8.27z"></path> <path fill="#806346" d="M438.63 323.68c0 .67-.53 1.2-1.2 1.2-.66 0-1.2-.53-1.2-1.2v-8.27c0-.65.54-1.18 1.2-1.18.67 0 1.2.53 1.2 1.2v8.26z"></path> <path stroke="#262626" d="M438.63 323.68c0 .67-.53 1.2-1.2 1.2-.66 0-1.2-.53-1.2-1.2v-8.27c0-.65.54-1.18 1.2-1.18.67 0 1.2.53 1.2 1.2v8.26z"></path> <path fill="#806346" d="M443.64 301.36c-.18.53-.78.77-1.27.6-.52-.18-.77-.77-.6-1.26l2.74-7.57c.2-.53.78-.77 1.27-.6.53.18.77.77.6 1.26l-2.73 7.56z"></path> <path stroke="#262626" d="M443.64 301.36c-.18.53-.78.77-1.27.6-.52-.18-.77-.77-.6-1.26l2.74-7.57c.2-.53.78-.77 1.27-.6.53.18.77.77.6 1.26l-2.73 7.56z"></path> <path fill="#6C75E1" d="M443.1 301.36c0-1.9-1.78-2.42-3.95-1.15s-3.96 3.86-3.96 5.75v9.18l2 1.16 5.95-3.44v-11.5h-.04z"></path> <path stroke="#262626" d="M443.1 301.36c0-1.9-1.78-2.42-3.95-1.15s-3.96 3.86-3.96 5.75v9.18l2 1.16 5.95-3.44v-11.5h-.04z"></path> <path fill="#806346" d="M439.26 295.86c1.85 0 3.36 1.5 3.36 3.36 0 1.86-1.5 3.37-3.36 3.37-1.86 0-3.37-1.52-3.37-3.38 0-1.85 1.5-3.36 3.36-3.36"></path> <path stroke="#262626" stroke-width="1.6" d="M439.26 295.86c1.85 0 3.36 1.5 3.36 3.36 0 1.86-1.5 3.37-3.36 3.37-1.86 0-3.37-1.52-3.37-3.38 0-1.85 1.5-3.36 3.36-3.36z"></path> <path fill="#464646" d="M439.54 295.86c.07 0 .14 0 .2.04 1.62.24 2.88 1.64 2.88 3.32 0 1.7-1.23 3.1-2.87 3.33-1.62-.24-2.88-1.64-2.88-3.33 0-.38.07-.77.18-1.12-.32.04-.67 0-1.02-.07l.1-.2v-.04c.04-.08.08-.15.1-.22v-.04c.05-.07.08-.14.12-.17v-.04c.03-.07.07-.14.14-.17 0 0 0-.04.02-.04.04-.07.1-.1.14-.17.04-.07.1-.1.18-.18l.03-.03c.1-.1.25-.2.35-.28l.04-.04c.07-.03.14-.07.17-.14l.18-.1s.04 0 .04-.04l.2-.1h.05c.06-.04.13-.04.16-.07h.04c.07-.04.14-.04.2-.07h.05c.06 0 .13-.04.2-.04h.04c.06 0 .13-.03.24-.03H439.4c.1 0 .14 0 .14.03"></path> <path stroke="#262626" d="M439.54 295.86c.07 0 .14 0 .2.04 1.62.24 2.88 1.64 2.88 3.32 0 1.7-1.23 3.1-2.87 3.33-1.62-.24-2.88-1.64-2.88-3.33 0-.38.07-.77.18-1.12-.32.04-.67 0-1.02-.07l.1-.2v-.04c.04-.08.08-.15.1-.22v-.04c.05-.07.08-.14.12-.17v-.04c.03-.07.07-.14.14-.17 0 0 0-.04.02-.04.04-.07.1-.1.14-.17.04-.07.1-.1.18-.18l.03-.03c.1-.1.25-.2.35-.28l.04-.04c.07-.03.14-.07.17-.14l.18-.1s.04 0 .04-.04l.2-.1h.05c.06-.04.13-.04.16-.07h.04c.07-.04.14-.04.2-.07h.05c.06 0 .13-.04.2-.04h.04c.06 0 .13-.03.24-.03H439.4c.1 0 .14 0 .14.03z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#806346" d="M437.68 304.13c.17.53-.07 1.1-.6 1.26-.52.17-1.08-.08-1.26-.6l-2.73-7.57c-.2-.53.06-1.1.58-1.26.53-.18 1.1.07 1.27.6l2.73 7.56z"></path> <path stroke="#262626" d="M437.68 304.13c.17.53-.07 1.1-.6 1.26-.52.17-1.08-.08-1.26-.6l-2.73-7.57c-.2-.53.06-1.1.58-1.26.53-.18 1.1.07 1.27.6l2.73 7.56z"></path> <path fill="#FFCBA6" d="M427.2 318.8c0 .68-.52 1.2-1.2 1.2-.66 0-1.18-.52-1.18-1.2v-8.26c0-.66.52-1.2 1.2-1.2.66 0 1.18.54 1.18 1.2v8.27z"></path> <path stroke="#262626" d="M427.2 318.8c0 .68-.52 1.2-1.2 1.2-.66 0-1.18-.52-1.18-1.2v-8.26c0-.66.52-1.2 1.2-1.2.66 0 1.18.54 1.18 1.2v8.27z"></path> <path fill="#FFCBA6" d="M423.73 320.8c0 .68-.52 1.2-1.2 1.2-.65 0-1.18-.52-1.18-1.2v-8.26c0-.67.53-1.2 1.2-1.2.66 0 1.18.53 1.18 1.2v8.27z"></path> <path stroke="#262626" d="M423.73 320.8c0 .68-.52 1.2-1.2 1.2-.65 0-1.18-.52-1.18-1.2v-8.26c0-.67.53-1.2 1.2-1.2.66 0 1.18.53 1.18 1.2v8.27z"></path> <path fill="#FFCBA6" d="M428.74 298.5c-.17.5-.77.76-1.26.58-.52-.17-.77-.77-.6-1.26l2.74-7.57c.17-.52.77-.77 1.26-.6.53.18.77.78.6 1.27l-2.74 7.57z"></path> <path stroke="#262626" d="M428.74 298.5c-.17.5-.77.76-1.26.58-.52-.17-.77-.77-.6-1.26l2.74-7.57c.17-.52.77-.77 1.26-.6.53.18.77.78.6 1.27l-2.74 7.57z"></path> <path fill="#23B2A7" d="M428.18 298.5c0-1.9-1.78-2.43-3.96-1.17-2.17 1.26-3.96 3.86-3.96 5.75v9.18l2 1.16 5.96-3.44v-11.5h-.04z"></path> <path stroke="#262626" d="M428.18 298.5c0-1.9-1.78-2.43-3.96-1.17-2.17 1.26-3.96 3.86-3.96 5.75v9.18l2 1.16 5.96-3.44v-11.5h-.04z"></path> <path fill="#FFCBA6" d="M424.36 293c1.86 0 3.37 1.5 3.37 3.35 0 1.86-1.5 3.37-3.37 3.37-1.85 0-3.36-1.5-3.36-3.37 0-1.86 1.5-3.36 3.36-3.36"></path> <path stroke="#262626" stroke-width="1.6" d="M424.36 293c1.86 0 3.37 1.5 3.37 3.35 0 1.86-1.5 3.37-3.37 3.37-1.85 0-3.36-1.5-3.36-3.37 0-1.86 1.5-3.36 3.36-3.36z"></path> <path fill="#98760F" d="M424.64 293c.07 0 .14 0 .2.02 1.62.25 2.9 1.65 2.9 3.33 0 1.68-1.24 3.1-2.9 3.33-1.6-.24-2.86-1.65-2.86-3.33 0-.38.07-.77.18-1.12-.32.04-.67 0-1.02-.07l.1-.2v-.04l.1-.2v-.05l.1-.18v-.04c.05-.07.08-.14.15-.18 0 0 0-.03.03-.03.03-.07.1-.1.14-.18.03-.07.1-.1.18-.17l.03-.04c.1-.1.25-.2.35-.28l.04-.03c.07-.04.14-.07.17-.14.07-.03.14-.06.18-.1 0 0 .03 0 .03-.03l.2-.1h.05c.07-.04.14-.04.17-.08h.04c.08-.04.15-.04.22-.08h.03c.07 0 .14-.03.2-.03h.05c.07 0 .14-.05.24-.05H424.5c.1.04.14.04.14.04"></path> <path stroke="#262626" d="M424.64 293c.07 0 .14 0 .2.02 1.62.25 2.9 1.65 2.9 3.33 0 1.68-1.24 3.1-2.9 3.33-1.6-.24-2.86-1.65-2.86-3.33 0-.38.07-.77.18-1.12-.32.04-.67 0-1.02-.07l.1-.2v-.04l.1-.2v-.05l.1-.18v-.04c.05-.07.08-.14.15-.18 0 0 0-.03.03-.03.03-.07.1-.1.14-.18.03-.07.1-.1.18-.17l.03-.04c.1-.1.25-.2.35-.28l.04-.03c.07-.04.14-.07.17-.14.07-.03.14-.06.18-.1 0 0 .03 0 .03-.03l.2-.1h.05c.07-.04.14-.04.17-.08h.04c.08-.04.15-.04.22-.08h.03c.07 0 .14-.03.2-.03h.05c.07 0 .14-.05.24-.05H424.5c.1.04.14.04.14.04z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFCBA6" d="M422.8 301.26c.16.52-.08 1.08-.6 1.26-.54.17-1.1-.07-1.27-.6l-2.73-7.57c-.18-.52.07-1.08.6-1.26.52-.18 1.08.06 1.25.6l2.74 7.56z"></path> <path stroke="#262626" d="M422.8 301.26c.16.52-.08 1.08-.6 1.26-.54.17-1.1-.07-1.27-.6l-2.73-7.57c-.18-.52.07-1.08.6-1.26.52-.18 1.08.06 1.25.6l2.74 7.56z"></path> <path fill="#FFF" d="M412.3 294.2l-34.75 20.1v-22.96l34.76-20.04z"></path> <path stroke="#262626" d="M412.3 294.2l-34.75 20.1v-22.96l34.76-20.04z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#FFF" d="M382.56 308.5l4.6-11.4 5.28.13 4.98-8.76h4.94l4.97-11.36"></path> <path stroke="#262626" d="M382.56 308.5l4.6-11.4 5.28.13 4.98-8.76h4.94l4.97-11.36" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#515151" d="M385.08 290.5c.25.28.4.7.4 1.26 0 1.65-1.34 3.75-3 4.7-1.08.63-2.06.6-2.6 0l5.2-5.96z"></path> <path stroke="#333" d="M385.08 290.5c.25.28.4.7.4 1.26 0 1.65-1.34 3.75-3 4.7-1.08.63-2.06.6-2.6 0l5.2-5.96z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#8B8B8B" d="M385.08 290.5c-.52-.6-1.47-.67-2.6 0v2.98l2.6-2.98z"></path> <path stroke="#333" d="M385.08 290.5c-.52-.6-1.47-.67-2.6 0v2.98l2.6-2.98z" stroke-linecap="round" stroke-linejoin="round"></path> <path stroke="#333" d="M379.93 296.42c-.25-.28-.4-.7-.4-1.26 0-1.65 1.35-3.75 3-4.7v2.98l-2.6 2.98z" stroke-linecap="round" stroke-linejoin="round"></path> <path fill="#515151" d="M393.95 326.56c0 .66-.53 1.2-1.2 1.2-.66 0-1.2-.54-1.2-1.2v-8.27c0-.68.54-1.2 1.2-1.2.67 0 1.2.52 1.2 1.2v8.26z"></path> <path stroke="#262626" d="M393.95 326.56c0 .66-.53 1.2-1.2 1.2-.66 0-1.2-.54-1.2-1.2v-8.27c0-.68.54-1.2 1.2-1.2.67 0 1.2.52 1.2 1.2v8.26z"></path> <path fill="#515151" d="M397.42 324.56c0 .67-.53 1.2-1.2 1.2-.66 0-1.2-.53-1.2-1.2v-8.27c0-.68.54-1.2 1.2-1.2.67 0 1.2.52 1.2 1.2v8.26z"></path> <path stroke="#262626" d="M397.42 324.56c0 .67-.53 1.2-1.2 1.2-.66 0-1.2-.53-1.2-1.2v-8.27c0-.68.54-1.2 1.2-1.2.67 0 1.2.52 1.2 1.2v8.26z"></path> <path fill="#CC9E70" d="M400.3 305.15l2.97-1.72c.5-.28 1.08-.1 1.36.35.28.5.1 1.1-.35 1.37l-4 2.3-3.95-2.3c-.5-.28-.63-.88-.35-1.37.28-.5.87-.63 1.37-.35l2.94 1.72z"></path> <path stroke="#262626" d="M400.3 305.15l2.97-1.72c.5-.28 1.08-.1 1.36.35.28.5.1 1.1-.35 1.37l-4 2.3-3.95-2.3c-.5-.28-.63-.88-.35-1.37.28-.5.87-.63 1.37-.35l2.94 1.72z"></path> <path fill="#FB6045" d="M398.4 304.24c0-1.9-1.8-2.42-3.96-1.16-2.18 1.26-3.96 3.85-3.96 5.75V318l2 1.16 5.95-3.43v-11.5h-.03z"></path> <path stroke="#262626" d="M398.4 304.24c0-1.9-1.8-2.42-3.96-1.16-2.18 1.26-3.96 3.85-3.96 5.75V318l2 1.16 5.95-3.43v-11.5h-.03z"></path> <path fill="#CC9E70" d="M391.84 311.17l2.98 1.72c.5.27.63.87.35 1.36-.28.5-.87.63-1.36.35l-3.95-2.3v-4.6c0-.56.45-.98.98-.98.56 0 .98.46.98.98v3.47h.04z"></path> <path stroke="#262626" d="M391.84 311.17l2.98 1.72c.5.27.63.87.35 1.36-.28.5-.87.63-1.36.35l-3.95-2.3v-4.6c0-.56.45-.98.98-.98.56 0 .98.46.98.98v3.47h.04z"></path> <path fill="#CC9E70" d="M394.44 298.56c1.85 0 3.36 1.5 3.36 3.36 0 1.86-1.5 3.37-3.36 3.37-1.86 0-3.37-1.52-3.37-3.38 0-1.85 1.5-3.36 3.37-3.36"></path> <path stroke="#262626" d="M394.44 298.56c1.85 0 3.36 1.5 3.36 3.36 0 1.86-1.5 3.37-3.36 3.37-1.86 0-3.37-1.52-3.37-3.38 0-1.85 1.5-3.36 3.37-3.36z"></path> <path fill="#262626" d="M396 301.87c.18-.1.42-.04.52.14.1.2.05.43-.14.54-.18.1-.42.04-.53-.14-.1-.2-.04-.42.15-.53"></path> <path fill="#262626" d="M393.92 303.07c.18-.1.42-.04.52.14.1.2.05.43-.14.54-.18.1-.42.04-.53-.14-.1-.2-.04-.42.15-.53"></path> <path fill="#464646" d="M393.6 305.22c-.7-.63-1.13-1.5-1.13-2.53 0-.22.04-.43.07-.6h.14c1.4 0 2.6-.84 3.1-2.03 1.07.56 1.8 1.64 1.85 2.94.1-.34.17-.7.17-1.08 0-1.85-1.5-3.36-3.36-3.36-1.86 0-3.37 1.5-3.37 3.36-.03 1.6 1.05 2.9 2.53 3.3"></path> <path stroke="#262626" d="M393.6 305.22c-.7-.63-1.13-1.5-1.13-2.53 0-.22.04-.43.07-.6h.14c1.4 0 2.6-.84 3.1-2.03 1.07.56 1.8 1.64 1.85 2.94.1-.34.17-.7.17-1.08 0-1.85-1.5-3.36-3.36-3.36-1.86 0-3.37 1.5-3.37 3.36-.03 1.6 1.05 2.9 2.53 3.3z" stroke-linecap="round" stroke-linejoin="round"></path></g></g> <path fill="#FB6046" d="M322.18 135.32l-1.4 11.3-9.9-9.9z"></path> <path fill="#858585" d="M267.67 94.17l9.55 1.77-7.78 7.78z"></path> <path fill="#858585" d="M100.33 271.83l-9.55-1.77 7.78-7.78z"></path> <path fill="#858585" d="M92.67 109.83l1.77-9.55 7.78 7.78z"></path> <path fill="#858585" d="M278.33 265.17l-1.77 9.55-7.78-7.78z"></path> <path fill="#6C75E1" d="M365.35 193.66l-10.5 4.44 3.62-13.53z"></path> <path fill="#26C0B4" d="M323.18 240.68l-11.3-1.4 9.9-9.9z"></path></g></g></g></svg>

			</div>

		</section>

		<section class="homepage-map / band">

			<?php if ( have_rows('worldwide_map_markers') ) : ?>

				<div class="homepage-map__image">

					<div class="content">

						<?php while ( have_rows('worldwide_map_markers') ) : the_row(); ?>

							<div class="homepage-map__image-item" style="left: <?php the_sub_field('left'); ?>%; top: <?php the_sub_field('top'); ?>%;">
								<a href="<?php echo get_sub_field('link_new')['url']; ?>"><?php echo str_replace(' ', '&nbsp;', get_sub_field('title')); ?></a>
							</div>

						<?php endwhile; ?>

					</div>

				</div>

			<?php endif; ?>

			<?php if ( have_rows('worldwide_links') ) : ?>

				<div class="homepage-map__content">

					<h3><?php _e('Open Contracting Worldwide', 'ocp'); ?></h3>

					<div class="homepage-map__links">

						<?php while ( have_rows('worldwide_links') ) : the_row(); ?>

							<a class="homepage-map__link" href="<?php echo get_sub_field('link')['url']; ?>">
								<span><?php echo get_sub_field('link')['title']; ?></span>
							</a>

						<?php endwhile; ?>

					</div>

				</div>

			<?php endif; ?>

		</section>

	</div> <!-- / .wrapper -->

<?php get_footer(); ?>
