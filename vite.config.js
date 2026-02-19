import { readdirSync, readFileSync } from 'node:fs';
import { basename, join, resolve } from 'node:path';
import vue from '@vitejs/plugin-vue2';
import SVGSpriter from 'svg-sprite';
import { defineConfig } from 'vite';
import sassGlobImports from 'vite-plugin-sass-glob-import';
import { viteStaticCopy } from 'vite-plugin-static-copy';

function svgSpritePlugin(inputDir, outputFile) {
  return {
    name: 'svg-sprite',
    buildStart() {
      for (const file of readdirSync(inputDir).filter((f) => f.endsWith('.svg'))) {
        this.addWatchFile(join(inputDir, file));
      }
    },
    async generateBundle() {
      const spriter = new SVGSpriter({
        mode: { symbol: { dest: '.', sprite: outputFile } },
        shape: { id: { generator: (path) => basename(path, '.svg') } },
      });

      for (const file of readdirSync(inputDir).filter((f) => f.endsWith('.svg'))) {
        const path = join(inputDir, file);
        spriter.add(path, file, readFileSync(path, 'utf-8'));
      }

      const { result } = await spriter.compileAsync();
      this.emitFile({ type: 'asset', fileName: outputFile, source: result.symbol.sprite.contents });
    },
  };
}

export default defineConfig({
  base: './',
  plugins: [
    vue(),
    sassGlobImports(),
    viteStaticCopy({
      targets: [
        {
          src: 'node_modules/mapbox-gl/dist/mapbox-gl.css',
          dest: 'node_modules/mapbox-gl',
        },
      ],
    }),
    svgSpritePlugin('resources/svg', 'svg/icons.svg'),
  ],
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        // JS entry points
        'archive-resource': resolve(__dirname, 'resources/js/archive-resource.js'),
        'block-download-carousel': resolve(__dirname, 'resources/js/block-download-carousel.js'),
        'block-featured-stories-carousel': resolve(__dirname, 'resources/js/block-featured-stories-carousel.js'),
        'block-our-model': resolve(__dirname, 'resources/js/block-our-model.js'),
        'block-quote-carousel': resolve(__dirname, 'resources/js/block-quote-carousel.js'),
        'block-stats': resolve(__dirname, 'resources/js/block-stats.js'),
        'block-team-profile': resolve(__dirname, 'resources/js/block-team-profile.js'),
        'block-timeline': resolve(__dirname, 'resources/js/block-timeline.js'),
        'block-where-we-work': resolve(__dirname, 'resources/js/block-where-we-work.js'),
        'element-queries': resolve(__dirname, 'resources/js/element-queries.js'),
        header: resolve(__dirname, 'resources/js/header.js'),
        'impact-stories': resolve(__dirname, 'resources/js/impact-stories.js'),
        'latest-news': resolve(__dirname, 'resources/js/latest-news.js'),
        mailchimp: resolve(__dirname, 'resources/js/mailchimp.js'),
        worldwide: resolve(__dirname, 'resources/js/modules/worldwide/worldwide.js'),
        scripts: resolve(__dirname, 'resources/js/scripts.js'),
        'scroll-prompt': resolve(__dirname, 'resources/js/scroll-prompt.js'),
        // SCSS entry points
        styles: resolve(__dirname, 'resources/scss/styles.scss'),
        gutenberg: resolve(__dirname, 'resources/scss/gutenberg.scss'),
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name?.endsWith('.css')) {
            return 'css/[name].[ext]';
          }
          if (assetInfo.name && /\.(woff2?|ttf|eot|otf)$/.test(assetInfo.name)) {
            return 'fonts/[name].[ext]';
          }
          return 'assets/[name].[ext]';
        },
        manualChunks: {
          vendor: ['vue'],
        },
      },
    },
  },
  resolve: {
    alias: {
      '@': resolve(__dirname, 'resources'),
    },
  },
});
