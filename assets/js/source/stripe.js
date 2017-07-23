const StripeModule = (function($) {
  const userId = data.userId;
  function stripeForm() {
    if ( $('#card-element').length === 0 ) {
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
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      stripe.createToken(card).then(function(result) {
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

  function saveToken( token ) {
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'save_card',
        stripe_token: token,
        user_id: userId
      },
    })
    .done(function( result ) {
      NProgress.done();
      window.location.reload();
    })
    .fail(function(e) {
      console.error(e);
      NProgress.done();
    })
  }

  function chargeSource(e) {
    e.preventDefault();
    const card_id = $("[data-card-id]").attr('data-card-id');
    const redirectUrl = $(this).attr('data-redirect');
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'charge_source',
        card_id: card_id,
        user_id: userId
      },
    })
    .done(function( r ) {
      console.log(r);
      if ( r.success ) {
        window.location.replace( redirectUrl + '?pdf_filename=' + r.data.pdf_filename );
        NProgress.done();
      }
    })
    .fail(function(e) {
      console.error(e);
      NProgress.done();
    })
  }

  function removeCard(e) {
    e.preventDefault();
    const card_id = $(this).parents('[data-card-id]').attr('data-card-id');
    $.ajax({
      url: data.adminAjax,
      type: 'POST',
      data: {
        action: 'remove_card',
        card_id: card_id,
      },
    })
    .done(function( result ) {
      if ( result.success ) {
        console.log(result);
        window.location.reload();
        NProgress.done();
      } else {
        console.log(result);
        NProgress.done();
      }
    })
    .fail(function(e) {
      console.error(e);
      NProgress.done();
    })
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
    init: init,
  }
}(jQuery));

StripeModule.init();
