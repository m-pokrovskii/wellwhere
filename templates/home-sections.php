<?php
  $activites = get_terms('activity', array(
    'hide_empty' => false
  ));
  $menu_items = wp_get_nav_menu_items('Home Menu');
 ?>
<?php get_template_part('templates/home-slider') ?>
<div class="HomeSection -activites">
  <h2 class="HomeSection__headline">Vos activités préférées</h2>
  <ul class="ActivitesList">
      <?php foreach ($activites as $activity): ?>
        <?php
          $image = get_field('activity_image', $activity);
        ?>
        <li class="ActivitesList__item" style="background-image: url(<?php echo $image['sizes']['activity'] ?>);">
          <a class="ActivitesList__itemTitle" href="<?php echo get_term_link($activity, 'activity') ?>">
            <span><?php echo $activity->name ?></span>
          </a>
        </li>
      <?php endforeach; ?>
  </ul>
</div>
<div class="HomeSection -partnerships">
  <h2 class="HomeSection__headline"><?php _e("DEVENIR PARTENAIRE") ?></h2>
  <div class="HomePartnershipBlock">
    <div class="HomePartnershipBlock__desc">
      <?php _e("Nec piget dicere avide magis hanc insulam populum Romanum invasisse quam iuste. Nec piget dicere avide magis hanc insulam populum Romanum invasisse quam iuste. Nec piget dicere avide magis hanc insulam populum Romanum invasisse quam iuste.") ?>
    </div>
    <div class="HomePartnershipBlock__button">
      <a href="<?php echo page_link_by_file('page-partnership.php') ?>" class="ButtonPartner"><?php _e("ESPACE PARTENAIRE") ?></a>
    </div>
  </div>
</div>
<div class="HomeSection -misc">
  <ul class="MiscMenuList">
    <?php foreach ($menu_items as $menu_item): ?>
      <li>
        <a href="<?php echo $menu_item->url ?>">
          <?php echo $menu_item->title ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
  <div class="MiscNewsletter">
    <label class="MiscNewsletter__emailFieldLabel" for="newsletterEmailField">
      <?php _e("INSCRIVEZ-VOUS A NOTRE NEWSLETTER") ?>
    </label>
    <input type="text" class="MiscNewsletter__emailField" name="newsletterEmailField">
    <button class="MiscNewsletter__button"><?php _e("S’inscrire >") ?></button>
  </div>
</div>
