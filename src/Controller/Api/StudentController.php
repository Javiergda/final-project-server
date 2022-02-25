<?php

namespace App\Controller\Api;

use App\Entity\Daily;
use App\Entity\Student;
use App\Entity\User;
use App\Repository\DailyRepository;
use App\Repository\StudentRepository;
use App\Repository\UserRepository;
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
    public function list()
    {
        $students = $this->studentRepository->findBy([], ['id' => 'DESC']);

        $result = [];
        foreach ($students as $student) {
            $result[] = [
                'id' => $student->getId(),
                'name' => $student->getName(),
                'surname' => $student->getSurname(),
                'user_id' => $student->getUser()->getId(),
                'birth_date' => $student->getBirthDate()->format('Y-m-d'),
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
    public function add(Request $request, UserRepository $userRepository)
    {
        $content = json_decode($request->getContent(), true);
        $student = new Student();

        // instanciamos a user para obtener/comprobar si id existe
        $student->setUser($userRepository->findOneBy(['id' => $content['user_id']]));
        $student->setName($content['userName']);
        $student->setSurname($content['surname']);
        $student->setBirthDate(\DateTime::createFromFormat('Y-m-d', $content['birth_date']));
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
     * @Route("/{userId}", methods={"GET"})
     */
    public function findByDailyStudent($userId)
    {
        return new JsonResponse($this->studentRepository->getStudentWithDaily($userId));
    }

    /**
     * @Route("/current/{date}", methods={"GET"})
     */
    public function findByDailyStudentByDate($date)
    {
        return new JsonResponse($this->studentRepository->getStudentWithDailyByDate($date));
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        $content = json_decode($request->getContent(), true);
        $student = $this->studentRepository->find($id);

        if (isset($content['userName'])) {
            $student->setName($content['userName']);
        }
        if (isset($content['surname'])) {
            $student->setSurname($content['surname']);
        }
        if (isset($content['birth_date'])) {
            $student->setBirthDate(\DateTime::createFromFormat('Y-m-d', $content['birth_date']));
        }
        if (isset($content['phone1'])) {
            $student->setPhone1($content['phone1']);
        }
        if (isset($content['phone2'])) {
            $student->setPhone2($content['phone2']);
        }
        if (isset($content['letter'])) {
            $student->setLetter($content['letter']);
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
