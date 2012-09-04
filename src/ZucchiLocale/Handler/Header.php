<?php
/**
 * ZucchiLocale (http://zucchi.co.uk/)
 *
 * @link      http://github.com/zucchi/ZucchiLocale for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zucchi Limited (http://zucchi.co.uk)
 * @license   http://zucchi.co.uk/legals/bsd-license New BSD License
 */
namespace ZucchiLocale\Handler;

use Zend\Mvc\MvcEvent;
use Locale;
use Zucchi\Debug\Debug;

/**
 * Parse headers for locale identifier
 * 
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiLocale
 * @subpackage Handler
 *
 */
class Header extends AbstractHandler
{
    /**
     * test for locale in request headers
     * 
     * @param MvcEvent $event
     * @return Ambigous <boolean, string>
     */
    public function bootstrap(MvcEvent $event)
    {
        $app = $event->getApplication();
        $request = $event->getRequest();
        $headers = $request->getHeaders();
        
        if ($headers->has('Accept-Language')) {
            $locales = $headers->get('Accept-Language')->getPrioritized();

            foreach ($locales as $locale) {
                $locale = $locale->getLanguage();
                if ($match = $this->lookup($locale)) {
                    return $match;
                }
            }
        }
        return null;
    }
}