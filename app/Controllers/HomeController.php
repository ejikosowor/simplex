<?php

namespace App\Controllers;

use App\Simplex\Listeners\ResponseEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index()
    {
        return 'hello world';
    }
}