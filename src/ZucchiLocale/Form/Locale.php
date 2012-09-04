<?php
/**
 * ZucchiLocale (http://zucchi.co.uk/)
 *
 * @link      http://github.com/zucchi/ZucchiLocale for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zucchi Limited (http://zucchi.co.uk)
 * @license   http://zucchi.co.uk/legals/bsd-license New BSD License
 */
namespace ZucchiLocale\Form;

use Zend\Form\Form as ZendForm;
use Zend\Form\Fieldset;
use Zucchi\Debug\Debug;
use ResourceBundle;

/**
 * form to allow configuration of settings
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiLocale
 * @subpackage Form
 */
class Locale extends ZendForm
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('locale');
        $this->setAttribute('method', 'post');
        
        $localeGroup = new Fieldset('locale');
        $localeGroup->setLabel('Locale Settings');
        $this->add($localeGroup);
        
        $localeGroup->add(array(
            'name' => 'handlers',
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'attributes' => array(
                'type' => 'multi_checkbox',
            ),
            'options' => array(
                'value_options' => array(
                    'ZucchiLocale\Handler\Query' => 'Query String',
                    'ZucchiLocale\Handler\Route' => 'Route',
//                    'ZucchiLocale\Handler\Host' => 'Hostname (not yet implemented)',
                    'ZucchiLocale\Handler\Cookie' => 'Cookie',
                    'ZucchiLocale\Handler\Session' => 'Session',
                    'ZucchiLocale\Handler\Header' => 'HTTP Accept Language Header',
                ),
                'label' => 'Handlers',
                'bootstrap' => array( // options for bootstrap form
                    'help' => array(
                        'style' => 'block',
                        'content' => 'Select the handlers you wish to use for detecting the Locale',
                    ),
                )
            ),
        ));
        
        $locales = array();
        $dataPath = realpath(__DIR__ . '/../../../data/') . '/icudt49l';
        if (file_exists($dataPath . '.dat')) {
            $rawLocales = ResourceBundle::getLocales($dataPath);
            foreach ($rawLocales as $rl) {
                $locales[$rl] = $rl . ' - ' . 
                    \Locale::getDisplayName($rl);
            } 
        }
        
        $localeGroup->add(array(
            'name' => 'allowed',
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'attributes' => array(
                'type' => 'multi_checkbox',
            ),
            'options' => array(
                'value_options' => $locales,
                'label' => 'Locales',
                'bootstrap' => array( // options for bootstrap form
                    'help' => array(
                        'style' => 'block',
                        'content' => 'Select the Locales that you wish to allow',
                    ),
                )
            ),
        ));
        
        $actions = new Fieldset('actions');
        $actions->setAttribute('class', 'form-actions');
        $this->add($actions);
        
        $actions->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Save',
                'class' => 'btn btn-primary'
            ),
            'options' => array(
                'bootstrap' => array(
                    'style' => 'inline',
                ),
            ),
        ));
        
        $actions->add(array(
            'name' => 'reset',
            'attributes' => array(
                'type' => 'reset',
                'value' => 'reset',
                'class' => 'btn'
            ),
            'options' => array(
                'bootstrap' => array(
                    'style' => 'inline',
                ),
            ),
        ));
        
    }
}