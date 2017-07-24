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

const SinglePageFixed = (function ($) {
  const header = $('.HeaderWrap');
  const title = $('.SignlePage__headline');
  const w = $(window);

  function init() {
    if ($(".App.-single").length == 0) { return };

    doIt();
    w.on('resize', doIt);
  }

  function doIt() {
    setTimeout(function () {
      if (window.innerWidth > 1024) {
        w.off('scroll.header').on('scroll.header', handleScroll)
      } else if (window.innerWidth <= 1024) {
        destroy();
      }
    }, 1000)
  }

  function destroy() {
    w.off('scroll.header');
    header.removeAttr('style');
    header.removeClass('-absolute');
    title.removeAttr('style');
  }

  function handleScroll(e) {
    const titlePos = title.offset().top;
    const headerHeight = header.outerHeight();
    const scrollPos = w.scrollTop();
    if (scrollPos + headerHeight >= titlePos) {
      header.addClass('-absolute');
      header.css({
        top: titlePos - (headerHeight * 2)
      })
    } else {
      header.removeClass('-absolute');
      header.css({ top: 0 })
    }

  }

  return {
    init: init,
    destroy: destroy
  }

}(jQuery));
SinglePageFixed.init();


$('.ui.rating').rating({
  maxRating: 5,
  interactive: false
});

$('.GymFavorite').rating({
  interactive: true
})

$('.ui.dropdown').dropdown();


$('.ListingFilter__trigger').on('click', function () {
  $(this).toggleClass('-open')
  $('.ListingFilter__menu').toggle();
})


$('[data-action=listing-switch-map]').on('click', function () {
  $('.ListingMaps').toggleClass('-visible')
})

$('.ui.accordion').accordion({
  exclusive: false,
});

$('ui.modal').modal('setting', 'transition', 'scale');

if (typeof $.fn.fancybox !== 'undefined') {
  $("[data-fancybox]").fancybox({
    clickContent: function (current, event) {
      return false;
    },
    buttons: [
      'thumbs',
      'close'
    ]
  });
}


$('.PriceBlock__row').on('click', function () {
  let radio = $(this).find('input[type=radio]');
  let radioCurrentValue = radio.prop("checked");
  radio.prop('checked', !radioCurrentValue);
});


const ScrollMagic = (function () {




  const doc = $(document);
  const scrollPos = $(document).scrollTop();
  const menuLinks = $('.ContentMenu li a');
  const activiClassName = 'current';
  const offset = 700;
  const headOffset = 100

  function init() {
    doc.on("scroll", onScroll);
    menuLinks.on('click', smoothScroll);
  }

  function smoothScroll(e) {
    e.preventDefault();
    const targetId = $(this).attr('href');
    const refElement = $(targetId);

    $('html, body').animate({
      scrollTop: refElement.offset().top - headOffset
    }, 500);
  }

  function onScroll() {
    var scrollPos = $(document).scrollTop();
    menuLinks.each(function () {
      const curentLink = $(this);
      const targetId = $(this).attr('href');
      const refElement = $(targetId);
      const lastLink = menuLinks[menuLinks.length - 1];

      // TODO: More precise calculaction
      if (refElement.position().top + offset <= scrollPos) {
        menuLinks.removeClass(activiClassName);
        curentLink.addClass(activiClassName);
      }
      else {
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
  }

}());

ScrollMagic.init();

const Sticky = (function ($) {
  let singleMenuSticky,
    gymTitle,
    priceBlock;

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
    priceBlock
      .sticky({
        offset: 71,
        context: '.SignlePage__sidebar.-center'
      });


    singleMenuSticky
      .sticky({
        offset: 168,
        context: '.SignlePage__sidebar.-center'
      });
  }

  function stickyDestory() {
    gymTitle
      .sticky('destroy')
      .attr('style', "")
      ;

    priceBlock
      .sticky('destroy')
      .attr('style', "")
      ;

    singleMenuSticky
      .sticky('destroy')
      .attr('style', "")
      ;
  }

  function doSticky() {
    setTimeout(function () {
      if (window.innerWidth <= 1024) {
        stickyDestory();
      } else {
        stickyInit();
      }
    }, 1000)
  }

  return {
    init: init
  }
}(jQuery));
Sticky.init();

// $('.SignlePage__headline').sticky({
//   offset: 71
// });


const ProfileSwitch = (function ($) {
  const menu = $('.ProfileMenu');
  const links = $('.ProfileMenu a');
  let sections;

  function init() {
    getSections()
    events();
    onLoad();
  }

  function events() {
    links.on('click', function (e) {
      e.preventDefault();
      location.hash = this.hash
    });

    $(window).on('hashchange', activate);
  }


  function onLoad() {
    if (!location.hash || !location.hash == "#") { return };

    activateLink();
    activateSection();
  }


  function activate() {
    if (!location.hash || !location.hash == "#") { return };

    activateSection()
    activateLink()
    activateMobileLink()
  }


  function activateMobileLink() {
    const mobileMenu = $('.SmMenu__menu1');
    const mobileMenuLinks = $('.SmMenu__menu1 > li > a');
    let curent = mobileMenu.find("[href='" + location.hash + "']");

    mobileMenuLinks.removeClass('active');
    curent.addClass('active');
  }

  function activateLink() {
    let curent = menu.find("[href='" + location.hash + "']");

    links.removeClass('active');
    curent.addClass('active');
  }

  function activateSection() {
    sections.hide();
    $(location.hash).show();
  }

  function getSections() {
    let idsArray = [];
    let idsString = "";
    links.each(function (k, el) {
      idsArray.push(el.hash);
    })
    sections = $(idsArray.join());
  }

  return {
    init: init
  }


}(jQuery));
ProfileSwitch.init();


const ShowMore = (function () {
  const showMoreLink = $('[data-show-more-link]')

  function init() {
    showMoreLink.on('click', function (e) {
      e.preventDefault();
      const showMoreContainer = $(this).parents('[data-show-more]');
      const short = showMoreContainer.find('.Comment__description-short');
      const long = showMoreContainer.find('.Comment__description-long');
      short.hide();
      long.show();

    });

  }

  return {
    init: init
  }

}());

ShowMore.init();

const SinglePageHeader = (function ($) {
  const header = $('.Header.md');

  function init() {
    if ($(".App.-single").length == 0) { return };
    $(window).on('scroll', switchFixed);
  }

  function switchFixed(e) {

  }

  return {
    init: init
  }

}(jQuery));
SinglePageHeader.init();


const PaymentCard = (function ($) {
  const activator = $('.PaymentAddCard__activator')
  const addNewCard = $('.PaymentAddNewCardForm')
  const form = $('.PaymentAddNewCardForm__form')
  const submit = $('.PaymentAddNewCardForm__button')
  const cardItem = $('.PaymentCardsItem').first();

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
  }
}(jQuery));
PaymentCard.init()


const CheckPass = (function () {
  const checkPass = $('[data-check-pass]');
  const checkPassDone = $('[data-check-pass-done]');
  const checkPassForm = $('[data-check-pass-form]');

  function init() {
    checkPassForm.on('submit', function (e) {
      e.preventDefault();
      checkPass.hide();
      checkPassDone.show();
      setTimeout(function () {
        checkPass.show();
        checkPassDone.hide();
      }, 3000)
    })
  }

  return {
    init: init
  }

}());
CheckPass.init()


const AjaxGlobalHandlers = (function () {
  const doc = $(document);

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
  }
}());
AjaxGlobalHandlers.init()

const Basket = (function () {
  const addBasketButton = $('[data-add-basket]');
  const removeBasketButton = $('[data-remove-basket]');
  const addBasketForm = $('[data-add-basket-form]');
  const redirectUrl = $('[data-add-basket-form]').attr('data-redirect');

  function init() {
    handlers();
  }

  function handlers() {
    addBasketButton.on('click', add);
    removeBasketButton.on('click', remove);
  }

  function add(e) {
    e.preventDefault()
    const basketData = addBasketForm.serializeObject();
    basketData.action = 'add_basket';
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: basketData,
    })
      .done(function (r) {
        if (r.success) {
          NProgress.done();
          window.location = redirectUrl;
        } else {
          console.log(r.data.message);
        }

      })
      .fail(function () {
        // console.log("error");
      })
  }

  function remove(e) {
    e.preventDefault()
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'remove_basket'
      },
    })
      .done(function (r) {
        if (r.success) {
          NProgress.done();
          window.location.reload();
        } else {
          console.log(r);
        }
      })
      .fail(function () {
        // console.log("error");
      })
  }

  return {
    init: init
  }
}());
Basket.init();


const Auth = (function ($) {
  function init() {
    $('body').on('submit', '.LoginForm', wpestate_login);
    $('body').on('submit', '.RegForm', wpestate_register_user);
    $('body').on('click', '.facebookloginsidebar_topbar', login_via_facebook);
    $('body').on('click', '.googleloginsidebar_topbar', login_via_google_oauth);
  }

  function wpestate_register_user(e) {
    e.preventDefault();
    var user_login_register, user_email_register, user_pass, user_pass_retype, nonce, ajaxurl;
    let user_first_name;
    let user_last_name;

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
        'user_last_name': user_last_name,
      },

      success: function (data) {
        jQuery('#register_message_area').empty().append('<div class="login-alert">' + data + '</div>');
        jQuery('#user_login_register').val('');
        jQuery('#user_email_register').val('');
        jQuery('#user_password').val('');
        jQuery('#user_password_retype').val('');
      },
      error: function (errorThrown) {
      }
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
      success: function (data) {
        $('#login_message_area').empty().append('<div class="login-alert">' + data.message + '<div>');
        if (data.loggedin === true) {
          window.location.reload();
        }
      },
      error: function (errorThrown) {
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
        'login_type': login_type,
      },
      success: function (data) {
        window.location.href = data;
      },
      error: function (errorThrown) {

      }
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
      success: function (data) {
        window.location.href = data;
      },
      error: function (errorThrown) {
      }
    });//end ajax
  }

  return {
    init: init
  }
}(jQuery));

Auth.init();
