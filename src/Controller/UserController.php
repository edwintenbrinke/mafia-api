<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class UserController
 * @Route("/user")
 * @author Edwin ten Brinke <edwin.ten.brinke@extendas.com>
 */
class UserController extends BaseController
{
    /**
     * @Route("/profile", name="user_profile", methods={"GET"})
     * @param SerializerInterface $serializer
     * @param UserRepository      $user_repository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getProfile(SerializerInterface $serializer, UserRepository $user_repository)
    {
        $user = $user_repository->find(1);
        return $this->jsonResponse(
            $serializer,
            $user_repository->findProfileForOne($user),
            parent::SERIALIZE_PUBLIC
        );
    }
}
