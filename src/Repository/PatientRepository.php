<?php

namespace App\Repository;

use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Patient>
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    //    /**
    //     * @return Patient[] Returns an array of Patient objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findByName(string $query): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.nomPatient LIKE :query')
            ->orWhere('b.prenomPatient LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByCNI(string $query): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.cni LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function filter(?string $query){
        $patients = $this->findAll();
        if(isset($query) && trim($query) !== '') {
            return array_filter($patients, function (Patient $patient) use ($query) {
        return str_contains($patient->getNomPatient(), $query) || str_contains($patient->getPrenomPatient(), $query);});
        }
        return $patients;
    }
}