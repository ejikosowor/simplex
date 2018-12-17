<?php

namespace App\Controllers;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{   
    /** @var Environment */
    protected $templating;

    function __construct(Environment $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param string $template
     *
     * @param array $data
     */
    public function view($template, $data = [])
    {
        return $this->templating->render($template, $data);
    }
}