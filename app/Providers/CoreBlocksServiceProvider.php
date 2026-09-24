<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;
use WP_Post;

class CoreBlocksServiceProvider extends ServiceProvider
{
    /**
     * Blocks that should not be available in the editor.
     */
    private array $disabledBlocks = [
        'core/columns',
        'core/column',
    ];

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
        add_filter(
            'allowed_block_types_all',
            [$this, 'filterAllowedBlockTypes'],
            10,
            2
        );
    }

    /**
     * Allow all registered blocks except those explicitly disabled.
     *
     * @param array<string>|true $allowedBlockTypes
     * @return array<string>
     */
    public function filterAllowedBlockTypes(
        array|true $allowedBlockTypes,
        WP_Post $post
    ): array {
        $registeredBlocks = array_keys(
            \WP_Block_Type_Registry::get_instance()->get_all_registered()
        );

        return array_values(array_diff(
            $registeredBlocks,
            $this->disabledBlocks
        ));
    }
}
