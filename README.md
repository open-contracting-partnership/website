# Open Contracting Partnership - WordPress Theme

**Version**: 3.17.8

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

- Local URL is `open-contracting.test`
- Theme directory name is `ocp-website`
- [Git-Flow](https://nvie.com/posts/a-successful-git-branching-model/) to be used for git branching
- [PHP PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- `.editorconfig` rules used to maintain coding styles

## Project dependencies

- PHP 7.4
- [Composer](https://getcomposer.org/download/)
- [Laravel Mix](https://github.com/JeffreyWay/laravel-mix/tree/master/docs#summary)
- [NPM](https://nodejs.org/en/download)

## Setup

### Back-end

Install all PHP dependencies with composer:

```bash
composer install
```
### Database

Use WP Migrate to pull the latest database from the production environment. Initially you can [export the database](https://www.open-contracting.org/wp-admin/tools.php?page=wp-migrate-db-pro&adbc-ignore-notice=0#migrate/1) only and import locally, and then run WP Mirgate to properly download the database, media and plugins.

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
