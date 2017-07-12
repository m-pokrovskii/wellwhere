<div class="ListingFilter">
  <div class="ListingFilter__trigger">
    Tous les filtres
  </div>
  <div class="ListingFilter__trigger-map">
    <img class="ListingFilter__trigger-map-icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon-map.svg" alt="">
    <span data-action="listing-switch-map" class="ListingFilter__trigger-map-text">Plan</span>
  </div>
  <div class="ListingFilter__menu">
    <div class="ListingFilter__column1">
      <div class="ListingFilter__fieldset">
        <div class="ListingFilter__fieldsetTitle">Catégorie</div>
        <div class="ui selection dropdown">
          <input type="hidden" name="gender">
          <img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrow-bottom.svg" alt="">
          <div class="default text">Age</div>
          <div class="menu">
            <div class="item" data-value="1">Adultes</div>
            <div class="item" data-value="0">Childs</div>
          </div>
        </div>
      </div>
      <div class="ListingFilter__fieldset">
        <div class="ListingFilter__fieldsetTitle" for="">Activités</div>
        <div class="ui checkbox">
          <input type="checkbox" name="Fitness" id="Fitness" value="Fitness">
          <label for="Fitness">Fitness</label>
        </div>

        <div class="ui checkbox">
          <input type="checkbox" name="Studio" id="Studio" value="Studio">
          <label for="Studio">Studio</label>
        </div>

        <div class="ui checkbox">
          <input type="checkbox" name="Arts Martiaux" id="Arts Martiaux" value="Arts Martiaux">
          <label for="Arts Martiaux">Arts Martiaux</label>
        </div>
        <a href="#" class="ListingFilter__menuReset">Toutes les activités ></a>
      </div>
    </div>
    <div class="ListingFilter__column2">
      <div class="ListingFilter__fieldset">
        <div class="ListingFilter__fieldsetTitle">Rayon</div>
        <div class="ui selection dropdown">
          <input type="hidden" name="gender">
          <img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrow-bottom.svg" alt="">
          <div class="default text">5km</div>
          <div class="menu">
            <div class="item" data-value="1">5km</div>
            <div class="item" data-value="0">10km</div>
          </div>
        </div>
      </div>
      <div class="ListingFilter__fieldset">
        <div class="ListingFilter__fieldsetTitle">Note minimale</div>
        <div class="ui selection dropdown">
          <input type="hidden" name="gender">
          <img class="dropdown icon" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/arrow-bottom.svg" alt="">
          <div class="default text">5 étoile</div>
          <div class="menu">
            <div class="item" data-value="1">1 étoile</div>
            <div class="item" data-value="2">2 étoile</div>
            <div class="item" data-value="3">3 étoile</div>
            <div class="item" data-value="4">4 étoile</div>
            <div class="item" data-value="5">5 étoile</div>
          </div>
        </div>
      </div>
    </div>
    <div class="ListingFilter__menuFooter">
      <button class="ListingFilter__button" name="ListingFilter__button">
        enregistrer
      </button>
    </div>
  </div>
</div>
