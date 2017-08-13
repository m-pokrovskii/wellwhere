<?php
	// Template Name: Payment Cards
?>
<?php
	if (!is_user_logged_in()) {
		wp_redirect("/");
	}
 ?>
<?php get_header(); ?>
<div class="App -payment">
	<?php get_template_part('templates/payment-header') ?>
	<div class="PaymentPage">
		<div class="PaymentTitle"></div>
		<?php get_template_part( 'templates/payment-steps' ); ?>
		<div class="PaymentCards">
			<!-- TODO. Ajax -->
    	<ul class="PaymentCardsList">
				<?php
					$cards = get_posts(array(
						'post_type' => 'card',
						'posts_per_page' => "-1",
						'meta_key' => 'user_id',
						'meta_value' => get_current_user_id()
					));
				?>
				<?php foreach ($cards as $card): ?>
					<?php
						$brand = get_post_meta($card->ID, 'brand', true);
						$brand_image = get_card_image($brand);
					 ?>
					<li data-card-id="<?php echo $card->ID ?>" class="PaymentCardsItem">
	    			<div class="PaymentCardsItem__logo">
	    				<img src="<?php echo $brand_image ?>" alt="<?php echo $brand ?>">
	    			</div>
	    			<div class="PaymentCardsItem__body">
	    				<div class="PaymentCardsItem__title">
	    					<?php echo $card->post_title ?>
	    				</div>
	    			</div>
	    			<div class="PaymentCardsItem__buttonBlock">
							<form class="PaymentCardsItem__button-form" action="<?php echo page_link_by_file('page-payment-step-3.php') ?>" method="post">
								<input type="hidden" name="card_id" value="<?php echo $card->ID ?>">
								<button type="submit" class="PaymentCardsItem__button -select">
									<?php _e('séléctionner') ?>
								</button>
							</form>
							<button
								data-card-remove
								class="PaymentCardsItem__button -remove">
								<?php _e('remove') ?>
							</button>
	    			</div>
	    		</li>
				<?php endforeach; ?>
    	</ul>
			<div class="PaymentAddCard">
				<div class="PaymentAddCard__activator">
					<?php _e("+ Ajouter un mode de paiement") ?>
				</div>
				<div class="PaymentAddNewCardForm -hide -show">
					<div class="PaymentAddNewCardForm__headline">
						<img class="PaymentAddNewCardForm__cards-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo-cards.png" alt="">
						<div class="PaymentAddNewCardForm__title">Carte de crédit</div>
					</div>
					<form class="StripeForm" action="/charge" method="post" id="payment-form">
						<div class="StripeForm__fields">
							<div class="StripeForm__element">
						    <div class="StripeForm__card-element" id="card-element">
						      <!-- a Stripe Element will be inserted here. -->
						    </div>
						    <!-- Used to display form errors -->
						    <div class="StripeForm__errors" id="card-errors" role="alert"></div>
						  </div>
						  <div class="StripeForm__button-block">
						  	<button class="StripeForm__button">Ajouter</button>
						  </div>
						</div>
					</form>
				</div>
			</div>
    </div>
	</div>
	<?php get_template_part( 'templates/payment-footer' ); ?>
</div>
<?php get_footer(); ?>
