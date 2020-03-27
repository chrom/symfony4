<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixture extends BaseFixtures implements DependentFixtureInterface
{
    const COMMENT_NUMBER = 100;

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Comment::class, self::COMMENT_NUMBER, function (Comment $comment) {
            $comment->setAuthorName($this->faker->name);
                $comment->setContent($this->faker->boolean ? $this->faker->paragraph : $this->faker->sentence(2, true));
                $comment->setArticle($this->getRandomReference(Article::class));
                $comment->setCreatedAt($this->faker->dateTimeBetween('-1 months', '-1 seconds'));

        });

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            ArticleFixtures::class,
            ];
    }
}
