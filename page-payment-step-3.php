<?php
	// Template Name: Payment Page Step 3
?>
<?php get_header(); ?>
<div class="App -payment">
	<?php get_template_part('templates/payment-header') ?>
	<div class="PaymentPage">
		<div class="PaymentTitle"><?php the_title() ?></div>
		<?php get_template_part( 'templates/payment-steps' ); ?>
		<div class="PaymentBasket">
    	<div class="PaymentBasketList">
    	  <div class="PaymentBasketListItem">
          <i class="PaymentBasketListItem__close"></i>
    	    <div class="PaymentBasketListItem__image">
    	      <a href="#"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/tmp-basket-image.png" alt=""></a>
    	    </div>
    	    <div class="PaymentBasketListItem__body">
    	      <div class="PaymentBasketListItem__title">Fresh Air Workout</div>
    	      <div class="PaymentBasketListItem__entries">5 entrées</div>
    	      <div class="PaymentBasketListItem__date">À activer avant le 06/07/2017</div>
    	    </div>
          <div class="PaymentBasketListItem__price">Fr. 8.90.-</div>
          <div class="PaymentBasketListItem__remove -xs">
            Remove
          </div>
    	  </div>
    	</div>
      <div class="PaymentTotal">
        <div class="PaymentTotal__title">Mode de paiement</div>
        <div class="PaymentTotal__card">
          <div class="PaymentTotal__card-image">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo-mastercard.png" alt="">
          </div>
          <div class="PaymentTotal__card-title">Mastercard ****0923</div>
        </div>
        <div class="PaymentTotal__container-price">
          <div class="PaymentTotal__price-text">
            <div class="PaymentTotal__total-text">TOTAL</div>
            <div class="PaymentTotal__tva-text">(TVA inclus.)</div>
          </div>
          <div class="PaymentTotal__price">
            Fr. 8.90.-
          </div>
        </div>
        <div class="PaymentTotal__buttonBlock">
          <div class="PaymentTotal__button">
            Confirmer paiement
          </div>
        </div>
      </div>
    </div>
	</div>
	<?php get_template_part( 'templates/payment-footer' ); ?>
</div>
<?php get_footer(); ?>
