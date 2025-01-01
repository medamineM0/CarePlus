<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    #[Route('/',name:'app_home')]
    public function index(): Response
    {
        return $this->render("home.html.twig");
    }
    #[Route('/dashboard',name:'dashboard')]
    public function signin(): Response
    {
        return $this->render("dashboard.html.twig");
    }
}