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

/***/ "./src/admin/scss/sync.scss":
/*!**********************************!*\
  !*** ./src/admin/scss/sync.scss ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://easy-build-cf7-light/./src/admin/scss/sync.scss?");

/***/ }),

/***/ "./src/admin/sync.js":
/*!***************************!*\
  !*** ./src/admin/sync.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_sync_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/sync.scss */ \"./src/admin/scss/sync.scss\");\n\r\njQuery(document).ready(function($) {\r\n    var $formPanel = $('#form-panel');\r\n    var $formTagBox = $('#form-panel.contact-form-editor-panel');\r\n    let $edit_with_elementor_url = $('.cf7-builder-sync-url').data('elementor-url');\r\n    let $post_id = $('.cf7-builder-sync-url').data('post-id');\r\n    let $form_id = $('.cf7-builder-sync-url').data('form-id');\r\n    if ($formPanel.length && $edit_with_elementor_url && typeof $edit_with_elementor_url !== 'undefined') {\r\n        // Add buttons wrapper div\r\n        var buttonsHtml = '<div class=\"cf7-builder-button-wrapper\">' +\r\n            '<a href=\"'+ $edit_with_elementor_url +'\" ' +\r\n            'class=\"button button-primary\" ' +\r\n            'style=\"margin-top: 20px; display: inline-block;\" ' +\r\n            'target=\"_blank\">' +\r\n            'Edit with Elementor' +\r\n            '</a>' +\r\n            '<button class=\"button button-secondary cf7-builder-sync-form\" ' +\r\n            'style=\"margin-top: 20px; margin-left: 10px;\" ' +\r\n            'data-post-id=\"' + $post_id + '\" ' +\r\n            'data-form-id=\"' + $form_id + '\">' +\r\n            'Sync' +\r\n            '</button>' +\r\n            '</div>';\r\n        $formPanel.append(buttonsHtml);\r\n    }\r\n    if ($formTagBox.length && $edit_with_elementor_url && typeof $edit_with_elementor_url !== 'undefined') {\r\n        // Add overlay to the form-tag-box\r\n        $formTagBox.css('position', 'relative');\r\n        var $overlay = $('<div/>', {\r\n            class: 'cf7-builder-overlay'\r\n        }).append($('<div/>', {\r\n            class: 'cf7-builder-overlay-message'\r\n        }).html('This form is managed by CF7 Builder'));\r\n\r\n        $formTagBox.append($overlay);\r\n    }\r\n    // call ajax when sync button is clicked\r\n    $(document).on('click', '.cf7-builder-sync-form', function(e) {\r\n        e.preventDefault();\r\n        var data = {\r\n            action: 'cf7_builder_sync',\r\n            nonce: easyBuilderCf7lightObj.nonce,\r\n            post_id: $(this).data('post-id'),\r\n            form_id: $(this).data('form-id'),\r\n        };\r\n        $.ajax({\r\n            url: easyBuilderCf7lightObj.ajaxurl,\r\n            type: 'POST',\r\n            data: data,\r\n            success: function(response) {\r\n                if (response.success) {\r\n                    alert(response.data);\r\n                } else {\r\n                    alert(response.data);\r\n                }\r\n            }\r\n        });\r\n    });\r\n});\n\n//# sourceURL=webpack://easy-build-cf7-light/./src/admin/sync.js?");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./src/admin/sync.js");
/******/ 	
/******/ })()
;