<?php
  $menu_items = wp_get_nav_menu_items('Payment Footer Menu');
 ?>
<div class="Footer -payment">
	<div class="Footer__phone">
		<div class="Footer__phone-text">
			Lun-Ven / 10h-19h +41 21 34 33
		</div>
	</div>
	<ul class="Footer__payment-links">
		<?php foreach ($menu_items as $menu_item): ?>
			<li><a href="<?php echo $menu_item->url ?>"><?php echo $menu_item->title ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>
