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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./resources/scripts/admin/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./config.json":
/*!*********************!*\
  !*** ./config.json ***!
  \*********************/
/*! exports provided: variables, development, release, default */
/***/ (function(module) {

module.exports = {"variables":{"color":{"material-red":"#f44336","material-pink":"#e91e63","material-purple":"#9c27b0","material-deep-purple":"#673ab7","material-indigo":"#3f51b5","material-blue":"#2196f3","material-light-blue":"#03a9f4","material-cyan":"#00bcd4","material-teal":"#009688","material-green":"#4caf50","material-light-green":"#8bc34a","material-lime":"#cddc39","material-yellow":"#ffeb3b","material-amber":"#ffc107","material-orange":"#ff9800","material-deep-orange":"#ff5722","material-brown":"#795548","material-grey":"#9e9e9e","material-blue-grey":"#607d8b"},"font-size":{"xs":"12px","s":"16px","m":"20px","l":"28px","xl":"36px"}},"development":{"url":"http://quangminhist.local/","port":3000},"release":{"include":["app","dist","languages","theme","vendor",".htaccess","config.json","LICENSE","README.md"]}};

/***/ }),

/***/ "./resources/scripts/admin/_admin.js":
/*!*******************************************!*\
  !*** ./resources/scripts/admin/_admin.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(jQuery, $) {

var stcAdminScripts = {
    frame: null,

    init: function init() {
        this.frame = wp.media({
            title: 'Chọn hình ảnh',
            button: {
                text: 'Sử dụng hình ảnh này'
            },
            multiple: false });
        this.bindEvents();
    },

    bindEvents: function bindEvents() {
        var _this = this;
        jQuery(document).on('click', '[data-trigger-toggle-feature]', function (e) {
            e.preventDefault();
            _this.disableTheGrid();
            var thisButton = jQuery(this);
            jQuery.post('/wp-admin/admin-ajax.php', {
                action: 'toggle_is_feature',
                post_id: jQuery(this).data('post-id')
            }, function (response) {
                if (response.success === true) {
                    if (thisButton.hasClass('dashicons-yes')) {
                        thisButton.removeClass('dashicons-yes').addClass('dashicons-no');
                    } else {
                        thisButton.removeClass('dashicons-no').addClass('dashicons-yes');
                    }
                }
                _this.enableTheGrid();
            });
        });

        jQuery(document).on('click', '[data-trigger-change-thumbnail-id]', function () {

            var postId = jQuery(this).data('post-id');
            var thisButton = jQuery(this);
            var frame = wp.media({
                title: 'Chọn hình ảnh',
                button: {
                    text: 'Sử dụng hình ảnh này'
                },
                multiple: false });
            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                console.log(attachment);
                var attachmentId = attachment.id;
                _this.disableTheGrid();
                jQuery.post('/wp-admin/admin-ajax.php', {
                    action: 'update_post_thumbnail_id',
                    post_id: postId,
                    attachment_id: attachmentId
                }, function (response) {
                    if (response.success === true) {
                        thisButton.find('img').attr('src', attachment.sizes.thumbnail.url);
                    }
                    _this.enableTheGrid();
                });
            });
            frame.open();
        });
    },

    openMediaGallery: function openMediaGallery() {
        if (this.frame) {
            this.frame.open();
        }
    },

    disableTheGrid: function disableTheGrid() {
        jQuery('form#posts-filter').append('<div class="gm-loader" style="position:absolute;z-index:99999999;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;background-color:rgba(192,192,192,0.51);color:#000000">\u0110ang c\u1EADp nh\u1EADt</div>');
    },

    enableTheGrid: function enableTheGrid() {
        jQuery('form#posts-filter').find('.gm-loader').remove();
    },

    initSocialLogin: function initSocialLogin() {
        $('.gm-social-login__item').click(function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var title = $(this).data('title');
            var w = 800;
            var h = 400;
            var left = screen.width / 2 - w / 2;
            var top = screen.height / 2 - h / 2;
            window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        });
    },

    socialLoginReturn: function socialLoginReturn(result) {
        if (result.success === true) {
            window.location.href = result.redirect;
        }
    }
};

jQuery(function () {
    stcAdminScripts.init();
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery"), __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./resources/scripts/admin/_custom_thumbnail_support.js":
/*!**************************************************************!*\
  !*** ./resources/scripts/admin/_custom_thumbnail_support.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(jQuery, $) {

var mediaGridObserver = new MutationObserver(function (mutations) {
    for (var i = 0; i < mutations.length; i++) {
        for (var j = 0; j < mutations[i].addedNodes.length; j++) {
            var element = jQuery(mutations[i].addedNodes[j]);

            if (element.attr('class')) {
                var elementClass = element.attr('class');

                if (element.attr('class').indexOf('attachment') !== -1) {
                    var attachmentPreview = element.children('.attachment-preview');
                    if (attachmentPreview.length !== 0) {
                        if (attachmentPreview.attr('class').indexOf('subtype-svg+xml') !== -1) {

                            var handler = function (element) {
                                jQuery.ajax({
                                    url: '/wp-admin/admin-ajax.php',
                                    type: "POST",
                                    dataType: 'html',
                                    data: {
                                        'action': 'stc_get_attachment_url_thumbnail',
                                        'attachmentID': element.attr('data-id')
                                    },
                                    success: function success(data) {
                                        if (data) {
                                            element.find('img').attr('src', data);
                                            element.find('.filename').text('SVG Image');
                                        }
                                    }
                                });
                            }(element);
                        }
                    }
                }
            }
        }
    }
});

var attachmentPreviewObserver = new MutationObserver(function (mutations) {
    for (var i = 0; i < mutations.length; i++) {
        for (var j = 0; j < mutations[i].addedNodes.length; j++) {
            var element = $(mutations[i].addedNodes[j]);
            var onAttachmentPage = false;
            if (element.hasClass('attachment-details') || element.find('.attachment-details').length != 0) {
                onAttachmentPage = true;
            }

            if (onAttachmentPage == true) {
                var urlLabel = element.find('label[data-setting="url"]');
                if (urlLabel.length != 0) {
                    var value = urlLabel.find('input').val();
                    element.find('.details-image').attr('src', value);
                }
            }
        }
    }
});

jQuery(document).ready(function () {
    mediaGridObserver.observe(document.body, {
        childList: true,
        subtree: true
    });
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "jquery"), __webpack_require__(/*! jquery */ "jquery")))

/***/ }),

/***/ "./resources/scripts/admin/index.js":
/*!******************************************!*\
  !*** ./resources/scripts/admin/index.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _config = __webpack_require__(/*! @config */ "./config.json");

var _config2 = _interopRequireDefault(_config);

__webpack_require__(/*! @styles/admin */ "./resources/styles/admin/index.scss");

__webpack_require__(/*! @scripts/admin/_admin.js */ "./resources/scripts/admin/_admin.js");

__webpack_require__(/*! @scripts/admin/_custom_thumbnail_support.js */ "./resources/scripts/admin/_custom_thumbnail_support.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/***/ }),

/***/ "./resources/styles/admin/index.scss":
/*!*******************************************!*\
  !*** ./resources/styles/admin/index.scss ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = jQuery;

/***/ })

/******/ });
//# sourceMappingURL=admin.js.map