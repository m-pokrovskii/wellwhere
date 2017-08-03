<?php 
	$cuid = get_current_user_id();
	$posts_per_page = 10;

	$reviews_query = new WP_Query(array(
		'post_type' => 'review',
		'posts_per_page' => $posts_per_page,
		'author' => $cuid
	));
	$reviews = $reviews_query->posts;
 ?>
<section id="comments" class="ProfilePage__comments-section ProfileComments">
	<div class="ProfileComments__list">
		<?php foreach ($reviews as $review): ?>
			<?php profile_review_template( $review ) ?>
		<?php endforeach ?>
	</div>
	<?php if ($reviews_query->max_num_pages > 1): ?>
		<div class="ProfileComments__loadMore">
			<a
				data-load-more-profile-review
				data-review-per-page = <?php echo $posts_per_page ?>
				href="#" 
				class="ProfileComments__loadMore-link">plus anciens</a>
		</div>		
	<?php endif ?>
</section>