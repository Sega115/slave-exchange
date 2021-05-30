<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findIntersectionIntervals(Order $order): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->leftJoin('o.client', 'oc')
            ->leftJoin('o.slave', 'os');

        if ($order->getStartDate()){
            $queryBuilder->andWhere('o.start_date >= :startDate')
                ->setParameter('startDate', $order->getStartDate()->format('Y-m-d H:i:s'));
        }

        if ($order->getEndDate()){
            $queryBuilder->andWhere('o.end_date <= :endDate')
                ->setParameter('endDate', $order->getEndDate());
        }

        if ($order->getClient() && $order->getClient()->getIsVip()){
            $queryBuilder->andWhere('oc.is_Vip = 1');
        }

        if ($order->getId()){
            $queryBuilder->andWhere('o.id != :id')
                ->setParameter('id', $order->getId());
        }

        if ($order->getSlave()){
            $queryBuilder
                ->andWhere('os.id = :slaveID')
                ->setParameter('slaveID', $order->getSlave()->getId());
        }
        return $queryBuilder;
    }
}
