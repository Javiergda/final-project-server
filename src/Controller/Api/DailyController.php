<?php

namespace App\Controller\Api;

use App\Entity\Daily;
use App\Entity\Student;
use App\Repository\DailyRepository;
use App\Repository\StudentRepository;
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

    public function findByDailyStudent($userId, EntityManagerInterface $em, Student $student)
    {
        // $dql = 'SELECT stu, dai FROM App\Entity\Student stu LEFT JOIN stu.dailies dai WHERE stu.user = :userId';
        // $query = $em->createQuery($dql)->setParameter('userId', $userId);
        // $students = $query->getResult();

        // $dql = "
        //     SELECT stu, i FROM App\Entity\Student stu
        //     LEFT JOIN stu.id i
        //     WHERE 
        //     (stu.user_id = :userId AND TIMESTAMPDIFF(year,stu.birth_date,NOW()) < 4)
        //     AND
        //     (date = CURDATE() OR date IS NULL)
        // ";
        // $dql = "SELECT stu FROM App\Entity\Student ";

        $dailies = $this->dailyRepository->createQueryBuilder('dai')
            ->select('dai')
            ->leftjoin('dai.student', 'stu')
            ->andWhere('stu.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->execute();


        $result = [];
        foreach ($dailies as $daily) {

            $result[] = [
                'id' => $daily->getId(),
                'id' => $daily->getConent(['id']),
                'breackfast' => $daily->getBreackfast(),
                'lunch1' => $daily->getlunch1(),
                'lunch2' => $daily->getlunch2(),
                'dessert' => $daily->getDessert(),
                'snack' => $daily->getSnack(),
                'bottle' => $daily->getBottle(),
                'diaper' => $daily->getDiaper(),
                'nap' => $daily->getNap(),
                'message' => $daily->getMessage(),
            ];
        }

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
