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

include_once(dirname(__FILE__) . '/fw/UIController.php');
include_once(dirname(__FILE__) . '/fw/Utils.php');

class Error extends UIController
{

    function __construct()
    {
        $uiConfig = new UIConfig();
        $uiConfig->scriptName = 'error';
        $uiConfig->templatePath = 'templates/error.php';

        parent::__construct($uiConfig);
    }

    protected function _prepareMoreDataModel()
    {
    }
}

$ctrl = new Error();
$ctrl->render();
?>