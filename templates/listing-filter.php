<div class="ListingFilter">
  <div class="ListingFilter__trigger">
    <?php _e("Tous les filtres") ?>
    <div class="ListingFilter__menu">
      <div class="ListingFilter__column1">
        <div class="ListingFilter__fieldset">
          <div class="ListingFilter__fieldsetTitle">
            <?php _e("Catégorie") ?>
          </div>
          <div class="ui selection dropdown">
            <input type="hidden" name="gender">
            <img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrow-bottom.svg" alt="">
            <div class="default text"><?php _e("Age") ?></div>
            <div class="menu">
              <div class="item" data-value="1"><?php _e("Adultes") ?></div>
              <div class="item" data-value="0"><?php _e("Childs") ?></div>
            </div>
          </div>
        </div>
        <div class="ListingFilter__fieldset">
          <div class="ListingFilter__fieldsetTitle" for=""><?php _e("Activités") ?></div>
          <div class="ui checkbox">
            <input type="checkbox" name="Fitness" id="Fitness" value="Fitness">
            <label for="Fitness"><?php _e("Fitness") ?></label>
          </div>

          <div class="ui checkbox">
            <input type="checkbox" name="Studio" id="Studio" value="Studio">
            <label for="Studio"><?php _e("Studio") ?></label>
          </div>

          <div class="ui checkbox">
            <input type="checkbox" name="Arts Martiaux" id="Arts Martiaux" value="Arts Martiaux">
            <label for="Arts Martiaux"><?php _e("Arts Martiaux") ?></label>
          </div>
          <a href="#" class="ListingFilter__show-more-activites"><?php _e("Toutes les activités >") ?></a>
        </div>
      </div>
      <div class="ListingFilter__column2">
        <div class="ListingFilter__fieldset">
          <div class="ListingFilter__fieldsetTitle"><?php _e("Rayon") ?></div>
          <div class="ui selection dropdown">
            <input type="hidden" name="gender">
            <img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrow-bottom.svg" alt="">
            <div class="default text"><?php _e("5km") ?></div>
            <div class="menu">
              <div class="item" data-value="1"><?php _e("5km") ?></div>
              <div class="item" data-value="0"><?php _e("10km") ?></div>
            </div>
          </div>
        </div>
        <div class="ListingFilter__fieldset">
          <div class="ListingFilter__fieldsetTitle"><?php _e("Note minimale") ?></div>
          <div class="ui selection dropdown">
            <input type="hidden" name="gender">
            <img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrow-bottom.svg" alt="">
            <div class="default text"><?php _e("5 étoile") ?></div>
            <div class="menu">
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
        <button class="ListingFilter__button" name="ListingFilter__button">
          <?php _e("enregistrer") ?>
        </button>
      </div>
    </div>
  </div>
  <div class="ListingFilter__trigger-map">
    <img class="ListingFilter__trigger-map-icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-map.svg" alt="">
    <span data-action="listing-switch-map" class="ListingFilter__trigger-map-text">
      <?php _e("Plan") ?>
    </span>
  </div>
</div>
