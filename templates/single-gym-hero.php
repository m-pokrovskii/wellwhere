<?php 
	$cuid = get_current_user_id();
	$favorited_gyms = get_user_meta( $cuid, 'favorited_gym_id' );
	$gym_id = $post->ID;
	$is_favorited = in_array($gym_id, $favorited_gyms);
?>
<div class="SignlePage__hero">
  <div
    class="SinglePage__hero-image"
    style="background-image: url('<?php echo get_the_post_thumbnail_url($post, 'single-hero') ?>');">
  </div>
  <div 
  	class="GymFavorite SignlePage__hero-favorite ui heart rating" 
  	data-gym-id="<?php echo $gym_id ?>" 
  	data-rating="<?php echo $is_favorited ?>" 
  	data-max-rating="1"></div>
</div>
