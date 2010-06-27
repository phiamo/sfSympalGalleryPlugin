<?php

/**
 * PluginsfSympalGalleryAsset
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginsfSympalGallerySlide extends BasesfSympalGallerySlide implements sfSympalGallerySlideInterface
{
	/**
	 * @return sfSympalAsset
	 */
	public function getAsset(){
		return $this->_get('Asset');
	}
	/*
	 * @return a Link, a symfony route or something else link_to is aware of
	 */
	public function getLink(){
		if($this->getUrl()){
			return $this->getUrl();
		}
		if($this->getAsset()->getContent()->getFirst() && !$this->getLinkFile()){
			return $this->getAsset()->getContent()->getFirst()->getUrl();	
		}
		return $this->getAsset()->getUrl();
		
	}
}