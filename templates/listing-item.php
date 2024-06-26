<?php 
    $cuid              = get_current_user_id();
    $favorited_gyms    = get_user_meta( $cuid, 'favorited_gym_id' ) ?: array();
    $gym_id            = $post->ID;
    $is_favorited      = in_array($gym_id, $favorited_gyms);
    $average_rating    = get_post_meta( $gym_id, 'average_rating', true );
    $number_of_reviews = get_review_count( $gym_id );
 ?>
<div class="ListingItem">
  <div class="ListingItem__preview"
    style="background-image: url(<?php echo get_the_post_thumbnail_url($post, 'listing') ?>);">
    <a class="ListingItem__preview-link" href="<?php the_permalink() ?>"></a>
    <div class="ListingItem__previewRating">
      <div class="GymRating -white ListingItem__previewRatingStars ui star rating" 
        data-rating="<?php echo $average_rating ?>" 
        data-max-rating="5"></div>
      <?php if ( $number_of_reviews ): ?>
        <div class="ListingItem__previewRatingText">
          <?php echo $number_of_reviews ?> <?php _e('avis') ?>
        </div>              
      <?php endif ?>
    </div>
    <div 
      class="GymFavorite ListingItem__favorite ui heart rating" 
      data-gym-id="<?php echo $gym_id ?>" 
      data-rating="<?php echo $is_favorited ?>" 
      data-max-rating="1"></div>
  </div>
  <div class="ListingItem__title">
    <?php 
      $location = get_field('gym_map', $post->ID);
      $lat = get_post_meta( $post->ID, 'lat', true );
      $lng = get_post_meta( $post->ID, 'lng', true );
     ?>
    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
  </div>
  <div class="ListingItem__listEnrties">
    <?php if ( have_rows('gym_tickets', $post->ID) ): ?>
      <?php while ( have_rows('gym_tickets', $post->ID) ) : the_row() ?>
        <?php
          $ticket_title = get_sub_field('gym_ticket_title');
          $ticket_price = get_sub_field('gym_ticket_price');
         ?>
        <div class="ListingItem__entry">
          <div class="ListingItem__entryTitle"><?php echo $ticket_title ?></div>
          <div class="ListingItem__entryPrice">CHF <?php echo $ticket_price ?></div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>