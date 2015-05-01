<?php
/**
 * Nooku Framework - http://nooku.org/framework
 *
 * @copyright   Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/nooku-framework for the canonical source repository
 */


/**
 * Class ComKoowaRouterRouter
 *
 * This class will intercept the parse
 */
class ComKoowaRouterRouter extends KObject
{

    /**
     * @param $router
     * @param JUri $uri
     */
    public function build($router, JUri $uri)
    {

        $query = $uri->getQuery(true);

        if(isset($query['option']))
        {
            $component = str_replace('com_', '', $query['option']);
            // this should be more agnostic
            $domain = JFactory::getApplication()->isSite() ? 'site' : 'admin';

            $identifier = $this->getIdentifier()->toArray();

            $identifier['domain'] = $domain;
            $identifier['package'] = $component;
            $identifier['path'] = array('dispatcher');

            $str_identifier = 'com://' . $domain .'/'. $component .'.dispatcher.router';

            $manager = $this->getObject('manager');

            $parts = array($identifier['type'], $identifier['package']);
            $parts = array_merge($parts, $identifier['path']);
            $parts[] = 'Router';

            $class = KStringInflector::implode($parts);

            // has been bootstrapped OR class is defined exists
            $enabled = $manager->hasIdentifier($str_identifier) OR (class_exists($class));

            if($enabled)
            {
                if($this->getConfig($identifier)->get('prefix_component', true))
                {
                    $segments[] = 'component';
                }

                $segments[] = $component;

                $identifier['path'] = array('dispatcher', 'router', 'rule');
                $identifier['name'] = 'build';
                // do the parsing

                $segments = array_merge($segments, $this->getObject($identifier)->execute($query));

                unset($query['option']);

                $uri->setPath(implode('/', $segments));

                $uri->setQuery($query);
            }

        }

    }

}