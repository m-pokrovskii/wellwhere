<?php 
	$cuid = get_current_user_id();
	$favorited_gym_ids = get_user_meta( $cuid, 'favorited_gym_id' );
	$posts_per_page = 4;
	$favorited_gyms = new WP_Query(array(
		'post_type' => 'gym',
		'post__in' => ( $favorited_gym_ids ) ? $favorited_gym_ids : array(0),
		'posts_per_page' => $posts_per_page,
	));
 ?>
<section id="favorites" class="ProfilePage__favorites-section ProfileFavorite">
	<div class="FavoriteList">
		<?php if ( $favorited_gyms->posts ): ?>
			<?php foreach ($favorited_gyms->posts as $favorited_gym): ?>
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
						<div 
							data-rating="<?php echo get_post_meta( $favorited_gym->ID, 'average_rating', true ) ?>"
							class="GymRating ui rating FavoriteListItem__rating"></div>
					</div>
				</div>
			<?php endforeach ?>
		<?php endif ?>
	</div>
	<?php if ($favorited_gyms->max_num_pages > 1): ?>
	<div class="ProfileFavorite__loadMore">
		<a 
			data-load-more-favorites 
			data-favorites-per-page = <?php echo $posts_per_page ?>
			href="" 
			class="ProfileFavorite__loadMore-link">
			<?php _e('plus anciens') ?>
		</a>
	</div>
	<?php endif ?>
</section>