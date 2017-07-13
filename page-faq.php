<?php
	// Template Name: Page Faq
?>
<?php get_header(); ?>
<div class="App">
	<?php get_template_part('templates/header') ?>
  <div class="FaqPage">
    <div class="FaqPage__title"><?php the_title() ?></div>
      <?php  if( have_rows('faq_items') ): ?>
        <div class="ui fluid accordion">
          <?php while ( have_rows('faq_items') ) : the_row(); ?>
            <div class="title"><i class="dropdown icon"></i>
              <?php the_sub_field('faq_question'); ?>
            </div>
            <div class="content">
              <?php the_sub_field('faq_answer'); ?>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <h1>No Questions</h1>
      <?php endif; ?>
	</div>
	<?php get_template_part( 'templates/footer-single' ); ?>
</div>
<?php get_footer(); ?>
