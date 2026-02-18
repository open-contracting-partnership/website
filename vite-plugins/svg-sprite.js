import { readFileSync, writeFileSync, mkdirSync, readdirSync } from 'fs';
import { join, basename } from 'path';
import SVGSpriter from 'svg-sprite';

export default function svgSpritePlugin(inputDir, outputFile) {
  return {
    name: 'svg-sprite',
    buildStart() {
      // Add all SVG files as watch targets
      const svgFiles = readdirSync(inputDir).filter(file => file.endsWith('.svg'));
      svgFiles.forEach(file => {
        this.addWatchFile(join(inputDir, file));
      });
    },
    async generateBundle() {
      const spriter = new SVGSpriter({
        mode: {
          symbol: {
            dest: '.',
            sprite: outputFile
          }
        },
        shape: {
          id: {
            generator: (name) => basename(name, '.svg')
          }
        }
      });

      const svgFiles = readdirSync(inputDir).filter(file => file.endsWith('.svg'));

      for (const file of svgFiles) {
        const filePath = join(inputDir, file);
        const content = readFileSync(filePath, 'utf-8');
        spriter.add(filePath, file, content);
      }

      return new Promise((resolve, reject) => {
        spriter.compile((error, result) => {
          if (error) {
            reject(error);
            return;
          }

          for (const mode in result) {
            for (const resource in result[mode]) {
              const { path: outputPath, contents } = result[mode][resource];
              this.emitFile({
                type: 'asset',
                fileName: outputFile,
                source: contents
              });
            }
          }
          resolve();
        });
      });
    }
  };
}
