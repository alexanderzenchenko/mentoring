<?php

require_once 'vendor/autoload.php';

use App\Controllers\IndexController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$session->start();

$request = Request::createFromGlobals();
$request->setSession($session);

$response = new Response();
$status = Response::HTTP_OK;

$indexController = new IndexController($request, $response);

$uri = $request->getPathInfo();

if ('/' === $uri) {
    $html = $indexController->indexAction();
} elseif ('/show' === $uri) {
    $html = $indexController->showAction();
} else {
    $html = '<html><body><h1>Page Not Found</h1></body></html>';
    $status = Response::HTTP_BAD_REQUEST;
}

$response->setContent($html);
$response->setStatusCode($status);

$response->send();
