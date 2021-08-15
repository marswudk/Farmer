<?php

use DI\Container;
use Jenssegers\Blade\Blade;

$container = new Container();

$appConfig = require dirname(__FILE__) . '/config.php';
$container->set('AppConfig', $appConfig);

$container->set(PDO::class, function (Container $c) {
    $appConfig = $c->get('AppConfig');

    $host = $appConfig['db.host'];
    $user = $appConfig['db.user'];
    $password = $appConfig['db.password'];
    $port = $appConfig['db.port'];
    $dbName = $appConfig['db.dbName'];

    $pdo = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbName . ';charset=utf8',
        $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
});

//-------------以上不用動到--------------
$container->set('Blade', function (Container $c) {
    $appConfig = $c->get('AppConfig');

    $viewPath = $appConfig['blade']['viewPath'];
    $cachePath = $appConfig['blade']['cachePath'];

    return (new Blade($viewPath, $cachePath));
});

return $container;