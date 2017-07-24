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


$('.SmOpener').on('click', toggleMobileMenu);

function toggleMobileMenu(e) {
  $('.SmOpener').toggleClass('open');
  $('.SmMenu').toggle();
}

/***/ }),
/* 1 */
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
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var GM = function ($) {
  var map = void 0;
  var singleMap = $('.wellwhere-map');
  var clusterIcon = singleMap.attr('data-cluster-icon');
  var mapStyles = JSON.parse(mapData.styles);
  function init() {
    singleMap.each(function () {
      map = new_map($(this));
    });
  }

  function new_map($el) {
    var $markers = $el.find('.marker');
    var args = {
      zoom: 16,
      center: new google.maps.LatLng(0, 0),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false,
      streetViewControl: false,
      mapTypeControl: false,
      styles: mapStyles
    };

    // create map
    var map = new google.maps.Map($el[0], args);

    // add a markers reference
    map.markers = [];

    // add markers
    $markers.each(function () {

      add_marker($(this), map);
    });

    // center map
    center_map(map);

    // return
    return map;
  }

  function add_marker($marker, map) {

    var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
    var pin = $marker.attr('data-icon');

    // create marker
    var marker = new google.maps.Marker({
      position: latlng,
      animation: google.maps.Animation.DROP,
      map: map,
      icon: pin
    });

    // add to array
    map.markers.push(marker);

    // if marker contains HTML, add it to an infoWindow
    if ($marker.html()) {
      // create info window
      var infowindow = new google.maps.InfoWindow({
        content: $marker.html()
      });

      // show info window when marker is clicked
      google.maps.event.addListener(marker, 'click', function () {

        infowindow.open(map, marker);
      });
    }
  }

  function center_map(map) {
    var bounds = new google.maps.LatLngBounds();

    // loop through all markers and create bounds
    $.each(map.markers, function (i, marker) {

      var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

      bounds.extend(latlng);
    });

    // only 1 marker?
    if (map.markers.length == 1) {
      // set center of map
      map.setCenter(bounds.getCenter());
      map.setZoom(16);
    } else {
      // fit to bounds
      map.fitBounds(bounds);
      var markerCluster = new MarkerClusterer(map, map.markers, {
        styles: [{
          url: 'http://wellwhere.lm/wp-content/themes/wellwhere/assets/img/map-marker-red-round.png',
          height: 50,
          width: 50,
          textColor: "#fff",
          textSize: 14
        }]
      });
    }
  }

  return {
    init: init
  };
}(jQuery);
GM.init();

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$('.SliderGyms').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  infinite: true,
  appendArrows: $('.SliderContainer'),
  nextArrow: '<img class="SliderGyms__nextArrow" src="' + data.url + '/assets/img/arrow.svg" alt="">',
  prevArrow: '<img class="SliderGyms__prevArrow" src="' + data.url + '/assets/img/arrow.svg" alt="">',
  responsive: [{
    breakpoint: 1025,
    settings: {
      arrows: false,
      centerMode: true,
      centerPadding: '40px',
      slidesToShow: 2
    }
  }, {
    breakpoint: 768,
    settings: {
      arrows: false,
      centerMode: true,
      centerPadding: '40px',
      slidesToShow: 1
    }
  }]
});

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var StripeModule = function ($) {
  var userId = data.userId;
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
        NProgress.done();
      }
    }).fail(function (e) {
      console.error(e);
      NProgress.done();
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
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


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

$('.ui.rating').rating({
  maxRating: 5,
  interactive: false
});

$('.GymFavorite').rating({
  interactive: true
});

$('.ui.dropdown').dropdown();

$('.ListingFilter__trigger').on('click', function () {
  $(this).toggleClass('-open');
  $('.ListingFilter__menu').toggle();
});

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
  var radioCurrentValue = radio.prop("checked");
  radio.prop('checked', !radioCurrentValue);
});

var ScrollMagic = function () {

  var doc = $(document);
  var scrollPos = $(document).scrollTop();
  var menuLinks = $('.ContentMenu li a');
  var activiClassName = 'current';
  var offset = 700;
  var headOffset = 100;

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

    $(window).on('hashchange', activate);
  }

  function onLoad() {
    if (!location.hash || !location.hash == "#") {
      return;
    };

    activateLink();
    activateSection();
  }

  function activate() {
    if (!location.hash || !location.hash == "#") {
      return;
    };

    activateSection();
    activateLink();
    activateMobileLink();
  }

  function activateMobileLink() {
    var mobileMenu = $('.SmMenu__menu1');
    var mobileMenuLinks = $('.SmMenu__menu1 > li > a');
    var curent = mobileMenu.find("[href='" + location.hash + "']");

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
    showMoreLink.on('click', function (e) {
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
  var checkPassDone = $('[data-check-pass-done]');
  var checkPassForm = $('[data-check-pass-form]');

  function init() {
    checkPassForm.on('submit', function (e) {
      e.preventDefault();
      checkPass.hide();
      checkPassDone.show();
      setTimeout(function () {
        checkPass.show();
        checkPassDone.hide();
      }, 3000);
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
      trickleSpeed: 100,
      showSpinner: false
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
      if (r.success) {
        NProgress.done();
        window.location = redirectUrl;
      } else {
        console.log(r.data.message);
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
  function init() {
    $('body').on('submit', '.LoginForm', wpestate_login);
    $('body').on('submit', '.RegForm', wpestate_register_user);
    $('body').on('click', '.facebookloginsidebar_topbar', login_via_facebook);
    $('body').on('click', '.googleloginsidebar_topbar', login_via_google_oauth);
  }

  function wpestate_register_user(e) {
    e.preventDefault();
    var user_login_register, user_email_register, user_pass, user_pass_retype, nonce, ajaxurl;
    var user_first_name = void 0;
    var user_last_name = void 0;

    ajaxurl = data.adminAjax;
    $('#register_message_area_topbar').empty().append('<div class="login-alert">Proccessing...</div>');

    user_login_register = jQuery('#user_login_register').val();
    user_email_register = jQuery('#user_email_register').val();
    user_first_name = $('#user_first_name').val();
    user_last_name = $('#user_last_name').val();
    nonce = jQuery('#security-register-topbar').val();

    jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
        'action': 'wpestate_ajax_register_user',
        'user_login_register': user_login_register,
        'user_email_register': user_email_register,
        'user_pass': user_pass,
        'user_pass_retype': user_pass_retype,
        'security-register': nonce,
        'user_first_name': user_first_name,
        'user_last_name': user_last_name
      },

      success: function success(data) {
        jQuery('#register_message_area').empty().append('<div class="login-alert">' + data + '</div>');
        jQuery('#user_login_register').val('');
        jQuery('#user_email_register').val('');
        jQuery('#user_password').val('');
        jQuery('#user_password_retype').val('');
      },
      error: function error(errorThrown) {}
    });
  }

  function wpestate_login(e) {
    e.preventDefault();
    var login_user, login_pwd, security, ispop, ajaxurl;
    login_user = $('#login_user').val();
    login_pwd = $('#login_pwd').val();
    security = $('#security-login').val();
    ispop = $('#loginpop').val();
    ajaxurl = data.adminAjax;

    $('#login_message_area').empty().append('<div class="login-alert">' + data.login_loading + '</div>');
    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajaxurl,
      data: {
        'action': 'ajax_loginx_form',
        'login_user': login_user,
        'login_pwd': login_pwd,
        'ispop': ispop,
        'security-login': security
      },
      success: function success(data) {
        $('#login_message_area').empty().append('<div class="login-alert">' + data.message + '<div>');
        if (data.loggedin === true) {
          window.location.reload();
        }
      },
      error: function error(errorThrown) {
        console.log(errorThrown);
      }
    });
  }

  function login_via_facebook(e) {
    var login_type, ajaxurl;
    ajaxurl = data.adminAjax;
    login_type = 'facebook';
    jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
        'action': 'wpestate_ajax_facebook_login',
        'login_type': login_type
      },
      success: function success(data) {
        window.location.href = data;
      },
      error: function error(errorThrown) {}
    });
  }

  function login_via_google_oauth(e) {

    var ajaxurl, login_type;
    ajaxurl = data.adminAjax;

    jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
        'action': 'wpestate_ajax_google_login_oauth'
      },
      success: function success(data) {
        window.location.href = data;
      },
      error: function error(errorThrown) {}
    }); //end ajax
  }

  return {
    init: init
  };
}(jQuery);

Auth.init();

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(1);

__webpack_require__(5);

__webpack_require__(3);

__webpack_require__(2);

__webpack_require__(4);

__webpack_require__(0);

/***/ })
/******/ ]);
//# sourceMappingURL=app.js.map