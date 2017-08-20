<?php  global $wp_query; ?>
<div class="ListingItems">
	<div class="ui inverted dimmer"></div>
  <div class="ContainerListingItems">
    <?php if ( have_posts() ): ?>
      <?php while( have_posts() ): the_post(); ?>
        <?php get_template_part( 'templates/listing-item' ); ?>
      <?php endwhile; ?>
      <?php $pagination_query = $wp_query; ?>
      <?php include(locate_template('templates/listing-pagination.php')); ?>
    <?php endif; ?>
  </div>
</div>
<?php wp_reset_postdata(); ?>
