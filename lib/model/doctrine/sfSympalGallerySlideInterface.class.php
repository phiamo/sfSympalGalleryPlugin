<?php

/**
 * PluginsfSympalGallerySlide
 *
 * GallerySlides provide a relation to Assets, basically 
 * a Gallery just wants to have a collection of slides to manage linking and thumbnailing correctly 
 *
 * @package    sfSympalGallery
 * @subpackage model
 * @author     Philipp A. Mohrenweiser <phiamo@gmail.com>
 */
interface sfSympalGallerySlideInterface
{
	/**
	 * @return sfSympalAsset
	 */
	public function getAsset();
	/*
	 * @return a Link, a symfony route or something else link_to is aware of
	 */
	public function getLink();
}