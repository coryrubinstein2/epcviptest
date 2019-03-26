<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/26/19
 * Time: 12:31 PM
 */

namespace CoreBundle\Entity;
use Doctrine\ORM\EntityRepository;

class CustomersRepository extends EntityRepository
{
    public function findByNewAndApproved($new, $approved)
    {
        return $this->createQueryBuilder('c')
            ->where('c.status = :new')
            ->orWhere('c.status = :approved')
            ->setParameter('new', $new)
            ->setParameter('approved', $approved)
            ->getQuery()
            ->execute();
    }
}