var ElementQueries = require('css-element-queries/src/ElementQueries');

 //attaches to DOMLoadContent
ElementQueries.listen();

//or if you want to trigger it yourself.
// Parse all available CSS and attach ResizeSensor to those elements which have rules attached
// (make sure this is called after 'load' event, because CSS files are not ready when domReady is fired.
ElementQueries.init();
