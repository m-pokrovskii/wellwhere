<div class="ListingItems">
  <div class="ContainerListingItems">
    <?php if ( have_posts() ): ?>
      <?php while( have_posts() ): the_post(); ?>
        <?php get_template_part( 'templates/listing-item' ); ?>
      <?php endwhile; ?>
      <?php get_template_part('templates/listing-pagination'); ?>
    <?php endif; ?>
  </div>
</div>
<?php wp_reset_postdata(); ?>
