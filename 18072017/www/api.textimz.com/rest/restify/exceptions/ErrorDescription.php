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


namespace restify\exceptions;


class ErrorDescription
{

    private $internalId;
    private $message;
    private $httpCode;

    public function __construct($internalId, $message, $httpCode = 412)
    {
        $this->internalId = $internalId;
        $this->message = $message;
        $this->httpCode = $httpCode;
    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @return mixed
     */
    public function getInternalId()
    {
        return $this->internalId;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }


} 