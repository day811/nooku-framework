<?php
/**
 * Koowa Framework - http://developer.joomlatools.com/koowa
 *
 * @copyright	Copyright (C) 2007 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://github.com/joomlatools/koowa for the canonical source repository
 */

/**
 * Command Mixin Interface
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Command
 */
interface KCommandCallbackInterface
{
    /**
     * Invoke all the registered callback for a specific command
     *
     * @param KCommandInterface   $command  The command
     * @param KObjectInterface    $chain    The target object
     * @return mixed|null If a callback break, returns the break condition. NULL otherwise.
     */
    public function invokeCallbacks(KCommandInterface $command, KObjectInterface $target);

    /**
     * Add a callback
     *
     * If the handler has already been added. It will not be re-added but parameters will be merged. This allows to
     * change or add parameters for existing handlers.
     *
     * @param  	string          $command  The command name to register the handler for
     * @param 	string|Closure  $method   The name of a method or a Closure object
     * @param   array|object    $params   An associative array of config parameters or a KObjectConfig object
     * @throws  InvalidArgumentException If the method does not exist
     * @return  KCommandCallbackAbstract
     */
    public function addCommandCallback($command, $method, $params = array());

    /**
     * Remove a callback
     *
     * @param  	string	$command  The command to unregister the handler from
     * @param 	string	$method   The name of the method to unregister
     * @return  KCommandCallbackAbstract
     */
    public function removeCommandCallback($command, $method);

    /**
     * Set the break condition
     *
     * @param mixed|null $condition The break condition, or NULL to set reset the break condition
     * @return KCommandChain
     */
    public function setBreakCondition($condition);

    /**
     * Get the break condition
     *
     * @return mixed|null   Returns the break condition, or NULL if not break condition is set.
     */
    public function getBreakCondition();
}