<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Response
     */
    protected $response;

    /**
     * IndexController constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function indexAction()
    {
        $name = $this->request->request->get('name');
        $email = $this->request->request->get('email');
        $useSessionOrCookies = $this->request->request->get('useSessionOrCookies');

        if (isset($name) && isset($email) && isset($useSessionOrCookies)) {
            $this->fillStorage($name, $email, $useSessionOrCookies);
            return $this->showAction();
        }

        return require_once __DIR__ . '/../Templates/index.php';
    }

    /**
     * @return mixed
     */
    public function showAction()
    {
        $session = $this->request->getSession()->all();
        $cookies = $this->request->cookies->all();
        $userIp = $this->request->getClientIp();
        $userAgent = $this->request->server->get('HTTP_USER_AGENT');

        return require_once __DIR__ . '/../Templates/show.php';
    }

    /**
     * @param $name
     * @param $email
     * @param $useSessionOrCookies
     */
    protected function fillStorage($name, $email, $useSessionOrCookies)
    {
        switch ($useSessionOrCookies) {
            case 'session':
                $this->fillSession($name, $email);
                break;
            case 'cookies':
                $this->fillCookies($name, $email);
                break;
        }
    }

    /**
     * @param $name
     * @param $email
     */
    protected function fillSession($name, $email)
    {
        $this->request->getSession()->set('name', $name);
        $this->request->getSession()->set('email', $email);
    }

    /**
     * @param $name
     * @param $email
     */
    protected function fillCookies($name, $email)
    {
        $this->response->headers->setCookie(new Cookie('name', $name));
        $this->response->headers->setCookie(new Cookie('email', $email));
    }
}
