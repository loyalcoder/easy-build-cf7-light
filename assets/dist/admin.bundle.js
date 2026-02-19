/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/admin/scss/admin.scss":
/*!***********************************!*\
  !*** ./src/admin/scss/admin.scss ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://easy-build-cf7-light/./src/admin/scss/admin.scss?");

/***/ }),

/***/ "./src/admin/index.js":
/*!****************************!*\
  !*** ./src/admin/index.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_admin_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/admin.scss */ \"./src/admin/scss/admin.scss\");\n\r\nclass Offcanvas {\r\n    constructor(element) {\r\n      this.element = element;\r\n      // Target both buttons that should trigger the offcanvas\r\n      this.triggers = [\r\n        document.querySelector('.page-title-action'),\r\n        document.querySelector('#menu-posts-cf7-builder .wp-submenu-wrap li:last-child a')\r\n      ];\r\n      this.backdrop = document.createElement('div');\r\n      this.backdrop.className = 'offcanvas-backdrop fade';\r\n      this.isShown = false;\r\n  \r\n      // Add click handler to both trigger elements\r\n      this.triggers.forEach(trigger => {\r\n        if (trigger) {\r\n          trigger.addEventListener('click', (e) => {\r\n            e.preventDefault();\r\n            this.toggle();\r\n          });\r\n        }\r\n      });\r\n\r\n      this.element.querySelector('.btn-close').addEventListener('click', this.hide.bind(this));\r\n      this.backdrop.addEventListener('click', this.hide.bind(this));\r\n    }\r\n  \r\n    show() {\r\n      if (this.isShown) return;\r\n      \r\n      document.body.appendChild(this.backdrop);\r\n      setTimeout(() => this.backdrop.classList.add('show'), 0);\r\n      \r\n      this.element.style.visibility = 'visible';\r\n      this.element.classList.add('show');\r\n      this.isShown = true;\r\n    }\r\n  \r\n    hide() {\r\n      if (!this.isShown) return;\r\n      \r\n      this.backdrop.classList.remove('show');\r\n      setTimeout(() => this.backdrop.remove(), 300);\r\n      \r\n      this.element.classList.remove('show');\r\n      setTimeout(() => {\r\n        this.element.style.visibility = 'hidden';\r\n        this.isShown = false;\r\n      }, 300);\r\n    }\r\n  \r\n    toggle() {\r\n      this.isShown ? this.hide() : this.show();\r\n    }\r\n  }\r\n  \r\n  // Initialize\r\n  document.addEventListener('DOMContentLoaded', () => {\r\n    const offcanvasElements = document.querySelectorAll('.offcanvas');\r\n    offcanvasElements.forEach(el => new Offcanvas(el));\r\n  });\r\n\r\n\r\n  document.addEventListener('DOMContentLoaded', function() {\r\n    const createNewButton = document.getElementById('cf7-create-new');\r\n    const newFormContainer = document.getElementById('new-form-container');\r\n    const cf7Select = document.getElementById('cf7-select');\r\n  \r\n    // Function to populate the select options (you'll need to implement this)\r\n    function populateCF7Options() {\r\n      // Fetch CF7 forms and populate the select\r\n      // This might involve an AJAX call to the WordPress backend\r\n    }\r\n  \r\n    // Call this function to populate the select options when the page loads\r\n    populateCF7Options();\r\n  });\r\n\r\n  jQuery(document).ready(function($) {\r\n\r\n    var $titleInput = $('#cf7-title');\r\n    var $selectInput = $('#cf7-select');\r\n    var $submitButton = $('#cf7-builder-submit');\r\n\r\n\r\n    function checkFields() {\r\n        var titleValue = $titleInput.length ? $titleInput.val().trim() : '';\r\n        var selectValue = $selectInput.length ? $selectInput.val() : '';\r\n        $submitButton.prop('disabled', !(titleValue !== '' && selectValue !== ''));\r\n    }\r\n\r\n    $titleInput.on('input', checkFields);\r\n    $selectInput.on('change', checkFields);\r\n\r\n    // Initial check on page load\r\n    checkFields();\r\n});\r\ndocument.addEventListener('DOMContentLoaded', function() {\r\n    const layoutItems = document.querySelectorAll('.layout-item');\r\n    const hiddenField = document.getElementById('selected-layout');\r\n    const submitButton = document.getElementById('cf7-builder-submit');\r\n  \r\n    layoutItems.forEach(item => {\r\n      item.addEventListener('click', function() {\r\n        layoutItems.forEach(i => i.classList.remove('selected'));\r\n        this.classList.add('selected');\r\n        hiddenField.value = this.getAttribute('data-layout');\r\n        // submitButton.disabled = false;\r\n      });\r\n    });\r\n  });\r\n  \n\n//# sourceURL=webpack://easy-build-cf7-light/./src/admin/index.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/admin/index.js");
/******/ 	
/******/ })()
;