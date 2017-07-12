<?php
  $location = get_field('gym_map');
  $pin = get_field('google_map_pin', 'option');
?>
<div class="wellwhere-map SingleMainContent__map">
  <div
    class="marker"
    data-lat="<?php echo $location['lat']; ?>"
    data-lng="<?php echo $location['lng']; ?>"
    data-icon="<?php echo $pin['url'] ?>" ></div>
</div>
