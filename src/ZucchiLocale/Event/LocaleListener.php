<?php
/**
 * ZucchiLocale (http://zucchi.co.uk/)
 *
 * @link      http://github.com/zucchi/ZucchiLocale for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zucchi Limited (http://zucchi.co.uk)
 * @license   http://zucchi.co.uk/legals/bsd-license New BSD License
 */
namespace ZucchiLocale\Event;

use Zend\EventManager\EventCollection;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zucchi\Debug\Debug;
use Locale;

/**
 * Listener to attache locale handlers
 * 
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiLocale
 * @subpackage Event
 */
class LocaleListener // implements ListenerAggregateInterface
{
    /**
     * the found locale
     * @var string
     */
    public $foundLocale;
    
    /**
     * which handler found the locale
     * @var string
     */
    public $foundByHandler;
    
    /**
     * currently registered handlers
     * @var array
     */
    protected $handlers = array();
    
    /**
     * currently registered listeners
     * @var array
     */
    protected $listeners = array();
    
    /**
     * Attach listeners to events
     * @param SharedEventManagerInterface $events
     */
    public function attach(SharedEventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('Zend\Mvc\Application', MvcEvent::EVENT_BOOTSTRAP, array($this, 'detect'), 1000);
        $this->listeners[] = $events->attach('Zend\Mvc\Application', MvcEvent::EVENT_ROUTE, array($this, 'detect'), -1);
        $this->listeners[] = $events->attach('Zend\Mvc\Application', MvcEvent::EVENT_FINISH, array($this, 'store'), -1);
    }
    
    /**
     * remove listeners from events
     * @param SharedEventManagerInterface $events
     */
    public function detach(SharedEventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
    
    /**
     * perform locale detection and set default
     * 
     * @param MvcEvent $e
     */
    public function detect(MvcEvent $e)
    {
        $app = $e->getApplication();
        $sm = $app->getServiceManager();
        $eventName = $e->getName();
        
        if (!$this->handlers) {
            $this->handlers = $sm->get('config')['ZucchiLocale']['locale']['handlers'];
        }
        
        foreach ($this->handlers as $p) {
            $handler = $sm->get($p);
            if (!$this->foundLocale && method_exists($handler, $eventName)) {
                $locale = $handler->{$eventName}($e);
                if ($locale) {
                    $this->foundByHandler = $p;
                    $this->foundLocale = $locale;
                    Locale::setDefault($locale);
                    return;
                }
            }
        }
    }
    
    /**
     * store the current locale
     * 
     * @param MvcEvent $e
     */
    public function store(MvcEvent $e)
    {
        $app = $e->getApplication();
        $sm = $app->getServiceManager();
        
        if (!$this->handlers) {
            $this->handlers = $sm->get('config')['ZucchiLocale']['locale']['handlers'];
        }
        
        foreach ($this->handlers as $p) {
            $handler = $sm->get($p);
            if ($this->foundLocale && method_exists($handler, 'store')) {
                $locale = $handler->store($this->foundLocale);
            }
        }
    }
}