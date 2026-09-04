# Open Contracting Partnership - WordPress Theme

**Version**: 3.28.6

| Environment | Status |
| :-- | :-- |
| [Production](https://www.open-contracting.org) | [![buddy pipeline](https://app.buddy.works/the-idea-bureau/website/pipelines/pipeline/247819/badge.svg?token=231a92d6d37280c9e8d3da6807a26e182bd2e613ef32061d150ac2619f979a3f "buddy pipeline")](https://app.buddy.works/the-idea-bureau/website/pipelines/pipeline/247819) |
| [Staging](https://ocp-website.staging.bureaudomains.co) | [![buddy pipeline](https://app.buddy.works/the-idea-bureau/website/pipelines/pipeline/247818/badge.svg?token=231a92d6d37280c9e8d3da6807a26e182bd2e613ef32061d150ac2619f979a3f "buddy pipeline")](https://app.buddy.works/the-idea-bureau/website/pipelines/pipeline/247818) |

---

## Versioning

We use the [Semantic Versioning 2.0.0](https://semver.org/) version scheme, when bumping versions the following files must be updated:

- README.md
- style.css

## Project guidelines

- Local URL is `ocp-website.test`
- [Git-Flow](https://nvie.com/posts/a-successful-git-branching-model/) to be used for git branching
- [PHP PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- `.editorconfig` rules used to maintain coding styles

## Project dependencies

- PHP 8.1
- [Composer](https://getcomposer.org/download/)
- [NPM](https://nodejs.org/en/download)

## Integrations

- Mapbox (worldwide map tiles and `theideabureau` styles)
- GitHub ([worldwide map data](https://github.com/open-contracting-partnership/ocp-data/tree/publish))
- Google Sheets (timeline `google_sheet_url`)
- [imgix](https://www.imgix.com) (image CDN)
- Knight Lab CDN (TimelineJS CSS)
- Mailchimp (newsletter signup)

## Setup

### Back-end

Install all PHP dependencies with composer:

```bash
composer install
```

Copy `.env.example` to `.env` and fill it in. `make wp` (see [Local server](#local-server)) writes the file for you, using the values from the files backup.

### Database

Use WP Migrate to pull the latest database from the production environment. Initially you can [export the database](https://www.open-contracting.org/wp-admin/tools.php?page=wp-migrate-db-pro&adbc-ignore-notice=0#migrate/1) only and import locally, and then run WP Mirgate to properly download the database, media and plugins.

### Local server

Alternatively, `make up` serves the production site from PHP's built-in server, using this checkout as the theme. It needs:

- **PHP 8.1** (`brew install php@8.1`), which the Makefile finds at its Homebrew path from `PHP_VERSION`; override that, or point `PHP=` at a binary
- **MySQL** (`mysql -uroot`, no password)
- **wp-cli** (`brew install wp-cli`), for `make urls`
- A `public_html` files backup and a database backup from production, in the repository root (the newest of each is auto-detected):
  - `*.tar` or `*.tar.gz` (override with `TAR=`)
  - `*.sql` or `*.sql.gz` (override with `DUMP=`)
- PHP and front-end dependencies installed, and assets built

| Command | Description |
|---|---|
| `make up` | `setup` and `serve` |
| `make setup` | `db`, `wp` and `urls` |
| `make db` | create and load the database (`FORCE=1` to re-load), rewrite the site URL to localhost, activate this theme, disable production-only plugins, and drop caches of production paths |
| `make wp` | extract files into a working directory (`FORCE=1` to re-extract), patch `wp-config.php`, write `.env`, and symlink this directory as the theme |
| `make urls` | rewrite production URLs to localhost, including inside serialized and JSON values |
| `make serve` | start PHP's built-in server (`php -S`) at http://localhost:8090, with 4 request workers (`WORKERS=`) and OPcache off so file edits take effect immediately |
| `make flush` | drop cached rewrite rules |
| `make clean` | drop the database and remove the working directory |
| `make help` | list the available commands (runs by default) |

Images are requested from imgix, which serves them from production, so uploads need no local setup. To serve on another port, set `PORT` on every command, like `make up PORT=8100`, and delete `.env` first, so that `make wp` writes the port into the imgix base URL.

> [!TIP]
> Run `make flush` if a custom post type or taxonomy archive returns a 404: for example, after switching git branches or changing its registration.

### Front-end

Start by installing all npm dependencies and then run the watch command to compile assets.

```bash
npm install
npm run watch
```

### SVG sprites

SVG files within the `/resources/svg` directory will be combined into a single SVG sprite, and can be referenced using the following snippet where a filename of `icon-twitter.svg` is referenced as:

```
<svg><use xlink:href="#icon-twitter"></use></svg>
```

SVGs used like this can be interacted with JavaScript and styled with CSS.

### World map

The homepage's "Where we work" map is generated. `worldmap/map-transform.php` reads `worldmap/map-original.svg`, replaces each path with circles, and writes `worldmap/map-new.svg`, whose contents are pasted into `views/blocks/where-we-work-map.twig`.

```bash
cd worldmap && php map-transform.php
```

The script resolves both filenames relative to the working directory, so run it from inside `worldmap`. Nothing reads that directory at runtime: it holds the source and the tool, and the template holds the output.
