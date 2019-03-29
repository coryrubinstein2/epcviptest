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
use FOS\UserBundle\Model\GroupableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="CoreBundle\Entity\CustomersRepository")
 * @ExclusionPolicy("all")
 * @ORM\Table(name="Customers")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class Customers extends BaseUser  implements UserInterface, \Serializable, GroupableInterface
{
    const STATUS_NEW = "new";
    const STATUS_PENDING = "pending";
    const STATUS_IN_REVIEW = "in review";
    const STATUS_APPROVED = "approved";
    const STATUS_INACTIVE = "inactive";
    const STATUS_DELETED = "deleted";

    /**
     * @ORM\Id
     * @ORM\Column(name="uuid", type="integer")
     * @Expose
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $uuid;

    /**
     * @ORM\Column(type="string", name="firstName", nullable=true)
     * @Expose
     * @Assert\NotBlank
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", name="lastName", nullable=true)
     * @Expose
     * @Assert\NotBlank
     */
    protected $lastName;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateOfBirth", type="datetime", nullable=true)
     */
    protected $dateOfBirth;

    /**
     * @ORM\Column(type="string", name="status")
     * @Assert\NotBlank
     */
    protected $status = 'new';

    /**
     * @var \DateTime
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * @var \CoreBundle\Entity\Products
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Products", mappedBy="customer")
     */
    protected $products;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->products = new ArrayCollection();
        $this->roles = [];
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
     * @return Customers
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