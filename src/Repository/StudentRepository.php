<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }


    // public function getAllStudents()
    // {
    //     $query =  $this->createQueryBuilder('s')
    //         ->select('s, u')
    //         ->Join('s.user', 'u')
    //         ->orderBy('s.id', 'ASC')
    //         ->getQuery()
    //         ->getArrayResult();

    //     dump($query);
    //     return $query;
    // }

    public function getStudentWithDaily($userId)
    {
        $query =  $this->createQueryBuilder('s')
            ->select('s, d')
            ->leftJoin('s.dailies', 'd')
            ->andWhere('s.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult();

        foreach ($query as &$user) {


            $data = [];
            foreach ($user['dailies'] as $daily) {
                $data[$daily['date']->format('Y-m-d')] = $daily;
            }
            unset($user['dailies']);
            $user['dailies'] = $data;
        }
        return $query;
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */

    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('s')
    //         ->andWhere('s.id = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('s.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }


    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
