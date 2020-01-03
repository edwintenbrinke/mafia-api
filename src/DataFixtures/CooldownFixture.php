<?php

namespace App\DataFixtures;

use App\Entity\Cooldown;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CooldownFixture extends Fixture implements DependentFixtureInterface
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
        $cooldown = new Cooldown();
        $cooldown->setUser($this->getReference(UserFixture::USER));
        $manager->persist($cooldown);

        $cooldown = new Cooldown();
        $cooldown->setUser($this->getReference(UserFixture::USER.'2'));
        $manager->persist($cooldown);
        $manager->flush();
    }
}
