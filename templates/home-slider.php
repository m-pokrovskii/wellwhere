<?php
  $recommended_posts = get_posts(array(
    'post_type' => 'gym',
    'meta_key' => 'gym_recommended',
    'meta_value' => true
  ));
 ?>

<div class="HomeSection -recomended">
  <h2 class="HomeSection__headline">Recommandé</h2>
  <div class="SliderContainer">
    <div class="WrapSliderGyms">
      <div class="HomeSection__slider SliderGyms">
        <?php foreach ($recommended_posts as $recommended_post): ?>
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
                <div class="ui star rating GymRating" data-rating="3"></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>