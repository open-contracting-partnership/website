# Open Contracting Partnership - WordPress Theme

[![buddy pipeline](https://app.buddy.works/the-idea-bureau/website/pipelines/pipeline/247819/badge.svg?token=0a1174bd02e3c4104f3e3a4f22a48140acb7af40544b9684abde1d7d8d8d8cd9 "buddy pipeline")](https://app.buddy.works/the-idea-bureau/website/pipelines/pipeline/247819)

**Website**: https://www.open-contracting.org/

**Version**: 3.5.1

---

## Project guidelines

- [Git-Flow](https://nvie.com/posts/a-successful-git-branching-model/) to be used for git branching
- [PHP PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- `.editorconfig` rules used to maintain coding styles

## Project dependencies

- [Composer](https://getcomposer.org/download/)
- [Laravel Mix](https://github.com/JeffreyWay/laravel-mix/tree/master/docs#summary)
- [Yarn](https://classic.yarnpkg.com/en/docs/install/) (or npm)

## Installation and usage

### Front-end

Start by installing all yarn dependencies:

```
yarn install
```

Laravel Mix provides various commands in order to compile front-end assets:

```
yarn run watch   # watch all files and compile
yarn run hot     # watch all files, compile with live reload
yarn run dev     # compile without minify
yarn run prod    # compile with minify
```

#### SVG sprites

SVG files within the `/resources/svg` directory will be combined into a single SVG sprite, and can be referenced using the following snippet where a filename of `icon-twitter.svg` is referenced as:

```
<svg><use xlink:href="#icon-twitter"></use></svg>
```

SVGs used like this can be interacted with JavaScript and styled with CSS.

### Back-end

Composer is used for back-end libraries, use the following command to install dependancies.

```
composer install
```

### Lock files

Both yarn and composer lock files are to be committed.
