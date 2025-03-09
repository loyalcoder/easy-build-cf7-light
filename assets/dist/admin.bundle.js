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

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://builder7-cf7-elementor-addon/./src/admin/scss/admin.scss?");

/***/ }),

/***/ "./src/admin/index.js":
/*!****************************!*\
  !*** ./src/admin/index.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_admin_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/admin.scss */ \"./src/admin/scss/admin.scss\");\n\nclass Offcanvas {\n    constructor(element) {\n      this.element = element;\n      // Target both buttons that should trigger the offcanvas\n      this.triggers = [\n        document.querySelector('.page-title-action'),\n        document.querySelector('#menu-posts-cf7-builder .wp-submenu-wrap li:last-child a')\n      ];\n      this.backdrop = document.createElement('div');\n      this.backdrop.className = 'offcanvas-backdrop fade';\n      this.isShown = false;\n  \n      // Add click handler to both trigger elements\n      this.triggers.forEach(trigger => {\n        if (trigger) {\n          trigger.addEventListener('click', (e) => {\n            e.preventDefault();\n            this.toggle();\n          });\n        }\n      });\n\n      this.element.querySelector('.btn-close').addEventListener('click', this.hide.bind(this));\n      this.backdrop.addEventListener('click', this.hide.bind(this));\n    }\n  \n    show() {\n      if (this.isShown) return;\n      \n      document.body.appendChild(this.backdrop);\n      setTimeout(() => this.backdrop.classList.add('show'), 0);\n      \n      this.element.style.visibility = 'visible';\n      this.element.classList.add('show');\n      this.isShown = true;\n    }\n  \n    hide() {\n      if (!this.isShown) return;\n      \n      this.backdrop.classList.remove('show');\n      setTimeout(() => this.backdrop.remove(), 300);\n      \n      this.element.classList.remove('show');\n      setTimeout(() => {\n        this.element.style.visibility = 'hidden';\n        this.isShown = false;\n      }, 300);\n    }\n  \n    toggle() {\n      this.isShown ? this.hide() : this.show();\n    }\n  }\n  \n  // Initialize\n  document.addEventListener('DOMContentLoaded', () => {\n    const offcanvasElements = document.querySelectorAll('.offcanvas');\n    offcanvasElements.forEach(el => new Offcanvas(el));\n  });\n\n\n  document.addEventListener('DOMContentLoaded', function() {\n    const createNewButton = document.getElementById('cf7-create-new');\n    const newFormContainer = document.getElementById('new-form-container');\n    const cf7Select = document.getElementById('cf7-select');\n  \n    // Function to populate the select options (you'll need to implement this)\n    function populateCF7Options() {\n      // Fetch CF7 forms and populate the select\n      // This might involve an AJAX call to the WordPress backend\n    }\n  \n    // Call this function to populate the select options when the page loads\n    populateCF7Options();\n  });\n\n  jQuery(document).ready(function($) {\n\n    var $titleInput = $('#cf7-title');\n    var $selectInput = $('#cf7-select');\n    var $submitButton = $('#cf7-builder-submit');\n\n\n    function checkFields() {\n        var titleValue = $titleInput.length ? $titleInput.val().trim() : '';\n        var selectValue = $selectInput.length ? $selectInput.val() : '';\n        $submitButton.prop('disabled', !(titleValue !== '' && selectValue !== ''));\n    }\n\n    $titleInput.on('input', checkFields);\n    $selectInput.on('change', checkFields);\n\n    // Initial check on page load\n    checkFields();\n});\ndocument.addEventListener('DOMContentLoaded', function() {\n    const layoutItems = document.querySelectorAll('.layout-item');\n    const hiddenField = document.getElementById('selected-layout');\n    const submitButton = document.getElementById('cf7-builder-submit');\n  \n    layoutItems.forEach(item => {\n      item.addEventListener('click', function() {\n        layoutItems.forEach(i => i.classList.remove('selected'));\n        this.classList.add('selected');\n        hiddenField.value = this.getAttribute('data-layout');\n        // submitButton.disabled = false;\n      });\n    });\n  });\n  \n\n//# sourceURL=webpack://builder7-cf7-elementor-addon/./src/admin/index.js?");

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