<?php

declare(strict_types=1);


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return new Response('OMG!');
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        return new Response('test!');
    }

    /**
     * @Route("/news/{slug}")
     * @param $slug
     * @return Response
     */
    public function news($slug)
    {
        $comments = [
            'Hi', 'Uhh', 'Cool!'
        ];

//        dump($slug, $this);
        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', '', $slug)),
            'comments'=> $comments
        ]);
//        return new Response(sprintf('Article - %s', $slug));
    }
}
