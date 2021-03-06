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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(dirname(__FILE__) . '/tiles/head.php'); ?>
</head>
<body>

<div class="container-fluid wrapper">
    <?php include(dirname(__FILE__) . '/tiles/header.php'); ?>

    <h1>An Exception Has Occurred</h1>

    <ol class="breadcrumb">
        <li><a href="./">Home</a></li>
        <li class="active">Error</li>
    </ol>

    <div class="alert alert-danger">
        There was an error connecting to the restifydb server.
    </div>
    <div class="push"></div>
</div>

<?php include(dirname(__FILE__) . '/tiles/footer.php'); ?>
<?php include(dirname(__FILE__) . '/tiles/scripts.php'); ?>
</body>
</html>