<?php

namespace App;

use Illuminate\Support\Collection;

class Assets
{
    private static ?Collection $manifest = null;

    private static function getManifest(): Collection
    {
        if (self::$manifest === null) {
            $path = get_template_directory() . '/dist/.vite/manifest.json';

            self::$manifest = collect(file_exists($path)
                ? json_decode(file_get_contents($path), true)
                : [])
                ->map(function ($item) {
                    return [
                        $item['file'] ?? null,
                        ...($item['css'] ?? []),
                    ];
                })
                ->flatten()
                ->sort()
                ->values();
        }

        return self::$manifest;
    }

    private static function getUrl(string $entry): ?string
    {
        $pattern = '#^' . str_replace('VITE', '(.{8})', $entry) . '$#';
        $manifest = self::getManifest();
        $file = $manifest->first(fn ($file) => preg_match($pattern, $file)) ?? null;

        return $file ? get_template_directory_uri() . '/dist/' . $file : null;
    }

    public static function getPath(string $entry): ?string
    {
        $pattern = '#^' . str_replace('VITE', '(.{8})', $entry) . '$#';
        $manifest = self::getManifest();
        $file = $manifest->first(fn ($file) => preg_match($pattern, $file)) ?? null;

        return $file ? 'dist/' . $file : null;
    }

    public static function registerScript(string $handle, string $path, bool $in_footer = false): void
    {
        $url = self::getUrl($path);

        if (! $url) {
            return;
        }

        wp_register_script_module($handle, $url, [], false, ['in_footer' => $in_footer]);
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
