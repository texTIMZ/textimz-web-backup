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

(function () {
    var config = angular.module("com.countrylicious.config", []);

    config.get = function() {
        return {
            apiUrl: "/api/countrylicious/"
        }
    }
})();