<div class="gallery-<?php echo $gallery->getId(); ?>">
<?php foreach($gallery->getRawValue()->getGallerySlides() as $slide): ?>
<?php echo link_to( $slide->getAsset()->getThumbnail($options['thumb_width'], $options['thumb_height'])->render(), $slide->getLink());?>
<?php endforeach;?>
</div>