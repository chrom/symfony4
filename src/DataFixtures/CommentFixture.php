<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixture extends BaseFixtures
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Comment::class, 100, function (Comment $comment) {


            $comment = new Comment();
            $comment->setAuthorName($this->faker->name)
                ->setContent($this->faker->boolean ? $this->faker->paragraph : $this->faker->sentence(2, true))
                ->setArticle($this->getReference(Article::class . '_0'))
                ->setCreatedAt($this->faker->dateTimeBetween('-1 months', '-1 seconds'));

        });

        $manager->flush();
    }
}
