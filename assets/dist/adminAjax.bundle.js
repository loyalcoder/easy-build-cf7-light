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

eval("jQuery(function($){\n    \"use strict\"\n    $(document).on('submit', '.crete-post', function(e){\n        e.preventDefault();\n        var formData = new FormData();\n        formData.append('action', 'create_cf7_builder_post');\n        formData.append('nonce', easyBuilderCf7lightObj.nonce);\n        formData.append('title', $('#cf7-title').val());\n        formData.append('cf7_form_id', $('#cf7-select').val());\n        formData.append('selected_layout', $('#selected-layout').val());\n\n        $.ajax({\n            url: easyBuilderCf7lightObj.ajaxurl,\n            type: 'POST',\n            data: formData,\n            processData: false,\n            contentType: false,\n            success: function(response) {\n                if (response.success) {\n                    let link = '<a href=\"'+response.data.edit_url+'\" target=\"_blank\">Edit With Elementor</a>';\n                    let newWindow = window.open(response.data.edit_url, '_blank');\n                    if (!newWindow || newWindow.closed || typeof newWindow.closed == 'undefined') {\n                        if (confirm(\"Failed to open new window. Reload page?\")) {\n                            window.location.reload();\n                        }\n                    }\n                }\n            },\n            error: function(xhr, status, error) {\n                console.error(error);\n                alert('An error occurred. Please try again.');\n            }\n        });\n    });\n    $(document).on('click', '.cf7-builder-sync', function(e) {\n        e.preventDefault();\n        var data = {\n            action: 'cf7_builder_sync',\n            nonce: easyBuilderCf7lightObj.nonce,\n            post_id: $(this).data('post-id'),\n            form_id: $(this).data('form-id'),\n        };\n    \n        showCustomAlert('loading', 'Syncing', 'Please wait while we sync your form.');\n    \n        $.ajax({\n            url: easyBuilderCf7lightObj.ajaxurl,\n            type: 'POST',\n            data: data,\n            success: function(response) {\n                console.log(response);\n                \n                if (response.success) {\n                    showCustomAlert('success', 'Sync Successful', 'Your form has been successfully synced.');\n                } else {\n                    showCustomAlert('error', 'Oops...', 'Something went wrong! ' + (response.data || 'Please try again.'));\n                }\n            },\n            error: function(xhr, status, error) {\n                console.error(error);\n                showCustomAlert('error', 'Error', 'An error occurred while syncing. Please try again later.');\n            }\n        });\n    });\n});\n\nfunction showCustomAlert(type, title, message) {\n    const alert = document.getElementById('custom-alert');\n    const alertIcon = document.getElementById('alert-icon');\n    const alertTitle = document.getElementById('alert-title');\n    const alertMessage = document.getElementById('alert-message');\n    const alertButton = document.getElementById('alert-button');\n    console.log(type);\n    alertIcon.className = 'alert-icon ';\n    alertTitle.textContent = title;\n    alertMessage.textContent = message;\n\n    if (type === 'loading') {\n        alertButton.style.display = 'none';\n    } else {\n        alertButton.style.display = 'inline-block';\n    }\n\n    alert.style.display = 'block';\n\n    alertButton.onclick = function() {\n        alert.style.display = 'none';\n    };\n}\n\n//# sourceURL=webpack://builder7-cf7-elementor-addon/./src/admin/admin-ajax.js?");

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