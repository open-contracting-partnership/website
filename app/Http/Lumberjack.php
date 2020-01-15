<?php

namespace App\Http;

use Rareloop\Lumberjack\Http\Lumberjack as LumberjackCore;
use App\Menu\Menu;
use ImLiam\ShareableLink;

class Lumberjack extends LumberjackCore
{
	public function addToContext($context)
	{
		$context['is_home'] = is_home();
		$context['is_front_page'] = is_front_page();
		$context['is_logged_in'] = is_user_logged_in();

		// In Timber, you can use TimberMenu() to make a standard Wordpress menu available to the
		// Twig template as an object you can loop through. And once the menu becomes available to
		// the context, you can get items from it in a way that is a little smoother and more
		// versatile than Wordpress's wp_nav_menu. (You need never again rely on a
		// crazy "Walker Function!")

		$context['social_links'] = array(
			'twitter' => get_field('twitter_url', 'options') ?: NULL,
			'facebook' => get_field('facebook_url', 'options') ?: NULL,
			'linkedin' => get_field('linkedin_url', 'options') ?: NULL
		);

		$share_links = new ShareableLink(get_permalink(), trim(wp_title('', FALSE)));

		$context['share_links'] = array(
			'twitter' => $share_links->twitter,
			'facebook' => $share_links->facebook,
			'linkedin' => $share_links->linkedin
		);

		$context['header'] = [
			'primary_menu' => new \Timber\Menu('Header: Primary'),
			'secondary_menu' => new \Timber\Menu('Header: Secondary')
		];

		$context['footer'] = [
			'menu' => new \Timber\Menu('Footer')
		];

		$context['search_term'] = get_search_query();

		// fetch the menu
		$mega_menus = get_field('mega_menu', 'options');

		foreach ( $context['header']['primary_menu']->items as &$item ) {

			$item->mega_menu = false;

			if ( $mega_menus ) {

				$mega_menu = array_filter($mega_menus, function($menu) use ($item){
					return $menu['parent'] == $item->id;
				});

				if ( $mega_menu ) {
					$item->mega_menu = current($mega_menu);
				}

			}

		}

		return $context;
	}
}
