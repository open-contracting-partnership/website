<?php

namespace App\Providers\Blocks;

use Timber\Timber;

class CodeHighlightServiceProvider
{
    /**
     * Perform any additional boot required for this application
     */
    public function boot(): void
    {
        add_action('acf/init', function () {
            acf_register_block_type([
                'name' => 'ocp/code-highlight',
                'title' => __('Code Highlight'),
                'render_callback' => array($this, 'render'),
                'category' => 'ocp-blocks',
                'icon' => 'editor-code',
                'mode' => 'edit',
                'enqueue_assets' => function () {
                    wp_enqueue_script_module('block-code-highlight');
                },
                'keywords' => ['code', 'highlight', 'snippet', 'syntax'],
                'post_types' => ['post', 'news', 'resource', 'event', 'page'],
                'supports' => [
                    'align' => false,
                ],
            ]);
        });
    }

    public function render(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void
    {
        $context = Timber::get_context();

        $language = get_field('language') ?: 'text';

        $languageLabels = [
            'text' => 'Text',
            'bash' => 'Bash',
            'css' => 'CSS',
            'html' => 'HTML',
            'javascript' => 'JavaScript',
            'json' => 'JSON',
            'markdown' => 'Markdown',
            'php' => 'PHP',
            'python' => 'Python',
            'sql' => 'SQL',
            'typescript' => 'TypeScript',
            'xml' => 'XML',
            'yaml' => 'YAML',
        ];

        $context['block'] = [];
        $context['block']['language'] = $language;
        $context['block']['language_label'] = $languageLabels[$language] ?? ucfirst($language);
        $context['block']['code'] = get_field('code') ?: '';
        $context['block']['options'] = is_array(get_field('options')) ? get_field('options') : [];
        $context['block']['preview'] = $is_preview;

        Timber::render('blocks/code-highlight.twig', $context);
    }
}
