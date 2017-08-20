<?php
  $menu_items = wp_get_nav_menu_items('Single Footer Menu');
 ?>
<div class="Footer -single">
  <div class="Footer__logo">
    <a href="#"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo.svg" alt=""></a>
  </div>
  <ul class="Footer__pages">
    <?php foreach ($menu_items as $menu_item): ?>
      <li class="Footer__page">
        <a href="<?php echo $menu_item->url ?>"><?php echo $menu_item->title ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
  <div class="Footer__copyright">
    <?php echo get_field('copyright', 'option') ?>
  </div>
</div>
