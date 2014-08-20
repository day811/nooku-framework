<?php
/**
 * Nooku Framework - http://nooku.org/framework
 *
 * @copyright   Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/nooku-framework for the canonical source repository
 */

/**
 * Identifier Translator Locator
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Koowa\Library\Translator\Locator\Identifier
 */
abstract class KTranslatorLocatorIdentifier extends KTranslatorLocatorAbstract
{
    /**
     * Locate the translation based on a physical path
     *
     * @param  string $url       The translation url
     * @param  string $locale    The locale to search for
     * @return string  The real file path for the translation
     */
    public function locate($url, $locale)
    {
        $result     = array();
        $identifier = $this->getIdentifier($url);

        $info   = array(
            'url'     => $identifier,
            'locale'  => $locale,
            'path'    => '',
            'domain'  => $identifier->getDomain(),
            'package' => $identifier->getPackage(),
        );

        return $this->find($info);
    }
}
