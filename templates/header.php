<div class="HeaderWrap">
  <div class="Header -md">
    <a href="/" class="Header__logo"></a>
    <div class="Header__search ui right icon loading">
      <input
      class="Header__input-search prompt"
      placeholder="Où voulez-vous vous entraîner?"
      type="text"
      name="headerSearch"
      id="headerSearch">
      <div class="ui fluid search">
        <div class="results"></div>
      </div>
    </div>
    <a href="<?php echo page_link_by_file('page-partnership.php') ?>" class="Header__ButtonPartner ButtonPartner">DEVENIR PARTENAIRE</a>
    <div class="Header__loginLink">
      <?php if ( is_user_logged_in() ): ?>
        <?php
          $curruser = wp_get_current_user();
          $avtar_url = get_avatar_url( $curruser->ID );
         ?>
        <div class="LoggedInUserDropdown ui text menu">
            <div class="ui dropdown item">
              <span class="LoggedInUserDropdown__user-name">
                <?php echo "$curruser->first_name $curruser->last_name" ?>
              </span>
              <img class="LoggedInUserDropdown__avatar ui avatar image" src=" <?php echo $avtar_url ?>  ">
              <i class="dropdown icon"></i>
              <div class="menu">
                <a href="#" class="item">Profil</a>
                <a href="#" class="item">Commentaires</a>
                <a href="#" class="item">Pass</a>
                <a href="#" class="item">Favorits</a>
                <a href="<?php echo wp_logout_url("/") ?>" class="item">
                  <?php echo __('Logout', 'wellwhere') ?>
                </a>
              </div>
            </div>
          </div>
      <?php else: ?>
        <a href="#">M'identifer</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="Header -sm">
    <div class="Header__sm-opener SmOpener">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="SmMenu">
      <div class="SmMenu__user">
        <div class="SmMenu__userAvatar" style="background-image: url('<?php echo get_stylesheet_directory_uri() ?>/assets/img/temp-mobile-avatar.png');"></div>
        <div class="SmMenu__userContent">
          <div class="SmMenu__userTitle">
            Bonjour Marco !
          </div>
          <div class="SmMenu__userDesc">
            Membre depuis le 23.04.2048
          </div>
        </div>
      </div>
      <div class="SmMenu__search">
        <label class="SmMenu__searchLabel" for="SmMenu__searchField">Rechercher</label>
        <div class="SmMenu__searchForm">
          <input class="SmMenu__searchField prompt"  placeholder="Où voulez-vous vous entrainer ?" type="text" name="SmMenu__searchField" value="">
          <button type="button" class="SmMenu__searchButton" name="SmMenu__searchButton"></button>
        </div>
        <div class="ui fluid loading search">
          <div class="results"></div>
        </div>
      </div>
      <ul class="SmMenu__menu1">
        <li><a href="#">Profil</a></li>
        <li><a href="#">Pass</a></li>
        <li><a href="#">Commentaires</a></li>
        <li><a href="#">Favorits</a></li>
      </ul>
      <ul class="SmMenu__menu2">
        <li><a href="#">A propos</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Conditions générales</a></li>
      </ul>
      <ul class="SmMenu__socials">
        <li class="SmMenu__socialsItem">
          <a href="#"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo-facebook.png" alt=""></a>
        </li>
        <li class="SmMenu__socialsItem">
          <a href="#"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo-instagram.png" alt=""></a>
        </li>
        <li class="SmMenu__socialsItem">
          <a href="#"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo-orange.png" alt=""></a>
        </li>
      </ul>
    </div>
    <a href="/" class="Header__logo"></a>
  </div>
</div>
