<?php

/**
 * PluginsfSympalGalleryAsset
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    sfSympalGallery
 * @subpackage model
 * @author     Philipp A. Mohrenweiser <phiamo@gmail.com>
 */
abstract class PluginsfSympalGalleryAsset extends BasesfSympalGalleryAsset
{
	public function preSave($event){
		if($this->isNew()){
			$name = get_class($this);
			$content = sfSympalContent::createNew($name);
			$content->$name = $this;
			$content->setSite(sfSympalContext::getInstance()->getService('site_manager')->getSite());
			$content->setTitle($this->getAsset()->getName());
			$content->setDatePublished('NOW()');
			$this->setContent ($content);
		}
	}
	public function getLink(){
		if($this->getUrl()){
			return $this->getUrl();
		}
		return $this->getContent()->getRoute();
	}
}