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

    private static function getUrl(string $entry): ?string
    {
        $manifest = self::getManifest();
        $file = $manifest[$entry]['file'] ?? null;
        return $file ? get_template_directory_uri() . '/dist/' . $file : null;
    }

    public static function getPath(string $entry): ?string
    {
        $manifest = self::getManifest();
        $file = $manifest[$entry]['file'] ?? null;
        return $file ? 'dist/' . $file : null;
    }

    public static function registerScript(string $handle, string $path, bool $in_footer = false): void
    {
        $url = self::getUrl($path);
        if (! $url) {
            return;
        }
        wp_register_script($handle, $url, [], false, $in_footer);
    }

    public static function registerStyle(string $handle, string $path): void
    {
        $url = self::getUrl($path);
        if (! $url) {
            return;
        }
        wp_register_style($handle, $url, [], false);
    }
}
