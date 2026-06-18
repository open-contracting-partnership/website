import { createHighlighter } from 'shiki/bundle/web';

const THEME = 'github-light';
const LANGUAGES = [
    'text',
    'bash',
    'css',
    'html',
    'javascript',
    'json',
    'markdown',
    'php',
    'python',
    'scss',
    'sql',
    'typescript',
    'xml',
    'yaml',
];

let highlighterPromise;

function getHighlighter() {
    if (!highlighterPromise) {
        highlighterPromise = createHighlighter({
            themes: [THEME],
            langs: LANGUAGES,
        });
    }

    return highlighterPromise;
}

async function highlightCodeBlock($source) {
    const code = $source.textContent ?? '';
    const language = $source.dataset.language || 'text';

    if (code.length === 0) {
        return;
    }

    try {
        const highlighter = await getHighlighter();
        const highlightedCode = highlighter.codeToHtml(code, {
            lang: language,
            theme: THEME,
        });

        const $snippet = $source.closest('.block[data-block-type="code-highlight"]');
        const $pre = $snippet ? $snippet.querySelector('.block__pre') : null;

        if (!$pre) {
            return;
        }

        $pre.outerHTML = highlightedCode;

        const $shiki = $snippet.querySelector('.shiki');

        if ($shiki) {
            $shiki.classList.add('block__shiki');
        }
    } catch (error) {
        // Keep the original code block visible if highlighting fails.
        console.error('Shiki highlighting failed for code snippet block.', error);
    }
}

function highlightAllCodeBlocks(root = document) {
    console.log("Highlighting code blocks...");
    const $sources = root.querySelectorAll('.block[data-block-type="code-highlight"] .block__source[data-language]');

    console.log(`Found ${$sources.length} code blocks to highlight.`);
    $sources.forEach(($source) => {
        highlightCodeBlock($source);
    });
}

function watchForCodeBlocks() {
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                if (!(node instanceof HTMLElement)) {
                    return;
                }

                if (node.matches('.block[data-block-type="code-highlight"] .block__source[data-language]')) {
                    highlightCodeBlock(node);
                    return;
                }

                highlightAllCodeBlocks(node);
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true,
    });
}

if (document.readyState === 'loading') {
    window.addEventListener('DOMContentLoaded', () => {
        highlightAllCodeBlocks();
        watchForCodeBlocks();
    });
} else {
    highlightAllCodeBlocks();
    watchForCodeBlocks();
}
