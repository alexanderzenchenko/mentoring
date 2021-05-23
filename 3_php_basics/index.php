<?php
require_once 'vendor\autoload.php';

use Controllers\IndexContorller;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$uri = $request->getPathInfo();

$indexController = new IndexContorller();

switch ($uri) {
    case '/':
        $content = $indexController->indexAction($request);
        break;
    case '/analyze-file':
        $content = $indexController->analyzeFileAction($request);
        break;
    case '/analyze-url':
        $content = $indexController->analyzeUrlAction($request);
        break;
    default:
        $content = '';
}

require_once './Templates/layout.php';

?>
