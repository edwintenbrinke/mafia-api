<?php

namespace App\Controller;

use App\Entity\User;
use App\Helper\Time;
use App\Repository\UserRepository;
use App\Service\Crime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CrimeController
 * @Route("/crime")
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class CrimeController extends BaseController
{
    /**
     * @Route("/standard", name="standard_crime", methods={"POST"})
     * @param Crime                  $crime
     *
     * @param EntityManagerInterface $em
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function standardCrime(Crime $crime, EntityManagerInterface $em)
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
     *
     * @Route("/organized", name="organized_crime", methods={"POST"})
     * @param Crime                  $crime
     *
     * @param EntityManagerInterface $em
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function organizedCrime(Crime $crime, EntityManagerInterface $em)
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
}
