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

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://builder7-cf7-elementor-addon/./src/admin/scss/sync.scss?");

/***/ }),

/***/ "./src/admin/sync.js":
/*!***************************!*\
  !*** ./src/admin/sync.js ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _scss_sync_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./scss/sync.scss */ \"./src/admin/scss/sync.scss\");\n\njQuery(document).ready(function($) {\n    var $formPanel = $('#form-panel');\n    var $formTagBox = $('#form-panel.contact-form-editor-panel');\n    let $edit_with_elementor_url = $('.cf7-builder-sync-url').data('elementor-url');\n    let $post_id = $('.cf7-builder-sync-url').data('post-id');\n    let $form_id = $('.cf7-builder-sync-url').data('form-id');\n    if ($formPanel.length && $edit_with_elementor_url && typeof $edit_with_elementor_url !== 'undefined') {\n        // Add buttons wrapper div\n        var buttonsHtml = '<div class=\"cf7-builder-button-wrapper\">' +\n            '<a href=\"'+ $edit_with_elementor_url +'\" ' +\n            'class=\"button button-primary\" ' +\n            'style=\"margin-top: 20px; display: inline-block;\" ' +\n            'target=\"_blank\">' +\n            'Edit with Elementor' +\n            '</a>' +\n            '<button class=\"button button-secondary cf7-builder-sync-form\" ' +\n            'style=\"margin-top: 20px; margin-left: 10px;\" ' +\n            'data-post-id=\"' + $post_id + '\" ' +\n            'data-form-id=\"' + $form_id + '\">' +\n            'Sync' +\n            '</button>' +\n            '</div>';\n        $formPanel.append(buttonsHtml);\n    }\n    if ($formTagBox.length && $edit_with_elementor_url && typeof $edit_with_elementor_url !== 'undefined') {\n        // Add overlay to the form-tag-box\n        $formTagBox.css('position', 'relative');\n        var $overlay = $('<div/>', {\n            class: 'cf7-builder-overlay'\n        }).append($('<div/>', {\n            class: 'cf7-builder-overlay-message'\n        }).html('This form is managed by CF7 Builder'));\n\n        $formTagBox.append($overlay);\n    }\n    // call ajax when sync button is clicked\n    $(document).on('click', '.cf7-builder-sync-form', function(e) {\n        e.preventDefault();\n        var data = {\n            action: 'cf7_builder_sync',\n            nonce: easyBuilderCf7lightObj.nonce,\n            post_id: $(this).data('post-id'),\n            form_id: $(this).data('form-id'),\n        };\n        $.ajax({\n            url: easyBuilderCf7lightObj.ajaxurl,\n            type: 'POST',\n            data: data,\n            success: function(response) {\n                if (response.success) {\n                    alert(response.data);\n                } else {\n                    alert(response.data);\n                }\n            }\n        });\n    });\n});\n\n//# sourceURL=webpack://builder7-cf7-elementor-addon/./src/admin/sync.js?");

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