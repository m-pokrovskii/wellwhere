<?php 
  global $post;
  $image  = get_field('hero_image', $post->ID);
  $slogan = get_field('hero_title', $post->ID);
?>
<div class="Hero" style="background: url(<?php echo $image; ?>) no-repeat 50% 50%">
  <div class="Hero__slogan">
    <?php echo $slogan ?>
  </div>
  <div class="Hero__search HeroSearch">
    <div class="HeroSearch__field">
      <input
      placeholder="<?php _e("Où voulez-vous vous entraîner?") ?>"
      class="HeroSearch__input prompt"
      type="text"
      name="heroSearch">
      <div class="ui fluid search">
        <div class="results"></div>
      </div>
    </div>
    <div class="HeroSearch__helper hide-sm">
      <?php _e("Pressez ‘Enter’ pour chercherEnter") ?>
    </div>
  </div>
</div>
