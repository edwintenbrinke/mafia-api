<?php

namespace App\DataFixtures;

use App\Entity\Counter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CounterFixture extends Fixture implements DependentFixtureInterface
{
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            UserFixture::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $counter = new Counter();
        $counter->setUser($this->getReference(UserFixture::USER));
        $manager->persist($counter);
        $manager->flush();
    }
}
