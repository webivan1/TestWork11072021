<?php

namespace App\DataFixtures;

use App\Model\Quote\Entities\Quote;
use App\Model\Quote\Entities\Values;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $quote = Quote::create(
                new Values\Task('Task ' . $i),
                new Values\Amount(mt_rand(10, 10000) + (mt_rand(0, 99) / 100)),
                new Values\Percentage(mt_rand(0, 100)),
                new Values\Reference($i % 2 === 0 ? 'Some reference text ' . $i : null)
            );

            $manager->persist($quote);
        }

        $manager->flush();
    }
}
