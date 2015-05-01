<?php
/**
 * Nooku Framework - http://nooku.org/framework
 *
 * @copyright   Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/nooku-framework for the canonical source repository
 */

/**
 * Class ComKoowaRouter
 */
class ComKoowaDispatcherRouter extends KDispatcherRouter
{

    /**
     * @param KHttpUrlInterface $url
     * @return array
     */
    public function parse(KHttpUrlInterface $url)
    {

        $vars = array();

        $identifier = $this->getIdentifier()->toArray();
        $identifier['path'] = array('dispatcher', 'router', 'rule');
        $identifier['name'] = 'parse';
        $segments = explode('/', trim($url->getPath(), '/'));

        if($segments[0] == 'component')
        {
            $segments = array_slice($segments, 2);
        }

        if(count($segments))
        {
            $vars = $this->getObject($identifier)->execute($segments);
        }

        return $vars;
    }
}
