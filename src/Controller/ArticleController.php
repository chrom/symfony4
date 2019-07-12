<?php

declare(strict_types=1);


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return new Response('OMG!');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function news($slug)
    {
        return new Response(sprintf('Article - %s', $slug));
    }
}
