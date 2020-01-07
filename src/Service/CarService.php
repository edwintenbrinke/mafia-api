<?php

namespace App\Service;

use App\Entity\Car;
use App\Entity\User;
use App\Helper\Random;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Car
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class CarService
{
    private $cars;
    private $em;

    public function __construct($cars_config_file, EntityManagerInterface $em)
    {
        $this->cars = json_decode(file_get_contents($cars_config_file));
        $this->em = $em;
    }

    /**
     * @param User $user
     * @param      $rank
     *
     * @return array
     * @throws \Exception
     */
    public function getCar(User $user, $rank)
    {
        // object to array so it can be sorted
        $array_ranks = (array)$rank->gta_class;
        // sort the array
        krsort($array_ranks);

        // check if they get a fancier car
        $car = null;
        $chance = Random::chance();
        foreach ($array_ranks as $key => $gta_class)
        {
            // failsafe
            if (!isset($this->cars->$key))
            {
                continue;
            }

            if ($chance < $gta_class) {

                return $this->createCar($user, $key);
            }

            continue;
        }

        // default car
        return $this->createCar($user, '0');
    }

    /**
     * @param User   $user
     * @param string $key
     *
     * @return array
     * @throws \Exception
     */
    private function createCar(User $user, string $key)
    {
        $car_key = array_rand($this->cars->$key);
        $car_info = $this->cars->$key[$car_key];

        /** @var Car $car */
        $car = Car::createFromJson($car_info);
        $car->setGarage($user->getGarage());

        $this->em->persist($car);

        return ['message ' . $car->getName(), $car];
    }
}
