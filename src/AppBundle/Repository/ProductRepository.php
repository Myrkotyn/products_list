<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function search($search)
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('p.name', ':search'),
                    $qb->expr()->like('p.price', ':search')
                )
            )
            ->setParameter('search', "%$search%")
            ->getQuery()
            ->getResult();
    }

    public function productsByCategory($categoryId)
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
            ->join('p.categories', 'c')
            ->andWhere(
                $qb->expr()->eq('c.id', ':categoryId')
            )
            ->setParameter('categoryId', $categoryId)
            ->getQuery()
            ->getResult();

//        @todo recursive query for improve performance
    }
}