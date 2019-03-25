<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/24/19
 * Time: 11:06 AM
 */

namespace CoreBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Customers")
 */
class Customers
{
    /**
     * @ORM\Id
     * @ORM\Column(name="uuid", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", name="firstName", nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="lastName", nullable=true)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfBirth", type="datetime", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Status")
     * @ORM\JoinColumn(name="status", referencedColumnName="id", nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var \CoreBundle\Entity\Products
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Products", mappedBy="customer")
     */
    private $products;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->createdAt->setTimezone(new \DateTimeZone('GMT'));
        $this->products = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return Customers
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return Customers
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     * @return Customers
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
        $this->dateOfBirth->setTimezone(new \DateTimeZone('GMT'));
        return $this;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     * @return Customers
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Customers
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime $deletedAt
     * @return Customers
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * @return Products
     */
    public function getProducts()
    {
        return $this->products;
    }
}