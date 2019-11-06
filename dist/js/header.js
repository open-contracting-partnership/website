(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/header"],{

/***/ "./resources/js/header.js":
/*!********************************!*\
  !*** ./resources/js/header.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.body.addEventListener('click', function (event) {
  // target hamburger, return to prevent continuing
  if (event.target && event.target.closest('.site-header__hamburger')) {
    event.stopPropagation();
    document.body.classList.toggle('mobile-menu-active');
    return;
  } // target navigation, return to prevent continuing


  if (event.target && event.target.closest('.site-header__navigation')) {
    event.stopPropagation();
    return;
  }

  document.body.classList.remove('mobile-menu-active');
});

/***/ }),

/***/ 2:
/*!**************************************!*\
  !*** multi ./resources/js/header.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/beneverard/Sites/open-contracting/wp-content/themes/ocp-v1/resources/js/header.js */"./resources/js/header.js");


/***/ })

},[[2,"/js/manifest"]]]);