<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/26/19
 * Time: 10:08 PM
 */

namespace CoreBundle\Entity;
use Doctrine\ORM\EntityRepository;


class ProductsRepository extends EntityRepository
{
    public function findByPendingStatusFromDate($pending, $date)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.status = :pending')
            ->andWhere('p.updatedAt < :date')
            ->setParameter('pending', $pending)
            ->setParameter('date', $date)
            ->getQuery()
            ->execute();
    }
}