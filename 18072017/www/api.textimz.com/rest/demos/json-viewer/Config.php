<?php
/**
 * restifydb - expose your databases as REST web services in minutes
 *
 * @copyright (C) 2015 Daniel CHIRITA
 * @version 1.1
 * @author Daniel CHIRITA <daniel.chirita at gmail dot com>
 * @link https://restifydb.com/
 *
 * This file is part of restifydb demos.
 *
 * @license https://restifydb.com/#license
 *
 */

class Config
{

    private static $config = array(
        'resourceUID' => 'a01',
        'proxy' => array(
            'enabled' => false,
            'host' => '10.200.0.10',
            'port' => 8080,
            'user' => '',
            'password' => ''
        ),
        'restifyPath' => 'http://restify-local:99/'
    );

    public static function getConfig()
    {
        return self::$config;
    }
}

?>