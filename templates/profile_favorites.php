<?php 
	$cuid = get_current_user_id();
	$favorited_gym_ids = get_user_meta( $cuid, 'favorited_gym_id' );
	$favorited_gyms = get_posts(array(
		'post_type' => 'gym',
		'post__in' => $favorited_gym_ids,
		'posts_per_page' => -1,
	));
 ?>
<section id="favorites" class="ProfilePage__favorites-section ProfileFavorite">
	<div class="FavoriteList">
		<?php if ( $favorited_gyms ): ?>
			<?php foreach ($favorited_gyms as $favorited_gym): ?>
				<div class="FavoriteListItem">
					<div 
						class="FavoriteListItem__image" 
						style="background-image: url( <?php echo get_the_post_thumbnail_url($favorited_gym, 'listing') ?> )" >
						<div 
							data-rating="1" 
							data-max-rating="1"
							data-gym-id="<?php echo $favorited_gym->ID ?>"
							class="GymFavorite ui rating FavoriteListItem__favorite"></div>
					</div>
					<div class="FavoriteListItem__content">
						<div class="FavoriteListItem__category">Salle</div>
						<div class="FavoriteListItem__title">
							<a href="<?php echo get_permalink( $favorited_gym->ID ); ?>">
								<?php echo $favorited_gym->post_title ?>
							</a>
						</div>
						<div class="GymRating ui rating FavoriteListItem__rating"></div>
					</div>
				</div>
			<?php endforeach ?>
		<?php endif ?>
	</div>
	<div class="ProfileFavorite__loadMore">
		<a data-load-more-favorites href="" class="ProfileFavorite__loadMore-link">
			<?php _e('plus anciens') ?>
		</a>
	</div>
</section>