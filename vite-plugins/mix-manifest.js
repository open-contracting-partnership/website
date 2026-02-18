import { readFileSync, writeFileSync, existsSync } from 'fs';
import { join } from 'path';
import { createHash } from 'crypto';

export default function mixManifestPlugin() {
  return {
    name: 'mix-manifest',
    enforce: 'post',
    apply: 'build',
    closeBundle() {
      const outDir = 'dist';
      const viteManifestPath = join(outDir, '.vite/manifest.json');

      if (!existsSync(viteManifestPath)) {
        console.warn('Vite manifest not found at', viteManifestPath);
        return;
      }

      const viteManifest = JSON.parse(readFileSync(viteManifestPath, 'utf-8'));
      const mixManifest = {};

      for (const [src, entry] of Object.entries(viteManifest)) {
        // Only include entry points (JS and CSS entry files)
        if (!entry.isEntry) continue;

        const outputFile = entry.file;
        const outputPath = join(outDir, outputFile);

        // Generate hash from file content
        let hash;
        if (existsSync(outputPath)) {
          const content = readFileSync(outputPath);
          hash = createHash('md5').update(content).digest('hex').slice(0, 8);
        } else {
          hash = Date.now().toString(36);
        }

        // Determine the key based on the output file
        const key = '/' + outputFile;
        mixManifest[key] = `${key}?id=${hash}`;
      }

      writeFileSync(
        join(outDir, 'mix-manifest.json'),
        JSON.stringify(mixManifest, null, 2)
      );

      console.log('Generated mix-manifest.json');
    }
  };
}
