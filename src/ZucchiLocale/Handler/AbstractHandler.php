<?php
/**
 * ZucchiLocale (http://zucchi.co.uk/)
 *
 * @link      http://github.com/zucchi/ZucchiLocale for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zucchi Limited (http://zucchi.co.uk)
 * @license   http://zucchi.co.uk/legals/bsd-license New BSD License
 */
namespace ZucchiLocale\Handler;

use Locale;
/**
 * 
 * @author Matt Cockayne <matt@zucchi.co.uk>
 * @package ZucchiLocale 
 * @subpackage Handler
 */
abstract class AbstractHandler implements HandlerInterface
{
    const LOCALE_KEY = 'locale';
    
    protected $config;
    
    public function setConfig($config)
    {
        $this->config = $config;
    }
    
    public function getConfig()
    {
        return $this->config;
    }
    
    public function lookup($locale)
    {
        $match = Locale::lookup($this->config['allowed'], $locale);
        return $match;
    }
}
?>