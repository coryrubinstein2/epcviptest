<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/24/19
 * Time: 11:17 AM
 */

namespace CoreBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="CoreBundle\Entity\ProductsRepository")
 * @ORM\Table(name="Products")
 * @ExclusionPolicy("all")
 * @UniqueEntity("issn")
 */
class Products
{
    const STATUS_NEW = "new";
    const STATUS_PENDING = "pending";
    const STATUS_IN_REVIEW = "in review";
    const STATUS_APPROVED = "approved";
    const STATUS_INACTIVE = "inactive";
    const STATUS_DELETED = "deleted";

    /**
     * @ORM\Id
     * @ORM\Column(name="issn", type="string", length=255)
     * @Expose
     * @Assert\NotBlank
     */
    private $issn;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Expose
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", name="status")
     * @Expose
     * @Assert\NotBlank
     */
    private $status = 'new';

    /**
     * @var \DateTime
     * @Expose
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     * @Expose
     */
    private $updatedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     * @Expose
     */
    private $deletedAt;

    /**
     * @var \CoreBundle\Entity\Customers
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Customers")
     * @ORM\JoinColumn(name="customer", referencedColumnName="uuid")
     */
    private $customer;

    public function __construct()
    {
        $this->issn = md5(mt_rand(0,10000000));
        $this->createdAt = new \DateTime();
        $this->createdAt->setTimezone(new \DateTimeZone('GMT'));
    }

    /**
     * @return mixed
     */
    public function getIssn()
    {
        return $this->issn;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Products
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Products
     */
    public function setStatus($status)
    {
        if (!in_array($status, [self::STATUS_NEW, self::STATUS_PENDING, self::STATUS_IN_REVIEW, self::STATUS_APPROVED, self::STATUS_INACTIVE, self::STATUS_DELETED]))
        {
            throw new \Exception("Invalid Status ".$status);
        }

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
     * @param \DateTime $createdAt
     * @return Products
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
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
     * @return Products
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
     * @return Products
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * @return Customers
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customers $customer
     * @return Products
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }
}