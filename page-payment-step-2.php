<?php
	// Template Name: Payment Page Step 2
?>
<?php get_header(); ?>
<div class="App -payment">
	<?php get_template_part('templates/payment-header') ?>
	<div class="PaymentPage">
		<div class="PaymentTitle"><?php the_title() ?></div>
		<?php get_template_part( 'templates/payment-steps' ); ?>
		<div class="PaymentCards">
    	<ul class="PaymentCardsList">
    		<li class="PaymentCardsItem">
    			<div class="PaymentCardsItem__logo">
    				<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo-mastercard.png" alt="">
    			</div>
    			<div class="PaymentCardsItem__body">
    				<div class="PaymentCardsItem__title">
    					Mastercard ****0923
    				</div>
    				<a href="#" class="PaymentCardsItem__modifier">
    					modifier
    				</a>
    			</div>
    			<div class="PaymentCardsItem__buttonBlock">
    				<a href="#" class="PaymentCardsItem__button">séléctionner</a>
    			</div>
    		</li>
    	</ul>
			<div class="PaymentAddCard">
				<div class="PaymentAddCard__activator">
					+ Ajouter un mode de paiement
				</div>
				<div class="PaymentAddNewCardForm -hide">
					<div class="PaymentAddNewCardForm__headline">
						<img class="PaymentAddNewCardForm__cards-image" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo-cards.png" alt="">
						<div class="PaymentAddNewCardForm__title">Carte de crédit</div>
					</div>
					<form action="#" class="PaymentAddNewCardForm__form">
						<div class="PaymentAddNewCardForm__row">
							<div class="PaymentAddNewCardForm__field">
								<label class="PaymentAddNewCardForm__label" for="card-number">Numéro de carte</label>
								<input
									type="text"
									class="PaymentAddNewCardForm__input-text"
									name="card-number"
									id="card-number"
									value="99999999"
								>
							</div>
							<div class="PaymentAddNewCardForm__field">
								<label class="PaymentAddNewCardForm__label" for="card-owner">Titulaire de la carte</label>
								<input
								type="text"
								class="PaymentAddNewCardForm__input-text"
								name="card-owner"
								id="card-owner"
								value="Neo Anderson"
								>
							</div>
						</div>
						<div class="PaymentAddNewCardForm__row">
							<div class="PaymentAddNewCardForm__field">
								<label class="PaymentAddNewCardForm__label" for="">Date d’expiration</label>
								<div class="PaymentAddNewCardForm__select ui compact selection dropdown">
									<input type="hidden" value="1" name="card-month">
									<img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrrow-bottom-gray.svg" alt="">
									<div class="default text">MM</div>
									<div class="menu">
										<div class="item" data-value="1">01</div>
										<div class="item" data-value="2">02</div>
										<div class="item" data-value="2">03</div>
									</div>
								</div>
								<div class="PaymentAddNewCardForm__select ui compact selection dropdown">
									<input type="hidden" value="4" name="card-year">
									<img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrrow-bottom-gray.svg" alt="">
									<div class="default text">YY</div>
									<div class="menu">
										<div class="item" data-value="1">20</div>
										<div class="item" data-value="2">19</div>
										<div class="item" data-value="3">18</div>
										<div class="item" data-value="4">17</div>
									</div>
								</div>
							</div>
							<div class="PaymentAddNewCardForm__field">
								<label class="PaymentAddNewCardForm__label" for="card-code">Code de sécurité</label>
								<input type="password" id="card-code" name="card-code" value="999" class="PaymentAddNewCardForm__input-text">
							</div>
						</div>
						<div class="PaymentAddNewCardForm__row">
							<div class="PaymentAddNewCardForm__buttonBlock">
								<a class="PaymentAddNewCardForm__button" href="#">+ Ajouter</a>
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
