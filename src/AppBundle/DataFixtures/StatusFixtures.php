<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/24/19
 * Time: 5:49 PM
 */

namespace AppBundle\DataFixtures;
use CoreBundle\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    const STATUS = 'status_';

    public function load(ObjectManager $manager)
    {
        $statusTypeArr = ['new', 'pending', 'review', 'approved', 'inactive', 'deleted'];

        foreach ($statusTypeArr as $statusType)
        {
            $status = new Status();
            $status->setType($statusType);
            $manager->persist($status);
            $this->addReference(self::STATUS.$status->getType(), $status);
        }

        $manager->flush();
    }
}