<?php
//Sample
//<editor-fold desc="#FileManagerController">
//$app->post('/files', [\Farmer\SlimApp\Controller\FileManagerController::class, 'uploadFile']);
//$app->get('/files', [\Farmer\SlimApp\Controller\FileManagerController::class, 'getFile']);
//</editor-fold>

//<editor-fold desc="#HomeController">
$app->get('/home', [\FARMER\SlimApp\Controller\HomeController::class, 'getAll']);
//</editor-fold>