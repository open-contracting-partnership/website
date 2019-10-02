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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@babel/runtime/helpers/classCallCheck.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/classCallCheck.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

module.exports = _classCallCheck;

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/createClass.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/createClass.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

module.exports = _createClass;

/***/ }),

/***/ "./resources/scss/styles.scss":
/*!************************************!*\
  !*** ./resources/scss/styles.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./styleguide_assets/aigis_assets/scripts/class-polyfill.js":
/*!******************************************************************!*\
  !*** ./styleguide_assets/aigis_assets/scripts/class-polyfill.js ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ClasslistPolyfill; });
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);



var ClasslistPolyfill =
/*#__PURE__*/
function () {
  function ClasslistPolyfill() {
    _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, ClasslistPolyfill);
  }

  _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(ClasslistPolyfill, null, [{
    key: "addClass",
    value: function addClass(el, className) {
      if (el.classList) {
        el.classList.add(className);
      } else {
        el.className += ' ' + className;
      }
    }
  }, {
    key: "removeClass",
    value: function removeClass(el, className) {
      if (el.classList) {
        el.classList.remove(className);
      } else {
        el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      }
    }
  }, {
    key: "toggleClass",
    value: function toggleClass(el, className) {
      if (el.classList) {
        el.classList.toggle(className);
      } else {
        var classes = el.className.split(' ');
        var existingIndex = classes.indexOf(className);

        if (existingIndex >= 0) {
          classes.splice(existingIndex, 1);
        } else {
          classes.push(className);
        }

        el.className = classes.join(' ');
      }
    }
  }, {
    key: "hasClass",
    value: function hasClass(el, className) {
      if (el.classList) {
        return el.classList.contains(className);
      } else {
        return new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
      }
    }
  }]);

  return ClasslistPolyfill;
}();



/***/ }),

/***/ "./styleguide_assets/aigis_assets/scripts/styleguide.js":
/*!**************************************************************!*\
  !*** ./styleguide_assets/aigis_assets/scripts/styleguide.js ***!
  \**************************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ "./node_modules/@babel/runtime/helpers/classCallCheck.js");
/* harmony import */ var _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/createClass */ "./node_modules/@babel/runtime/helpers/createClass.js");
/* harmony import */ var _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _class_polyfill__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./class-polyfill */ "./styleguide_assets/aigis_assets/scripts/class-polyfill.js");




var Styleguide =
/*#__PURE__*/
function () {
  function Styleguide() {
    _babel_runtime_helpers_classCallCheck__WEBPACK_IMPORTED_MODULE_0___default()(this, Styleguide);

    this.options = {
      previews: this.checkPreviews()
    };
    this.modal = document.querySelector('.aigis-contents__preview'); // create a template modal wrapper
    // this will be cloned to wrap the single component preview code

    this.modal_template = document.createElement('div');
    _class_polyfill__WEBPACK_IMPORTED_MODULE_2__["default"].addClass(this.modal_template, 'aigis-modal__item'); // initialise the page

    this.initialiseStyleguide();
  }

  _babel_runtime_helpers_createClass__WEBPACK_IMPORTED_MODULE_1___default()(Styleguide, [{
    key: "checkPreviews",
    value: function checkPreviews() {
      var preview_array = Array.from(document.querySelectorAll('.aigis-preview'));
      return preview_array.length ? true : false;
    }
  }, {
    key: "openModal",
    value: function openModal() {
      _class_polyfill__WEBPACK_IMPORTED_MODULE_2__["default"].addClass(document.body, 'aigis-modal--active');
    }
  }, {
    key: "closeModal",
    value: function closeModal() {
      // fix the URL
      history.pushState("", document.title, window.location.pathname + window.location.search);
      _class_polyfill__WEBPACK_IMPORTED_MODULE_2__["default"].removeClass(document.body, 'aigis-modal--active');
    }
  }, {
    key: "checkHash",
    value: function checkHash() {
      // get the URL hash
      var hash = window.location.hash;
      var preview; // if there is a hash

      if (hash) {
        // check that the hash relates to an element
        preview = document.querySelector(hash); // if it does, open the single component view

        if (preview !== null) {
          this.addPreview(preview);
        }
      } // else close the modal
      else {
          this.closeModal();
        }
    }
  }, {
    key: "setMainActiveClass",
    value: function setMainActiveClass() {
      // search up through the menu to expand the current dropdown
      var current_item = document.querySelector('.aigis-header__navigation > ul:first-child [data-tree-current]');

      if (current_item !== null) {
        var searching = true; // search up through the menu items
        // until the top level

        while (searching) {
          // if the current item is the top-level parent
          // set active class and stop searching
          if (current_item.getAttribute('data-path-depth') === '0') {
            _class_polyfill__WEBPACK_IMPORTED_MODULE_2__["default"].addClass(current_item, 'is-active');
            searching = false;
          } else {
            current_item = current_item.parentNode;
          }
        }
      }
    }
  }, {
    key: "setSubActiveClass",
    value: function setSubActiveClass() {
      // search up through the menu to expand the current dropdown
      var current_item = document.querySelector('.aigis-header__sub-navigation [data-tree-current]');

      if (current_item !== null) {
        _class_polyfill__WEBPACK_IMPORTED_MODULE_2__["default"].addClass(current_item, 'is-active');
      }
    }
  }, {
    key: "createSubNav",
    value: function createSubNav() {
      var current_menu = document.querySelector('.aigis-header__navigation li[data-path-depth="0"].is-active > ul');
      var sub_nav = document.querySelector('.aigis-header__sub-navigation');

      if (current_menu !== null) {
        sub_nav.innerHTML = current_menu.innerHTML;
      }
    }
    /**
     * hash_selector: the selected element using the URL hash as an ID
     */

  }, {
    key: "addPreview",
    value: function addPreview(hash_selector) {
      var current_item = hash_selector.nextElementSibling;
      var searching = true; // search through next siblings
      // until the preview code is found

      while (searching) {
        if (_class_polyfill__WEBPACK_IMPORTED_MODULE_2__["default"].hasClass(current_item, 'aigis-preview') === true) {
          searching = false; // clone in the modal template wrapper

          var modal_item = this.modal_template.cloneNode(); // set the modal html as the current preview code

          modal_item.innerHTML = current_item.innerHTML; // append the modal wrapper

          this.modal.innerHTML = modal_item.innerHTML;
          this.openModal();
        } else {
          current_item = current_item.nextElementSibling;
        }
      }
    }
  }, {
    key: "setPreviewLinks",
    value: function setPreviewLinks() {
      var _this = this;

      var link_icon = document.querySelector('.link-icon'); // setup the hash anchor element

      var link_template = document.createElement('a');
      link_template.appendChild(link_icon.cloneNode(true));
      _class_polyfill__WEBPACK_IMPORTED_MODULE_2__["default"].addClass(link_template, 'preview-link'); // get all preview titles

      var preview_titles = Array.from(document.querySelectorAll('.aigis-module > [id]')); // loop through each title

      preview_titles.forEach(function (title) {
        // get the title id
        // replace all non-alphanumeric characters with dashes
        // e.g. spaces, ampersands
        // convert it to lowercase
        var new_title_id = title.id.replace(/\W+/g, '-').toLowerCase(); // replace the title id with the new clean version

        title.id = new_title_id; // clone the hash anchor

        var title_link = link_template.cloneNode(true); // apply the current id as the href

        title_link.href = "#".concat(new_title_id); // if there's a hash already and the same link has been clicked
        // re-open the modal

        title_link.addEventListener('click', function (event) {
          if (event.currentTarget.hash === window.location.hash) {
            _this.openModal();
          }
        }, false); // append the anchor to the title

        title.appendChild(title_link);
      });
    }
  }, {
    key: "setupPreviews",
    value: function setupPreviews() {
      var _this2 = this; // add a listener for a hash change


      window.addEventListener('hashchange', function () {
        _this2.checkHash();
      }); // setup the preview links next to the titles

      this.setPreviewLinks(); // check to see if we've loaded in with a hash link

      this.checkHash();
      document.querySelector('.aigis-header__close').addEventListener('click', this.closeModal, false);
    }
  }, {
    key: "setupColors",
    value: function setupColors() {
      var colors = Array.from(document.querySelectorAll('.aigis-preview > .aigis-colorpalette'));

      if (colors.length) {
        colors.forEach(function (color) {
          _class_polyfill__WEBPACK_IMPORTED_MODULE_2__["default"].addClass(color.parentNode, 'aigis-preview--color');
        });
      }
    }
  }, {
    key: "initialiseStyleguide",
    value: function initialiseStyleguide() {
      this.setMainActiveClass();
      this.createSubNav();
      this.setSubActiveClass();
      this.setupColors();

      if (this.options.previews) {
        this.setupPreviews();
      }
    }
  }]);

  return Styleguide;
}(); // wrap this all in an IIFE
// doesn't pollute the global scope


(function () {
  // create a new instance of the Styleguide class
  var app = new Styleguide();
})();

/***/ }),

/***/ "./styleguide_assets/aigis_assets/styles/theme.scss":
/*!**********************************************************!*\
  !*** ./styleguide_assets/aigis_assets/styles/theme.scss ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!****************************************************************************************************************************************************!*\
  !*** multi ./styleguide_assets/aigis_assets/scripts/styleguide.js ./resources/scss/styles.scss ./styleguide_assets/aigis_assets/styles/theme.scss ***!
  \****************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/beneverard/Sites/open-contracting/wp-content/themes/ocp-v1/styleguide_assets/aigis_assets/scripts/styleguide.js */"./styleguide_assets/aigis_assets/scripts/styleguide.js");
__webpack_require__(/*! /Users/beneverard/Sites/open-contracting/wp-content/themes/ocp-v1/resources/scss/styles.scss */"./resources/scss/styles.scss");
module.exports = __webpack_require__(/*! /Users/beneverard/Sites/open-contracting/wp-content/themes/ocp-v1/styleguide_assets/aigis_assets/styles/theme.scss */"./styleguide_assets/aigis_assets/styles/theme.scss");


/***/ })

/******/ });