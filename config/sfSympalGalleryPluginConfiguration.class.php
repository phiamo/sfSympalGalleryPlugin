<?php

/**
 * sfSympalGalleryPlugin configuration.
 * 
 * @package     sfSympalGalleryPlugin
 * @subpackage  config
 * @author      phiamo@gmail.com
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class sfSympalGalleryPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    #$this->dispatcher->connect('sympal_content.filter_generator_yaml', array($this, 'addAssetsListToGeneratorYaml'));
    #$this->dispatcher->connect('form.post_configure', array($this, 'changeAssetsListWidget'));
  }

  public function addAssetsListToGeneratorYaml(sfEvent $event, $generator)
  {
    #$generator['generator']['param']['config']['form']['display']['Content'][] = 'slides_list';
    
    return $generator;
  }
/*
  public function changeAssetsListWidget(sfEvent $event)
  {
    $form = $event->getSubject();

    if (isset($form['slides_list']))
    {
      $widgetSchema = $form->getWidgetSchema();
      $widgetSchema['slides_list'] = new sfWidgetFormTagString();

      $validatorSchema = $form->getValidatorSchema();
      $validatorSchema['slides_list'] = new sfValidatorTagString(array('required' => false));

      $widgetSchema->setHelp('slides_list', 'Specify a comma separated list of assets that describe this content.');
    }
  }*/
}
