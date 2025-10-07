<?php

namespace App\Http;

use App\Menu\Menu;
use ImLiam\ShareableLink;
use Rareloop\Lumberjack\Http\Lumberjack as LumberjackCore;

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

        $this->addSocialContext($context);
        $this->addFurnitureContext($context);
        $this->addLanguageContext($context);

        $context['search_term'] = get_search_query();

        // add terms url
        $context['site']->terms_url = get_permalink(1314);

        return $context;
    }

    public function addFurnitureContext(&$context)
    {

        $context['header'] = [
            'primary_menu' => new \Timber\Menu('Header: Primary'),
            'secondary_menu' => new \Timber\Menu('Header: Secondary'),
            'translations_menu' => new \Timber\Menu('Header: Translations'),
        ];

        $context['footer'] = [
            'menu' => new \Timber\Menu('Footer'),
            'i18n' => [
                'newsletter_header' => __('Get Our Newsletter', 'ocp'),
                'contact_header' => __('Contact', 'ocp'),
                'connect_header' => __('Connect with us:', 'ocp')
            ],
            'year' => date('Y')
        ];

        // fetch the menu
        $mega_menus = get_field('mega_menu', 'options');

        foreach ($context['header']['primary_menu']->items as &$item) {
            $item->mega_menu = false;

            if ($mega_menus) {
                $mega_menu = array_filter($mega_menus, function ($menu) use ($item) {
                    return $menu['parent'] == $item->id;
                });

                if ($mega_menu) {
                    $item->mega_menu = current($mega_menu);
                }
            }
        }
    }

    public function addSocialContext(&$context)
    {

        $context['social_links'] = array(
            'twitter' => get_field('twitter_url', 'options') ?: null,
            'facebook' => get_field('facebook_url', 'options') ?: null,
            'linkedin' => get_field('linkedin_url', 'options') ?: null,
            'github' => get_field('github_url', 'options') ?: null,
            'soundcloud' => get_field('soundcloud_url', 'options') ?: null,
            'youtube' => get_field('youtube_url', 'options') ?: null
        );

        $share_links = new ShareableLink(get_permalink(), trim(wp_title('', false)));

        $context['share']['links'] = array(
            'twitter' => $share_links->twitter,
            'facebook' => $share_links->facebook,
            'linkedin' => $share_links->linkedin
        );

        $context['share']['i18n']['heading'] = _x(
            'Share:',
            'The share widget heading',
            'ocp'
        );
    }

    public function addLanguageContext(&$context)
    {
        $currentLanguageCode = apply_filters('wpml_current_language', null);
        $currentLanguageName = apply_filters('wpml_translated_language_name', null, $currentLanguageCode);

        $context['i18n']['current_language_name'] = $currentLanguageName;
        $context['i18n']['alternate_languages'] = apply_filters('wpml_active_languages', []);
    }
}
