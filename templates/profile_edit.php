<?php
	$curruser   = wp_get_current_user();
	$image_path = get_stylesheet_directory_uri() . "/assets";
?>
<section id="profile" class="ProfilePage__profil-section ProfileProfile">
	<h1 class="ProfileProfile__headline"><?php _e('Profil') ?></h1>
	<form data-profile-update action="" class="ProfileProfile__form ui form">
		<fieldset class="field">
			<label for=""><?php _e('Prénom') ?></label>
			<input name="first_name" value="<?php echo $curruser->first_name ?>" type="text">
		</fieldset>
		<fieldset class="field">
			<label for=""><?php _e('Nom') ?></label>
			<input name="last_name" value="<?php echo $curruser->last_name ?>" type="text">
		</fieldset>
		<fieldset class="field">
			<label for=""><?php _e('Adresse Mail') ?></label>
			<input name="email" value="<?php echo $curruser->user_email ?>" type="text">
		</fieldset>
		<fieldset class="field">
			<label for=""><?php _e('Rue') ?></label>
			<input name="street" value="<?php echo get_user_meta( $curruser->ID, 'street', true) ?>" type="text">
		</fieldset>
		<fieldset class="field">
			<label for=""><?php _e('Ville') ?></label>
				<input name="city" value="<?php echo get_user_meta( $curruser->ID, 'city', true) ?>" type="text">
		</fieldset>
		<fieldset class="field">
			<label for=""><?php _e('Code Postal') ?></label>
				<input name="cp" value="<?php echo get_user_meta( $curruser->ID, 'cp', true) ?>" type="text">
		</fieldset>
		<fieldset class="field">
			<label for=""><?php _e('Pays') ?></label>
				<input name="country" value="<?php echo get_user_meta( $curruser->ID, 'country', true) ?>" type="text">
		</fieldset>
		<fieldset class="field">
			<label for="phone"><?php _e('Téléphone') ?></label>
			<input name="phone" id="phone" value="<?php echo get_user_meta( $curruser->ID, 'phone', true) ?>" type="text">
		</fieldset>
		<fieldset class="inline field">
			<label for=""><?php _e('Sexe') ?></label>
			<div class="ui compact selection dropdown">
				<input type="hidden" value="<?php echo get_user_meta( $curruser->ID, 'gender', true) ?>" name="gender">
				<i class="dropdown icon"></i>
				<div class="default text"><?php _e('Sexe') ?></div>
				<div class="menu">
					<div class="item" data-value="male"><?php _e('M') ?></div>
					<div class="item" data-value="female"><?php _e('W') ?></div>
				</div>
			</div>
		</fieldset>
		<fieldset class="field">
			<label for=""><?php _e('Date de naissance') ?></label>
			<div class="ProfileProfile__form-date">
				<div class="ProfileProfile__form-date-day ui compact selection dropdown">
					<input type="hidden" value="<?php echo get_user_meta( $curruser->ID, 'day', true) ?>" name="day">
					<i class="dropdown icon"></i>
					<div class="default text"><?php _e('Day') ?></div>
					<div class="menu">
						<?php for ($i=1; $i <= 31 ; $i++): ?>
							<div class="item" data-value="<?php echo $i ?>">
								<?php echo ($i < 10 ) ? "0$i" : $i ; ?>
							</div>
						<?php endfor; ?>
					</div>
				</div>
				<div class="ProfileProfile__form-date-month ui compact selection dropdown">
					<input type="hidden" value="<?php echo get_user_meta( $curruser->ID, 'month', true) ?>" name="month">
					<i class="dropdown icon"></i>
					<div class="default text"><?php _e('Month') ?></div>
					<div class="menu">
						<?php for ($i=1; $i <= 12 ; $i++): ?>
							<div class="item" data-value="<?php echo $i ?>">
								<?php echo ($i < 10 ) ? "0$i" : $i ; ?>
							</div>
						<?php endfor; ?>
					</div>
				</div>
				<div class="ProfileProfile__form-date-year ui compact selection dropdown">
					<input type="hidden" value="<?php echo get_user_meta( $curruser->ID, 'year', true) ?>" name="year">
					<i class="dropdown icon"></i>
					<div class="default text"><?php _e('Year') ?></div>
					<div class="menu">
						<?php $current_year = date("Y"); ?>
						<?php for ($i = $current_year; $i >= 1970 ; $i--): ?>
							<div class="item" data-value="<?php echo $i ?>">
								<?php echo $i ?>
							</div>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</fieldset>
		<div class="ui small success message"></div>
		<div class="ui small error message"></div>
		<fieldset class="ProfileProfile__form-btns">
			<a href="" data-profile-cancel class="ProfileProfile__btn-cancel"><?php _e('Annuler modifications') ?></a>
			<button data-profile-submit type="submit" class="ProfileProfile__btn-accept"><?php _e('Enregistrer modifications') ?></button>
		</fieldset>
	</form>
</section>