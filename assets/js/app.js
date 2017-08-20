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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "assets/js/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$.fn.serializeObject = function () {
  var o = {};
  var a = this.serializeArray();
  $.each(a, function () {
    if (o[this.name] !== undefined) {
      if (!o[this.name].push) {
        o[this.name] = [o[this.name]];
      }
      o[this.name].push(this.value || '');
    } else {
      o[this.name] = this.value || '';
    }
  });
  return o;
};

if (window.location.hash == '#_=_') {
  history.replaceState ? history.replaceState(null, null, window.location.href.split('#')[0]) : window.location.hash = '';
}

var SinglePageFixed = function ($) {
  var header = $('.HeaderWrap');
  var title = $('.SignlePage__headline');
  var w = $(window);

  function init() {
    if ($(".App.-single").length == 0) {
      return;
    };

    doIt();
    w.on('resize', doIt);
  }

  function doIt() {
    setTimeout(function () {
      if (window.innerWidth > 1024) {
        w.off('scroll.header').on('scroll.header', handleScroll);
      } else if (window.innerWidth <= 1024) {
        destroy();
      }
    }, 1000);
  }

  function destroy() {
    w.off('scroll.header');
    header.removeAttr('style');
    header.removeClass('-absolute');
    title.removeAttr('style');
  }

  function handleScroll(e) {
    var titlePos = title.offset().top;
    var headerHeight = header.outerHeight();
    var scrollPos = w.scrollTop();
    if (scrollPos + headerHeight >= titlePos) {
      header.addClass('-absolute');
      header.css({
        top: titlePos - headerHeight * 2
      });
    } else {
      header.removeClass('-absolute');
      header.css({ top: 0 });
    }
  }

  return {
    init: init,
    destroy: destroy
  };
}(jQuery);
SinglePageFixed.init();

$('.ui.dropdown').dropdown();

$('[data-action=listing-switch-map]').on('click', function () {
  $('.ListingMaps').toggleClass('-visible');
});

$('.ui.accordion').accordion({
  exclusive: false
});

$('ui.modal').modal('setting', 'transition', 'scale');

if (typeof $.fn.fancybox !== 'undefined') {
  $("[data-fancybox]").fancybox({
    clickContent: function clickContent(current, event) {
      return false;
    },
    buttons: ['thumbs', 'close']
  });
}

$('.PriceBlock__row').on('click', function () {
  var radio = $(this).find('input[type=radio]');
  radio.prop('checked', 'checked');
});

var ScrollMagic = function () {

  var doc = $(document);
  var scrollPos = $(document).scrollTop();
  var menuLinks = $('.ContentMenu li a');
  var activiClassName = 'current';
  var offset = 600;
  var headOffset = 173;

  function init() {
    doc.on("scroll", onScroll);
    menuLinks.on('click', smoothScroll);
  }

  function smoothScroll(e) {
    e.preventDefault();
    var targetId = $(this).attr('href');
    var refElement = $(targetId);

    $('html, body').animate({
      scrollTop: refElement.offset().top - headOffset
    }, 500);
  }

  function onScroll() {
    var scrollPos = $(document).scrollTop();
    menuLinks.each(function () {
      var curentLink = $(this);
      var targetId = $(this).attr('href');
      var refElement = $(targetId);
      var lastLink = menuLinks[menuLinks.length - 1];

      // TODO: More precise calculaction
      if (refElement.position().top + offset <= scrollPos) {
        menuLinks.removeClass(activiClassName);
        curentLink.addClass(activiClassName);
      } else {
        curentLink.removeClass(activiClassName);
        if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
          menuLinks.removeClass(activiClassName);
          curentLink.addClass(activiClassName);
        }
      }
    });
  }

  return {
    init: init
  };
}();

ScrollMagic.init();

var Sticky = function ($) {
  var singleMenuSticky = void 0,
      gymTitle = void 0,
      priceBlock = void 0;

  function init() {
    $.fn.sticky.settings.silent = true;
    cache();
    events();
  }

  function cache() {
    singleMenuSticky = $('.ContentMenu');
    priceBlock = $('.PriceBlock > .ui.sticky');
    gymTitle = $('.SignlePage__headline');
  }

  function events() {
    $(window).off('resize.sticky').on('resize.sticky', doSticky);
    $(window).trigger('resize.sticky');
  }

  function stickyInit() {
    gymTitle.sticky();
    priceBlock.sticky({
      offset: 71,
      context: '.SignlePage__sidebar.-center'
    });

    singleMenuSticky.sticky({
      offset: 168,
      context: '.SignlePage__sidebar.-center'
    });
  }

  function stickyDestory() {
    gymTitle.sticky('destroy').attr('style', "");

    priceBlock.sticky('destroy').attr('style', "");

    singleMenuSticky.sticky('destroy').attr('style', "");
  }

  function doSticky() {
    setTimeout(function () {
      if (window.innerWidth <= 1024) {
        stickyDestory();
      } else {
        stickyInit();
      }
    }, 1000);
  }

  return {
    init: init
  };
}(jQuery);
Sticky.init();

// $('.SignlePage__headline').sticky({
//   offset: 71
// });


var ProfileSwitch = function ($) {
  var menu = $('.ProfileMenu');
  var links = $('.ProfileMenu a');
  var mobileMenu = $('.SmMenu__menu1');
  var mobileMenuLinks = $('.SmMenu__menu1 > li > a');
  var SmMenu = $('.SmMenu');
  var sections = void 0;

  function init() {
    getSections();
    events();
    onLoad();
  }

  function events() {
    links.on('click', function (e) {
      e.preventDefault();
      location.hash = this.hash;
    });

    mobileMenuLinks.on('click', handleMobileLinks);

    $(window).on('hashchange', activate);
  }

  function handleMobileLinks(e) {
    SmMenu.hide();
  }

  function onLoad() {
    if (!location.hash || !location.hash == "#") {
      return;
    };
    try {
      $(location.hash);
    } catch (e) {
      return;
    }
    activateLink();
    activateMobileLink();
    setTimeout(function () {
      activateSection();
    }, 300);
  }

  function activate() {
    if (!location.hash || !location.hash == "#") {
      return;
    };
    try {
      $(location.hash);
    } catch (e) {
      return;
    }
    activateSection();
    activateLink();
    activateMobileLink();
  }

  function activateMobileLink() {
    var curent = mobileMenu.find("[href$='" + location.hash + "']");

    mobileMenuLinks.removeClass('active');
    curent.addClass('active');
  }

  function activateLink() {
    var curent = menu.find("[href='" + location.hash + "']");

    links.removeClass('active');
    curent.addClass('active');
  }

  function activateSection() {
    sections.hide();
    $(location.hash).show();
  }

  function getSections() {
    var idsArray = [];
    var idsString = "";
    links.each(function (k, el) {
      idsArray.push(el.hash);
    });
    sections = $(idsArray.join());
  }

  return {
    init: init
  };
}(jQuery);
ProfileSwitch.init();

var ShowMore = function () {
  var showMoreLink = $('[data-show-more-link]');

  function init() {
    $('body').on('click', '[data-show-more-link]', function (e) {
      e.preventDefault();
      var showMoreContainer = $(this).parents('[data-show-more]');
      var short = showMoreContainer.find('.Comment__description-short');
      var long = showMoreContainer.find('.Comment__description-long');
      short.hide();
      long.show();
    });
  }

  return {
    init: init
  };
}();

ShowMore.init();

var SinglePageHeader = function ($) {
  var header = $('.Header.md');

  function init() {
    if ($(".App.-single").length == 0) {
      return;
    };
    $(window).on('scroll', switchFixed);
  }

  function switchFixed(e) {}

  return {
    init: init
  };
}(jQuery);
SinglePageHeader.init();

var PaymentCard = function ($) {
  var activator = $('.PaymentAddCard__activator');
  var addNewCard = $('.PaymentAddNewCardForm');
  var form = $('.PaymentAddNewCardForm__form');
  var submit = $('.PaymentAddNewCardForm__button');
  var cardItem = $('.PaymentCardsItem').first();

  function init() {
    activator.on('click', function () {
      addNewCard.toggle();
    });

    // form.on('submit', function(e) {
    //   e.preventDefault();
    //   const cardItemclone = cardItem.clone();
    //   const data = $(this).serializeArray();
    //   cardItemclone.find('.PaymentCardsItem__title').text(data[0].value);
    //   $('.PaymentCardsList').append(cardItemclone);
    // })
    //
    // submit.on('click', function(e) {
    //   e.preventDefault();
    //   form.submit();
    // })
  }
  return {
    init: init
  };
}(jQuery);
PaymentCard.init();

var CheckPass = function () {
  var checkPass = $('[data-check-pass]');
  var checkPassValid = $('[data-check-pass-valid]');
  var checkPassExpire = $('[data-check-pass-expire]');
  var checkPassForm = $('[data-check-pass-form]');
  var checkPassNoFound = $('[data-check-pass-no-found]');

  var inProcess = false;

  function init() {
    checkPassForm.form({
      on: 'blur',
      fields: {
        password_ticket: {
          identifier: 'partnership_validator_pass',
          rules: [{
            type: 'empty',
            prompt: "Please enter a ticket's password"
          }]
        },
        password_gym: {
          identifier: 'partnership_gym_pass',
          rules: [{
            type: 'empty',
            prompt: "Please enter a gym's password"
          }]
        }
      }
    });
    checkPassForm.on('submit', validatePass);
  }

  function validatePass(e) {
    e.preventDefault();
    if (!checkPassForm.form('is valid')) {
      return false;
    };
    var checkPassFormData = checkPassForm.serializeObject();
    if (inProcess) {
      return;
    } else {
      inProcess = true;
    };
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'check_pass',
        pass: checkPassFormData.partnership_validator_pass,
        gym_pass: checkPassFormData.partnership_gym_pass,
        nonce: data.nonce
      }
    }).done(function (r) {
      console.log(r);
      if (r.success) {
        var name_el = $('.PartnershipValidator__holder');
        var entries_remain_el = $('.PartnershipValidator__entries-remain');
        var expire_date_el = $('.PartnershipValidator__expire-date');

        name_el.html(r.data.holder);
        entries_remain_el.html(r.data.entries_remain ? r.data.entries_remain : "–");
        expire_date_el.html(r.data.expire_date);

        if (r.data.type === 'valid') {
          checkPass.fadeOut(function () {
            checkPassValid.fadeIn();
          });
        } else if (r.data.type === 'expire') {
          checkPass.fadeOut(function () {
            checkPassExpire.fadeIn();
          });
        } else if (r.data.type === 'no found') {
          checkPass.fadeOut(function () {
            checkPassNoFound.fadeIn();
          });
        }
      } else if (r.success == false) {
        checkPassForm.form("add errors", [r.data.message]);
      }
    }).fail(function (e) {
      console.error(e.statusText);
      console.error(e.responseText);
    }).always(function () {
      inProcess = false;
    });
  }

  return {
    init: init
  };
}();
CheckPass.init();

var AjaxGlobalHandlers = function () {
  var doc = $(document);

  function init() {
    configure();
    handlers();
  }

  function configure() {
    NProgress.configure({
      trickleSpeed: 200,
      showSpinner: true
    });
  }

  function handlers() {
    doc.on('ajaxStart', function () {
      NProgress.start();
    });

    doc.on('ajaxComplete', function () {
      NProgress.done();
    });
  }

  return {
    init: init
  };
}();
AjaxGlobalHandlers.init();

var Basket = function () {
  var addBasketButton = $('[data-add-basket]');
  var removeBasketButton = $('[data-remove-basket]');
  var addBasketForm = $('[data-add-basket-form]');
  var redirectUrl = $('[data-add-basket-form]').attr('data-redirect');

  function init() {
    handlers();
  }

  function handlers() {
    addBasketButton.on('click', add);
    removeBasketButton.on('click', remove);
  }

  function add(e) {
    e.preventDefault();
    var basketData = addBasketForm.serializeObject();
    basketData.action = 'add_basket';
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: basketData
    }).done(function (r) {
      console.log(r);
      if (r.success) {
        NProgress.done();
        window.location = redirectUrl;
      } else {
        if (r.data.is_user_logged_in == false) {
          Auth.openModal();
        }
        console.log(r);
      }
    }).fail(function () {
      // console.log("error");
    });
  }

  function remove(e) {
    e.preventDefault();
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'remove_basket'
      }
    }).done(function (r) {
      if (r.success) {
        NProgress.done();
        window.location.reload();
      } else {
        console.log(r);
      }
    }).fail(function () {
      // console.log("error");
    });
  }

  return {
    init: init
  };
}();
Basket.init();

var Auth = function ($) {
  var loginForm = $('.LoginForm');
  var regForm = $('.RegForm');
  var forgotForm = $('.ForgotPassForm');
  var facebookLogin = $('[data-login="facebook"]');
  var googleLogin = $('[data-login="google"]');
  var openModalLink = $('[data-open-modal-auth]');
  var authModal = $('.AuthModal.ui.modal');
  var switchers = $('[data-switch-modal]');
  var mobileOpenModalLink = $('[data-mobile-modal]');

  function init() {
    validationsInit();
    openModalLink.on('click', openModalHandler);
    loginForm.on('submit', login);
    regForm.on('submit', register_user);
    forgotForm.on('submit', forgotPassword);
    facebookLogin.on('click', login_via_facebook);
    googleLogin.on('click', login_via_google_oauth);
    switchers.on('click', switchForms);
    mobileOpenModalLink.on('click', openModalMobileHandler);
  }

  function switchForms(e) {
    e.preventDefault();
    var switcher = $(this);
    var destination = switcher.attr('href');
    var destinationForm = $(destination);
    var switcherForm = authModal.find('form.ui.form');
    switcherForm.hide();
    destinationForm.show();
  }

  function openModalHandler(e) {
    e.preventDefault();
    openModal();
  }
  function openModalMobileHandler(e) {
    e.preventDefault();
    openModal();
    switchForms.call(this, e);
  }

  function openModal() {
    authModal.modal('show');
  }

  function validationsInit() {
    loginForm.form({
      on: 'blur',
      fields: {
        login_email: 'email',
        login_password: 'empty'
      }
    });

    regForm.form({
      on: 'blur',
      fields: {
        user_first_name: 'empty',
        user_last_name: 'empty',
        user_email_register: 'email',
        user_password_register: 'empty'
      }
    });

    forgotForm.form({
      on: 'blur',
      fields: {
        forgot_email: 'email'
      }
    });
  }

  function login(e) {
    e.preventDefault();

    if (loginForm.form('is valid') === false) {
      return false;
    }

    var loginFields = loginForm.serializeObject();
    var login_email = loginFields.login_email;
    var login_password = loginFields.login_password;
    var security = loginFields.security_login;
    var ajaxurl = data.adminAjax;

    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajaxurl,
      data: {
        'action': 'ajax_loginx_form',
        'login_email': login_email,
        'login_password': login_password,
        'security_login': security
      },
      success: function success(r) {
        if (r.success) {
          window.location.reload();
        } else {
          loginForm.form("add errors", [r.data.message]);
        }
      },
      error: function error(e) {
        console.log(e);
      }
    });
  }

  function register_user(e) {
    e.preventDefault();

    if (regForm.form('is valid') === false) {
      return false;
    }

    var regFields = regForm.serializeObject();

    var user_first_name_register = regFields.user_first_name_register;
    var user_last_name_register = regFields.user_last_name_register;
    var user_email_register = regFields.user_email_register;
    var user_password_register = regFields.user_password_register;
    var ajaxurl = data.adminAjax;
    var security_register = regFields.security_register;

    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajaxurl,
      data: {
        'action': 'ajax_register_user',
        'security_register': security_register,
        'user_first_name': user_first_name_register,
        'user_last_name': user_last_name_register,
        'user_email_register': user_email_register,
        'user_password_register': user_password_register
      },
      success: function success(r) {
        if (r.success) {
          regForm.find('.ui.small.info.message').hide();
          regForm.find('.ui.small.success.message').html(r.data.message);
          setTimeout(function () {
            $('form.ui.form').hide();
            $('#LoginForm').show();
          }, 3000);
        } else {
          regForm.form("add errors", [r.data.message]);
        }
      },
      error: function error(e) {
        console.log(e);
      }
    });
  }

  function login_via_facebook(e) {
    e.preventDefault();

    var ajaxurl = data.adminAjax;
    var login_type = 'facebook';
    jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
        'action': 'ajax_facebook_login'
      },
      success: function success(r) {
        console.log(r);
        if (r.success) {
          window.location = r.data.url;
        }
      },
      error: function error(errorThrown) {}
    });
  }

  function login_via_google_oauth(e) {
    e.preventDefault();
    gapi.load('client', function () {
      gapi.client.init({
        apiKey: data.google_api_key,
        clientId: data.google_oauth_api,
        scope: 'profile'
      }).then(function () {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signIn({
          scope: 'profile email'
        }).then(function (r) {
          var profile = auth2.currentUser.get().getBasicProfile();
          var userData = {
            googleId: profile.getId(),
            fullName: profile.getName(),
            firstName: profile.getGivenName(),
            lastName: profile.getFamilyName(),
            userEmail: profile.getEmail(),
            imageUrl: profile.getImageUrl()
          };

          $.ajax({
            url: data.adminAjax,
            type: 'POST',
            data: {
              action: 'ajax_google_login_oauth',
              userData: userData
            }
          }).done(function (r) {
            console.log(r);
            if (r.success) {
              window.location.reload();
            }
          }).fail(function (e) {
            console.log(e);
          });
        });
      });
    });
  }

  function forgotPassword(e) {
    e.preventDefault();

    if (forgotForm.form('is valid') === false) {
      return false;
    }

    var forgotFields = forgotForm.serializeObject();
    var forgot_email = forgotFields.forgot_email;
    var securityforgot = forgotFields.security_forgot;
    var ajaxurl = data.adminAjax;

    jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
        'action': 'ajax_forgot_pass',
        'forgot_email': forgot_email,
        'security-forgot': securityforgot
      },

      success: function success(r) {
        if (r.success) {
          forgotForm.find('.ui.small.success.message').html(r.data.message);
        } else {
          forgotForm.form("add errors", [r.data.message]);
        }
      },
      error: function error(e) {
        console.log(e);
        forgotForm.form("add errors", [r.data.message]);
      }
    });
  }

  return {
    openModal: openModal,
    init: init
  };
}(jQuery);

Auth.init();

var Profile = function ($) {
  var profileForm = $('[data-profile-update]');
  var submitButton = $('[data-profile-submit]');
  var canselButton = $('[data-profile-cancel]');
  function init() {
    validation();
    profileForm.on('submit', profileUpdate);
  }

  function validation() {
    profileForm.form({
      on: 'blur',
      fields: {
        first_name: 'empty',
        last_name: 'empty',
        email: 'email'
      }
    });
  }

  function profileUpdate(e) {
    e.preventDefault();
    if (profileForm.form('is valid') === false) {
      return false;
    }

    var profileFields = profileForm.serializeObject();

    $.ajax({
      type: 'POST',
      url: data.adminAjax,
      data: {
        'action': 'update_user_profie',
        'fields': profileFields,
        'nonce': data.nonce
      }
    }).done(function (r) {
      if (r.success) {
        var successMessage = profileForm.find('.ui.success.message');
        successMessage.show().html(r.data.message);
        setTimeout(function () {
          successMessage.hide();
        }, 2000);
      } else {
        var errors = [];
        $.each(r.data.errors, function (key, el) {
          errors.push(el);
        });
        profileForm.form("add errors", errors);
        profileForm.form("add errors", r.data.message);
      }
    }).fail(function (e) {
      console.log(e);
    });
  }
  return {
    init: init
  };
}(jQuery);
Profile.init();

var ProfileAvatarUpload = function ($) {
  var imageInput = $('#ProfileUploadForm__image');
  var avatarMessage = $('[data-profile-avatar-message]');
  var profileAvatar = $('.Profile__avatar');
  var headerAvatar = $('.LoggedInUserDropdown__avatar');
  var mobileMenuAvatar = $('.SmMenu__userAvatar');
  var delteAvatar = $('[data-profile-avatar-delete]');
  function init() {
    imageInput.on('change', upload);
    delteAvatar.on('click', remove);
  }

  function upload(e) {
    var input = $(this);
    var fileList = this.files;
    var form = new FormData();
    var image = fileList[0];
    avatarMessage.hide();
    form.append('profile_upload_avatar', image);
    form.append('action', 'upload_avatar');
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      processData: false,
      contentType: false,
      data: form
    }).done(function (r) {
      input.val('');
      if (r.success) {
        profileAvatar.css({
          backgroundImage: 'url(' + r.data.url + ')'
        });
        mobileMenuAvatar.css({
          backgroundImage: 'url(' + r.data.url + ')'
        });
        headerAvatar.attr('src', r.data.url);
        input.val('');
      } else {
        console.log(r);
        if (r.data.error) {
          avatarMessage.show().html(r.data.error);
        }
      }
    }).fail(function (e) {
      console.log(e);
    });
  }

  function remove(e) {
    e.preventDefault();
    console.log('remove');
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'remove_avatar'
      }
    }).done(function (r) {
      if (r.success) {
        profileAvatar.css({
          backgroundImage: ''
        });
      } else {
        console.log(r.data.error);
      }
    }).fail(function (e) {
      console.log(e);
    });
  }

  return {
    init: init
  };
}(jQuery);
ProfileAvatarUpload.init();

var Rating = exports.Rating = function () {
  var nonIteractiveRating = void 0;
  var favorite = void 0;
  var inProcess = void 0;

  function init() {

    nonIteractiveRating = $('.ui.rating');
    favorite = $('.GymFavorite');
    inProcess = false;

    nonIteractiveRating.rating({
      maxRating: 5,
      interactive: false
    });

    favorite.rating({
      interactive: true,
      onRate: function onRate() {
        if (data.userId) {
          saveFavoriteGym.call(this);
        } else {
          Auth.openModal();
        }
      }
    });
  }

  function saveFavoriteGym() {
    var el = $(this);
    var gymId = el.attr('data-gym-id');
    if (inProcess) {
      return;
    } else {
      inProcess = true;
    };
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'save_favorite_gym',
        nonce: data.nonce,
        gym_id: gymId
      }
    }).done(function (r) {
      console.log(r);
      if (r.success) {
        el.rating('set rating', r.data.rating);
      }
    }).fail(function (e) {
      console.log(e);
    }).always(function () {
      inProcess = false;
    });
  }

  return {
    init: init
  };
}();
Rating.init();

var Reviews = function () {
  var commentContainer = $('.Comments__body');
  var profileReviewContainer = $('.ProfileComments__list');
  var reviewRating = $('[data-review-rating]');
  var reviewForm = $('[data-review-form]');
  var ratingInput = $('#rating');
  var loadMoreReviewLink = $('[data-load-more-review]');
  var loadMoreProfileReviewLink = $('[data-load-more-profile-review]');

  var inProcess = false;

  function init() {
    var _reviewRating$rating;

    reviewForm.form({
      on: 'blur',
      fields: {
        review_textarea: 'empty',
        rating: ['integer[1..5]', 'empty']
      }
    });

    reviewRating.rating((_reviewRating$rating = {
      maxRating: 5,
      interactive: true,
      initialRating: 5
    }, _defineProperty(_reviewRating$rating, 'maxRating', 5), _defineProperty(_reviewRating$rating, 'onRate', function onRate(val) {
      ratingInput.val(val);
    }), _reviewRating$rating));

    reviewForm.on('submit', addReview);
    loadMoreReviewLink.on('click', loadMoreReview);
    loadMoreProfileReviewLink.on('click', loadMoreProfileReview);
  }

  function loadMoreProfileReview(e) {
    e.preventDefault();
    if (inProcess === true) {
      return false;
    }
    inProcess = true;

    var review_per_page = loadMoreProfileReviewLink.attr('data-review-per-page');
    var offset = profileReviewContainer.find('.ProfileComments__item').length;

    $.ajax({
      url: data.adminAjax,
      type: 'GET',
      data: {
        action: 'load_more_profile_review',
        review_per_page: review_per_page,
        offset: offset
      }
    }).done(function (r) {
      profileReviewContainer.append(r);
      if (r.success === false) {
        console.log(r.data.message);
        loadMoreProfileReviewLink.fadeOut();
      }
    }).fail(function (e) {
      console.log(e);
    }).always(function () {
      inProcess = false;
    });
  }

  function loadMoreReview(e) {
    e.preventDefault();
    if (inProcess === true) {
      return false;
    }
    inProcess = true;

    var review_per_page = loadMoreReviewLink.attr('data-review-per-page');
    var gym_id = loadMoreReviewLink.attr('data-gym-id');
    var offset = commentContainer.find('.Comment').length;

    $.ajax({
      url: data.adminAjax,
      type: 'GET',
      data: {
        action: 'load_more_review',
        review_per_page: review_per_page,
        offset: offset,
        gym_id: gym_id
      }
    }).done(function (r) {
      commentContainer.append(r);
      if (r.success === false) {
        console.log(r.data.message);
        loadMoreReviewLink.fadeOut();
      }
    }).fail(function (e) {
      console.log(e);
    }).always(function () {
      inProcess = false;
    });
  }

  function addReview(e) {
    e.preventDefault();
    if (reviewForm.form('is valid') === false) {
      return;
    }
    if (inProcess === true) {
      return false;
    }
    inProcess = true;

    var reviewData = reviewForm.serializeObject();
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'add_review',
        nonce: data.nonce,
        subject: reviewData.subject,
        review: reviewData.review_textarea,
        rating: reviewData.rating,
        gym_id: reviewData.gym_id

      }
    }).done(function (r) {
      console.log(r);
      if (r.success) {
        window.location.reload();
      } else {
        reviewForm.form("add errors", [r.data.message]);
      }
    }).fail(function (e) {
      console.log(e);
    }).always(function () {
      inProcess = false;
    });
  }

  return {
    init: init
  };
}();
Reviews.init();

var Favorites = function () {
  var loadMoreFavoritesLink = $('[data-load-more-favorites]');
  var profileFavoritesContainer = $('.FavoriteList');
  var inProcess = false;

  function init() {
    loadMoreFavoritesLink.on('click', loadMoreFavorites);
  }

  function loadMoreFavorites(e) {
    e.preventDefault();
    if (inProcess === true) {
      return false;
    }
    inProcess = true;

    var favorites_per_page = loadMoreFavoritesLink.attr('data-favorites-per-page');
    var offset = profileFavoritesContainer.find('.FavoriteListItem').length;

    $.ajax({
      url: data.adminAjax,
      type: 'GET',
      data: {
        action: 'load_more_favorites',
        favorites_per_page: favorites_per_page,
        offset: offset
      }
    }).done(function (r) {
      profileFavoritesContainer.append(r);
      if (r.success === false) {
        console.log(r);
        loadMoreFavoritesLink.fadeOut();
      }
    }).fail(function (e) {
      console.log(e);
    }).always(function () {
      inProcess = false;
    });
  }

  return {
    init: init
  };
}();

Favorites.init();

var Uri = exports.Uri = function () {

  function extend(extendObj) {
    var uri = path(extendObj);
    $.uriAnchor.setAnchor(uri);
  }

  function path(extendObj) {
    var uri = $.uriAnchor.makeAnchorMap();
    extendObj = extendObj || {};
    $.extend(true, uri, extendObj);
    return uri;
  }

  return {
    extend: extend,
    path: path
  };
}();

var Filter = function () {
  var filterTrigger = $('.ListingFilter__trigger');
  var filterMenu = $('.ListingFilter__menu');
  var filterMapButton = $('[data-map-filter-button]');
  var filterMapForm = $('[data-filter-map-form]');
  var showMoreActivitiesLink = $('[data-show-more-activities]');
  function init() {
    events();
  }

  function events() {
    filterTrigger.on('click', function () {
      $(this).toggleClass('-open');
      filterMenu.toggle();
    });
    filterMapButton.on('click', updateFilterUri);
    showMoreActivitiesLink.on('click', showMoreActivities);
  }

  function showMoreActivities(e) {
    e.preventDefault();
    $('[data-hide]').toggle();
    // showMoreActivitiesLink.hide();
  }

  function updateFilterUri(e) {
    e.preventDefault();
    // let filterData = filterMapForm.serializeObject();
    var filterData = filterMapForm.serializeObject();
    filterData.type = 'filter';
    filterData.page = '1';
    // Workarround if no checkbox selected
    filterData.activity = filterData.activity || "";
    Uri.extend(filterData);
  }

  return {
    init: init
  };
}();
Filter.init();

var ListingPagination = function () {
  function init() {
    $('body').on('click', '.ListingPagination a.page-numbers', function (e) {
      e.preventDefault();
      var pageNumber = $(this).html();
      Uri.extend({
        type: 'pagination',
        page: pageNumber
      });
    });
  }
  return {
    init: init
  };
}();
ListingPagination.init();

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$('.SmOpener').on('click', toggleMobileMenu);

function toggleMobileMenu(e) {
  $('.SmOpener').toggleClass('open');
  $('.SmMenu').toggle();
}

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var url = data.adminAjax + '?action=search&q={query}';
$('.HeroSearch__field, .Header__search, .SmMenu__search').search({
  apiSettings: {
    action: 'search',
    cache: false,
    url: url
  },
  fields: {
    actionURL: 'url'
  },
  searchFullText: false,
  searchFields: ['title']
});

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _uiInit = __webpack_require__(0);

var GM = function ($) {
	var map = void 0;
	var infowindow = void 0;
	var mapcluster = void 0;
	var is_fit_bounds = false;
	var inProcess = false;
	var isfirstTimeLoaded = void 0;

	var singleMap = $('.wellwhere-map');
	var clusterIcon = singleMap.attr('data-cluster-icon');
	var mapStyles = JSON.parse(mapData.styles);
	var listingItemsContainer = $('.ContainerListingItems');
	var listingsContainer = $('.ListingItems');

	function init() {
		$(window).on('hashchange', handleHashChange);
		firstTimeLoad();

		singleMap.each(function () {
			map = new_map($(this));
			if ($(this).is('[data-listing-map]')) {
				handleMapMovement(map);
			}
		});
	}

	function firstTimeLoad() {
		$(document).ready(function () {
			var uriMap = $.uriAnchor.makeAnchorMap();
			isfirstTimeLoaded = true;
			handleHashChange();
			// console.log(uriMap);
			if (uriMap.rating) {
				$('.ListingFilter__rating-field').dropdown('set selected', uriMap.rating);
			}
			if (uriMap.gender) {
				$('.ListingFilter__gender-field').dropdown('set selected', uriMap.gender);
			}
			if (uriMap.activity) {
				var activityArray = uriMap.activity.split(',');
				$('.ListingFilter__activity-field').checkbox('uncheck');
				$.each(activityArray, function (index, val) {
					var checkbox = $('input[name="activity"][value="' + val + '"]');
					checkbox.parent('.ListingFilter__activity-field').checkbox('check');
				});
			}
		});
	}

	function handleHashChange(e) {
		var uriMap = $.uriAnchor.makeAnchorMap();
		if (uriMap.type == 'map' || uriMap.type == 'filter' || uriMap.type == 'pagination') {
			listingsContainer.dimmer('show');
			// if ( inProcess ) { return } else { inProcess = true };
			$.ajax({
				url: data.adminAjax,
				type: 'GET',
				data: {
					action: 'get_gyms_by_uri',
					uri: uriMap
				}
			}).done(function (r) {
				console.log(r);
				if (r.success) {
					dealListingItems(r.data.markers, r.data.pagination);
					clearAllMarkers();
					if (mapcluster) {
						mapcluster.clearMarkers();
					}
					$.each(r.data.markers, function (index, el) {
						add_marker(el.lat, el.lng, el.pin, el.html, map);
					});
					if (uriMap.type == 'filter' || uriMap.type == 'pagination' || isfirstTimeLoaded == true) {
						wellwhereFitBounds();
					}
					if (mapcluster) {
						mapcluster.clearMarkers();
						mapcluster.addMarkers(map.markers);
					} else {
						if (map.markers.length > 1) {
							mapcluster = cluster(map, map.markers);
						}
					}
				} else {
					removeListingItems();
					clearAllMarkers();
				}
			}).fail(function (e) {
				console.log(e.statusText);
			}).always(function () {
				isfirstTimeLoaded = false;
				inProcess = false;
			});
		};
	}

	function handleMapMovement(map) {
		google.maps.event.addListener(map, 'bounds_changed', mapMovement);
		// google.maps.event.addListener(map, 'dragend', mapMovement);
		// google.maps.event.addListener(map, 'zoom_changed', mapMovement);
	}

	function clearAllMarkers() {
		while (map.markers.length) {
			map.markers.pop().setMap(null);
		}
	}

	function dealListingItems(listingItems, $pagination) {
		listingItemsContainer.html("");
		$.each(listingItems, function (index, item) {
			listingItemsContainer.append(item.listingItem);
		});
		_uiInit.Rating.init();
		if ($pagination) {
			listingItemsContainer.append($pagination);
		}
		listingsContainer.dimmer('hide');
	}

	function removeListingItems() {
		listingItemsContainer.html("");
	}

	function mapMovement() {
		var bounds = {};
		if (is_fit_bounds) {
			return;
		}
		bounds.lat_TR = map.getBounds().getNorthEast().lat();
		bounds.lng_TR = map.getBounds().getNorthEast().lng();
		bounds.lat_BL = map.getBounds().getSouthWest().lat();
		bounds.lng_BL = map.getBounds().getSouthWest().lng();

		var mapUri = {
			type: 'map',
			map: 'listing',
			page: 1,
			_map: bounds
		};

		_uiInit.Uri.extend(mapUri);
	}

	function new_map($el) {
		var $markers = $el.find('.marker');
		var scrollwheel = $el.attr('data-scrollwheel') || false;
		var args = {
			zoom: 16,
			center: new google.maps.LatLng(0, 0),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: scrollwheel,
			streetViewControl: false,
			mapTypeControl: false,
			styles: mapStyles,
			// TODO. Probably need to remove
			gestureHandling: "greedy"
		};

		// create map
		map = new google.maps.Map($el[0], args);

		// add a markers reference
		map.markers = [];

		// add markers
		$markers.each(function () {
			var lat = $(this).attr('data-lat');
			var lng = $(this).attr('data-lng');
			var pin = $(this).attr('data-icon');
			var markerHtml = $(this).html();
			// map.markers
			add_marker(lat, lng, pin, markerHtml, map);
		});

		wellwhereFitBounds();
		return map;
	}

	function add_marker(lat, lng, pin, markerHtml, map) {
		var latlng = new google.maps.LatLng(lat, lng);

		// create marker
		var marker = new google.maps.Marker({
			position: latlng,
			// animation: google.maps.Animation.DROP,
			map: map,
			icon: pin
		});

		// add to array
		map.markers.push(marker);

		// if marker contains HTML, add it to an infoWindow
		if (markerHtml) {
			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function () {
				if (infowindow) {
					infowindow.close();
				}
				infowindow = new InfoBox({
					alignBottom: true,
					maxWidth: 343,
					pixelOffset: new google.maps.Size(-171, -80),
					closeBoxURL: data.url + "/assets/img/icon-svg-error.svg",
					content: markerHtml
				});
				infowindow.open(map, marker);
			});
		}
	}

	// function center_map( map ) {
	// 	let bounds = new google.maps.LatLngBounds();
	// 	// loop through all markers and create bounds
	// 	$.each( map.markers, function( i, marker ){

	// 		let latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

	// 		bounds.extend( latlng );

	// 	});

	// 	wellwhereFitBounds();
	// }

	function cluster(map, markers) {
		return new MarkerClusterer(map, markers, {
			styles: [{
				url: 'http://wellwhere.lm/wp-content/themes/wellwhere/assets/img/map-marker-red-round.png',
				height: 50,
				width: 50,
				textColor: "#fff",
				textSize: 14
			}]
		});
	}

	function wellwhereFitBounds() {
		is_fit_bounds = true;
		var bounds = new google.maps.LatLngBounds();
		// loop through all markers and create bounds
		$.each(map.markers, function (i, marker) {
			var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
			bounds.extend(latlng);
		});

		if (map.markers.length == 1) {
			// set center of map
			map.setCenter(bounds.getCenter());
			map.setZoom(16);

			google.maps.event.addListenerOnce(map, 'idle', function () {
				is_fit_bounds = false;
			});
		} else {
			map.fitBounds(bounds);
			mapcluster = cluster(map, map.markers);

			google.maps.event.addListenerOnce(map, 'idle', function () {
				is_fit_bounds = false;
			});
		}
	}

	return {
		init: init
	};
}(jQuery);
GM.init();

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$('.SliderGyms').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  infinite: false,
  appendArrows: $('.SliderContainer'),
  nextArrow: '<img class="SliderGyms__nextArrow" src="' + data.url + '/assets/img/arrow.svg" alt="">',
  prevArrow: '<img class="SliderGyms__prevArrow" src="' + data.url + '/assets/img/arrow.svg" alt="">',
  responsive: [{
    breakpoint: 1025,
    settings: {
      arrows: false,
      slidesToShow: 2.5
    }
  }, {
    breakpoint: 768,
    settings: {
      arrows: false,
      slidesToShow: 1.5
    }
  }]
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var StripeModule = function ($) {
  var userId = data.userId;
  var chargeInProcess = false;
  function stripeForm() {
    if ($('#card-element').length === 0) {
      return false;
    }
    // Create a Stripe client
    var stripe = Stripe('pk_test_G6LDMUdv0HThh4NSY4ZEY0fw');

    // Create an instance of Elements
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        lineHeight: '24px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };

    // Create an instance of the card Element
    var card = elements.create('card', { style: style, hidePostalCode: true });

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function (event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      stripe.createToken(card).then(function (result) {
        if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server
          saveToken(result.token);
        }
      });
    });
  }

  function saveToken(token) {
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'save_card',
        stripe_token: token,
        user_id: userId
      }
    }).done(function (result) {
      NProgress.done();
      window.location.reload();
    }).fail(function (e) {
      console.error(e);
      NProgress.done();
    });
  }

  function chargeSource(e) {
    e.preventDefault();
    if (chargeInProcess === true) {
      return;
    }
    chargeInProcess = true;
    var card_id = $("[data-card-id]").attr('data-card-id');
    var redirectUrl = $(this).attr('data-redirect');
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'charge_source',
        card_id: card_id,
        user_id: userId
      }
    }).done(function (r) {
      console.log(r);
      if (r.success) {
        window.location.replace(redirectUrl + '?pdf_filename=' + r.data.pdf_filename);
      }
    }).fail(function (e) {
      console.error(e);
    }).always(function () {
      chargeInProcess = false;
    });
  }

  function removeCard(e) {
    e.preventDefault();
    var card_id = $(this).parents('[data-card-id]').attr('data-card-id');
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'remove_card',
        card_id: card_id
      }
    }).done(function (result) {
      if (result.success) {
        console.log(result);
        window.location.reload();
        NProgress.done();
      } else {
        console.log(result);
        NProgress.done();
      }
    }).fail(function (e) {
      console.error(e);
      NProgress.done();
    });
  }

  function handlers() {
    $('body').on('click', '[data-charge]', chargeSource);
    $('body').on('click', '[data-card-remove]', removeCard);
  }

  function init() {
    stripeForm();
    handlers();
  }

  return {
    init: init
  };
}(jQuery);

StripeModule.init();

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(2);

__webpack_require__(0);

__webpack_require__(4);

__webpack_require__(3);

__webpack_require__(5);

__webpack_require__(1);

/***/ })
/******/ ]);
//# sourceMappingURL=app.js.map