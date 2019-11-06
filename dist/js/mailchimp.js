(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/mailchimp"],{

/***/ "./resources/js/mailchimp.js":
/*!***********************************!*\
  !*** ./resources/js/mailchimp.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var $mailchimp_forms = document.querySelectorAll('.js-mailchimp-form');
$mailchimp_forms.forEach(function ($form) {
  $form.addEventListener('submit', function (event) {
    event.preventDefault();
    $form.querySelector('.js-mailchimp-form__message').innerHTML = '&nbsp;';
    fetch(mailchimp_options.root + 'ocp/v1/mailchimp/add-subscriber', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      credentials: 'same-origin',
      body: JSON.stringify({
        email: $form.email.value
      })
    }).then(function (response) {
      return response.json();
    }).then(function (data) {
      $form.querySelector('.js-mailchimp-form__message').innerHTML = data.message;
    })["catch"](function (error) {
      $form.querySelector('.js-mailchimp-form__message').innerHTML = mailchimp_options.error_text;
    });
  });
});

/***/ }),

/***/ 4:
/*!*****************************************!*\
  !*** multi ./resources/js/mailchimp.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/beneverard/Sites/open-contracting/wp-content/themes/ocp-v1/resources/js/mailchimp.js */"./resources/js/mailchimp.js");


/***/ })

},[[4,"/js/manifest"]]]);