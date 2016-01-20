# Pattern Library

Created to be the starting point of our projects, Pattern Library is a simple gulp driven output of web elements.

## Setup

```
$ npm install
```

## Assets

The assets directory is used to contain front-end files such as CSS (Sass), JavaScript, images, fonts etc.

Gulp is used to process Sass, JavaScript and image files.

- [Install node](http://nodejs.org/download/)
- [Install gulp](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md)
- [Install sass](http://sass-lang.com/install)
- [Install sass globbing](https://github.com/chriseppstein/sass-globbing)
- Run the following commands within this directory:
  - `npm install`
  - `gulp`

Gulp will watch the files within the assets directory and compile as necessary.

## Browser Sync and Live Reload

[BrowserSync](http://www.browsersync.io/) has been included with the gulp build, simply change the proxy url in the gulpfile.js and run:
-   `gulp bs`

Currently there is no support for Live Reload

## Style Guide Structure

The styleguide template structure loosely follows that of Brad Frost's [Pattern Lab](http://patternlab.io/about.html), in that we use the following template levels:

- **Atoms**
- **Molecules**
- **Organisms**
- **Templates**
- **Pages**

An explanation of this model can be found on the [Pattern Lab](http://patternlab.io/about.html) website.

In the styleguide the **pages** templates are important as these are exposed without the styleguide interface when accessed via the root URL.
