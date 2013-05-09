<?php
/**
 * ZucchiLocale (http://zucchi.co.uk/)
 *
 * @link      http://github.com/zucchi/ZucchiLocale for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zucchi Limited (http://zucchi.co.uk)
 * @license   http://zucchi.co.uk/legals/bsd-license New BSD License
 */
namespace ZucchiLocale\Handler;

use Zend\Mvc\MvcEvent;

/**
 * Parse Route for locale identifier
 * 
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiLocale
 * @subpackage Handler
 *
 */
class Route extends AbstractHandler
{
    /**
     * test for locale in Route
     * 
     * @param MvcEvent $event
     * @return Ambigous <boolean, string>
     */
    public function route(MvcEvent $event)
    {
        $locale = false;
        $routeMatch = $event->getRouteMatch();
        if ($routeMatch) {
            $locale = $this->lookup($routeMatch->getParam(self::LOCALE_KEY, false));
        }
        return $locale;
    }
}