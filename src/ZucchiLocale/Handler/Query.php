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

/**
 * Parse $_GET string for locale identifier
 * #
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiLocale
 * @subpackage Handler
 *
 */
class Query extends AbstractHandler
{
    /**
     * test for locale in $_GET
     * 
     * @param MvcEvent $event
     * @return Ambigous <boolean, string>
     */
    public function bootstrap(MvcEvent $event)
    {
        $allowed = $this->config['allowed'];
        if (isset($_GET[self::LOCALE_KEY])
        ){
            return $this->lookup($_GET[self::LOCALE_KEY]);
        } 
    }
}