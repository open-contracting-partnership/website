<?php

namespace App;

class Assets
{
    private static ?array $manifest = null;

    private static function getManifest(): array
    {
        if (self::$manifest === null) {
            $path = get_template_directory() . '/dist/.vite/manifest.json';
            self::$manifest = file_exists($path)
                ? json_decode(file_get_contents($path), true)
                : [];
        }
        return self::$manifest;
    }

    private static function getAsset(string $entry): array
    {
        $manifest = self::getManifest();
        $file = $manifest[$entry]['file'] ?? null;
        if (! $file) {
            return [null, ''];
        }

        $url = get_template_directory_uri() . '/dist/' . $file;
        $path = get_template_directory() . '/dist/' . $file;
        $version = file_exists($path) ? substr(md5_file($path), 0, 8) : '';

        return [$url, $version];
    }

    public static function registerScript(string $handle, string $path, bool $in_footer = false): void
    {
        [$url, $version] = self::getAsset($path);
        if (! $url) {
            return;
        }

        wp_register_script(
            $handle,
            $url,
            [],
            $version,
            $in_footer
        );
    }

    public static function registerStyle(string $handle, string $path): void
    {
        [$url, $version] = self::getAsset($path);
        if (! $url) {
            return;
        }

        wp_register_style(
            $handle,
            $url,
            [],
            $version
        );
    }
}
