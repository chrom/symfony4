<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Services\MarkdownHelper;
use App\Services\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @var bool Not used right now
     */
    private $isDebug;

    /**
     * ArticleController constructor.
     * @param bool $isDebug
     */
    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="app_index")
     */
    public function index(ArticleRepository $repository)
    {
        $articles = $repository->findAllPublishedOrderByNewest();

        return $this->render('article/homepage.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        return new Response('test!');
    }

    /**
     * @Route("/show/{slug}", name="article_show")
     * @param Article $article
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function show(Article $article)
    {
        $comments = [
            'Hi',
            'Uhh',
            'Cool!'
        ];

//          dump($slug, $this);
        return $this->render('article/show.html.twig', [
            'comments'       => $comments,
            'article' => $article
        ]);
//        return new Response(sprintf('Article - %s', $slug));
    }

    /**
     * @Route("/news/{slug}/heard", name="article_toggle_heard", methods={"POST"})
     * @param $slug
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function toggleArticleHeard($slug, LoggerInterface $logger)
    {
        $logger->info($slug);

//        return new JsonResponse(['hearts' => rand(5, 100)]);
        return $this->json(['hearts' => rand(5, 100)]);
    }
}
