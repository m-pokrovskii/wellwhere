<?php
	// Template Name: Payment Page Step 1
?>
<?php get_header(); ?>
<div class="App -payment">
	<?php get_template_part('templates/payment-header') ?>
	<div class="PaymentPage">
		<div class="PaymentTitle">Paiement sécurisé</div>
		<?php get_template_part( 'templates/payment-steps' ); ?>
		<?php get_template_part( 'templates/payment-form' ); ?>
	</div>
	<?php get_template_part( 'templates/payment-footer' ); ?>
</div>
<?php get_footer(); ?>
