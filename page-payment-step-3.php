<?php
	// Template Name: Payment Page Step 3
?>
<?php
	if ( !is_user_logged_in() ) {
	   auth_redirect();
	}
	if ( is_user_logged_in() ) {
		$curruser = wp_get_current_user();
	}
	if ( !isset( $_POST['card_id'] ) ) {
		wp_redirect( page_link_by_file('page-payment-step-2.php') );
	}
	$card_id = $_POST['card_id'];
	$card = get_posts(array(
		'p' => $card_id,
		'post_type' => 'card',
		'meta_key' => 'user_id',
		'meta_value' => get_current_user_id()
	));

	if ( !$card ) {
		wp_redirect( page_link_by_file('page-payment-step-2.php') );
	}

	$basket = get_user_meta($curruser->ID, '_basket', true);

	$card = $card[0];

 ?>
<?php get_header(); ?>
<div class="App -payment">
	<?php get_template_part('templates/payment-header') ?>
	<div class="PaymentPage">
		<div class="PaymentTitle"><?php the_title() ?></div>
		<?php
			function create_pdf() {
				$mpdf = new mPDF('utf-8', 'A4');
				$template = file_get_contents( get_stylesheet_directory_uri() .'/templates/pass-pdf-template.php', 2);
				$mpdf->showImageErrors = true;
				$mpdf->WriteHTML($template);
				$mpdf->Output( __DIR__. '/my_filename.pdf','F' );
			}
			echo get_bloginfo('stylesheet_url');
			// create_pdf()

		 ?>
		<?php get_template_part( 'templates/payment-steps' ); ?>
		<div class="PaymentBasket">
    	<div class="PaymentBasketList">
				<?php if ( $basket ): ?>
					<div class="PaymentBasketListItem">
	          <i data-remove-basket class="PaymentBasketListItem__close"></i>
	    	    <div class="PaymentBasketListItem__image">
	    	      <a href="<?php echo get_permalink( $basket['basket_gym_id'] ) ?>">
								<img src="<?php echo get_the_post_thumbnail_url($basket['basket_gym_id'], 'single-preview') ?>" alt="">
							</a>
	    	    </div>
	    	    <div class="PaymentBasketListItem__body">
	    	      <div class="PaymentBasketListItem__title"><?php echo $basket['basket_gym_title'] ?></div>
	    	      <div class="PaymentBasketListItem__entries"><?php echo $basket['basket_ticket_entries'] ?></div>
							<div class="PaymentBasketListItem__date">
								À activer avant le <?php echo $basket['basket_ticket_expire'] ?>
							</div>
	    	    </div>
	          <div class="PaymentBasketListItem__price">CHF <?php echo $basket['basket_ticket_price'] ?>.-</div>
	          <div class="PaymentBasketListItem__remove -xs">
	            Remove
	          </div>
	    	  </div>
				<?php else: ?>
					<div class="PaymentBasketEmpty">
						Empty
					</div>
				<?php endif; ?>
    	</div>
			<?php if ( $basket ): ?>
				<div class="PaymentTotal">
	        <div class="PaymentTotal__title">Mode de paiement</div>
	        <div class="PaymentTotal__card">
	          <div class="PaymentTotal__card-image">
	            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo-mastercard.png" alt="">
	          </div>
	          <div class="PaymentTotal__card-title"><?php echo $card->post_title ?></div>
	        </div>
	        <div class="PaymentTotal__container-price">
	          <div class="PaymentTotal__price-text">
	            <div class="PaymentTotal__total-text">TOTAL</div>
	            <div class="PaymentTotal__tva-text">(TVA inclus.)</div>
	          </div>
	          <div class="PaymentTotal__price">
	            CHF <?php echo $basket['basket_ticket_price'] ?>.-
	          </div>
	        </div>
	        <div class="PaymentTotal__buttonBlock">
	          <div
							data-charge
							data-redirect="<?php echo page_link_by_file('page-payment-step-4.php') ?>"
							data-card-id = <?php echo $card->ID ?>
							class="PaymentTotal__button">
	            Confirmer paiement
	          </div>
	        </div>
	      </div>
			<?php endif; ?>
    </div>
	</div>
	<?php get_template_part( 'templates/payment-footer' ); ?>
</div>
<?php get_footer(); ?>
