<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class GutenbergServiceProvider extends ServiceProvider
{
    /**
     * Register any app specific items into the container
     */
    public function register(): void
    {
    }

    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        // supports
        add_action('after_setup_theme', [$this, 'addSupports'], 5);

        // blocks
        add_action('init', [$this, 'registerBlockCategories'], 5);
        add_action('init', [$this, 'loadBlocks'], 5);
        add_filter('acf/settings/load_json', [$this, 'loadBlockFields']);
        add_filter('acf/json/save_paths', [$this, 'saveBlockFields'], 10, 2);

        // patterns
        add_action('init', [$this, 'disableCorePatterns'], 5);
        add_action('init', [$this, 'registerPatternCategories'], 5);
        add_action('init', [$this, 'loadPatterns'], 5);
    }

    public function addSupports(): void
    {
        // add_theme_support('align-wide');
    }

    public function disableCorePatterns(): void
    {
        remove_theme_support('core-block-patterns');
    }

    public function registerBlockCategories(): void
    {
        add_filter('block_categories_all', function ($categories, $post) {
            return array_merge($categories, [
                [
                    'slug' => 'app-blocks',
                    'title' => 'Website Blocks'
                ]
            ]);
        }, 10, 2);
    }

    public function registerPatternCategories(): void
    {
        register_block_pattern_category('app-patterns', [
            'label' => 'Website',
        ]);
    }

    public static function loadBlocks(): void
    {
        $blocks = glob(__DIR__ . '/../../blocks/**/block.json');
        $logoSvg = file_get_contents(get_template_directory() . '/resources/img/wp-block-icon.svg');

        foreach ($blocks as $blocksPath) {
            register_block_type($blocksPath, [
                'icon' => $logoSvg,
            ]);
        }
    }

    public static function loadBlockFields(array $paths): array
    {
        collect(glob(__DIR__ . '/../../blocks/*'))
            ->map(fn ($blockDirectoryPath) => realpath($blockDirectoryPath))
            ->each(function ($blockDirectoryPath) use (&$paths) {
                $paths[] = $blockDirectoryPath;
            });

        return $paths;
    }

    public static function saveBlockFields(array $paths, array $post): array
    {
        $blockFieldPaths = glob(__DIR__ . '/../../blocks/**/' . $post['key'] . '.json');

        if (! empty($blockFieldPaths)) {
            return [dirname($blockFieldPaths[0])];
        }

        return $paths;
    }

    public static function loadPatterns(): void
    {
        $patterns = glob(__DIR__ . '/../../block-patterns/*.json');

        foreach ($patterns as $patternsPath) {
            $patternProperties = json_decode(file_get_contents($patternsPath), true);

            register_block_pattern(
                'app/' . basename($patternsPath, '.json'),
                $patternProperties
            );
        }
    }
}
