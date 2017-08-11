<?php global $post; ?>
<?php if ( have_rows('hero_features', $post->ID) ): ?>
  <ul class="HeroFeatures">
  <?php while ( have_rows('hero_features', $post->ID) ): the_row(); ?>
    <li class="HeroFeatures__item">
      <div class="HeroFeatures__icon">
        <img src="<?php the_sub_field('hero_features_icon') ?>" alt="<?php the_sub_field("hero_features_title") ?>">
      </div>
      <div class="HeroFeatures__text">
        <div class="HeroFeatures__title">
          <?php the_sub_field("hero_features_title") ?>
        </div>
        <div class="HeroFeatures__desc">
          <?php the_sub_field("hero_features_description") ?>
        </div>
      </div>
    </li>
  <?php endwhile; ?>
  </ul>
<?php endif ?>