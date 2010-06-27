<?php

/**
 * PluginsfSympalGallery form.
 *
 * @package    sfSympalGallery
 * @subpackage form
 * @author     Philipp A. Mohrenweiser <phiamo@gmail.com>
 */
abstract class PluginsfSympalGalleryForm extends BasesfSympalGalleryForm
{
	public function setup(){
		parent::setup();
		$this->widgetSchema['assets_list'] = new sfWidgetFormDoctrineChoice(array('model'=>'sfSympalAsset', 'renderer_class'=>'sfWidgetFormSelectDoubleList'));
		$this->validatorSchama['assets_list'] = new sfValidatorDoctrineChoice(array('multiple'=>true, 'model'=>'sfSympalAsset'));
	}

	public function doUpdateObject($values){
		if(isset($values['assets_list'])) {
			$values['Assets']= $values['assets_list'];
		}
		parent::doUpdateObject($values);

	}
}
