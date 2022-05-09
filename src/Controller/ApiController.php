<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ApiController extends AbstractController
{
    function index()
    {

        return $this->render('swagger.html.twig');
    }
}