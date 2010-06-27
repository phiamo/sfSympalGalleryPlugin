<div class="gallery-<?php echo $gallery->getId(); ?>">
<?php foreach($gallery->getAssets() as $asset): ?>
<?php echo link_to( $asset->getRawValue()->getThumbnail($options['thumb_width'], $options['thumb_height'])->render(),$asset->getGalleryAsset()->getFirst()->getLink());?>
<?php endforeach;?>
</div>