<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixture extends BaseFixtures
{
    const TAG_NUMBER = 10;

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Tag::class, self::TAG_NUMBER, function (Tag $tag, int $i){
            $tag->setName($this->faker->realText(20));
        });

        $manager->flush();
    }
}
