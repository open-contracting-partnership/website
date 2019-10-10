/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/svg.js":
/*!*****************************!*\
  !*** ./resources/js/svg.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _svg_icon_arrow_circle_svg__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../svg/icon-arrow-circle.svg */ "./resources/svg/icon-arrow-circle.svg");
/* harmony import */ var _svg_icon_close_svg__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../svg/icon-close.svg */ "./resources/svg/icon-close.svg");
/* harmony import */ var _svg_icon_menu_svg__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../svg/icon-menu.svg */ "./resources/svg/icon-menu.svg");
/* harmony import */ var _svg_icon_search_svg__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../svg/icon-search.svg */ "./resources/svg/icon-search.svg");
/* harmony import */ var _svg_logo_horizontal_svg__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../svg/logo-horizontal.svg */ "./resources/svg/logo-horizontal.svg");
/* harmony import */ var _svg_logo_vertical_svg__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../svg/logo-vertical.svg */ "./resources/svg/logo-vertical.svg");
/* harmony import */ var _svg_social_facebook_svg__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../svg/social-facebook.svg */ "./resources/svg/social-facebook.svg");
/* harmony import */ var _svg_social_linkedin_svg__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../svg/social-linkedin.svg */ "./resources/svg/social-linkedin.svg");
/* harmony import */ var _svg_social_twitter_svg__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../svg/social-twitter.svg */ "./resources/svg/social-twitter.svg");










/***/ }),

/***/ "./resources/svg/icon-arrow-circle.svg":
/*!*********************************************!*\
  !*** ./resources/svg/icon-arrow-circle.svg ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "icon-arrow-circle-usage",
      viewBox: "0 0 29 29",
      url: __webpack_require__.p + "svg/icons.svg#icon-arrow-circle",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./resources/svg/icon-close.svg":
/*!**************************************!*\
  !*** ./resources/svg/icon-close.svg ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "icon-close-usage",
      viewBox: "0 0 32 32",
      url: __webpack_require__.p + "svg/icons.svg#icon-close",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./resources/svg/icon-menu.svg":
/*!*************************************!*\
  !*** ./resources/svg/icon-menu.svg ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "icon-menu-usage",
      viewBox: "0 0 33 22",
      url: __webpack_require__.p + "svg/icons.svg#icon-menu",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./resources/svg/icon-search.svg":
/*!***************************************!*\
  !*** ./resources/svg/icon-search.svg ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "icon-search-usage",
      viewBox: "0 0 15 15",
      url: __webpack_require__.p + "svg/icons.svg#icon-search",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./resources/svg/logo-horizontal.svg":
/*!*******************************************!*\
  !*** ./resources/svg/logo-horizontal.svg ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "logo-horizontal-usage",
      viewBox: "0 0 187 66",
      url: __webpack_require__.p + "svg/icons.svg#logo-horizontal",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./resources/svg/logo-vertical.svg":
/*!*****************************************!*\
  !*** ./resources/svg/logo-vertical.svg ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "logo-vertical-usage",
      viewBox: "0 0 90 149",
      url: __webpack_require__.p + "svg/icons.svg#logo-vertical",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./resources/svg/social-facebook.svg":
/*!*******************************************!*\
  !*** ./resources/svg/social-facebook.svg ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "social-facebook-usage",
      viewBox: "0 0 12 22",
      url: __webpack_require__.p + "svg/icons.svg#social-facebook",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./resources/svg/social-linkedin.svg":
/*!*******************************************!*\
  !*** ./resources/svg/social-linkedin.svg ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "social-linkedin-usage",
      viewBox: "0 0 20 22",
      url: __webpack_require__.p + "svg/icons.svg#social-linkedin",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./resources/svg/social-twitter.svg":
/*!******************************************!*\
  !*** ./resources/svg/social-twitter.svg ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "social-twitter-usage",
      viewBox: "0 0 12 11",
      url: __webpack_require__.p + "svg/icons.svg#social-twitter",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ 3:
/*!***********************************!*\
  !*** multi ./resources/js/svg.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/beneverard/Sites/open-contracting/wp-content/themes/ocp-v1/resources/js/svg.js */"./resources/js/svg.js");


/***/ })

/******/ });