<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

/**
 * Composer Class Locator
 *
 * Proxy calls to the Composer Autoloader through Composer\Autoload\ClassLoader::findFile().
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Loader
 */
class KClassLocatorComposer extends KClassLocatorAbstract
{
    /**
     * The type
     *
     * @var string
     */
    protected $_type = 'composer';

    /**
     * The composer loader
     *
     * @var \Composer\Autoload\ClassLoader
     */
    protected $_loader = null;

    /**
     * Constructor
     *
     * @param array $config Array of configuration options.
     */
    public function __construct($config = array())
    {
        if(isset($config['vendor_path']))
        {
            if(file_exists($config['vendor_path'].'/autoload.php'))
            {
                $this->_loader = require $config['vendor_path'].'/autoload.php';

                //Unregister the loader. Let Nooku proxy class loading
                $this->_loader->unregister();
            }
        }
    }

    /**
     * Get the path based on a class name
     *
     * @param  string $class     The class name
     * @param  string $basepath  The base path
     * @return string|false   Returns canonicalized absolute pathname or FALSE of the class could not be found.
     */
    public function locate($class, $basepath = null)
    {
        $path = false;

        if($this->_loader) {
            $path = $this->_loader->findFile($class);
        }

        return $path;
    }
}