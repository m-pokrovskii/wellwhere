<?php
  $curruser = wp_get_current_user();
  $avatar_url = get_avatar_url( $curruser->ID );
  $image_path = get_stylesheet_directory_uri() . "/assets";
 ?>
<?php get_header(); ?>
<div class="App">
	<?php get_template_part('templates/header') ?>
  	<div class="ProfilePage">
  		<div class="ProfilePage__aside">
  			<div class="Profile__user-meta">
  				<div class="Profile__avatar" style="background-image: url(<?php echo get_user_meta( $curruser->ID, 'wellwhere_avatar', true ) ?>);">
  					<div class="Profile__avatar-hover">
              <a class="Profile__avatar-change" href="#">
                <label for="ProfileUploadForm__image" class="ProfileUploadForm__image-label">
                  <img src="<?php echo $image_path ?>/img/icon-gear.png" alt="">
                  <input
                    class="ProfileUploadForm__image"
                    type="file"
                    multiple=false
                    id="ProfileUploadForm__image"
                    accept= ".jpg, .jpeg, .png"
                    name="profile_upload_avatar">
                </label>
              </a>
              <a class="Profile__avatar-delete" href="#">
                <img src="<?php echo $image_path ?>/img/icon-trash.png" alt="">
              </a>
  					</div>
  				</div>
  				<div class="Profile__user-name">
  				  <?php echo "$curruser->first_name $curruser->last_name" ?>
  				</div>
  				<div class="Profile__user-desc">
            <?php _e('Membre depuis le', 'wellwhere') ?>
            <?php echo date_format ( date_create( $curruser->user_registered ), "d.m.Y") ?>
  				</div>
  			</div>
  			<ul class="Profile__menu ProfileMenu">
  				<li><a class="active" href="#profile">Profil</a></li>
  				<li><a href="#pass">Pass</a></li>
  				<li><a href="#comments">Commentaires</a></li>
  				<li><a href="#favorites">Favorits</a></li>
  			</ul>
  		</div>
  		<div class="ProfilePage__content">
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
  						<button data-profile-cancel class="ProfileProfile__btn-cancel"><?php _e('Annuler modifications') ?></button>
  						<button data-profile-submit type="submit" class="ProfileProfile__btn-accept"><?php _e('Enregistrer modifications') ?></button>
  					</fieldset>
  				</form>
  			</section>
  			<section id="pass" class="ProfilePage__pass-section ProfilPass">
  				<h1 class="ProfilPass__headline">Pass</h1>
  				<div class="ProfilPass__description">
  					At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri.
  				</div>
  				<div class="PassLists">
  					<div class="PassList -available">
  						<div class="PassList__headline">Pass valables</div>
  						<div class="PassRow -head">
  							<div class="PassRow__icon"></div>
  							<div class="PassRow__title">Salle</div>
  							<div class="PassRow__date">expire le</div>
  							<div class="PassRow__entries">Formule</div>
  							<div class="PassRow__available-entries">entrées restantes</div>
  							<div class="PassRow__button"></div>
  						</div>
  						<div class="PassRow">
  							<div class="PassRow__icon"><a href="#"><img src="<?php echo $image_path ?>/img/search-mini-icon.svg" alt=""></a></div>
  							<div class="PassRow__title">Wellwhere Fit</div>
  							<div class="PassRow__date">31/07/2019</div>
  							<div class="PassRow__entries">5 entrées</div>
  							<div class="PassRow__available-entries">0</div>
  							<div class="PassRow__button">
  								<a href="#" class="Pass__btn">Racheter</a>
  							</div>
  						</div>
  					</div>
  					<div class="PassList -expire">
  						<div class="PassList__headline">Pass expirés</div>
  						<div class="PassRow -head">
  							<div class="PassRow__icon"></div>
  							<div class="PassRow__title">Salle</div>
  							<div class="PassRow__date">expire le</div>
  							<div class="PassRow__entries">Formule</div>
  							<div class="PassRow__available-entries">entrées restantes</div>
  							<div class="PassRow__button"></div>
  						</div>
  						<div class="PassRow">
  							<div class="PassRow__icon"><a href="#"><img src="<?php echo $image_path ?>/img/search-mini-icon.svg" alt=""></a></div>
  							<div class="PassRow__title">Wellwhere Fit</div>
  							<div class="PassRow__date">31/07/2019</div>
  							<div class="PassRow__entries">5 entrées</div>
  							<div class="PassRow__available-entries">0</div>
  							<div class="PassRow__button">
  								<a href="#" class="Pass__btn">Racheter</a>
  							</div>
  						</div>
  						<div class="PassRow">
  							<div class="PassRow__icon"><a href="#"><img src="<?php echo $image_path ?>/img/search-mini-icon.svg" alt=""></a></div>
  							<div class="PassRow__title">Wellwhere Fit</div>
  							<div class="PassRow__date">31/07/2019</div>
  							<div class="PassRow__entries">5 entrées</div>
  							<div class="PassRow__available-entries">0</div>
  							<div class="PassRow__button">
  								<a href="#" class="Pass__btn">Racheter</a>
  							</div>
  						</div>
  					</div>
  				</div>
  			</section>
  			<section id="comments" class="ProfilePage__comments-section ProfileComments">
  				<div class="ProfileComments__list">
  					<div class="ProfileComments__item">
  						<div class="ProfileComments__wrap-type-date">
  							<div class="ProfileComments__type">Salle</div>
  							<div class="ProfileComments__date">10/12/2015</div>
  						</div>
  						<div class="ProfileComments__title">Wellwhere Fit</div>
  						<div class="ProfileComments__note">Note</div>
  						<div class="GymRating ui rating ProfileComments__rating"></div>
  						<div class="ProfileComments__commentaire">
  							Commentaire
  						</div>
  						<div class="ProfileComments__comment-title">
  							« Beau et moderne, mais trop petit »
  						</div>
  						<div class="ProfileComments__comment-description">
  							At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri.
  						</div>
  					</div>
  					<div class="ProfileComments__item">
  						<div class="ProfileComments__wrap-type-date">
  							<div class="ProfileComments__type">Salle</div>
  							<div class="ProfileComments__date">10/12/2015</div>
  						</div>
  						<div class="ProfileComments__title">Wellwhere Fit</div>
  						<div class="ProfileComments__note">Note</div>
  						<div class="GymRating ui rating ProfileComments__rating"></div>
  						<div class="ProfileComments__commentaire">
  							Commentaire
  						</div>
  						<div class="ProfileComments__comment-title">
  							« Beau et moderne, mais trop petit »
  						</div>
  						<div class="ProfileComments__comment-description">
  							At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri.
  						</div>
  					</div>
  					<div class="ProfileComments__item">
  						<div class="ProfileComments__wrap-type-date">
  							<div class="ProfileComments__type">Salle</div>
  							<div class="ProfileComments__date">10/12/2015</div>
  						</div>
  						<div class="ProfileComments__title">Wellwhere Fit</div>
  						<div class="ProfileComments__note">Note</div>
  						<div class="GymRating ui rating ProfileComments__rating"></div>
  						<div class="ProfileComments__commentaire">
  							Commentaire
  						</div>
  						<div class="ProfileComments__comment-title">
  							« Beau et moderne, mais trop petit »
  						</div>
  						<div class="ProfileComments__comment-description">
  							At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri.
  						</div>
  					</div>
  					<div class="ProfileComments__item">
  						<div class="ProfileComments__wrap-type-date">
  							<div class="ProfileComments__type">Salle</div>
  							<div class="ProfileComments__date">10/12/2015</div>
  						</div>
  						<div class="ProfileComments__title">Wellwhere Fit</div>
  						<div class="ProfileComments__note">Note</div>
  						<div class="GymRating ui rating ProfileComments__rating"></div>
  						<div class="ProfileComments__commentaire">
  							Commentaire
  						</div>
  						<div class="ProfileComments__comment-title">
  							« Beau et moderne, mais trop petit »
  						</div>
  						<div class="ProfileComments__comment-description">
  							At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri.
  						</div>
  					</div>

  				</div>
  				<div class="ProfileComments__loadMore">
  					<a href="#" class="ProfileComments__loadMore-link">plus anciens</a>
  				</div>
  			</section>
  			<section id="favorites" class="ProfilePage__favorites-section ProfileFavorite">
  				<div class="FavoriteList">
  					<div class="FavoriteListItem">
  						<div href="" class="FavoriteListItem__image" style="background-image: url(<?php echo $image_path ?>/img/tmp-favorite-image.png)" >
  							<div data-rating="1" data-max-rating="1" class="GymFavorite ui rating FavoriteListItem__favorite"></div>
  						</div>
  						<div class="FavoriteListItem__content">
  							<div class="FavoriteListItem__category">Salle</div>
  							<div class="FavoriteListItem__title"><a href="#">Wellwhere Fit</a></div>
  							<div class="GymRating ui rating FavoriteListItem__rating"></div>
  						</div>
  					</div>
  					<div class="FavoriteListItem">
  						<div href="" class="FavoriteListItem__image" style="background-image: url(img/tmp-favorite-image.png)" >
  							<div data-rating="1" data-max-rating="1" class="GymFavorite ui rating FavoriteListItem__favorite"></div>
  						</div>
  						<div class="FavoriteListItem__content">
  							<div class="FavoriteListItem__category">Salle</div>
  							<div class="FavoriteListItem__title"><a href="#">Wellwhere Fit</a></div>
  							<div class="GymRating ui rating FavoriteListItem__rating"></div>
  						</div>
  					</div>
  				</div>
  				<div class="ProfileFavorite__loadMore">
  					<a href="#" class="ProfileFavorite__loadMore-link">plus anciens</a>
  				</div>
  			</section>
  		</div>
  	</div>
	<?php get_template_part('templates/footer-single') ?>
</div>
<?php get_footer(); ?>
