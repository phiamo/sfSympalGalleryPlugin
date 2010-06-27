<?php 
/**
 * PluginsfSympalGallery form.
 *
 * @package    sfSympalGallery
 * @subpackage form
 * @author     Philipp A. Mohrenweiser <phiamo@gmail.com>
 */
class sfSympalGallerySlotForm extends sfSympalContentSlotForm{
  /**
   * add gallery choosign an parameterizing form
   */
  public function configure()
  {
    parent::configure();  	#var_dump($this->widgetSchema);

    $this->widgetSchema['galleries_list'] = new sfWidgetFormDoctrineChoice(array('model'=>'sfSympalGallery'));
  	
    $this->validatorSchema['galleries_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfSympalGallery', 'required' => false));

    $keys = array('thumb_width', 'thumb_height', 'renderer');
    $this->embedForm('gallery_detail', $this->getParameterForm($keys));
  }
  /**
   * generate a form with params to use
   * @param $keys
   * @return sfSympalGalleryForm
   */
  public function getParameterForm($keys){
    $inlineGallery = $this->getInlineObjectGalleryFromValue();
    $gallery = $inlineGallery->getRelatedObject();
    $options = $inlineGallery->getOptions();
    $values = $gallery->getOptions($options);
    $blank = new sfSympalGallery();
	$gForm = new sfSympalGalleryForm();
	$gForm->useFields($keys);
	$gForm->setDefaults(array_intersect_key($values, array_fill_keys($keys,0 )));
	$this->setOption('save_this_one', false);
  	return $gForm;
  }
  /**
   * Do not save embedded form! its just used to get parameters here
   * @see lib/vendor/symfony/lib/form/addon/sfFormObject#updateObjectEmbeddedForms($values, $forms)
   */
  public function saveEmbeddedForms($values = null, $forms = null){
  }
  /**
   * get the InlineGallery from current value
   */
  protected function getInlineObjectGalleryFromValue(){
  	require_once(dirname(__FILE__).'/../../../../../lib/vendor/symfony/lib/helper/HelperHelper.php');
    use_helper('InlineObject');
    $parser = get_inline_object_parser();
    $objects = $parser->parseTypes($this->getObject()->getValue());
    return $objects[1][0];  
  }
  /**
   * insert inline object syntax to valus
   */
  public function updateValueColumn(){
  	return $this->getGalleryInline();
  }
  /**
   * generate syntax
   *  (isnt there a function in inline object to generate ?)
   */
  public function getGalleryInline(){
  	$inline = $this->getInlineObjectGalleryFromValue();
  	$galleries = $this->getValue('galleries_list');
  	#var_dump($this->getEmbeddedForm('gallery_detail')->getDefaults());
  	$vals = $this->getValues();
  	$params = "";
  	foreach ($vals['gallery_detail'] as $key => $value){
  		$params .= " ".$key."=\"".$value."\"";
  	}
  	return '[gallery:'.$galleries[0].$params.']';
  }
}