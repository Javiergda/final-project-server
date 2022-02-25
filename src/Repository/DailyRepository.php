<?php

namespace App\Repository;

use App\Entity\Daily;
use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Daily|null find($id, $lockMode = null, $lockVersion = null)
 * @method Daily|null findOneBy(array $criteria, array $orderBy = null)
 * @method Daily[]    findAll()
 * @method Daily[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DailyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Daily::class);
    }

    // /**
    //  * @return Daily[] Returns an array of Daily objects
    //  */

    public function getDailyByStudents(Student $student, $filter = null)
    {
        $qb = $this->createQueryBuilder('d')
            ->where('d.student = :student')
            ->setParameter('student', $student);

        $dailies = $qb->getQuery()->execute();
        $data = [];

        foreach ($dailies as $daily) {
            $data[$daily->getDate()->format('Y-m-d')] = [
                'id' => $daily->getId(),
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

        return $data;
    }
}
