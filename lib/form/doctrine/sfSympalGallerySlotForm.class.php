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

		$this->embedForm('gallery_parameters', $this->getParameterForm($keys));
	}
	/**
	 * generate a form with params to use
	 * could that be made more generic for all inline_objects contentslots
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
		return $gForm;
	}
	/**
	 * Do not save embedded form! its just used to get parameters here
	 * @see lib/vendor/symfony/lib/form/addon/sfFormObject#updateObjectEmbeddedForms($values, $forms)
	 */
	public function saveEmbeddedForms($con = null, $forms = null){
		if (null === $forms)
		{
			$forms = $this->embeddedForms;
		}

		foreach ($forms as $name => $form)
		{
			if($name != 'gallery_parameters'){
				parent::saveEmbeddedForms($con, $forms);
			}
		}
	}
	/**
	 * get the InlineGallery from current value
	 */
	protected function getInlineObjectGalleryFromValue(){
		
		# why is use_helper not available ?
		require_once(dirname(__FILE__).'/../../../../../lib/vendor/symfony/lib/helper/HelperHelper.php');
		use_helper('InlineObject');
		$parser = get_inline_object_parser();
		$objects = $parser->parseTypes($this->getObject()->getValue());
		return $objects[1][0];
		
	}
	/**
	 * insert inline object syntax to value
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
		
		return '[gallery:'.$galleries[0].$this->generateParameters().']';
	}
	protected function generateParameters(){
		$vals = $this->getValues();
		$params = "";
		foreach ($vals['gallery_parameters'] as $key => $value){
			$params .= " ".$key."=\"".$value."\"";
		}
		return $params;
	}
}