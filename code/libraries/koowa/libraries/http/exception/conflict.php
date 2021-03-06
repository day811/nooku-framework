<?php
/**
 * Nooku Framework - http://nooku.org/framework
 *
 * @copyright   Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/nooku-framework for the canonical source repository
 */

/**
 * Conflict Http Exception
 *
 * The write request (PUT, POST, DELETE) has been rejected due conflicting changes made by another client, either to the
 * target resource itself or to a related resource. The server cannot currently complete the request without risking data
 * loss. The client should retry the request after accounting for any changes introduced by other clients.
 *
 * This response may include a Retry-After header indicating the time at which the conflicting edits are expected to
 * complete. Clients should wait until at least this time before retrying the request.
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Http\Exception
 */
class KHttpExceptionConflict extends KHttpExceptionAbstract
{
    protected $code = KHttpResponse::CONFLICT;
}