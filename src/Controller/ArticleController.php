<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
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
    public function show(Article $article, CommentRepository $commentRepository)
    {
//        $comments = $article->getComments();
//        $comments = $commentRepository->findBy(['article' => $article]);
        return $this->render('article/show.html.twig', [
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
    public function toggleArticleHeard(Article $article, LoggerInterface $logger, EntityManagerInterface $entityManager)
    {
        $article->incrementHeartCount();
        $logger->info('Hard counter was increase.');
        $entityManager->flush();


        return $this->json(['hearts' => $article->getHeartCount()]);
    }
}
