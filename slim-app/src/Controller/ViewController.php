<?php
namespace FARMER\SlimApp\Controller;

use Jenssegers\Blade\Blade;
use Slim\Psr7\Response;

abstract class ViewController {

    public function render(Response $response, $view, $data) {
        global $container;

        /** @var Blade $blade */
        $blade = $container->get('Blade');

        $response->getBody()->write($blade->make($view, $data)->render());
        return $response;
    }
}