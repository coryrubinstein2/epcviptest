<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/24/19
 * Time: 11:06 AM
 */

namespace CoreBundle\Entity;
use ApiBundle\Security\RandomStringGenerator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="CoreBundle\Entity\CustomersRepository")
 * @ExclusionPolicy("all")
 * @ORM\Table(name="Customers")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class Customers
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
    private $uuid;

    /**
     * @ORM\Column(name="username", type="string", length=25, unique=true)
     * @Expose
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @ORM\Column(name="password", type="string", length=64)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(name="email", type="string", length=60, unique=true)
     * @Assert\NotBlank
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(name="apiToken", type="string", length=255)
     */
    private $apiToken;

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
     * @ORM\Column(type="string", name="status")
     */
    private $status = 'new';

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
        $this->apiToken = $this->generateApiToken();
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

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return Customers
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return Customers
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Customers
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param mixed $apiToken
     * @return Customers
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
        return $this;
    }

    public function generateApiToken()
    {
        $generator = new RandomStringGenerator();
        $tokenLength = 32;
        $token = $generator->generate($tokenLength);
        return $token;
    }
}