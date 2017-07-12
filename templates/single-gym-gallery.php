<?php $gallery = get_field('gym_gallery'); ?>
<div class="SingleMainContent__photos">
  <?php foreach ($gallery as $gallery_item): ?>
    <a
      class="SingleMainContent__photo"
      data-fancybox="single-content-images"
      href="<?php echo $gallery_item['url'] ?>">
      <img
        src="<?php echo $gallery_item['sizes']['gallery'] ?>"
        alt="<?php echo $gallery_item['caption'] ?>">
    </a>
  <?php endforeach; ?>
</div>
