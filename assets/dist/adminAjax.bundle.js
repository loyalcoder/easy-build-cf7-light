/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/admin/admin-ajax.js":
/*!*********************************!*\
  !*** ./src/admin/admin-ajax.js ***!
  \*********************************/
/***/ (() => {

eval("jQuery(function($){\r\n    \"use strict\"\r\n    $(document).on('submit', '.crete-post', function(e){\r\n        e.preventDefault();\r\n        var formData = new FormData();\r\n        formData.append('action', 'create_cf7_builder_post');\r\n        formData.append('nonce', easyBuilderCf7lightObj.nonce);\r\n        formData.append('title', $('#cf7-title').val());\r\n        formData.append('cf7_form_id', $('#cf7-select').val());\r\n        formData.append('selected_layout', $('#selected-layout').val());\r\n\r\n        $.ajax({\r\n            url: easyBuilderCf7lightObj.ajaxurl,\r\n            type: 'POST',\r\n            data: formData,\r\n            processData: false,\r\n            contentType: false,\r\n            success: function(response) {\r\n                if (response.success) {\r\n                    let link = '<a href=\"'+response.data.edit_url+'\" target=\"_blank\">Edit With Elementor</a>';\r\n                    let newWindow = window.open(response.data.edit_url, '_blank');\r\n                    if (!newWindow || newWindow.closed || typeof newWindow.closed == 'undefined') {\r\n                        if (confirm(\"Failed to open new window. Reload page?\")) {\r\n                            window.location.reload();\r\n                        }\r\n                    }\r\n                }\r\n            },\r\n            error: function(xhr, status, error) {\r\n                console.error(error);\r\n                alert('An error occurred. Please try again.');\r\n            }\r\n        });\r\n    });\r\n    $(document).on('click', '.cf7-builder-sync', function(e) {\r\n        e.preventDefault();\r\n        var data = {\r\n            action: 'cf7_builder_sync',\r\n            nonce: easyBuilderCf7lightObj.nonce,\r\n            post_id: $(this).data('post-id'),\r\n            form_id: $(this).data('form-id'),\r\n        };\r\n    \r\n        showCustomAlert('loading', 'Syncing', 'Please wait while we sync your form.');\r\n    \r\n        $.ajax({\r\n            url: easyBuilderCf7lightObj.ajaxurl,\r\n            type: 'POST',\r\n            data: data,\r\n            success: function(response) {\r\n                console.log(response);\r\n                \r\n                if (response.success) {\r\n                    showCustomAlert('success', 'Sync Successful', 'Your form has been successfully synced.');\r\n                } else {\r\n                    showCustomAlert('error', 'Oops...', 'Something went wrong! ' + (response.data || 'Please try again.'));\r\n                }\r\n            },\r\n            error: function(xhr, status, error) {\r\n                console.error(error);\r\n                showCustomAlert('error', 'Error', 'An error occurred while syncing. Please try again later.');\r\n            }\r\n        });\r\n    });\r\n});\r\n\r\nfunction showCustomAlert(type, title, message) {\r\n    const alert = document.getElementById('custom-alert');\r\n    const alertIcon = document.getElementById('alert-icon');\r\n    const alertTitle = document.getElementById('alert-title');\r\n    const alertMessage = document.getElementById('alert-message');\r\n    const alertButton = document.getElementById('alert-button');\r\n    alertIcon.className = 'alert-icon ' + type;\r\n    alertTitle.textContent = title;\r\n    alertMessage.textContent = message;\r\n\r\n    if (type === 'loading') {\r\n        alertButton.style.display = 'none';\r\n    } else {\r\n        alertButton.style.display = 'inline-block';\r\n    }\r\n\r\n    alert.style.display = 'block';\r\n\r\n    alertButton.onclick = function() {\r\n        alert.style.display = 'none';\r\n    };\r\n}\n\n//# sourceURL=webpack://easy-build-cf7-light/./src/admin/admin-ajax.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/admin/admin-ajax.js"]();
/******/ 	
/******/ })()
;