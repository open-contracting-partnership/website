<?php

return [
	/**
	 * The current application environment
	 */
	'environment' => getenv('WP_ENV'),

	/**
	 * Is debug mode enabled?
	 */
	'debug' => WP_DEBUG ?? false,

	/**
	 * List of providers to initialise during app boot
	 */
	'providers' => [
		Rareloop\Lumberjack\Providers\RouterServiceProvider::class,
		Rareloop\Lumberjack\Providers\WordPressControllersServiceProvider::class,
		Rareloop\Lumberjack\Providers\TimberServiceProvider::class,
		Rareloop\Lumberjack\Providers\ImageSizesServiceProvider::class,
		Rareloop\Lumberjack\Providers\CustomPostTypesServiceProvider::class,
		Rareloop\Lumberjack\Providers\MenusServiceProvider::class,
		Rareloop\Lumberjack\Providers\LogServiceProvider::class,
		Rareloop\Lumberjack\Providers\ThemeSupportServiceProvider::class,
		Rareloop\Lumberjack\Providers\QueryBuilderServiceProvider::class,
		Rareloop\Lumberjack\Providers\SessionServiceProvider::class,
		Rareloop\Lumberjack\Providers\EncryptionServiceProvider::class,

		// Application Providers
		App\Providers\AppServiceProvider::class,
		App\Providers\AdminServiceProvider::class,
		App\Providers\ImgixServiceProvider::class,
		App\Providers\MailChimpServiceProvider::class,

		// Block Providers
		App\Providers\Blocks\ContentServiceProvider::class,
		App\Providers\Blocks\CoverServiceProvider::class,
		App\Providers\Blocks\DownloadCarouselServiceProvider::class,
		App\Providers\Blocks\FeaturedStoriesCarouselServiceProvider::class,
		App\Providers\Blocks\ImageWithLinksServiceProvider::class,
		App\Providers\Blocks\JumpToBarServiceProvider::class,
		App\Providers\Blocks\LogosServiceProvider::class,
		App\Providers\Blocks\MoreStoriesColumnsServiceProvider::class,
		App\Providers\Blocks\MoreStoriesServiceProvider::class,
		App\Providers\Blocks\OurModelServiceProvider::class,
		App\Providers\Blocks\PersonServiceProvider::class,
		App\Providers\Blocks\QuoteCarouselServiceProvider::class,
		App\Providers\Blocks\ResourceServiceProvider::class,
		App\Providers\Blocks\SignUpCoverServiceProvider::class,
		App\Providers\Blocks\StoriesServiceProvider::class,
		App\Providers\Blocks\TeamProfileServiceProvider::class,
		App\Providers\Blocks\TitleWithIconServiceProvider::class,

	],

	'aliases' => [
		'Config' => Rareloop\Lumberjack\Facades\Config::class,
		'Log' => Rareloop\Lumberjack\Facades\Log::class,
		'Router' => Rareloop\Lumberjack\Facades\Router::class,
		'Session' => Rareloop\Lumberjack\Facades\Session::class,
	],

	/**
	 * Logs enabled, path and level
	 *
	 * When path is `false` the default Apache/Nginx error logs are used. By setting path to a string, no logs will be sent
	 * to the default and instead a file will be created. To disable all logging output set `enabled` to `false`.
	 */
	'logs' => [
		'enabled' => true,
		'path' => false,
		'level' => Monolog\Logger::DEBUG,
	],

	'themeSupport' => [
		'post-thumbnails',
	],

	/**
	 * The key used by the Encrypter. This should be a random 32 character string.
	 */
	'key' => getenv('APP_KEY'),

	/**
	 * The key used by the Encrypter. This should be a random 32 character string.
	 */
	'mailchimp_api_key' => getenv('MAILCHIMP_API_KEY'),

];
