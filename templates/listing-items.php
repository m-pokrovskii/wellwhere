<div class="ListingItems">
  <?php if ( have_posts() ): ?>
    <?php while( have_posts() ): the_post(); ?>
      <div class="ListingItem">
        <div class="ListingItem__preview"
          style="background-image: url(<?php echo get_the_post_thumbnail_url($post, 'listing') ?>);">
          <a class="ListingItem__preview-link" href="<?php the_permalink() ?>"></a>
          <div class="ListingItem__previewRating">
            <div class="GymRating -white ListingItem__previewRatingStars ui star rating" data-rating="4" data-max-rating="5"></div>
            <div class="ListingItem__previewRatingText">6 avis</div>
          </div>
          <div class="GymFavorite ListingItem__favorite ui heart rating" data-rating="0" data-max-rating="1"></div>
        </div>
        <div class="ListingItem__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
        <div class="ListingItem__listEnrties">
          <?php if ( have_rows('gym_tickets', $post->ID) ): ?>
            <?php while ( have_rows('gym_tickets', $post->ID) ) : the_row() ?>
              <?php
                $ticket_title = get_sub_field('gym_ticket_title');
                $ticket_price = get_sub_field('gym_ticket_price');
               ?>
              <div class="ListingItem__entry">
                <div class="ListingItem__entryTitle"><?php echo $ticket_title ?></div>
                <div class="ListingItem__entryPrice">CHF <?php echo $ticket_price ?>-</div>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; ?>
    <?php get_template_part('templates/listing-pagination'); ?>
  <?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>