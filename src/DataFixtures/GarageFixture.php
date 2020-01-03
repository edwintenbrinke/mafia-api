<?php

namespace App\DataFixtures;

use App\Entity\Garage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class GarageFixture extends Fixture implements DependentFixtureInterface
{
    public const GARAGE = 'garage-reference';

    public function load(ObjectManager $manager)
    {
        /** @var \App\Entity\Garage $garage */
        $garage = new Garage();
        $garage->setUser($this->getReference(UserFixture::USER));

        $this->setReference(self::GARAGE, $garage);
        $manager->persist($garage);


        /** @var \App\Entity\Garage $garage */
        $garage = new Garage();
        $garage->setUser($this->getReference(UserFixture::USER.'2'));

        $this->setReference(self::GARAGE.'2', $garage);
        $manager->persist($garage);
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            UserFixture::class,
        ];
    }
}
