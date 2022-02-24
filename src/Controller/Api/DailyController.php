<?php

namespace App\Controller\Api;

use App\Entity\Daily;
use App\Entity\Student;
use App\Repository\DailyRepository;
use App\Repository\StudentRepository;
use DateTime;
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
     * @Route("", methods={"GET"})
     */
    public function prueba()
    {
        return new JsonResponse([
            'result' => 'ok',
        ]);
    }



    /**
     * @Route("/{student}", methods={"GET"})
     */

    public function findByDailyStudent(Student $student, Request $request)
    {
        // $dailies = $this->dailyRepository->getDailyWithStudents($userId);
        // $result = [];
        // foreach ($dailies as $daily) {

        //     $result[] = [
        //         'id' => $daily->getId(),
        //         'breackfast' => $daily->getBreackfast(),
        //         'lunch1' => $daily->getlunch1(),
        //         'lunch2' => $daily->getlunch2(),
        //         'dessert' => $daily->getDessert(),
        //         'snack' => $daily->getSnack(),
        //         'bottle' => $daily->getBottle(),
        //         'diaper' => $daily->getDiaper(),
        //         'nap' => $daily->getNap(),
        //         'message' => $daily->getMessage(),
        //     ];
        // }

        return new JsonResponse(
            [
                'dailies' => $this->dailyRepository->getDailyByStudents($student, $request->get('date'))
            ]
        );
    }

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
    public function add(Request $request, StudentRepository $studentRepository)
    {
        $content = json_decode($request->getContent(), true);

        $daily = new Daily();
        // instanciamos a user para obtener/comprobar si id existe
        $daily->setStudent($studentRepository->findOneBy(['id' => $content['student_id']]));


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
            $daily->setDate(\DateTime::createFromFormat('Y-m-d', $content['date']));
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
     * @Route("/{student}", methods={"POST"})
     */
    public function addOrUpdate(Request $request, Student $student)
    {
        $content = json_decode($request->getContent(), true);

        // dump($content);
        // die;
        // student_id y dia de hoy

        $daily = $this->dailyRepository->findOneBy(['student' => $student->getId(), 'date' => new DateTime()]);

        if ($daily) {
            $met = 'update';
        } else {
            $met = 'insert';
        }

        if ($met == 'insert') {
            $daily = new Daily();
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

        if ($met == 'insert') {
            $daily->setDate(new DateTime());
        }



        if (isset($content['absence'])) {
            $daily->setAbsence($content['absence']);
        }

        if ($met == 'insert') {
            $daily->setStudent($student);
            $this->em->persist($daily);
        }
        $this->em->flush();

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        $content = json_decode($request->getContent(), true);


        $daily = $this->dailyRepository->find($id);

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
            $daily->setDate(\DateTime::createFromFormat('Y-m-d', $content['date']));
        }
        if (isset($content['absence'])) {
            $daily->setAbsence($content['absence']);
        }
        $this->em->flush();

        return new JsonResponse([
            'result' => 'ok'
        ]);
    }
}
