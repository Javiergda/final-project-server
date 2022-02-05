<?php

namespace App\Controller\Api;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/student")
 */
class StudentController extends AbstractController
{

    private $em;
    private $studentRepository;

    public function __construct(EntityManagerInterface $em, StudentRepository $studentRepository)
    {
        $this->em = $em;
        $this->studentRepository = $studentRepository;
    }

    /**
     * @Route("", methods={"GET"})
     */
    public function list(Request $request)
    {
        $students = $this->studentRepository->findBy([], ['id' => 'DESC']);

        $result = [];
        foreach ($students as $student) {
            $result[] = [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'surname' => $student->getSurname(),
                'user_email' => $student->getUserEmail(),
                'birth_date' => $student->getBirthDate(),
                'phone1' => $student->getPhone1(),
                'phone2' => $student->getPhone2(),
                'letter' => $student->getLetter(),
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

        $student = new Student();
        $student->setName($content['name']);
        $student->setSurname($content['surname']);
        $student->setUserEmail($content['user_email']);
        $student->setBirthDate($content['birth_date']);
        $student->setPhone1($content['phone1']);
        $student->setPhone2($content['phone2']);
        $student->setLetter($content['letter']);

        $this->em->persist($student);
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
    //     $student = $this->studentRepository->find($id);

    //     return new JsonResponse([
    //         'id' => $student->getId(),
    //         'name' => $student->getName(),
    //         'surname' => $student->getSurname(),
    //         'user_email' => $student->getuserEmail(),
    //         'birth_date' => $student->getBirthDate(),
    //         'phone1' => $student->getPhone1(),
    //         'phone2' => $student->getPhone2(),
    //         'letter' => $student->getLetter(),

    //     ]);
    // }

    /**
     * @Route("/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        $content = json_decode($request->getContent(), true);
        $student = $this->studentRepository->find($id);

        if (isset($content['name'])) {
            $student->setName($content['name']);
        }
        if (isset($content['surname'])) {
            $student->setSurname($content['surname']);
        }
        if (isset($content['user_email'])) {
            $student->setUserEmail($content['user_email']);
        }
        if (isset($content['birth_date'])) {
            $student->setBirthDate($content['birth_date']);
        }
        if (isset($content['phone1'])) {
            $student->setPhone1($content['phone1']);
        }
        if (isset($content['phone2'])) {
            $student->setPhone2($content['phone2']);
        }
        if (isset($content['letter'])) {
            $student->setPhone2($content['letter']);
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
        $student = $this->studentRepository->find($id);
        $this->em->remove($student);
        $this->em->flush();

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }
}
