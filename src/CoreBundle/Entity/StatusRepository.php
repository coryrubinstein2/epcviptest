<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/24/19
 * Time: 11:14 PM
 */

namespace CoreBundle\Entity;
use Doctrine\ORM\EntityRepository;


class StatusRepository extends EntityRepository
{
    public function findOneByType($type)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.type = :type')
            ->setParameter('type', $type)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}