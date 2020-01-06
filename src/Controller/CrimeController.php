<?php

namespace App\Controller;

use App\Entity\User;
use App\Helper\Time;
use App\Repository\UserRepository;
use App\Service\CarService;
use App\Service\CrimeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CrimeController
 * @Route("/crime")
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class CrimeController extends BaseController
{
    /**
     * @Route("/standard", name="standard_crime", methods={"POST"})
     * @param CrimeService           $crime
     *
     * @param EntityManagerInterface $em
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function standardCrime(CrimeService $crime, EntityManagerInterface $em)
    {
        /** @var User $user */
        $user = $em->getRepository(User::class)->find(1);
        $user->setExperience(10000);

        // execute crime
        $message = $crime->executeCrime($user);

        $em->flush();

        return new JsonResponse([
            'message' => $message,
            'cooldown' => $user->getCooldown()->getCrime()->format(DATE_ISO8601)
        ]);
    }

    /**
     * @Route("/organized", name="organized_crime", methods={"POST"})
     * @param CrimeService           $crime
     *
     * @param EntityManagerInterface $em
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function organizedCrime(CrimeService $crime, EntityManagerInterface $em)
    {
        /** @var User $user */
        $user = $em->getRepository(User::class)->find(1);
        $user->setExperience(100);

        // execute crime
        $message = $crime->executeOrganizedCrime($user);

        $em->flush();

        return new JsonResponse([
            'message' => $message,
            'cooldown' => $user->getCooldown()->getOrganizedCrime()->format(DATE_ISO8601)
        ]);
    }

    /**
     * @Route("/grand-theft-auto", name="standard_grand_theft_auto", methods={"POST"})
     * @param CrimeService           $crime
     * @param EntityManagerInterface $em
     *
     * @param SerializerInterface    $serializer
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function grandTheftAuto(CrimeService $crime, EntityManagerInterface $em, SerializerInterface $serializer)
    {
        /** @var User $user */
        $user = $em->getRepository(User::class)->find(1);
        $user->setExperience(1000000);

        [$message, $car] = $crime->executeGta($user);

        $em->flush();

        return $this->jsonResponse(
            $serializer,
            [
                'car' => $car,
                'message' => $message,
                'cooldown' => $user->getCooldown()->getGrandTheftAuto()->format(DATE_ISO8601)
            ],
            parent::SERIALIZE_PUBLIC
        );
    }
}
