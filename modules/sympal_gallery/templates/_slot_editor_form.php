<?php use_helper('SympalContentSlotEditor') ?>
<?php echo trigger_flash_from_user($sf_user) ?>
<?php if ($contentSlot->getIsColumn()): ?>
  <?php if (sfSympalConfig::isI18nEnabled('sfSympalContentSlot') && !isset($form[$contentSlot->getName()])): ?>
    <?php echo $form[$sf_user->getEditCulture()][$contentSlot->getName()] ?>
  <?php else: ?>
    <?php echo $form[$contentSlot->getName()] ?>
  <?php endif; ?>
<?php else: ?>
  <?php echo $form['galleries_list'] ?>
  <a class="gallery_toggle_detail" href="#" onclick="return false;">Gallery parameters</a>
  <div class="gallery_detail" style="display: none">
  <?php echo $form['gallery_detail'] ?>

  </div>
<?php endif; ?>
<script type="text/javascript">
$(function() {
  $('.gallery_toggle_detail').click(function() {$('.gallery_detail').slideToggle();});		  
});

<?php if (sfSympalConfig::get('elastic_textareas', null, true)) :?>
$(function() {
  $('#sympal_slot_wrapper_<?php echo $contentSlot->getId() ?> form textarea').elastic();
});
<?php endif; ?>
</script>