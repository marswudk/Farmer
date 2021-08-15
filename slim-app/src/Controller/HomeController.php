<?php

namespace FARMER\SlimApp\Controller;

use FARMER\Application\Service\Home\HomeService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use FARMER\SlimApp\Common\ViewController;

class HomeController extends ViewController
{

    /** @var HomeService */
    private $homeService;

    /**
     * HomeController constructor.
     * @param HomeService $homeService
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function getAll(Request $request, Response $response) {

        $name = $this->homeService->getAll();

        return $this->render($response, 'front.home', ['name' => $name]);
    }


}