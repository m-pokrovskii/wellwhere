<div class="ListingFilter">
	<div class="ListingFilter__trigger">
		<?php _e("Tous les filtres") ?>
	</div>
	<div class="ListingFilter__menu">
		<form data-filter-map-form action="" class="ListingFilter__form">
			<div class="ListingFilter__column1">
				<?php
					$age = get_terms('age', array(
						'hide_empty' => false
					));
				?>
				<div class="ListingFilter__fieldset">
					<div class="ListingFilter__fieldsetTitle">
						<?php _e("Catégorie") ?>
					</div>
					<div class="ui selection dropdown ListingFilter__gender-field">
						<input type="hidden" name="gender">
						<img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrow-bottom.svg" alt="">
						<div class="default text"><?php _e("Toutes") ?></div>
						<div class="menu">
							<div class="item" data-value=""><?php _e("Toutes") ?></div>
							 <?php foreach ($age as $key => $age_tax): ?>
								 <div class="item" data-value="<?php echo $age_tax->term_id ?>"><?php echo $age_tax->name; ?></div>
							 <?php endforeach ?>
						</div>
					</div>
				</div>
				<?php
					$activity = get_terms('activity', array(
						'hide_empty' => false
					));
				?>
				<div class="ListingFilter__fieldset">
					<div class="ListingFilter__fieldsetTitle" for=""><?php _e("Activités") ?></div>
					<?php foreach ($activity as $key => $activity_tax): ?>
						<div class="ui checkbox ListingFilter__activity-field">
							<input
								type="checkbox"
								name="activity"
								id=<?php echo $activity_tax->name ?>
								value=<?php echo $activity_tax->term_id ?>
								class="ListingFilter__activity-checkbox"
								<?php checked( get_queried_object_id(), $activity_tax->term_id ) ?>
							>
							<label for=<?php echo $activity_tax->name ?> >
								<?php echo $activity_tax->name ?>
							</label>
						</div>
					<?php endforeach ?>
					<a href="#" class="ListingFilter__show-more-activites"><?php _e("Toutes les activités >") ?></a>
				</div>
			</div>
			<div class="ListingFilter__column2">
				<div class="ListingFilter__fieldset">
					<div class="ListingFilter__fieldsetTitle"><?php _e("Note minimale") ?></div>
					<div class="ui selection dropdown ListingFilter__rating-field">
						<input type="hidden" name="rating">
						<img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrow-bottom.svg" alt="">
						<div class="default text"><?php _e("Toutes") ?></div>
						<div class="menu">
							<div class="item" data-value=""><?php _e("Toutes") ?></div>
							<div class="item" data-value="1"><?php _e("1 étoile") ?></div>
							<div class="item" data-value="2"><?php _e("2 étoile") ?></div>
							<div class="item" data-value="3"><?php _e("3 étoile") ?></div>
							<div class="item" data-value="4"><?php _e("4 étoile") ?></div>
							<div class="item" data-value="5"><?php _e("5 étoile") ?></div>
						</div>
					</div>
				</div>
			</div>
			<div class="ListingFilter__menuFooter">
				<button data-map-filter-button class="ListingFilter__button" name="ListingFilter__button">
					<?php _e("enregistrer") ?>
				</button>
			</div>
		</form>
	</div>
	<div class="ListingFilter__trigger-map">
		<img class="ListingFilter__trigger-map-icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-map.svg" alt="">
		<span data-action="listing-switch-map" class="ListingFilter__trigger-map-text">
			<?php _e("Plan") ?>
		</span>
	</div>
</div>
