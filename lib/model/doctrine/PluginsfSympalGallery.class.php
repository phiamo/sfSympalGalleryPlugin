<?php

/**
 * PluginsfSympalGallery
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sfSympalGallery
 * @subpackage model
 * @author     Philipp A. Mohrenweiser <phiamo@gmail.com>
 */
abstract class PluginsfSympalGallery extends BasesfSympalGallery
{
	public function render($options){
		$renderers = sfConfig::get('app_sympal_gallery_gallery_renderers');
		$partial = $this->getRenderer()?$renderers[$this->getRenderer()]:'sympal_gallery/view';
		return get_partial($partial, array('gallery'=>$this, 'options'=>$this->getOptions($options)));
	}
	public function getOptions($options){
	    $gValues = $this->toArray();
	    $values = array();
	  	foreach(array_keys($gValues) as $key){
	  		if(isset($options[$key])){
	  			$values[$key] = $options[$key];
	  		}
	  		else{
	  			$values[$key] = $gValues[$key];
	  		}
	  	}
  		return $values;
	}
}
