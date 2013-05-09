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
use Zucchi\Debug\Debug;
use Zend\Session;

/**
 * Parse Cookies for locale identified
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiLocale
 * @subpackage Handler
 *
 */
class Cookie extends AbstractHandler
{
    /**
     * test for locale in cookie
     * 
     * @param MvcEvent $event
     * @return Ambigous <boolean, string>
     */
    public function bootstrap(MvcEvent $event)
    {
        $locale = false;
        $request = $event->getRequest();
        $cookies = $request->getCookie();
        if (isset($cookies[self::LOCALE_KEY])){
            $locale = $this->lookup($cookies[self::LOCALE_KEY]);
        }
        
        return $locale;
    }
    
    /**
     * store locale
     * 
     * @param string $locale
     */
    public function store($locale)
    {
        if ($locale) {
            setcookie(self::LOCALE_KEY,$locale);
        } 
    }
}