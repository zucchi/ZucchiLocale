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
use Zend\Session\Container as SessionContainer;
use Zucchi\Debug\Debug;

/**
 * Parse Session for locale identified
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiLocale
 * @subpackage Handler
 *
 */
class Session extends AbstractHandler
{
    /**
     * test for locale in session
     * 
     * @param MvcEvent $event
     * @return Ambigous <boolean, string>
     */
    public function bootstrap(MvcEvent $event)
    {
        $session = new SessionContainer(self::LOCALE_KEY);
        if (isset($session[self::LOCALE_KEY])) {
            return $this->lookup($session[self::LOCALE_KEY]);
        }
        return null;
    }
    
    /**
     * store locale in session
     * 
     * @param string $locale
     */
    public function store($locale)
    {
        if ($locale) {
            $session = new SessionContainer(self::LOCALE_KEY);
            $session[self::LOCALE_KEY] = $locale;
        }
    }
}