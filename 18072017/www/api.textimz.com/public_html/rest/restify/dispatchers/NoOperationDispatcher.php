<?php
/**
 * restifydb - expose your databases as REST web services in minutes
 *
 * @copyright (C) 2015 Daniel CHIRITA
 * @version 1.1
 * @author Daniel CHIRITA <daniel.chirita at gmail dot com>
 * @link https://restifydb.com/
 *
 * This file is part of restifydb framework.
 *
 * @license https://restifydb.com/#license
 *
 */


namespace restify\dispatchers;

use restify\exceptions\Exceptions;
use restify\exceptions\RestifyException;

class NoOperationDispatcher implements Dispatcher
{

    public function dispatch()
    {
        throw new RestifyException(Exceptions::$ERROR_NO_ACTION);
    }
}