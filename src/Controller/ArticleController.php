<?php

declare(strict_types=1);


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        return new Response('test!');
    }

    /**
     * @Route("/news/{slug}", name="article_show")
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
            'comments'=> $comments,
            'slug' => $slug
        ]);
//        return new Response(sprintf('Article - %s', $slug));
    }

    /**
     * @Route("/news/{slug}/heard", name="article_toggle_heard", methods={"POST"})
     */
    public function toggleArticleHeard($slug)
    {


//        return new JsonResponse(['hearts' => rand(5, 100)]);
        return $this->json(['hearts' => rand(5, 100)]);
    }
}
