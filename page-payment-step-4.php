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
        <img class="PaymentComplete__icon-done" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-done.png" alt="">
        <div class="PaymentComplete__text-thanks">Merci pour votre achat!</div>
				<?php if ( isset( $_GET['pdf_filename'] ) ): ?>
					<a target="_blank" href="<?php echo get_stylesheet_directory_uri() . '/tickets/' . $_GET['pdf_filename'] . ".pdf" ?>" class="PaymentComplete__link-show-pass">Voir mes pass.</a>
				<?php endif; ?>
      </div>
    </div>
	</div>
	<?php get_template_part( 'templates/payment-footer' ); ?>
</div>
<?php get_footer(); ?>
