<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/user")
 */
class UserController extends AbstractController
{

    private $em;
    private $userRepository;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("", methods={"GET"})
     */
    public function list(Request $request)
    {
        $users = $this->userRepository->findBy([], ['id' => 'DESC']);

        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'email' => $user->getEmail(),
                'user_type' => $user->getUserType(),
            ];
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("", methods={"POST"})
     */
    public function add(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $user = new User();
        $user->setName($content['name']);
        $user->setSurname($content['surname']);
        $user->setEmail($content['email']);
        $user->setPassword($content['password']);
        $user->setUsertype($content['user_type']);

        $this->em->persist($user);
        $this->em->flush();

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */

    // public function detail($id)
    // {
    //     $user = $this->userRepository->find($id);

    //     return new JsonResponse([
    //         'id' => $user->getId(),
    //         'name' => $user->getName(),
    //         'surname' => $user->getSurname(),
    //         'email' => $user->getEmail(),
    //         'user_type' => $user->getUsertype()
    //     ]);
    // }

    /**
     * @Route("/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        $content = json_decode($request->getContent(), true);
        $user = $this->userRepository->find($id);

        if (isset($content['name'])) {
            $user->setName($content['name']);
        }
        if (isset($content['surname'])) {
            $user->setSurname($content['surname']);
        }
        if (isset($content['email'])) {
            $user->setEmail($content['email']);
        }
        if (isset($content['password'])) {
            $user->setPassword($content['password']);
        }
        if (isset($content['user_type'])) {
            $user->setUsertype($content['user_type']);
        }
        $this->em->flush();

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $user = $this->userRepository->find($id);
        $this->em->remove($user);
        $this->em->flush();

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }
}
