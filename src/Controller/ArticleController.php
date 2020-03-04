<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
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
     * @Route("/show/{slug}", name="article_show")
     * @param $slug
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function show($slug, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Article::class);
        /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $slug]);

        if(!$article->getId()){
            throw $this->createNotFoundException(sprintf('This article no exist!'));
        }


        $comments = [
            'Hi',
            'Uhh',
            'Cool!'
        ];

        if($slug == 'hey'){
//            $slack->sendMessage('John Doe', 'Hi Andrew, have a new idea!!!');
        }

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
