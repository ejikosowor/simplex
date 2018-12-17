<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Simplex\Listeners\ResponseEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->view('index.html.twig');
    }

    public function login()
    {
        return $this->view('login.html.twig');
    }
}