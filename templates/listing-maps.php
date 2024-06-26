<?php
  $pin_icon = get_field('google_map_pin', 'option');
  $cluster_icon = get_stylesheet_directory_uri().'/assets/img/map-marker-red-round.png';
 ?>
<div class="ListingMaps">
  <div
    data-cluster-icon="<?php echo $cluster_icon ?>"
    data-scrollwheel = true
    data-listing-map
    class="wellwhere-map ListingMaps__m">
    <?php if ( have_posts() ): ?>
      <?php while( have_posts() ): the_post(); ?>
      <?php
        $location = get_field('gym_map', $post->ID);
       ?>
      <div
        style="display: none;"
        class="marker"
        data-lat="<?php echo $location['lat']; ?>"
        data-lng="<?php echo $location['lng']; ?>"
        data-icon="<?php echo $pin_icon['url'] ?>"
      >
        <?php get_template_part( 'templates/gym_map_preview' ); ?>
      </div>
      <?php endwhile  ?>
    <?php endif ?>
  </div>
</div>
