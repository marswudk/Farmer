<?php

ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);
ini_set('always_populate_raw_post_data', -1);
ini_set("memory_limit","2048M");
ini_set("upload_max_filesize","20M");
ini_set("post_max_size","20M");
ini_set('max_execution_time', 180);

error_reporting(E_ALL);
ini_set('display_errors', TRUE);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');

require '../../vendor/autoload.php';
$container = require '../container.php';

$app = \DI\Bridge\Slim\Bridge::create($container);

require '../router.php';

$app->run();