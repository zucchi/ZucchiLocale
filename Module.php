<?php
/**
 * ZucchiLocale (http://zucchi.co.uk/)
 *
 * @link      http://github.com/zucchi/ZucchiLocale for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zucchi Limited (http://zucchi.co.uk)
 * @license   http://zucchi.co.uk/legals/bsd-license New BSD License
 */
namespace ZucchiLocale;

use Zend\EventManager\EventInterface;
use Zend\EventManager\StaticEventManager;
use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\MvcEvent;
use Zucchi\Debug\Debug;
use ZucchiLocale\Event\LocaleListener;

/**
 * Module to allow selection and management of Locales to be used with Zucchi ZF2 Modules
 * 
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiLocale 
 * @subpackage Module
 */
class Module implements 
    AutoloaderProviderInterface,
    ConfigProviderInterface
{
    /**
     * (non-PHPdoc)
     * @see \Zend\ModuleManager\Feature\BootstrapListenerInterface::onBootstrap()
     */
    public function init(ModuleManager $moduleManager)
    {
        $events = $moduleManager->getEventManager();
        // attach listeners for locale
//         $events = StaticEventManager::getInstance();
        $listener = new LocaleListener();
        $listener->attach($events);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\ModuleManager\Feature\ConfigProviderInterface::getConfig()
     */
    public function getConfig($env = null)
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
}
