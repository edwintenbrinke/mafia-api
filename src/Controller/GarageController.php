<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Garage;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GarageController
 * @Route("/garage")
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class GarageController extends BaseController
{
    /**
     * @Route("/cars", name="garage_cars")
     * @param EntityManagerInterface $em
     * @param SerializerInterface    $serializer
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCars(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        /** @var User $user */
        $user = $em->getRepository(User::class)->find(1);

        return $this->jsonResponse(
            $serializer,
            $em->getRepository(Garage::class)->findAllCars($user),
            self::SERIALIZE_PUBLIC
        );
    }

    public function sellCar()
    {

    }

    public function repairCar()
    {

    }
}
