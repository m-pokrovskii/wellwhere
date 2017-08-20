<div class="GymMapPreview">
	<div class="GymMapPreview__image">
		<a target="_blank" href="<?php echo get_permalink( $post->ID ); ?>">
			<img src="<?php echo get_the_post_thumbnail_url($post, 'listing') ?>" alt="">
		</a>
	</div>
	<div class="GymMapPreview__title">
		<a target="_blank" href="<?php echo get_permalink( $post->ID ); ?>">
			<?php echo get_the_title( $post ); ?>
		</a>
	</div>
</div>