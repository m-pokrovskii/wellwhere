<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php $review_count = get_gym_reviews_count( $post->ID ) ?>
	<div class="SinglePage__content-container">
		<div class="SignlePage__headline ui sticky">
			<div class="SignlePage__headline-title">
				<?php the_title() ?>
			</div>
			<div class="SinglePage__headling-meta">
				<div class="SinglePage__headling-meta-address">
					<?php
					$zips = wp_get_post_terms($post->ID, 'zip');
					$zip = $zips[0];
					?>
					<?php echo $zip->name ?>
				</div>
				<div 
					class="GymRating SinglePage__headling-meta-rating ui rating" 
					data-rating=<?php echo get_post_meta( $post->ID, 'average_rating', true ) ?> 
					data-max-rating="5"></div>
			</div>
		</div>
		<div class="SignlePage__columns_container">
			<div class="SignlePage__sidebar -left">
				<ul class="ContentMenu ui sticky">
					<li><a href="#description">Description</a></li>
					<li><a href="#photos">Photos</a></li>
					<li><a href="#details">Horaires</a></li>
					<li><a href="#map">Plan</a></li>
					<li><a href="#comments">Commentaires <?php if( $review_count ) : ?> ( <?php echo $review_count ?> ) <?php endif; ?></a></li>
				</ul>
			</div>
			<div class="SignlePage__sidebar -center">
				<?php get_template_part('templates/price-block') ?>
				<div class="SingleMainContent">
					<div class="ui accordion">
						<div class="active title">
							Description
						</div>
						<div id="description" class="active content">
							<div class="SingleMainContent__description">
								<?php the_content() ?>
							</div>
						</div>
						<div class="active title">
							Photos
						</div>
						<div id="photos" class="active content">
							<?php get_template_part('templates/single-gym-gallery') ?>
						</div>
						<div class="active title">
							Horaires
						</div>
						<div id="details" class="active content">
							<div class="SingleMainContent__additional-details">
								<?php if( have_rows('gym_hours_of_work') ): ?>
									<?php while( have_rows('gym_hours_of_work') ) : the_row(); ?>
										<p>
											<?php the_sub_field('day'); ?>: 
											<?php the_sub_field('hours') ?>
										</p>
									<?php endwhile; ?>
								<?php endif ?>
							</div>
						</div>
						<div class="active title">
							Plan
						</div>
						<div id="map" class="active content">
							<?php get_template_part('templates/single-map'); ?>
						</div>
						<div class="active title last">
							<?php _e('Commentaires') ?>
						</div>
						<div id="comments" class="active content">
							<?php get_template_part( 'templates/reviews' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php endif; ?>
