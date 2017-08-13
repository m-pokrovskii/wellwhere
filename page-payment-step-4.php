<?php
	// Template Name: Payment Page Step 4
?>
<?php get_header(); ?>
<div class="App -payment">
	<?php get_template_part('templates/payment-header') ?>
	<div class="PaymentPage">
		<div class="PaymentTitle"></div>
		<div class="PaymentComplete">
      <div class="PaymentCompleteContent">
        <img class="PaymentComplete__icon-done" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-done.png" alt="">
        <div class="PaymentComplete__text-thanks">Merci pour votre achat!</div>
				<?php if ( isset( $_GET['pdf_filename'] ) ): ?>
					<a target="_blank" href="<?php echo page_link_by_file('page-profile.php') ?>#pass" class="PaymentComplete__link-show-pass">
						<?php _e("Voir mes pass.") ?>
					</a>
				<?php endif; ?>
      </div>
    </div>
	</div>
	<?php get_template_part( 'templates/payment-footer' ); ?>
</div>
<?php get_footer(); ?>
