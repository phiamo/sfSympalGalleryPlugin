<?php

/**
 * Class responsible for actually processing the gallery syntaxes:
 * 
 * [gallery:1]
 * [gallery:1 thumb_width="100" thumb_height="120" renderer="sympal_gallery/ajax_sliding"]
 * 
 * The heavy-lifting is done elsewhere.
 * 
 * @package    sfSympalGallery
 * @subpackage inline_object
 * @author     Philipp A. Mohrenweiser <phiamo@gmail.com>
 * @version     svn:$Id$ $Author$
 */
class sfSympalInlineObjectGallery extends sfInlineObjectDoctrineType
{
  public function setOptions($options){
  	$this->_options = $options;
  }
  /**
   * @see InlineObjectType
   */
  public function render()
  {
    $gallery = $this->getRelatedObject();

    if (!$gallery)
    {
      return '';
    }

    return $gallery->render($this->getOptions());
  }

  /**
   * @see sfInlineObjectDoctrineType
   */
  public function getModel()
  {
    return 'sfSympalGallery';
  }

  /**
   * @see sfInlineObjectDoctrineType
   */
  public function getKeyColumn()
  {
    return 'id';
  }
}