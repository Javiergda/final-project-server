<?php

namespace App\Controller\Api;

use App\Entity\Daily;
use App\Entity\Student;
use App\Repository\DailyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/daily")
 */
class DailyController extends AbstractController
{

    private $em;
    private $dailyRepository;

    public function __construct(EntityManagerInterface $em, DailyRepository $dailyRepository)
    {
        $this->em = $em;
        $this->dailyRepository = $dailyRepository;
    }

    /**
     * @Route("/{userId}", methods={"GET"})
     */

    public function findByDailyStudent($userId, Daily $daily, Student $student)
    {
        $dql = "
            SELECT stu, i FROM App\Entity\Student stu
            LEFT JOIN stu.id i
            WHERE 
            (stu.user_email = :userId AND TIMESTAMPDIFF(year,stu.birth_date,NOW()) < 4)
            AND
            (date = CURDATE() OR date IS NULL)
        ";
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'daily' => $daily,
            'student' => $student
        ]);
        $result = $query->execute();

        return new JsonResponse($result);
    }

    // --- join students + daily --- Para Alumnos(usuario inicia sesion):

    // -> igual que Profesores pero se filtra el email tutor tambien

    // SELECT * FROM students
    // LEFT JOIN daily ON daily.id_student=students.id_student
    // WHERE 
    // (students.email_user='usuario1@gmail.com' AND TIMESTAMPDIFF(year,birth_date,NOW()) < 4) 
    // AND 
    // (date = CURDATE() OR date IS NULL);



    // public function list(Request $request)
    // {
    //     $perfil = $request->query->get('perfil'); // HAY QUE MODIFICARLO --------------------------
    //     if ($perfil == null) {
    //         $usuarios = $this->usuarioRepository->findBy([], ['nombre' => 'ASC']);
    //     } else {
    //         $usuarios = $this->usuarioRepository->findBy(['perfil' => $perfil], ['nombre' => 'ASC']);
    //     }
    //     $resultado = [];
    //     foreach ($usuarios as $usuario) {
    //         $resultado[] = [
    //             'id' => $usuario->getId(),
    //             'email' => $usuario->getEmail(),
    //             'nombre' => $usuario->getNombre()
    //         ];
    //     }
    //     return new JsonResponse($resultado);
    // }

    /**
     * @Route("", methods={"POST"})
     */
    public function add(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $daily = new Daily();
        if (isset($content['student_id'])) {
            $daily->setStudentId($content['student_id']);
        }
        if (isset($content['breackfast'])) {
            $daily->setBreackfast($content['breackfast']);
        }
        if (isset($content['lunch1'])) {
            $daily->setLunch1($content['lunch1']);
        }
        if (isset($content['lunch2'])) {
            $daily->setLunch2($content['lunch2']);
        }
        if (isset($content['dessert'])) {
            $daily->setDessert($content['dessert']);
        }
        if (isset($content['snack'])) {
            $daily->setSnack($content['snack']);
        }
        if (isset($content['bottle'])) {
            $daily->setBottle($content['bottle']);
        }
        if (isset($content['diaper'])) {
            $daily->setDiaper($content['diaper']);
        }
        if (isset($content['nap'])) {
            $daily->setNap($content['nap']);
        }
        if (isset($content['message'])) {
            $daily->setMessage($content['message']);
        }
        if (isset($content['date'])) {
            $daily->setDate($content['date']);
        }
        if (isset($content['absence'])) {
            $daily->setAbsence($content['absence']);
        }

        $this->em->persist($daily);
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
    //     $daily = $this->dailyRepository->find($id);

    //     return new JsonResponse([
    //         'id' => $daily->getId(),
    //         'student_id' => $daily->getStudentId(),
    //         'breackfast' => $daily->getBreackfast(),
    //         'lunch1' => $daily->getLunch1(),
    //         'lunch2' => $daily->getLunch2(),
    //         'dessert' => $daily->getDessert(),
    //         'snack' => $daily->getSnack(),
    //         'bottle' => $daily->getBottle(),
    //         'diaper' => $daily->getDiaper(),
    //         'nap' => $daily->getNap(),
    //         'message' => $daily->getMessage(),
    //         'date' => $daily->getDate(),
    //         'absence' => $daily->getAbsence(),
    //     ]);
    // }

    /**
     * @Route("/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        $content = json_decode($request->getContent(), true);
        $daily = $this->dailyRepository->find($id);

        if (isset($content['student_id'])) {
            $daily->setStudentId($content['student_id']);
        }
        if (isset($content['breackfast'])) {
            $daily->setBreackfast($content['breackfast']);
        }
        if (isset($content['lunch1'])) {
            $daily->setLunch1($content['lunch1']);
        }
        if (isset($content['lunch2'])) {
            $daily->setLunch2($content['lunch2']);
        }
        if (isset($content['dessert'])) {
            $daily->setDessert($content['dessert']);
        }
        if (isset($content['snack'])) {
            $daily->setSnack($content['snack']);
        }
        if (isset($content['bottle'])) {
            $daily->setBottle($content['bottle']);
        }
        if (isset($content['diaper'])) {
            $daily->setDiaper($content['diaper']);
        }
        if (isset($content['nap'])) {
            $daily->setNap($content['nap']);
        }
        if (isset($content['message'])) {
            $daily->setMessage($content['message']);
        }
        if (isset($content['date'])) {
            $daily->setDate($content['date']);
        }
        if (isset($content['absence'])) {
            $daily->setAbsence($content['absence']);
        }
        $this->em->flush();

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     */
    // public function delete($id)
    // {
    //     $daily = $this->dailyRepository->find($id);
    //     $this->em->remove($daily);
    //     $this->em->flush();

    //     return new JsonResponse([
    //         'result' => 'ok'
    //     ]);
    // }
}
