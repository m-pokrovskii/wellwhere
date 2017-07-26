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

if (window.location.hash == '#_=_'){
    history.replaceState
        ? history.replaceState(null, null, window.location.href.split('#')[0])
        : window.location.hash = '';
}

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
  const loginForm = $('.LoginForm');
  const regForm = $('.RegForm');
  const forgotForm = $('.ForgotPassForm');
  const facebookLogin = $('[data-login="facebook"]');
  const googleLogin = $('[data-login="google"]');
  const openModalLink = $('[data-open-modal-auth]');

  function init() {
    validationsInit();
    openModalLink.on('click', openModal);
    loginForm.on('submit', login);
    regForm.on('submit', register_user);
    forgotForm.on('submit', forgotPassword);
    facebookLogin.on('click', login_via_facebook);
    googleLogin.on('click', login_via_google_oauth);
  }

  function openModal(e) {
    console.log('a');
    e.preventDefault();
    $('.ui.modal').modal('show');
  }

  function validationsInit() {
    loginForm.form({
      on: 'blur',
      fields: {
        login_email: 'email',
        login_password: 'empty',
      }
    });

    regForm.form({
      on: 'blur',
      fields: {
        user_first_name: 'empty',
        user_last_name: 'empty',
        user_email_register: 'email',
      }
    });

    forgotForm.form({
      on: 'blur',
      fields: {
        forgot_email: 'email',
      }
    });
  }

  function login(e) {
    e.preventDefault();

    if ( loginForm.form('is valid') === false ) {
      return false;
    }

    const loginFields =  loginForm.serializeObject();
    const login_email = loginFields.login_email;
    const login_password = loginFields.login_password;
    const security = loginFields.security_login;
    const ajaxurl = data.adminAjax;

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
      success: function (r) {
        if (r.success) {
          window.location.reload();
        } else {
          loginForm.form("add errors", [r.data.message] );
        }
      },
      error: function (e) {
        console.log(e);
      }
    });
  }

  function register_user(e) {
    e.preventDefault();

    if ( regForm.form('is valid') === false ) {
      return false;
    }

    const regFields =  regForm.serializeObject();

    const user_first_name_register = regFields.user_first_name_register;
    const user_last_name_register = regFields.user_last_name_register;
    const user_email_register = regFields.user_email_register;
    const ajaxurl = data.adminAjax;
    const security_register = regFields.security_register;

    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajaxurl,
      data: {
        'action': 'wpestate_ajax_register_user',
        'security_register': security_register,
        'user_first_name': user_first_name_register,
        'user_last_name': user_last_name_register,
        'user_email_register': user_email_register
      },
      success: function (r) {
        if (r.success) {
          regForm.find('.ui.small.info.message').hide();
          regForm.find('.ui.small.success.message').html(r.data.message);
        } else {
          regForm.form("add errors", [r.data.message] );
        }
      },
      error: function (e) {
        console.log(e);
      }
    });
  }

  function login_via_facebook(e) {
    e.preventDefault();

    const ajaxurl = data.adminAjax;
    const login_type = 'facebook';
    jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
        'action': 'wpestate_ajax_facebook_login',
      },
      success: function (r) {
        if (r.success) {
          console.log(r);
          window.location = r.data.url;
        } else {
          console.log(r);
        }
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

  function forgotPassword(e) {
    e.preventDefault();

    if ( forgotForm.form('is valid') === false ) {
      return false;
    }

    const forgotFields   = forgotForm.serializeObject();
    const forgot_email   = forgotFields.forgot_email;
    const securityforgot = forgotFields.security_forgot;
    const ajaxurl        = data.adminAjax;

    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
          'action':          'wpestate_ajax_forgot_pass',
          'forgot_email':    forgot_email,
          'security-forgot': securityforgot,
        },

        success: function (r) {
          if (r.success) {
            forgotForm.find('.ui.small.success.message').html(r.data.message);
          } else {
            forgotForm.form("add errors", [r.data.message] );
          }
        },
        error: function (e) {
          console.log(e);
          forgotForm.form("add errors", [r.data.message] );
        }
    });
  }

  return {
    init: init
  }
}(jQuery));

Auth.init();
