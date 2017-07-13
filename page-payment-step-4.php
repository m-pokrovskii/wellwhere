<?php
	// Template Name: Payment Page Step 4
?>
<?php get_header(); ?>
<div class="App -payment">
	<?php get_template_part('templates/payment-header') ?>
	<div class="PaymentPage">
		<div class="PaymentTitle"><?php the_title() ?></div>
		<div class="PaymentComplete">
      <div class="PaymentCompleteContent">
        <img class="PaymentComplete__icon-done" src="img/icon-done.png" alt="">
        <div class="PaymentComplete__text-thanks">Merci pour votre achat!</div>
        <a class="PaymentComplete__link-show-pass">Voir mes pass.</a>
      </div>
    </div>
	</div>
	<?php get_template_part( 'templates/payment-footer' ); ?>
</div>
<?php get_footer(); ?>
