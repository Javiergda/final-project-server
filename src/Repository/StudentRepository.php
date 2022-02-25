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

    public function getStudentWithDailyByDate($date)
    {
        $query =  $this->createQueryBuilder('s')
            ->select('s, d')
            ->leftJoin('s.dailies', 'd', 'WITH', $this->createQueryBuilder('sd')->expr()->eq('d.date', ':date'))
            ->setParameter('date', $date)
            ->getQuery()
            ->getArrayResult();

        foreach ($query as &$student) {
            $student['birth_date'] = $student['birth_date']->format('Y-m-d');
        }

        return $query;
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
}
