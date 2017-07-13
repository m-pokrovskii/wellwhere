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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
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


// const content = [
//   { title: 'Andorra', zip: '12411', description: 'zip: 12411'  },
//   { title: 'United Arab Emirates', zip: '012' },
//   { title: 'Afghanistan' },
//   { title: 'Antigua' },
//   { title: 'Anguilla' },
//   { title: 'Albania' },
//   { title: 'Armenia' },
//   { title: 'Netherlands Antilles' },
//   { title: 'Angola' },
//   { title: 'Argentina' },
//   { title: 'American Samoa' },
//   { title: 'Austria' },
//   { title: 'Australia' },
//   { title: 'Aruba' },
//   { title: 'Aland Islands' },
//   { title: 'Azerbaijan' },
//   { title: 'Bosnia' },
//   { title: 'Barbados' },
//   { title: 'Bangladesh' },
//   { title: 'Belgium' },
//   { title: 'Burkina Faso' },
//   { title: 'Bulgaria' },
//   { title: 'Bahrain' },
//   { title: 'Burundi' }
//   // etc
// ];
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

    form.on('submit', function (e) {
      e.preventDefault();
      var cardItemclone = cardItem.clone();
      var data = $(this).serializeArray();
      cardItemclone.find('.PaymentCardsItem__title').text(data[0].value);
      $('.PaymentCardsList').append(cardItemclone);
    });

    submit.on('click', function (e) {
      e.preventDefault();
      form.submit();
    });
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

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(1);

__webpack_require__(4);

__webpack_require__(3);

__webpack_require__(2);

__webpack_require__(0);

/***/ })
/******/ ]);
//# sourceMappingURL=app.js.map