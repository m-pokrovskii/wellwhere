<?php
	$gym_id = $post->ID;
	$cuid = get_current_user_id();
	$posts_per_page = 10;
	$reviews_query = new WP_Query(array(
		'post_type' => 'review',
		'posts_per_page' => $posts_per_page,
		'meta_key' => 'gym_id',
		'meta_value' => $gym_id
	));
	$reviews = $reviews_query->posts;
	$count_reviews = count( $reviews );
	$average_rating = get_post_meta( $gym_id, 'average_rating', true );
 ?>
<div class="SingleMainContent__comments Comments">
	<div class="Comments__header">
		<div class="Comments__comments-amount"><?php echo $count_reviews ?> <?php _e('Commentaires') ?></div>
		<div 
			data-rating = "<?php echo $average_rating ?>"
			class="GymRating Comments__ratings ui rating star"></div>
	</div>
	<div class="Comments__body">
		<?php foreach ($reviews as $review): ?>
			<?php 
				review_template( $review );
			?>
		<?php endforeach ?>
	</div>
	<?php if ( $reviews_query->max_num_pages > 1 ): ?>
		<div class="Comments__load-more">
		<span 
			data-load-more-review 
			data-review-per-page = <?php echo $posts_per_page ?>
			data-gym-id = <?php echo $gym_id ?>
			class="Comments__load-more-text">
			<?php _e("Plus anciens") ?>
		</span>
	</div>
	<?php endif ?>
</div>
<?php if ( is_user_logged_in() ): ?>
	<?php if ( user_gym_tickets( $cuid, $gym_id ) ): ?>
		<?php if ( !user_has_posted_review( $cuid, $gym_id ) ): ?>
			<form data-review-form class="AddReview ui tiny form">
				<div class="field">
					<label for="subject">
						<?php _e('Titre') ?>
					</label>
					<input type="text" name="subject" id="subject">
				</div>
				<div class="field">
					<label for="review_textarea">
						<?php _e('Votre commentaire') ?>
					</label>
					<textarea name="review_textarea" id="review_textarea"></textarea>
				</div>
				<div class="field">
					<label for="">
						<?php _e("Note") ?>
					</label>
					<input type="hidden" name="rating" id="rating" value="5">
					<div 
					data-review-rating 
					class="AddReview__rating GymRating ui rating star"></div>
				</div>
				<input type="hidden" value="<?php echo $gym_id ?>" name="gym_id" id="gym_id">
				<div class="ui error message"></div>
				<div class="ui tiny submit button">
					<?php _e("Envoyer") ?>
				</div>
			</form>			
		<?php endif ?>
	<?php endif ?>
<?php endif ?>