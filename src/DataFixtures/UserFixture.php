<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public const USER = 'user-reference';

    public function load(ObjectManager $manager)
    {
        /** @var \App\Entity\User $user */
        $user = new User();
        $user->setExperience(100);
        $user->setCash(100);
        $user->setBank(1000);

        $this->setReference(self::USER, $user);
        $manager->persist($user);

        /** @var \App\Entity\User $user */
        $user = new User();
        $user->setExperience(100);
        $user->setCash(100);
        $user->setBank(1000);

        $this->setReference(self::USER.'2', $user);
        $manager->persist($user);
        $manager->flush();
    }
}
