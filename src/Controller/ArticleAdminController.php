<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new", name="article_new")
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws \Exception
     */
    public function new(EntityManagerInterface $entityManager)
    {

        $contentData = "
 **Spicy jalapeno bacon ipsum dolor amet veniam shank in dolore. Ham hock nisi
    landjaeger cow,
    lorem proident beef ribs aute enim veniam ut cillum pork chuck picanha. Dolore
    reprehenderit
    labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod
    dolore cow
    turkey shank eu pork belly meatball non cupim.**

*Laboris beef [ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore] velit ea ball
    tip.* Pariatur
    laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua
    shoulder,
    capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur
    ham. Adipisicing
    picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground
    round doner incididunt
    occaecat lorem meatball prosciutto quis strip steak.

Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger
    enim strip steak
    mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt
    in filet mignon
    strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem
    shoulder tail consectetur
    cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim
    capicola irure pancetta chuck
    **fugiat**.

Sausage tenderloin officia jerky nostrud. Laborum elit pastrami non, pig kevin
    buffalo minim ex quis. Pork belly
    pork chop officia anim. Irure tempor leberkas kevin adipisicing cupidatat qui
    buffalo ham aliqua pork belly
    exercitation eiusmod. Exercitation incididunt rump laborum, t-bone short ribs
    buffalo ut shankle pork chop
    bresaola shoulder burgdoggen fugiat. Adipisicing nostrud chicken consequat beef
    ribs, quis filet mignon do.
    Prosciutto capicola mollit shankle aliquip do dolore hamburger brisket turducken
    eu.

Do mollit deserunt prosciutto laborum. Duis sint tongue quis nisi. Capicola qui beef
    ribs dolore pariatur.
    Minim strip steak fugiat nisi est, meatloaf pig aute. Swine rump turducken nulla
    sausage. Reprehenderit pork
    belly tongue alcatra, shoulder excepteur in beef bresaola duis ham bacon eiusmod.
    Doner drumstick short loin,
    adipisicing cow cillum tenderloin.";
        $article = new Article();
        $article->setTitle('Why asteroids Taste like bacon')
            ->setSlug(sprintf("why-asteroid-taste-like-bacon-%d", rand(1, 100)))
            ->setContext($contentData);

        $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $article->setCreatedAt(new \DateTime());

        $entityManager->persist($article);
        $entityManager->flush();
        return new Response(sprintf('This is done. ID: %d slug: %s', $article->getId(), $article->getSlug()));
    }
}
