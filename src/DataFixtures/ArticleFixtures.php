<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixtures
{
    private static $articleImages = [
        'asteroid.jpeg',
        'mercury.jpeg',
        'lightspeed.png',
    ];

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(
            Article::class,
            20,
            function (Article $article, $count) use ($manager) {

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
                $article->setAuthor($this->faker->name)
                    ->setHeartCount($this->faker->numberBetween(5, 100))
                    ->setImage($this->faker->randomElement(self::$articleImages))
                    ->setTitle($this->faker->sentence())
                    ->setContext($contentData);

                if ($this->faker->boolean(70)) {
                    $article->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));

                }
                $article->setCreatedAt(new \DateTime());

                $comment1 = new Comment();
                $comment1->setAuthorName($this->faker->name)
                    ->setContent($this->faker->sentence())
                    ->setArticle($article);
                $manager->persist($comment1);

            });
        $manager->flush();
    }
}
