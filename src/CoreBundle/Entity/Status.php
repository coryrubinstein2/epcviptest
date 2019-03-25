<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/24/19
 * Time: 11:23 AM
 */

namespace CoreBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CoreBundle\Entity\StatusRepository")
 * @ORM\Table(name="Status")
 */
class Status
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Status
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}