acf.addAction('render_block_preview', function($block, props) {
    if (props.name !== 'app/grid-column') {
        return;
    }

    requestAnimationFrame(() => {
        const $column = $block[0].querySelector('.grid-column');

        if (! $column) {
            return;
        }

        const $wpBlock = $column.closest('.wp-block');

        if ($wpBlock) {
            $wpBlock.style.gridColumn = `span ${$column.dataset.desktopSpan}`;
            $wpBlock.style.width = '100%';
        }
    });
});
