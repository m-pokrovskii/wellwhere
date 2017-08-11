<?php
  global $post;
  $recommended_posts = get_posts(array(
    'post_type' => 'gym',
    'meta_key' => 'gym_recommended',
    'meta_value' => true
  ));
 ?>

<div class="HomeSection -recomended">
  <h2 class="HomeSection__headline">
    <?php echo get_field('recommended_section_title', $post->ID); ?>
  </h2>
  <div class="SliderContainer">
    <div class="WrapSliderGyms">
      <div class="HomeSection__slider SliderGyms">
        <?php foreach ($recommended_posts as $recommended_post): ?>
          <?php 
            $number_of_reviews = get_review_count( $recommended_post->ID );
           ?>
          <div class="SliderGyms__slide">
            <div class="GymListigItem">
              <div class="GymListigItem__image">
                <a href="<?php echo get_permalink($recommended_post); ?>">
                  <img
                    src="<?php echo get_the_post_thumbnail_url($recommended_post, 'recommended-slider') ?>"
                    alt="<?php echo $recommended_post->post_title ?>">
                  </a>
              </div>
              <div class="GymListigItem__title">
                <a href="<?php echo get_permalink($recommended_post); ?>">
                  <?php echo $recommended_post->post_title ?>
                </a>
              </div>
              <div class="GymListigItem__rating">
                <div 
                  class="ui star rating GymRating" 
                  data-rating="<?php echo get_post_meta( $recommended_post->ID, 'average_rating', true ) ?>">
                </div>
                <?php if ($number_of_reviews): ?>
                  <div class="GymListigItem__rating-text">
                    <?php echo $number_of_reviews ?> <?php _e('avis') ?>
                  </div>                  
                <?php endif ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
